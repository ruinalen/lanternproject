<?php

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$keyword = $_GET['search'];
$kidquery = "SELECT * FROM `keyword` WHERE `keyword` LIKE '".$keyword."'; ";//kid찾기
$result = mysqli_query($conn, $kidquery);
$row = mysqli_fetch_assoc($result);
print ("<script>alert(".$row['kid'].");</script>");
if($row['kid']==null){
    print ("<script>alert('검색결과가 없습니다');</script>");
}else{
    $pidquery="SELECT * FROM `pkrelation` WHERE `kid` = ".$row['kid'];//pid 찾기
    $result = mysqli_query($conn, $pidquery);
    $row = mysqli_fetch_assoc($result);
    print ("<script>alert(".$row['pid'].");</script>");
    $sidquery="SELECT * FROM `posting` WHERE `pid` = ".$row['pid'];//pid 찾기
    $sidresult = mysqli_query($conn, $sidquery);
    $sidrow = mysqli_fetch_assoc($sidresult);
    print ("<script>alert(".$sidrow['lantern_sid'].");</script>");
    $resultquery = "SELECT * FROM `member` WHERE `sid` = ".$sidrow['lantern_sid'];
    $resultresult = mysqli_query($conn, $resultquery);
    $resultrow = mysqli_fetch_assoc($resultresult);
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
                            <p class="showing-results"><?php echo $row['pid'];?> Results Found </p>
                        </div>

                    </div>


                    <!-- Listings -->
                    <div class="row fs-listings">

                        <!-- Listing Item -->
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout" data-marker-id="1">
                                <a href="posting_view.php?pid=<?php echo $row['pid'];?>" class="listing-item">

                                    <!-- Image -->
                                    <div class="listing-item-image">
                                        <img src="./profile_img/<?php echo $sidrow['lantern_sid'];?>.png" alt="">
                                    </div>

                                    <!-- Content -->
                                    <div class="listing-item-content">
                                        <div class="listing-item-inner">
                                            <h3><?php print($resultrow['name_last']);
                                                print($resultrow['name_first']);?></h3>
                                            <span></span>
                                            <div class="star-rating" data-rating="4.5">
                                                <div class="rating-counter">(5 reviews)</div>
                                            </div>
                                        </div>

                                        <span class="like-icon"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Listing Item / End -->

<!--                        <!-- Listing Item -->
<!--                        <div class="col-lg-12 col-md-12">-->
<!--                            <div class="listing-item-container list-layout" data-marker-id="3">-->
<!--                                <a href="posting_view.php?pid=1" class="listing-item">-->
<!---
<!--                                    <!-- Image -->
<!--                                    <div class="listing-item-image">-->
<!--                                        <img src="./profile_img/21.png" alt="">-->
<!--                                    </div>-->
<!---->
<!--                                    <!-- Content -->
<!--                                    <div class="listing-item-content">-->
<!---->
<!--                                        <div class="listing-item-inner">-->
<!--                                            <h3>서경 배</h3>-->
<!--                                            <span></span>-->
<!--                                            <div class="star-rating" data-rating="0">-->
<!--                                                <div class="rating-counter">(0 reviews)</div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!---->
<!--                                        <span class="like-icon"></span>--
<!---->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <!-- Listing Item / End -->


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
<?php include 'map_search.php';?>


</body>
</html>
