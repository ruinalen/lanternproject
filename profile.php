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
<?php include 'header.php';?>
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

                                <label>School / Work</label>
                                <input value="" type="text" name="career" id="career" >

                                <label>Describe Yourself</label>
                                <textarea name="intro" id="intro" cols="30" rows="10"></textarea>

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

                <!-- Change Country and Languages -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Nationality & Languages</h4>
                        <div class="dashboard-list-box-static">

                            <!-- Change Password -->
                            <div class="my-profile">

                                <label>Which Country You Live</label>
                                <input value="" type="text" name="region" id="region" >

                                <label>Languages</label>
                                <div class="switcher-content">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="pricing-list-container">
                                                <tr class="pricing-list-item pattern">
                                                    <td>
                                                        <div class="fm-move"><i class="sl sl-icon-cursor-move"></i></div>
                                                        <div class="fm-input pricing-name"><input type="text" placeholder="Tisdfsdfsdfsdftle" /></div>
                                                        <div class="fm-input pricing-ingredients"><input type="text" placeholder="Description" /></div>
                                                        <div class="fm-input pricing-price"><input type="text" placeholder="Price" data-unit="USD" /></div>
                                                        <div class="fm-close"><a class="delete" href="#"><i class="fa fa-remove"></i></a></div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <a href="#" class="button add-pricing-list-item">Add Item</a>
                                            <a href="#" class="button add-pricing-submenu">Add Category</a>
                                        </div>
                                    </div>

                                </div>

                                <button class="button margin-top-15">Change Password</button>
                            </div>

                        </div>
                    </div>
                </div>

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


                                <!-- Change Password -->
<!--                <div class="col-lg-6 col-md-12">-->
<!--                    <div class="dashboard-list-box margin-top-0">-->
<!--                        <h4 class="gray">Change Password</h4>-->
<!--                        <div class="dashboard-list-box-static">-->
<!---->
<!--                            <!-- Change Password -->-->
<!--                            <div class="my-profile">-->
<!--                                <label class="margin-top-0">Current Password</label>-->
<!--                                <input type="password">-->
<!---->
<!--                                <label>New Password</label>-->
<!--                                <input type="password">-->
<!---->
<!--                                <label>Confirm New Password</label>-->
<!--                                <input type="password">-->
<!---->
<!--                                <button class="button margin-top-15">Change Password</button>-->
<!--                            </div>-->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->


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