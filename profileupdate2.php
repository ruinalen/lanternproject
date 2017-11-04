<?php
session_start();
/**
 * Created by PhpStorm.
 * User: SuhKyung
 * Date: 2017-11-04
 * Time: 오후 3:28
 */

$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$intro = $_POST['intro'];

if(isset($_POST['country'])) {
    $region = $_POST['country'];
}
if(isset($_POST['lang1'])) {
    $lang1 = $_POST['lang1'];
}
if(isset($_POST['lang_f1'])) {
    $lang_f1 = $_POST['lang_f1'];
}
if(isset($_POST['lang2'])) {
    $lang2 = $_POST['lang2'];
}
if(isset($_POST['lang_f2'])) {
    $lang_f2 = $_POST['lang_f2'];
}
if(isset($_POST['lang3'])) {
    $lang3 = $_POST['lang3'];
}
if(isset($_POST['lang_f3'])) {
    $lang_f3 = $_POST['lang_f3'];
}
if(isset( $_SESSION['user_sid'])) {
    $sid =  $_SESSION['user_sid'];
}
//$region = $_POST['country'];
//$lang1 = $_POST['lang1'];
//$lang_f1 = $_POST['lang_f1'];
//$lang2 = $_POST['lang2'];
//$lang_f2 = $_POST['lang_f2'];
//$lang3 = $_POST['lang3'];
//$lang_f3 = $_POST['lang_f3'];

//$sid = $_SESSION['user_sid'];

echo $lang2.$lang_f2.$lang3.$lang_f3;


$sql = "UPDATE member SET intro = '$intro', region = '$region', lang1 = '$lang1', lang_f1 = $lang_f1, lang2 = '$lang2', lang_f2 = $lang_f2, lang3 = '$lang3', lang_f3 = $lang_f3 where sid=$sid";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    echo "
        <script type='text/javascript'>
            alert('수정 완료');
            //location.href='http://223.195.109.38/lanternproject/profile.php';
        </script>
        ";
} else {
    echo "Error updating record: " . $conn->error;
    echo "
        <script type='text/javascript'>
            alert('다시 시도 하세요');
            //location.href='http://223.195.109.38/lanternproject/index.php';
        </script>
        ";
}


