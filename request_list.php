<?php
session_start();

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$sid = $_SESSION['user_sid'];

$received_list = array();
$sent_list = array();

$query1 = "SELECT * FROM `request` WHERE `lantern_sid`=$sid";
$result1 = mysqli_query($conn, $query1);
while ($row1 = mysqli_fetch_assoc($result1)) {
    array_push($received_list,$row1);
}

$query2 = "SELECT * FROM `request` WHERE `traveler_sid`=$sid";
$result2 = mysqli_query($conn, $query2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    array_push($sent_list,$row2);
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
    <header id="header-container" class="fixed fullwidth dashboard">

        <!-- Header -->
        <?php include 'header-dashboard.php';?>
        <!-- Header / End -->

    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->


    <!-- Dashboard -->
    <div id="dashboard">

        <!-- Navigation
        ================================================== -->

        <!-- Responsive Navigation Trigger -->
        <a href="#" class="dashboard-responsive-nav-trigger"><i class="fa fa-reorder"></i> Dashboard Navigation</a>

        <div class="dashboard-nav">
            <div class="dashboard-nav-inner">

                <ul data-submenu-title="Main">
                    <li><a href="dashboard.html"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                    <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages <span class="nav-tag messages">2</span></a></li>
                </ul>

                <ul data-submenu-title="Listings">
                    <li><a><i class="sl sl-icon-layers"></i> My Listings</a>
                        <ul>
                            <li><a href="dashboard-my-listings.html">Active <span class="nav-tag green">6</span></a></li>
                            <li><a href="dashboard-my-listings.html">Pending <span class="nav-tag yellow">1</span></a></li>
                            <li><a href="dashboard-my-listings.html">Expired <span class="nav-tag red">2</span></a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="dashboard-reviews.html"><i class="sl sl-icon-star"></i> Reviews</a></li>
                    <li><a href="dashboard-bookmarks.html"><i class="sl sl-icon-heart"></i> Bookmarks</a></li>
                    <li><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> Add Listing</a></li>
                </ul>

                <ul data-submenu-title="Account">
                    <li><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> My Profile</a></li>
                    <li><a href="index.html"><i class="sl sl-icon-power"></i> Logout</a></li>
                </ul>

            </div>
        </div>
        <!-- Navigation / End -->


        <!-- Content
        ================================================== -->
        <div class="dashboard-content">

            <!-- Titlebar -->
            <div id="titlebar">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Requests</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>My Requests</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Listings -->
                <div class="col-lg-6 col-md-12">

                    <div class="dashboard-list-box margin-top-0">

                        <h4>Received Request</h4>

                        <!-- Reply to review popup -->
                        <div id="small-dialog" class="zoom-anim-dialog mfp-hide">
                            <div class="small-dialog-header">
                                <h3>Reply to review</h3>
                            </div>
                            <div class="message-reply margin-top-0">
                                <textarea cols="40" rows="3"></textarea>
                                <button class="button">Reply</button>
                            </div>
                        </div>

                        <ul>

                            <?php
                                foreach ($received_list as $value){
                                    print"<li>
                                <div class=\"comments listing-reviews\">
                                    <ul>
                                        <li>
                                            <div class=\"avatar\"><img src=\"./profile_img/".$value['traveler_sid'].".png\" alt=\"\"></div>
                                            <div class=\"comment-content\"><div class=\"arrow-comment\"></div>
                                                <div class=\"comment-by\">".$value['traveler_name']." <div class=\"comment-by-listing\">on <a href=\"#\">Burger House</a></div> <span class=\"date\">June 2017</span>
                                                    <div class=\"star-rating\" data-rating=\"5\"></div>
                                                </div>
                                                <p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>

                                                <div class=\"review-images mfp-gallery-container\">
                                                    <a href=\"images/review-image-01.jpg\" class=\"mfp-gallery\"><img src=\"images/review-image-01.jpg\" alt=\"\"></a>
                                                </div>
                                                <a href=\"#small-dialog\" class=\"rate-review popup-with-zoom-anim\"><i class=\"sl sl-icon-action-undo\"></i> Reply to this review</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>";
                                }
                            ?>

                        </ul>
                    </div>

                </div>

                <!-- Listings -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4>Request Sent</h4>
                        <ul>

                            <li>
                                <div class="comments listing-reviews">
                                    <ul>
                                        <li>
                                            <div class="avatar"><img src="images/reviews-avatar.jpg" alt="" /> </div>
                                            <div class="comment-content"><div class="arrow-comment"></div>
                                                <div class="comment-by">Your review <div class="comment-by-listing own-comment">on <a href="#">Tom's Restaurant</a></div> <span class="date">May 2017</span>
                                                    <div class="star-rating" data-rating="4.5"></div>
                                                </div>
                                                <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
                                                <a href="#" class="rate-review"><i class="sl sl-icon-note"></i> Edit</a>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <div class="comments listing-reviews">
                                    <ul>
                                        <li>
                                            <div class="avatar"><img src="images/reviews-avatar.jpg" alt="" /> </div>
                                            <div class="comment-content"><div class="arrow-comment"></div>
                                                <div class="comment-by">Your review <div class="comment-by-listing own-comment">on <a href="#">Think Coffee</a></div> <span class="date">May 2017</span>
                                                    <div class="star-rating" data-rating="5"></div>
                                                </div>
                                                <p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
                                                <a href="#" class="rate-review"><i class="sl sl-icon-note"></i> Edit</a>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>


                <!-- Copyrights -->
                <div class="col-md-12">
                    <div class="copyrights">© 2017 Lantern. All Rights Reserved.</div>
                </div>
            </div>

        </div>
        <!-- Content / End -->


    </div>
    <!-- Dashboard / End -->


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


</body>
</html>
