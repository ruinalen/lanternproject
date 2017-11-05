<?php
session_start();
if($_SESSION['user_sid'] == NULL){
    echo("<script> document.location.href='http://223.195.109.38/lanternproject/index.php';</script>");
}
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$query1 = "SELECT * FROM `member` WHERE `sid` ='$_SESSION[user_sid]'";
$result = mysqli_query($conn, $query1);
$user = mysqli_fetch_assoc($result);?>
<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Listeo</title>
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
                    <li><a href="dashboard-reviews.html"><i class="sl sl-icon-star"></i> Reviews</a></li>
                    <li><a href="dashboard-bookmarks.html"><i class="sl sl-icon-heart"></i> Bookmarks</a></li>
                    <li class="active"><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> Add Listing</a></li>
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
                        <h2>Add Listing</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>Add Listing</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="add_posting???" method="post" id="add-posting-form">
                    <div id="add-listing">

                        <!-- Section -->
                        <div class="add-listing-section">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-doc"></i> Basic Informations</h3>
                            </div>

                            <!-- Title -->
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <h5>About the Lantern<i class="tip" data-tip-content="Please introduce yourself to travelers"></i></h5>
                                    <textarea name="intro" id="intro" cols="30" rows="8"><?php echo $user['intro']?></textarea>
                                </div>
                            </div>

                            <!-- Row -->
                            <div class="row with-forms">

                                <!-- Status -->
                                <div class="col-md-6">
                                    <h5>Language</h5>
                                    <select class="chosen-select-no-single" >
                                        <option label="blank">Select Category</option>
                                        <option>Eat & Drink</option>
                                        <option>Shops</option>
                                        <option>Hotels</option>
                                        <option>Restaurants</option>
                                        <option>Fitness</option>
                                        <option>Events</option>
                                    </select>
                                </div>

                                <!-- Type -->
                                <div class="col-md-6">
                                    <h5>Keywords <i class="tip" data-tip-content="Maximum of 15 keywords related with your business"></i></h5>
                                    <input type="text" placeholder="Keywords should be separated by commas">
                                </div>

                            </div>
                            <!-- Row / End -->

                        </div>
                        <!-- Section / End -->



                        <!-- Section -->
                        <div class="add-listing-section margin-top-45">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="sl sl-icon-book-open"></i> Keywords</h3>
                                <!-- Switcher -->
                                <label class="switch"><input type="checkbox" checked><span class="slider round"></span></label>
                            </div>

                            <!-- Switcher ON-OFF Content -->
                            <div class="switcher-content">

                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="pricing-list-container">
                                            <tr class="pricing-list-item pattern">
                                                <td>
                                                    <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                                                    <div class="fm-input pricing-name"><input type="text" placeholder="Title" /></div>
                                                    <div class="fm-input pricing-ingredients"><input type="text" placeholder="Description" /></div>
                                                    <div class="fm-input pricing-price"><input type="text" placeholder="Price" data-unit="USD" /></div>
                                                    <div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
                                                </td>
                                            </tr>
                                        </table>
                                        <a href="#" class="button add-pricing-list-item">Add Item</a>
                                    </div>
                                </div>

                            </div>
                            <!-- Switcher ON-OFF Content / End -->

                        </div>
                        <!-- Section / End -->


                        <a href="#" class="button preview" onclick="document.getElementById('add-posting-form').submit()" >Preview <i class="fa fa-arrow-circle-right"></i></a>

                    </div>
                    </form>
                </div>

                <!-- Copyrights -->
                <div class="col-md-12">
                    <div class="copyrights">© 2017 Listeo. All Rights Reserved.</div>
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


<!-- Opening hours added via JS (this is only for demo purpose) -->
<script>
    $(".opening-day.js-demo-hours .chosen-select").each(function() {
        $(this).append(''+
            '<option></option>'+
            '<option>Closed</option>'+
            '<option>1 AM</option>'+
            '<option>2 AM</option>'+
            '<option>3 AM</option>'+
            '<option>4 AM</option>'+
            '<option>5 AM</option>'+
            '<option>6 AM</option>'+
            '<option>7 AM</option>'+
            '<option>8 AM</option>'+
            '<option>9 AM</option>'+
            '<option>10 AM</option>'+
            '<option>11 AM</option>'+
            '<option>12 AM</option>'+
            '<option>1 PM</option>'+
            '<option>2 PM</option>'+
            '<option>3 PM</option>'+
            '<option>4 PM</option>'+
            '<option>5 PM</option>'+
            '<option>6 PM</option>'+
            '<option>7 PM</option>'+
            '<option>8 PM</option>'+
            '<option>9 PM</option>'+
            '<option>10 PM</option>'+
            '<option>11 PM</option>'+
            '<option>12 PM</option>');
    });
</script>

<!-- DropZone | Documentation: http://dropzonejs.com -->
<script type="text/javascript" src="scripts/dropzone.js"></script>


</body>
</html>
