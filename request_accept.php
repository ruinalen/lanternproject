<?php
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

$rqid = $_POST['rqid'];
$update_state = $_POST['update_state'];

    if($update_state==2){
    //수락클릭
        $query2 = "SELECT * FROM request  WHERE  `rqid` = ".$rqid;
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $requestdates = explode(";",$row2['request_dates']);

        $pid = $row2['pid'];
        $query3 = "SELECT * FROM pcalendar  WHERE  `pid` = ".$pid;
        $result3 = mysqli_query($conn, $query3);
        $row3 = mysqli_fetch_assoc($result3);
        $avadates = $row3['available_dates'];
        $reserdates = $row3['reserved_dates'];


        foreach ($requestdates as $request){
            if($request==""){
                break;
            }
            if(strpos($avadates, $request)==false){
                return json_encode("error");
            }
            $req = explode(",", $request);
            $avadates = str_replace($req[0].",","",$avadates);
            $reserdates = $reserdates.$req[0].",";
        }

        $query = "UPDATE pcalendar SET `available_dates` ='$avadates', `reserved_dates` = '$reserdates' WHERE `pid` =$pid";
        $conn->query($query);

    }elseif ($update_state==3){
    //거절클릭
    }

$query = "UPDATE request SET state =".$update_state." WHERE  `rqid` = ".$rqid;
$conn->query($query);


?>