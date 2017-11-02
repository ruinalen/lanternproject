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
                                                        <div class="fm-input pricing-name">
                                                            <select class="aachosen-select-no-single">
                                                                    <option label="Language">Select Language</option>
                                                                    <option value="Afrikanns">Afrikanns</option>
                                                                    <option value="Albanian">Albanian</option>
                                                                    <option value="Arabic">Arabic</option>
                                                                    <option value="Armenian">Armenian</option>
                                                                    <option value="Basque">Basque</option>
                                                                    <option value="Bengali">Bengali</option>
                                                                    <option value="Bulgarian">Bulgarian</option>
                                                                    <option value="Catalan">Catalan</option>
                                                                    <option value="Cambodian">Cambodian</option>
                                                                    <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                                                    <option value="Croation">Croation</option>
                                                                    <option value="Czech">Czech</option>
                                                                    <option value="Danish">Danish</option>
                                                                    <option value="Dutch">Dutch</option>
                                                                    <option value="English">English</option>
                                                                    <option value="Estonian">Estonian</option>
                                                                    <option value="Fiji">Fiji</option>
                                                                    <option value="Finnish">Finnish</option>
                                                                    <option value="French">French</option>
                                                                    <option value="Georgian">Georgian</option>
                                                                    <option value="German">German</option>
                                                                    <option value="Greek">Greek</option>
                                                                    <option value="Gujarati">Gujarati</option>
                                                                    <option value="Hebrew">Hebrew</option>
                                                                    <option value="Hindi">Hindi</option>
                                                                    <option value="Hungarian">Hungarian</option>
                                                                    <option value="Icelandic">Icelandic</option>
                                                                    <option value="Indonesian">Indonesian</option>
                                                                    <option value="Irish">Irish</option>
                                                                    <option value="Italian">Italian</option>
                                                                    <option value="Japanese">Japanese</option>
                                                                    <option value="Javanese">Javanese</option>
                                                                    <option value="Korean">Korean</option>
                                                                    <option value="Latin">Latin</option>
                                                                    <option value="Latvian">Latvian</option>
                                                                    <option value="Lithuanian">Lithuanian</option>
                                                                    <option value="Macedonian">Macedonian</option>
                                                                    <option value="Malay">Malay</option>
                                                                    <option value="Malayalam">Malayalam</option>
                                                                    <option value="Maltese">Maltese</option>
                                                                    <option value="Maori">Maori</option>
                                                                    <option value="Marathi">Marathi</option>
                                                                    <option value="Mongolian">Mongolian</option>
                                                                    <option value="Nepali">Nepali</option>
                                                                    <option value="Norwegian">Norwegian</option>
                                                                    <option value="Persian">Persian</option>
                                                                    <option value="Polish">Polish</option>
                                                                    <option value="Portuguese">Portuguese</option>
                                                                    <option value="Punjabi">Punjabi</option>
                                                                    <option value="Quechua">Quechua</option>
                                                                    <option value="Romanian">Romanian</option>
                                                                    <option value="Russian">Russian</option>
                                                                    <option value="Samoan">Samoan</option>
                                                                    <option value="Serbian">Serbian</option>
                                                                    <option value="Slovak">Slovak</option>
                                                                    <option value="Slovenian">Slovenian</option>
                                                                    <option value="Spanish">Spanish</option>
                                                                    <option value="Swahili">Swahili</option>
                                                                    <option value="Swedish ">Swedish </option>
                                                                    <option value="Tamil">Tamil</option>
                                                                    <option value="Tatar">Tatar</option>
                                                                    <option value="Telugu">Telugu</option>
                                                                    <option value="Thai">Thai</option>
                                                                    <option value="Tibetan">Tibetan</option>
                                                                    <option value="Tonga">Tonga</option>
                                                                    <option value="Turkish">Turkish</option>
                                                                    <option value="Ukranian">Ukranian</option>
                                                                    <option value="Urdu">Urdu</option>
                                                                    <option value="Uzbek">Uzbek</option>
                                                                    <option value="Vietnamese">Vietnamese</option>
                                                                    <option value="Welsh">Welsh</option>
                                                                    <option value="Xhosa">Xhosa</option>
                                                                </select>
                                                            </select>
                                                        </div>

                                                        <div class="fm-input pricing-ingredients">
                                                            <select class="chosen-select-no-single" >
                                                                <option label="Fluency">Select Fluency</option>
                                                                <option>1(Poor)</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="fm-input pricing-name">
                                                            <select class="aachosen-select-no-single" >
                                                                <option label="Language">Select Language</option>
                                                                <option value="Afrikanns">Afrikanns</option>
                                                                <option value="Albanian">Albanian</option>
                                                                <option value="Arabic">Arabic</option>
                                                                <option value="Armenian">Armenian</option>
                                                                <option value="Basque">Basque</option>
                                                                <option value="Bengali">Bengali</option>
                                                                <option value="Bulgarian">Bulgarian</option>
                                                                <option value="Catalan">Catalan</option>
                                                                <option value="Cambodian">Cambodian</option>
                                                                <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                                                <option value="Croation">Croation</option>
                                                                <option value="Czech">Czech</option>
                                                                <option value="Danish">Danish</option>
                                                                <option value="Dutch">Dutch</option>
                                                                <option value="English">English</option>
                                                                <option value="Estonian">Estonian</option>
                                                                <option value="Fiji">Fiji</option>
                                                                <option value="Finnish">Finnish</option>
                                                                <option value="French">French</option>
                                                                <option value="Georgian">Georgian</option>
                                                                <option value="German">German</option>
                                                                <option value="Greek">Greek</option>
                                                                <option value="Gujarati">Gujarati</option>
                                                                <option value="Hebrew">Hebrew</option>
                                                                <option value="Hindi">Hindi</option>
                                                                <option value="Hungarian">Hungarian</option>
                                                                <option value="Icelandic">Icelandic</option>
                                                                <option value="Indonesian">Indonesian</option>
                                                                <option value="Irish">Irish</option>
                                                                <option value="Italian">Italian</option>
                                                                <option value="Japanese">Japanese</option>
                                                                <option value="Javanese">Javanese</option>
                                                                <option value="Korean">Korean</option>
                                                                <option value="Latin">Latin</option>
                                                                <option value="Latvian">Latvian</option>
                                                                <option value="Lithuanian">Lithuanian</option>
                                                                <option value="Macedonian">Macedonian</option>
                                                                <option value="Malay">Malay</option>
                                                                <option value="Malayalam">Malayalam</option>
                                                                <option value="Maltese">Maltese</option>
                                                                <option value="Maori">Maori</option>
                                                                <option value="Marathi">Marathi</option>
                                                                <option value="Mongolian">Mongolian</option>
                                                                <option value="Nepali">Nepali</option>
                                                                <option value="Norwegian">Norwegian</option>
                                                                <option value="Persian">Persian</option>
                                                                <option value="Polish">Polish</option>
                                                                <option value="Portuguese">Portuguese</option>
                                                                <option value="Punjabi">Punjabi</option>
                                                                <option value="Quechua">Quechua</option>
                                                                <option value="Romanian">Romanian</option>
                                                                <option value="Russian">Russian</option>
                                                                <option value="Samoan">Samoan</option>
                                                                <option value="Serbian">Serbian</option>
                                                                <option value="Slovak">Slovak</option>
                                                                <option value="Slovenian">Slovenian</option>
                                                                <option value="Spanish">Spanish</option>
                                                                <option value="Swahili">Swahili</option>
                                                                <option value="Swedish ">Swedish </option>
                                                                <option value="Tamil">Tamil</option>
                                                                <option value="Tatar">Tatar</option>
                                                                <option value="Telugu">Telugu</option>
                                                                <option value="Thai">Thai</option>
                                                                <option value="Tibetan">Tibetan</option>
                                                                <option value="Tonga">Tonga</option>
                                                                <option value="Turkish">Turkish</option>
                                                                <option value="Ukranian">Ukranian</option>
                                                                <option value="Urdu">Urdu</option>
                                                                <option value="Uzbek">Uzbek</option>
                                                                <option value="Vietnamese">Vietnamese</option>
                                                                <option value="Welsh">Welsh</option>
                                                                <option value="Xhosa">Xhosa</option>
                                                            </select>
                                                            </select>
                                                        </div>

                                                        <div class="fm-input pricing-ingredients">
                                                            <select class="chosen-select-no-single" >
                                                                <option label="Fluency">Select Fluency</option>
                                                                <option>1(Poor)</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="fm-input pricing-name">
                                                            <select class="aachosen-select-no-single" >
                                                                <option label="Language">Select Language</option>
                                                                <option value="Afrikanns">Afrikanns</option>
                                                                <option value="Albanian">Albanian</option>
                                                                <option value="Arabic">Arabic</option>
                                                                <option value="Armenian">Armenian</option>
                                                                <option value="Basque">Basque</option>
                                                                <option value="Bengali">Bengali</option>
                                                                <option value="Bulgarian">Bulgarian</option>
                                                                <option value="Catalan">Catalan</option>
                                                                <option value="Cambodian">Cambodian</option>
                                                                <option value="Chinese (Mandarin)">Chinese (Mandarin)</option>
                                                                <option value="Croation">Croation</option>
                                                                <option value="Czech">Czech</option>
                                                                <option value="Danish">Danish</option>
                                                                <option value="Dutch">Dutch</option>
                                                                <option value="English">English</option>
                                                                <option value="Estonian">Estonian</option>
                                                                <option value="Fiji">Fiji</option>
                                                                <option value="Finnish">Finnish</option>
                                                                <option value="French">French</option>
                                                                <option value="Georgian">Georgian</option>
                                                                <option value="German">German</option>
                                                                <option value="Greek">Greek</option>
                                                                <option value="Gujarati">Gujarati</option>
                                                                <option value="Hebrew">Hebrew</option>
                                                                <option value="Hindi">Hindi</option>
                                                                <option value="Hungarian">Hungarian</option>
                                                                <option value="Icelandic">Icelandic</option>
                                                                <option value="Indonesian">Indonesian</option>
                                                                <option value="Irish">Irish</option>
                                                                <option value="Italian">Italian</option>
                                                                <option value="Japanese">Japanese</option>
                                                                <option value="Javanese">Javanese</option>
                                                                <option value="Korean">Korean</option>
                                                                <option value="Latin">Latin</option>
                                                                <option value="Latvian">Latvian</option>
                                                                <option value="Lithuanian">Lithuanian</option>
                                                                <option value="Macedonian">Macedonian</option>
                                                                <option value="Malay">Malay</option>
                                                                <option value="Malayalam">Malayalam</option>
                                                                <option value="Maltese">Maltese</option>
                                                                <option value="Maori">Maori</option>
                                                                <option value="Marathi">Marathi</option>
                                                                <option value="Mongolian">Mongolian</option>
                                                                <option value="Nepali">Nepali</option>
                                                                <option value="Norwegian">Norwegian</option>
                                                                <option value="Persian">Persian</option>
                                                                <option value="Polish">Polish</option>
                                                                <option value="Portuguese">Portuguese</option>
                                                                <option value="Punjabi">Punjabi</option>
                                                                <option value="Quechua">Quechua</option>
                                                                <option value="Romanian">Romanian</option>
                                                                <option value="Russian">Russian</option>
                                                                <option value="Samoan">Samoan</option>
                                                                <option value="Serbian">Serbian</option>
                                                                <option value="Slovak">Slovak</option>
                                                                <option value="Slovenian">Slovenian</option>
                                                                <option value="Spanish">Spanish</option>
                                                                <option value="Swahili">Swahili</option>
                                                                <option value="Swedish ">Swedish </option>
                                                                <option value="Tamil">Tamil</option>
                                                                <option value="Tatar">Tatar</option>
                                                                <option value="Telugu">Telugu</option>
                                                                <option value="Thai">Thai</option>
                                                                <option value="Tibetan">Tibetan</option>
                                                                <option value="Tonga">Tonga</option>
                                                                <option value="Turkish">Turkish</option>
                                                                <option value="Ukranian">Ukranian</option>
                                                                <option value="Urdu">Urdu</option>
                                                                <option value="Uzbek">Uzbek</option>
                                                                <option value="Vietnamese">Vietnamese</option>
                                                                <option value="Welsh">Welsh</option>
                                                                <option value="Xhosa">Xhosa</option>
                                                            </select>
                                                            </select>
                                                        </div>

                                                        <div class="fm-input pricing-ingredients">
                                                            <select class="chosen-select-no-single" >
                                                                <option label="Fluency">Select Fluency</option>
                                                                <option>1(Poor)</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                </tr>
                                            </table>
                                            <script type="text/javascript">
                                                $(".aachosen-select-no-single").chosen();
                                            </script>
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
<script type="text/javascript" src="scripts/optionsearch.js"></script>

</body>
</html>