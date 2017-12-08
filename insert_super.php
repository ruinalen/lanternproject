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
echo json_encode($keyword);


$query = "UPDATE pkrelation SET super_info = '$super_info' WHERE  `pid` = $pid AND `kid` = (SELECT kid FROM `keyword` WHERE `keyword` ='$keyword')";


if ($conn->query($query) === TRUE) {

} else {
    echo json_encode("Error updating record: " . $conn->erro);
}

?>