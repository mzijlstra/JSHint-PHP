<?php

require_once("HTTP/Request.php");

if (!isset($_GET['uri'])) {
    die('missing uri parameter');
}

if (!preg_match('#http://mumstudents.org/.*#', $_GET['uri'])) {
    die('sorry, only files local to mumstudents.org will be checked');
}

function get($url) {
    $r =& new HTTP_Request($url);
    if (!PEAR::isError($r->sendRequest()) && $r->getResponseCode() == 200) {
        return $r->getResponseBody();
    }
    else return "";
    
}

$js = '';
$src = $_GET['uri'];
$html = get($src);
$dom = new DOMDocument();
$dom->loadHTML($html);

$scriptTags = $dom->getElementsByTagName("script");
foreach ($scriptTags as $tag) {
    if ($tag->getAttribute("src")) {
        $url = $tag->getAttribute("src");
        if (preg_match("#^http://#", $url)) {
        	$js .= get($url) . "\n";
		} else {
			$js .= get($src . $url) . "\n";
		}
    } else {
        $js .= $tag->textContent . "\n";
    }
}

// TODO make a temporary directory, and then place each JS file in that
// that way the output can list the name of the each js file!
// plus the script can delete the directory to clean up after itself

$filename = tempnam("/tmp", "JS_");
file_put_contents($filename, $js);
$out = array();
exec('/usr/local/bin/jshint '. $filename, $out);
$out = preg_replace('#^/tmp/JS_\w{5,10}: (.*)$#', '$1', $out);
exec('rm ' . $filename);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <pre>
<?php if (count($out) === 0): ?>
Yay, all good!
<?php else: ?>
<?php foreach($out as $line): ?>
<?= $line ?>

<?php endforeach ?>
<?php endif ?>
        </pre>
    </body>
</html>
