<?php
// TODO separate into controller / view and cleanly handle die conditions

require_once("HTTP/Request.php");
PEAR::setErrorHandling(PEAR_ERROR_EXCEPTION);

if (!isset($_GET['uri'])) {
    die('missing uri parameter');
}

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
	$src = $_GET['uri'];
	$html = httpGet($src);
	$dom = new DOMDocument();
	$dom->loadHTML($html);
} catch (Exception $e) {
	die($e->getCode() . ' ' . $e->getMessage());
}

// make a temporary directory for the js files
$dirname = tempnam("/tmp", "JS_");
unlink($dirname);
mkdir($dirname);

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
				$js .= httpGet($src . $url);
			}
		} else {
			$js .= trim($tag->textContent);
			$file = 'embedded_' . ++$embID . '.js';
		}
		
		file_put_contents($dirname . '/' . $file, $js);
		exec('/usr/local/bin/jshint '. $dirname . '/' . $file, $res);

		// strip file system info, leaving just file name and message
		$res = preg_replace('#^/tmp/JS_\w{5,10}/(.*)$#', '$1', $res);
		$output[$file] = array('js' => $js, 'result' => $res);
	} catch(Exception $e) {
		$output[$file] = array('js' => $e->getCode(), 
			'result' => array($e->getMessage()));
	} 
}

// clean up temp files
exec('rm -rf ' . $dirname);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
	<?php foreach($output as $file => $out): ?>
		<div><?= $file ?></div>
		<pre><?= $out['js']?></pre>
		<?php if ($out['result']): ?>
			<pre>
<?php foreach ($out['result'] as $line): ?>
<?= $line ?>

<?php endforeach ?></pre>
		<?php else: ?>
		<pre>Yay, all good!</pre>
		<?php endif ?>
	<?php endforeach ?>
    </body>
</html>
