<?php


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
        $query = "INSERT INTO `lantern`.`member` (`sid`, `email`, `passwd`, `name_first`, `name_last`, `region`, `phone_num`, `lantern_offset`, `auth_offset`)
              VALUES (NULL,'$email', '$password1','$name_first','$name_last', '$details->country', 'NULL', '0', '0')";
        echo $query;
        $data = mysqli_query($conn, $query);
        echo $data;

    }
    else{
        echo "
        <script type='text/javascript'>
        alert('이미 가입된 이메일입니다.');
        </script>
        ";
    }
    echo "
            <script type='text/javascript'>
                //location.href='http://223.195.109.38/lanternproject/index.php';
            </script>
            ";


?>