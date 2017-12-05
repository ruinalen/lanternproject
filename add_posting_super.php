<?php
session_start();
$pid = $_SESSION['pid'];
$keywords = $_SESSION['keywords'];
echo var_dump($keywords);
?>

