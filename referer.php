<?php
if (!isset($_SERVER['HTTP_REFERER'])) {
    die("missing http referer header");
}

header("location: check.php?uri=" . $_SERVER['HTTP_REFERER']);
exit(0);
?>
