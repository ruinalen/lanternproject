<?php
/**
 * Created by PhpStorm.
 * User: donghyunkim
 * Date: 2017. 10. 28.
 * Time: PM 9:50
 */


    $conn = mysqli_connect('localhost','lantern','lantern','lantern');
    $name_first = $_POST['name_first'];
    $name_last = $_POST['name_last'];
    $email = $_POST['email'];
    $password1 = $_POST['password1'];


    $query = "INSERT INTO `lantern`.`member` (`sid`, `email`, `passwd`, `name_first`, `name_last`, `region`, `lang`, `phone_num`, `lantern_offset`, `auth_offset`) 
              VALUES (NULL,'$email', '$password1','$name_first','$name_last', 'NULL', 'NULL', 'NULL', '0', '0')";
    echo $query;


    echo "됬냐";
    $data = mysqli_query($conn, $query);
    echo $data;
?>