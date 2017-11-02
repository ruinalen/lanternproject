<?php
session_start();
/**
 * Created by PhpStorm.
 * User: SuhKyung
 * Date: 2017-10-30
 * Time: 오후 6:03
 */
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$email = $_POST['email'];
$password = $_POST['password'];

$query1 = "SELECT * FROM `member` WHERE `email` ='$email'";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);
if(!$row){
    echo "회원가입 되지 않은 이메일입니다.";
}else{
        if(strcmp($row['passwd'] ,$password)){
            echo "비밀번호가 일치하지 않습니다";
        }
        else{

            $_SESSION['user_sid'] = $row['sid'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_name_first'] = $row['name_first'];
            $_SESSION['user_name'] = $row['name_first'].$row['name_last'];
            $_SESSION['user_photo'] = $row['photo'];
        }
}

echo "
<script type='text/javascript'>
location.href='http://223.195.109.38/lanternproject/index.php';
</script>
";
