<?php
/**
 * Created by PhpStorm.
 * User: 김동현
 * Date: 2017-12-07
 * Time: 오전 3:12
 */
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$name_first = $_GET['search'];
$kidquery = "SELECT * FROM `keyword` WHERE `keyword` LIKE 'gangnam'; ";//kid찾기
$result = mysqli_query($conn, $kidquery);
$row = mysqli_fetch_assoc($result);
$pidquery="SELECT * FROM `pkrelation` WHERE `kid` = ".$row['kid'];//pid 찾기
$result = mysqli_query($conn, $pidquery);
$row = mysqli_fetch_assoc($result);
$sidquery="SELECT * FROM `posting` WHERE `pid` = ".$row['pid'];//pid 찾기
$sidresult = mysqli_query($conn, $sidquery);
$sidrow = mysqli_fetch_assoc($sidresult);
print($sidrow['lantern_sid']);
?>
