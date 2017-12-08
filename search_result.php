<?php
session_start();

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$search = $_GET['keyword'];
$date = $_GET['date'];
$search_list = array();
$places = array();
echo($date);

$kidquery = "SELECT * FROM `keyword` WHERE `keyword` LIKE '%$search%'";//kid찾기
$result1 = mysqli_query($conn, $kidquery);
$i=0;

while ($row1 = mysqli_fetch_assoc($result1)){
    echo ("  kid: ".$row1['kid']);
    $pidquery = "SELECT * FROM `pkrelation` WHERE `kid` = ".$row1['kid']." ORDER BY `super_offset` DESC";//pid 찾기
    $result2 = mysqli_query($conn, $pidquery);
    echo "  pid들: ";
    while($row2 = mysqli_fetch_assoc($result2)){
        if($date!=null) {//날짜 입력 시
            $calquery = "SELECT * FROM `pcalendar` WHERE `available_dates` LIKE '%$date%'";
            $calresult = mysqli_query($conn, $calquery);
            $cal = mysqli_num_rows($calresult);
            if ($cal != 0) {//해당 날짜가 available dates에 있으면 다음 쿼리 진행
                echo(" " . $row2['pid'] . " ");
                $sidquery = "SELECT * FROM `posting` WHERE `pid` = " . $row2['pid'];//sid 찾기
                $result3 = mysqli_query($conn, $sidquery);
                $row3 = mysqli_fetch_assoc($result3);

                $memquery = "SELECT * FROM `member` WHERE `sid` = " . $row3['lantern_sid'];
                $result4 = mysqli_query($conn, $memquery);
                $row4 = mysqli_fetch_assoc($result4);

                $requery = "SELECT * FROM `review` WHERE `receiver_sid` = " . $row3['lantern_sid'];
                $reresult = mysqli_query($conn, $requery);
                $reresult2 = mysqli_query($conn, $requery);
                $reviewscounter = mysqli_num_rows($reresult);
                if ($reviewscounter != 0) {
                    $total = 0;
                    while ($row5 = mysqli_fetch_assoc($reresult2)) {
                        $total = $total + $row5['rate'];
                    }
                    $averagescore = $total / $reviewscounter;
                    $averagescore = round($averagescore);
                }

                array_push($search_list, array(
                    "pid" => $row2['pid'],
                    "sid" => $row3['lantern_sid'],
                    "name" => $row4['name_first'] . " " . $row4['name_last'],
                    "reviewscounter" => $reviewscounter,
                    "rate" => $averagescore,
                    "keyword" => $row1['keyword']
                ));

                if ($row1['geo_offset'] == 1) {
                    array_push($places, array(
                        kid => $row1['kid'],
                        keyword => $row1['keyword'],
                        location => $row1['geo_location'],
                        address => $row1['geo_address'],
                        name => $row1['geo_name']
                    ));
                }
                $i++;

            }
        }else{//날짜 미입력 시 전체검색
            echo (" ".$row2['pid']." ");
            $sidquery = "SELECT * FROM `posting` WHERE `pid` = ".$row2['pid'];//sid 찾기
            $result3 = mysqli_query($conn, $sidquery);
            $row3 = mysqli_fetch_assoc($result3);

            $memquery = "SELECT * FROM `member` WHERE `sid` = ".$row3['lantern_sid'];//멤버정보 찾기
            $result4 = mysqli_query($conn, $memquery);
            $row4 = mysqli_fetch_assoc($result4);

            $requery = "SELECT * FROM `review` WHERE `receiver_sid` = ".$row3['lantern_sid'];//리뷰찾기
            $reresult = mysqli_query($conn, $requery);
            $reresult2 = mysqli_query($conn, $requery);
            $reviewscounter = mysqli_num_rows($reresult);
            if($reviewscounter!=0){
                $total = 0;
                while ($row5 = mysqli_fetch_assoc($reresult2)) {
                    $total = $total + $row5['rate'];
                }
                $averagescore = $total / $reviewscounter;
                $averagescore = round($averagescore);
            }

            array_push($search_list,array(
                "pid" => $row2['pid'],
                "sid" => $row3['lantern_sid'],
                "name" => $row4['name_first']." ".$row4['name_last'],
                "reviewscounter" => $reviewscounter,
                "rate" => $averagescore,
                "keyword" => $row1['keyword']
            ));

            if($row1['geo_offset']==1){
                array_push($places,array(
                    kid => $row1['kid'],
                    keyword => $row1['keyword'],
                    location=>$row1['geo_location'],
                    address=>$row1['geo_address'],
                    name=> $row1['geo_name']
                ));
            }
            $i++;

        }



    }
    echo "  /////  ";
}
if($i==0){
    echo ("<script>alert('검색결과가 없습니다'); location.href='./index.php';</script>");
}
?>
<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Lantern</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/colors/main.css" id="colors">

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container
    ================================================== -->
    <header id="header-container" class="fixed fullwidth">

        <!-- Header -->
        <?php include 'header.php';?>
        <!-- Header / End -->

    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->


    <!-- Content
    ================================================== -->
    <div class="fs-container">

        <div class="fs-inner-container content">
            <div class="fs-content">

                <section class="listings-container margin-top-30">
                    <!-- Sorting / Layout Switcher -->
                    <div class="row fs-switcher">

                        <div class="col-md-6">
                            <!-- Showing Results -->
                            <p class="showing-results"><?php echo count($search_list);?> Results Found </p>
                        </div>

                    </div>


                    <!-- Listings -->
                    <div class="row fs-listings">

                        <?php
                        foreach ($search_list as $item){
                            print "
                            <!-- Listing Item -->
                        <div class=\"col-lg-12 col-md-12\">
                            <div class=\"listing-item-container list-layout\" data-marker-id=\"1\" style='height: auto;'>
                                <a href=\"posting_view.php?pid=".$item['pid']."\" class=\"listing-item\">

                                    <!-- Image -->
                                    <div class=\"listing-item-image\">
                                        <img src=\"./profile_img/".$item['sid'].".png\" alt=\"\">
                                    </div>

                                    <!-- Content -->
                                    <div class=\"listing-item-content\">
                                        <div class=\"listing-item-inner\">
                                            <h3>".$item['name']."</h3>
                                            <span>Keyword '".$item['keyword']."' </span>
                                            <div class=\"star-rating\" data-rating=\"".$item['rate']."\">
                                                <div class=\"rating-counter\">(".$item['reviewscounter']." reviews)</div>
                                            </div>
                                        </div>

                                        <span class=\"like-icon\"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                            ";
                        }
                        ?>
                    </div>
                    <!-- Listings Container / End -->

                </section>

            </div>
        </div>
        <div class="fs-inner-container map-fixed">

            <!-- Map -->
            <div id="map-container">
                <div id="map" data-map-zoom="10" data-map-scroll="true">
                    <!-- map goes here -->
                </div>
            </div>

        </div>
    </div>


</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="scripts/jpanelmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="scripts/infobox.min.js"></script>
<script type="text/javascript" src="scripts/markerclusterer.js"></script>
<?php include 'map.php';?>


</body>
</html>
