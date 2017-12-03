<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$keyword = $_POST['keyword'];
$geo_offset = $_POST['geo_offset'];
if(isset($_POST['geo_name'])) {
    $geo_name = $_POST['geo_name'];
}else{
    $geo_name = null;
}
if(isset($_POST['geo_address'])) {
    $geo_address = $_POST['geo_address'];
}else{
    $geo_address = null;
}
if(isset($_POST['geo_location'])) {
    $geo_location = $_POST['geo_location'];
}else{
    $geo_location = null;
}

$query1 = "SELECT * FROM `keyword` WHERE `keyword` ='$keyword'";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);
if(!$row){
    $query2 = "INSERT INTO `lantern`.`keyword` (`keyword`, `geo_offset`, `geo_name`, `geo_address`, `geo_location`)
              VALUES ('$keyword', '$geo_offset','$geo_name','$geo_address', '$geo_location')";
    $data = mysqli_query($conn, $query2);
    $query3 = "SELECT * FROM `keyword` WHERE `keyword` ='$keyword'";
    $result = mysqli_query($conn, $query3);
    $row2 = mysqli_fetch_assoc($result);
    echo json_encode($row2);
}
else{
    echo json_encode($row);
}
//echo json_encode($keyword." /".$geo_location." /".$geo_name." /".$geo_address);

?>