<?php
// TODO work with uri's ending in .js 
// TODO rework it so we can highlight multiple columns in one line

require_once("HTTP/Request.php");
PEAR::setErrorHandling(PEAR_ERROR_EXCEPTION);

function httpGet($url) {
	if (!preg_match('#^http://mumstudents.org/.*$#', $url)) {
		throw new DomainException('Sorry, only files local to mumstudents.org '
			. 'will be checked');
	}

    $r =& new HTTP_Request($url);
    $r->sendRequest();
	if ($r->getResponseCode() == 200) {
        return $r->getResponseBody();
	} else {
		throw new RuntimeException('Bad reponse from server ' . $url, 
			$r->getResponseCode());
	}
} 
    
try {
	$src = filter_input(INPUT_GET, 'uri', FILTER_VALIDATE_URL); 
	if (!$src) {
		throw new Exception("Missing or invalid uri parameter");
	}
	$html = httpGet($src);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
} catch (Exception $e) {
	$error = $e->getMessage();
	include("error.php");
	exit;
}

// make a temporary directory for the js files
$dirname = tempnam("/tmp", "JS_"); // creates a file not a dir
unlink($dirname); // delete the file
mkdir($dirname); // create the directory

// find and test the different JS files
$output = array();
$embID = 0;
$scriptTags = $dom->getElementsByTagName("script");
foreach ($scriptTags as $tag) {
	$js = '';
	$file = 'error.js';
	$res = array();
	try {
		if ($tag->getAttribute("src")) {
			$url = $tag->getAttribute("src");
			$file = basename($url);
			if (preg_match("#^(http:)?//#", $url)) {
				$js .= httpGet($url);
			} else {
				$path = preg_replace("#/[\w.]*$#", "/", $src);
				$js .= httpGet($path . $url);
			}
		} else {
			$js .= trim($tag->textContent);
			$file = 'embedded_' . ++$embID . '.js';
		}
		
		file_put_contents($dirname . '/' . $file, $js);
		exec('/usr/local/bin/jshint '. $dirname . '/' . $file, $res);

		// strip file system info, leaving just file name and message
		$res = preg_replace('#^/tmp/JS_\w{5,10}/\w+.js: (.*)$#', '$1', $res);

		// create a list of line numbers on which errors were found
		$lines = array();
		foreach ($res as $line) {
			if (preg_match("/^line \d+/", $line)) {
				$nums = preg_replace("/^line (\d+), col (\d+).*$/", "\\1:\\2", $line);
				list($row, $col) = explode(":", $nums);
				$lines[$row] = $col;
			}
		}

		// put it all together in the output map for this file
		$output[$file] = array(
			'js' => explode("\n", $js), 
			'result' => implode("\n", $res), 
			'lines' => $lines
		);
	} catch(Exception $e) {
		$output[$file] = array(
			'js' => false, 
			'result' => $e->getMessage(),
			'lines' => array()
		);
	} 
}

// clean up temp files
exec('rm -rf ' . $dirname);

// show the result view
include('result.php');
?>

