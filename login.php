<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$email = $_POST['email'];
$password = $_POST['password'];

$query1 = "SELECT * FROM `member` WHERE `email` ='$email'";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);
if(!$row){
    echo "
<script type='text/javascript'>
alert('회원가입 되지 않은 이메일입니다.');
</script>
";
}else{
        if(strcmp($row['passwd'] ,$password)){
            echo "
<script type='text/javascript'>
alert('비밀번호가 일치하지 않습니다.');
</script>";
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
