<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$keyword = $_POST['keyword'];
if(isset($_POST['super_info'])) {
    $super_info = $_POST['super_info'];
}else{
    $super_info = null;
}


$pid = $_SESSION['pid'];

$query = "UPDATE pkrelation SET super_info = '$super_info' WHERE  `pid` = $pid AND `kid` = (SELECT `kid` FROM `keyword` WHERE `keyword` ='$keyword')";
//echo json_encode($query);

if ($conn->query($query) === TRUE) {
    echo json_encode($keyword."  update successfully");
} else {
    echo json_encode("Error updating record: " . $conn->erro);
}

?>