<?php
session_start();
if($_SESSION['user_sid'] == NULL){
    echo("<script> document.location.href='http://223.195.109.38/lanternproject/index.php';</script>");
}
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$query1 = "SELECT * FROM `member` WHERE `sid` ='$_SESSION[user_sid]'";
$result = mysqli_query($conn, $query1);
$user = mysqli_fetch_assoc($result);
echo("");
?>
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
        <div id="header" class="not-sticky">
            <div class="container">

                <!-- Left Side Content -->
                <div class="left-side">

                    <!-- Logo -->
                    <div id="logo">
                        <a href="index.php"><img src="images/logo00.png" alt=""></a>
                        <a href="index.php" class="dashboard-logo"><img src="images/logo2.png" alt=""></a>
                    </div>

                    <!-- Mobile Navigation -->
                    <div class="menu-responsive">
                        <i class="fa fa-reorder menu-trigger"></i>
                    </div>

                    <!-- Main Navigation -->
                    <nav id="navigation" class="style-1">
                        <ul id="responsive">

                            <li><a href="#">Home</a>
                                <ul>
                                    <li><a href="index.php">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                </ul>
                            </li>

                            <li><a href="#">Listings</a>
                                <ul>
                                    <li><a href="#">List Layout</a>
                                        <ul>
                                            <li><a href="listings-list-with-sidebar.html">With Sidebar</a></li>
                                            <li><a href="listings-list-full-width.html">Full Width</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Grid Layout</a>
                                        <ul>
                                            <li><a href="listings-grid-with-sidebar-1.html">With Sidebar 1</a></li>
                                            <li><a href="listings-grid-with-sidebar-2.html">With Sidebar 2</a></li>
                                            <li><a href="listings-grid-full-width.html">Full Width</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Half Screen Map</a>
                                        <ul>
                                            <li><a href="listings-half-screen-map-list.html">List Layout</a></li>
                                            <li><a href="listings-half-screen-map-grid-1.html">Grid Layout 1</a></li>
                                            <li><a href="listings-half-screen-map-grid-2.html">Grid Layout 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="listings-single-page.html">Single Listing</a></li>
                                </ul>
                            </li>

                            <li><a class="current" href="#">User Panel</a>
                                <ul>
                                    <li><a href="dashboard.html">Dashboard</a></li>
                                    <li><a href="dashboard-messages.html">Messages</a></li>
                                    <li><a href="dashboard-my-listings.html">My Listings</a></li>
                                    <li><a href="dashboard-reviews.html">Reviews</a></li>
                                    <li><a href="dashboard-bookmarks.html">Bookmarks</a></li>
                                    <li><a href="dashboard-add-listing.html">Add Listing</a></li>
                                    <li><a href="dashboard-my-profile.html">My Profile</a></li>
                                    <li><a href="dashboard-invoice.html">Invoice</a></li>
                                </ul>
                            </li>

                            <li><a href="#">Pages</a>
                                <ul>
                                    <li><a href="pages-blog.html">Blog</a>
                                        <ul>
                                            <li><a href="pages-blog.html">Blog</a></li>
                                            <li><a href="pages-blog-post.html">Blog Post</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="pages-contact.html">Contact</a></li>
                                    <li><a href="pages-elements.html">Elements</a></li>
                                    <li><a href="pages-pricing-tables.html">Pricing Tables</a></li>
                                    <li><a href="pages-typography.html">Typography</a></li>
                                    <li><a href="pages-404.html">404 Page</a></li>
                                    <li><a href="pages-icons.html">Icons</a></li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->

                <!-- Right Side Content / End -->
                <div class="right-side">
                    <!-- Header Widget -->
                    <div class="header-widget">

                        <!-- User Menu -->
                        <div class="user-menu">
                            <div class="user-name"><span><img src="images/dashboard-avatar.jpg" alt=""></span><?php echo $user['email']?></div>
                            <ul>
                                <li><a href="dashboard.html"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                                <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                                <li><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> My Profile</a></li>
                                <li><a href="index.php"><i class="sl sl-icon-power"></i> Logout</a></li>
                            </ul>
                        </div>

                        <a href="dashboard-add-listing.html" class="button border with-icon">Add Listing <i class="sl sl-icon-plus"></i></a>
                    </div>
                    <!-- Header Widget / End -->
                </div>
                <!-- Right Side Content / End -->

            </div>
        </div>
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
                    <li><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> Add Listing</a></li>
                </ul>

                <ul data-submenu-title="Account">
                    <li class="active"><a href="dashboard-my-profile.html"><i class="sl sl-icon-user"></i> My Profile</a></li>
                    <li><a href="logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
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
                        <h2>My Profile</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>My Profile</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Profile -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Profile Details</h4>
                        <div class="dashboard-list-box-static">
                            <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
                            <script type="text/javascript">
                                $(function() {
                                    $("#service_image").on('change', function(){
                                        readURL(this);
                                    });
                                });

                                function readURL(input) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#profile_img_area').attr('src', e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }


                            </script>

                            <script type="text/javascript">
                                $(document).ready(function() {

                                    $("#profilephoto").submit( function(e){
                                        e.preventDefault();

                                        var datas, xhr;

                                        datas = new FormData();
                                        datas.append( 'service_image', $( '#service_image' )[0].files[0] );

                                        $.ajax({
                                            url: './profilephoto.php', //업로드할 url
                                            contentType: 'multipart/form-data',
                                            type: 'POST',
                                            data: datas,
                                            dataType: 'json',
                                            mimeType: 'multipart/form-data',

                                            error : function (jqXHR, textStatus, errorThrown) {
                                                alert('ERRORS: ' + textStatus);
                                            },
                                            cache: false,
                                            contentType: false,
                                            processData: false
                                        });
                                    });

                                });

                            </script>
                            <form id="profilephoto" method="post" class="profile" enctype="multipart/form-data" action="./profilephoto.php">

                            <!-- Avatar -->
                            <div class="edit-profile-photo">
                                <img id="profile_img_area" src="./profile_img/<?php echo $_SESSION[user_sid]?>.png" alt="">
                                <div class="change-photo-btn">
                                    <div class="photoUpload">
                                        <span><i class="fa fa-upload"></i> SELECT PHOTO</span>
                                        <input id="service_image" name="service_image"  type="file" class="upload" />
                                    </div>
                                </div>
                            </div>

                                <button type="submit" class="button margin-top-15">PROFILE PHOTO UPLOAD</button>

                            </form>
                            <button onclick="refreshPage()" class="button margin-top-15 cancel-button">CANCEL</button>
                            <script>
                                function refreshPage(){
                                    window.location.reload();
                                }
                            </script>

                            <form method="post" class="profile" action="./profileupdate.php">
                            <!-- Details -->
                            <div class="my-profile">

                                <label>Your Name</label>
                                <input value="<?php echo $user['name_first']." ".$user['name_last']?>" type="text" readonly>

                                <label>Email</label>
                                <input value="<?php echo $user['email']?>" type="text" readonly>

                                <label>Phone Number</label>
                                <input value="" type="text" name="phone_num" id="phone_num" >

                                <label>Which Country You Live</label>
                                <input value="" type="text" name="region" id="region" >

                                <label>School / Work</label>
                                <input value="" type="text" name="career" id="career" >

                                <label>Describe Yourself</label>
                                <textarea name="intro" id="intro" cols="30" rows="10"></textarea>

                                <script>
                                    function nullCheck(info){
                                        if(info==="NULL" || info==="null" || info==="" || !info)
                                            return " ";
                                        else
                                            return info;
                                    }
                                    document.getElementById('phone_num').value = nullCheck("<?php echo $user['phone_num']?>");
                                    document.getElementById('region').value = nullCheck("<?php echo $user['region']?>");
                                    document.getElementById('career').value = nullCheck("<?php echo $user['career']?>");
                                    document.getElementById('intro').value = nullCheck("<?php echo $user['intro']?>");
                                </script>

<!--                                <label><i class="fa fa-twitter"></i> Twitter</label>-->
<!--                                <input placeholder="https://www.twitter.com/" type="text">-->
<!---->
<!--                                <label><i class="fa fa-facebook-square"></i> Facebook</label>-->
<!--                                <input placeholder="https://www.facebook.com/" type="text">-->
<!---->
<!--                                <label><i class="fa fa-google-plus"></i> Google+</label>-->
<!--                                <input placeholder="https://www.google.com/" type="text">-->
                            </div>

                            <button class="button margin-top-15">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Change Password -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Change Password</h4>
                        <div class="dashboard-list-box-static">

                            <!-- Change Password -->
                            <div class="my-profile">
                                <label class="margin-top-0">Current Password</label>
                                <input type="password">

                                <label>New Password</label>
                                <input type="password">

                                <label>Confirm New Password</label>
                                <input type="password">

                                <button class="button margin-top-15">Change Password</button>
                            </div>

                        </div>
                    </div>
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


</body>
</html>