<?php
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$rqid = $_POST['rqid'];
$query = "UPDATE request SET state = 2 WHERE  `rqid` = ".$rqid;
if ($conn->query($query) === TRUE) {
    echo $rqid;
}
else {
}

?>