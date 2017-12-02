<?php
    $conn = mysqli_connect('localhost','lantern','lantern','lantern');
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $lantern_sid = $_POST['Lantern_sid'];
    $traveler_sid = $_POST['Traveler_sid'];
    $writer_name = $_POST['writer_name'];


    $query = "INSERT INTO `lantern`.`review` (`rvid`,`receiver_sid`, `writer_sid`, `receiver_type`, `rate`, `comment`, `write_date`, `writer_name`) VALUES (NULL, $lantern_sid,$traveler_sid,0,$rating, '$comment', NOW(), '$writer_name')";
    echo $query;
    $data = mysqli_query($conn, $query);

echo "
            <script type='text/javascript'>
                alert('리뷰 등록 완료');
                location.href='http://223.195.109.38/lanternproject/posting_view.php';
            </script>
            ";
?>