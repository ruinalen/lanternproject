<?php
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$rqid = $_POST['rqid'];
$update_state = $_POST['update_state'];
$query = "UPDATE request SET state =".$update_state." WHERE  `rqid` = ".$rqid;
if ($conn->query($query) === TRUE) {
    if($update_state==2){
    //수락

    }elseif ($update_state==3){
    //거절
    }
}
else {
}

?>