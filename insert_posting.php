<?php
session_start();

$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$intro = $_POST['intro'];

if(isset($_POST['accommodation'])) {
    $accommodation = $_POST['accommodation'];
}else{
    $accommodation = 8;
}
if(isset($_POST['lang1'])) {
    $lang1 = $_POST['lang1'];
}else{
    $lang1 = NULL;
}
if(isset($_POST['lang_f1'])) {
    $lang_f1 = $_POST['lang_f1'];
}else{
    $lang_f1 = 0;
}
if(isset($_POST['lang2'])) {
    $lang2 = $_POST['lang2'];
}else{
    $lang2 = NULL;
}
if(isset($_POST['lang_f2'])) {
    $lang_f2 = $_POST['lang_f2'];
}else{
    $lang_f2 = 0;
}
if(isset($_POST['lang3'])) {
    $lang3 = $_POST['lang3'];
}else{
    $lang3 = NULL;
}
if(isset($_POST['lang_f3'])) {
    $lang_f3 = $_POST['lang_f3'];
}else{
    $lang_f3 = 0;
}
if(isset($_POST['kid'])) {
    $kid = 1;
}else{
    $kid = 0;
}
if(isset($_POST['disabled'])) {
    $disabled = 1;
}else{
    $disabled = 0;
}
if(isset($_POST['ownacar'])) {
    $ownacar = 1;
}else{
    $ownacar = 0;
}
if(isset( $_SESSION['user_sid'])) {
    $sid =  $_SESSION['user_sid'];
}

$keywords = $_POST['keywords_array'];
$keywords2 = $_POST['super_array'];

$superkeywords = "";

for($i=0; $i<sizeof($keywords); $i++){
    if($keywords2[$i]==1) {
        // array_push($superkeywords,$keywords[$i]);
        $superkeywords = $superkeywords.$keywords[$i].",";

    }
}

$available_dates = $_POST['available_dates'];



$sql1 = "UPDATE `lantern`.`member` SET lantern_offset=1, intro = '$intro', lang1 = '$lang1', lang_f1 = $lang_f1, lang2 = '$lang2', lang_f2 = $lang_f2, lang3 = '$lang3', lang_f3 = '$lang_f3' WHERE `sid` = $sid";
$conn->query($sql1);
    $sql2 = "INSERT INTO `lantern`.`posting` (`pid`, `lantern_sid`, `registration_date`, `accommodation`, `kid`, `disabled`, `owncar`)
              VALUES (NULL,'$sid', NOW(),$accommodation,$kid,$disabled,$ownacar)";
    $data = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM `posting` WHERE `lantern_sid` ='$sid' ORDER BY  `pid` DESC";
    $result = mysqli_query($conn, $sql3);
    $row = mysqli_fetch_assoc($result);
    $pid = $row['pid'];

    for ($i=0; $i<sizeof($keywords);$i++){
        $val = $keywords[$i];
        $val2 = $keywords2[$i];
        $sql4 = "INSERT INTO `lantern`.`pkrelation` (`kid`,`pid`,`super_offset`) VALUES ((SELECT `kid` FROM `keyword` WHERE `keyword` ='$val'),$pid,$val2)";
        $data = mysqli_query($conn, $sql4);
//        echo "$sql4";
    }

    $_SESSION['pid']=$pid;
    $_SESSION['superkeywords']=$superkeywords;

    $sql5 = "INSERT INTO `lantern`.`pcalendar` (`pid`, `available_dates`, `reserved_dates`)
              VALUES ($pid,'$available_dates', NULL)";
    $data = mysqli_query($conn, $sql5);




    echo "
        <script type='text/javascript'>
            location.href='http://223.195.109.38/lanternproject/add_posting_super.php';
        </script>
        ";




