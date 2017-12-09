<?php
    include  "Sendmail.php";

    $sendmail = new Sendmail();

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    do{
        $auth = generateRandomString();
        $result = mysqli_query($conn,  "SELECT EXISTS (SELECT * FROM member WHERE auth='$auth')" );
    }while(result==1);

    $conn = mysqli_connect('localhost','lantern','lantern','lantern');
    $name_first = $_POST['name_first'];
    $name_last = $_POST['name_last'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];

    $details = json_decode(file_get_contents("https://ipinfo.io/{$ip}"));

    $query1 = "SELECT * FROM `member` WHERE `email` ='$email'";
    $result = mysqli_query($conn, $query1);
    $row = mysqli_fetch_assoc($result);
    if(!$row){
        echo "없졍";
        $query = "INSERT INTO `lantern`.`member` (`sid`, `email`, `passwd`, `name_first`, `name_last`, `region`, `phone_num`, `lantern_offset`, `auth_offset`, `auth`)
              VALUES (NULL,'$email', '$password1','$name_first','$name_last', '$details->country', 'NULL', '0', '0', '$auth')";
        echo $query;
        $data = mysqli_query($conn, $query);

        $to = "$email";
        $from = "Lantern";
        $subject = "Lantern 이메일 인증입니다.";
        $body = "http://223.195.109.38/lanternproject/auth_mail.php?auth=".$auth;

        $sendmail->send_mail($to, $from, $subject, $body);

        echo "
            <script type='text/javascript'>
                alert('가입 완료');
                location.href='http://223.195.109.38/lanternproject/index.php';
            </script>
            ";

    }
    else{
        echo "
        <script type='text/javascript'>
        alert('이미 가입된 이메일입니다.');
        location.href='http://223.195.109.38/lanternproject/index.php';
        </script>
        ";
    }

