<?php
if (!isset($_SERVER[HTTP_REFERER])) {
    die('missing http referer header');
}

if (!preg_match('#http://mumstudents.org/.*#', $_SERVER['HTTP_REFERER'])) {
    die('sorry, only files local to mumstudents.org will be checked');
}

if (!isset($_POST['jsText'])) {
    die('invalid request, missing jsText parameter');
}
$js .= $_POST['jsText'];

$filename = tempnam("/tmp", "JS_");
file_put_contents($filename, $js);
$out = array();
exec('/usr/local/bin/jshint --config=/var/www/jshint/jshint.rc '. $filename, $out);
unlink($filename);
$out = preg_replace('#^/tmp/JS_\w{5,10}: (.*)$#', '$1', $out);
if (!$out) {
	$out = array('No errors found!');
}
?>

{
    "errors": "<?= $out[count($out) -1] ?>",
    "output": "<?= implode("<br />", $out) ?>"
}
