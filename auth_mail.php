<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$auth = $_GET[auth];

$query1 = "SELECT * FROM `member` WHERE `auth`='$auth'";
$result1 = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result1);
echo var_dump($row);
if($row==null){
    // 다르다
    echo "달라라";
}else{
    // 같다 auth_offset:1 로그인
    $query2 = "UPDATE member SET auth_offset = 1 WHERE  `sid` = ".$row['sid'];
    $conn->query($query2);

    $_SESSION['user_sid'] = $row['sid'];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['user_name_first'] = $row['name_first'];
    $_SESSION['user_name'] = $row['name_first']." ".$row['name_last'];

    echo "<script type='text/javascript'>
                alert('인증 완료');
                location.href='http://223.195.109.38/lanternproject/index.php';
            </script>";

}

?>
