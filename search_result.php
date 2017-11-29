<?php
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
                            <p class="showing-results">3 Results Found </p>
                        </div>

                    </div>


                    <!-- Listings -->
                    <div class="row fs-listings">

                        <!-- Listing Item -->
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout" data-marker-id="1">
                                <a href="posting_view.php?pid=3" class="listing-item">

                                    <!-- Image -->
                                    <div class="listing-item-image">
                                        <img src="./profile_img/31.png" alt="">
                                    </div>

                                    <!-- Content -->
                                    <div class="listing-item-content">
                                        <div class="listing-item-inner">
                                            <h3>Seyeon Kim</h3>
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

                        <!-- Listing Item -->
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout" data-marker-id="2">
                                <a href="listings-single-page.html" class="listing-item">

                                    <!-- Image -->
                                    <div class="listing-item-image">
                                        <img src="./profile_img/33.png" alt="">
                                    </div>

                                    <!-- Content -->
                                    <div class="listing-item-content">

                                        <div class="listing-item-inner">
                                            <h3>Honey Jam</h3>
                                            <span></span>
                                            <div class="star-rating" data-rating="5.0">
                                                <div class="rating-counter">(3 reviews)</div>
                                            </div>
                                        </div>

                                        <span class="like-icon"></span>

                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="col-lg-12 col-md-12">
                            <div class="listing-item-container list-layout" data-marker-id="3">
                                <a href="posting_view.php?pid=3" class="listing-item">

                                    <!-- Image -->
                                    <div class="listing-item-image">
                                        <img src="./profile_img/34.png" alt="">
                                    </div>

                                    <!-- Content -->
                                    <div class="listing-item-content">

                                        <div class="listing-item-inner">
                                            <h3>DongJoon Park</h3>
                                            <span></span>
                                            <div class="star-rating" data-rating="4.0">
                                                <div class="rating-counter">(1 reviews)</div>
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
