<?php
include  "Sendmail.php";
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$traveler_sid = $_SESSION['user_sid'];
$traveler_name = $_SESSION['user_name'];
$pid =  $_POST['pid'];
$lantern_sid = $_POST['lantern_sid'];
$count = $_POST['request-dates-count'];
$interests = $_POST['interests'];
$comment  = $_POST['comment'];

$datestimes = "";
for($i=0; $i<$count; $i++){
    $rday = $_POST['rday-'.$i];
    $rstart = $_POST['rtime-start-'.$i];
    $rend = $_POST['rtime-end-'.$i];
    $datestimes = $datestimes.$rday.",".$rstart.",".$rend.";";
}


$query = "INSERT INTO `lantern`.`request` (`rqid`,`pid`, `lantern_sid`, `traveler_sid`, `traveler_name`, `request_dates`, `comment`, `interests`, `time_stamp`) 
VALUES (NULL, $pid,$lantern_sid,$traveler_sid,'$traveler_name','$datestimes','$comment', '$interests', NOW())";
mysqli_query($conn, $query);

$query1 = "SELECT * FROM `member` WHERE `sid` =$lantern_sid";
$result = mysqli_query($conn, $query1);
$row = mysqli_fetch_assoc($result);

$sendmail = new Sendmail();
$to = $row['email'];
$from = "Lantern";
$subject = "Lantern 새로운 신청 알림입니다.";
$body = "새로운 신청이 도착했습니다. 지금 바로 확인해 보세요.
http://223.195.109.38/lanternproject/request_list.php
";

$sendmail->send_mail($to, $from, $subject, $body);

echo "
            <script type='text/javascript'>
                alert('신청 완료');
                location.href='http://223.195.109.38/lanternproject/posting_view.php?pid=".$pid."';
            </script>
            ";
?>