<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$phone_num = $_POST['phone_num'];
$region = $_POST['region'];
$career = $_POST['career'];
$intro = $_POST['intro'];
$sid = $_SESSION['user_sid'];


$sql = "UPDATE member SET phone_num = '$phone_num', career = '$career'  WHERE  `sid` = $sid";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    echo "
        <script type='text/javascript'>
            alert('수정 완료');
            location.href='http://223.195.109.38/lanternproject/profile.php';
        </script>
        ";
} else {
    echo "Error updating record: " . $conn->error;
    echo "
        <script type='text/javascript'>
            alert('다시 시도 하세요');
            location.href='http://223.195.109.38/lanternproject/index.php';
        </script>
        ";
}


