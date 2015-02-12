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

$validator = filter_input(INPUT_POST, 'validator');
if (!$validator) {
    $validator = 'jslint';
}

$filename = tempnam("/tmp", "JS_");
file_put_contents($filename, $js);
$out = array();
if ($validator === 'jshint') {
    exec("/usr/local/bin/jshint --config=/var/www/jshint/jshint.rc $filename", $out, $exit);
    $out = preg_replace('#^/tmp/JS_\w{5,10}: (.*)$#', '$1', $out);
} elseif ($validator === 'jslint') {
    exec("/usr/local/bin/jslint $filename", $out, $exit);
    array_shift($out);
    array_shift($out);
} else {
    $out[] = 'invalid validator selected';
}
unlink($filename);

if ($exit >= 3) {
    $out[] = "internal server error, validator did not execute";
}
if (!$out) {
	$out = array('No errors found!');
}

echo json_encode(array("output" => implode("\n", $out)));
?>

