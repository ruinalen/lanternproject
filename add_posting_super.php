<?php
session_start();
$pid = $_SESSION['pid'];
$keywords = $_SESSION['keywords'];
echo $pid.' / '.$keywords[0].$keywords[1];
?>