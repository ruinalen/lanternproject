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
                        <h4 class="gray">Profile</h4>
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

                            </div>

                            <button class="button margin-top-15">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- Change Country and Languages -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4 class="gray">Profile Details</h4>
                        <div class="dashboard-list-box-static">

                            <!-- Change Password -->
                            <div class="my-profile">

                                <form method="post" class="profile" action="./profileupdate2.php">

                                <label>Describe Yourself</label>
                                <textarea name="intro" id="intro" cols="30" rows="10"></textarea>

                                <label>Which Country You Live</label>
                                <select name="country" class="aachosen-select-no-single" id="regionSelect">
                                    <option value="AF">Afghanistan</option>
                                    <option value="AX">Åland Islands</option>
                                    <option value="AL">Albania</option>
                                    <option value="DZ">Algeria</option>
                                    <option value="AS">American Samoa</option>
                                    <option value="AD">Andorra</option>
                                    <option value="AO">Angola</option>
                                    <option value="AI">Anguilla</option>
                                    <option value="AQ">Antarctica</option>
                                    <option value="AG">Antigua and Barbuda</option>
                                    <option value="AR">Argentina</option>
                                    <option value="AM">Armenia</option>
                                    <option value="AW">Aruba</option>
                                    <option value="AU">Australia</option>
                                    <option value="AT">Austria</option>
                                    <option value="AZ">Azerbaijan</option>
                                    <option value="BS">Bahamas</option>
                                    <option value="BH">Bahrain</option>
                                    <option value="BD">Bangladesh</option>
                                    <option value="BB">Barbados</option>
                                    <option value="BY">Belarus</option>
                                    <option value="BE">Belgium</option>
                                    <option value="BZ">Belize</option>
                                    <option value="BJ">Benin</option>
                                    <option value="BM">Bermuda</option>
                                    <option value="BT">Bhutan</option>
                                    <option value="BO">Bolivia, Plurinational State of</option>
                                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                                    <option value="BA">Bosnia and Herzegovina</option>
                                    <option value="BW">Botswana</option>
                                    <option value="BV">Bouvet Island</option>
                                    <option value="BR">Brazil</option>
                                    <option value="IO">British Indian Ocean Territory</option>
                                    <option value="BN">Brunei Darussalam</option>
                                    <option value="BG">Bulgaria</option>
                                    <option value="BF">Burkina Faso</option>
                                    <option value="BI">Burundi</option>
                                    <option value="KH">Cambodia</option>
                                    <option value="CM">Cameroon</option>
                                    <option value="CA">Canada</option>
                                    <option value="CV">Cape Verde</option>
                                    <option value="KY">Cayman Islands</option>
                                    <option value="CF">Central African Republic</option>
                                    <option value="TD">Chad</option>
                                    <option value="CL">Chile</option>
                                    <option value="CN">China</option>
                                    <option value="CX">Christmas Island</option>
                                    <option value="CC">Cocos (Keeling) Islands</option>
                                    <option value="CO">Colombia</option>
                                    <option value="KM">Comoros</option>
                                    <option value="CG">Congo</option>
                                    <option value="CD">Congo, the Democratic Republic of the</option>
                                    <option value="CK">Cook Islands</option>
                                    <option value="CR">Costa Rica</option>
                                    <option value="CI">Côte d'Ivoire</option>
                                    <option value="HR">Croatia</option>
                                    <option value="CU">Cuba</option>
                                    <option value="CW">Curaçao</option>
                                    <option value="CY">Cyprus</option>
                                    <option value="CZ">Czech Republic</option>
                                    <option value="DK">Denmark</option>
                                    <option value="DJ">Djibouti</option>
                                    <option value="DM">Dominica</option>
                                    <option value="DO">Dominican Republic</option>
                                    <option value="EC">Ecuador</option>
                                    <option value="EG">Egypt</option>
                                    <option value="SV">El Salvador</option>
                                    <option value="GQ">Equatorial Guinea</option>
                                    <option value="ER">Eritrea</option>
                                    <option value="EE">Estonia</option>
                                    <option value="ET">Ethiopia</option>
                                    <option value="FK">Falkland Islands (Malvinas)</option>
                                    <option value="FO">Faroe Islands</option>
                                    <option value="FJ">Fiji</option>
                                    <option value="FI">Finland</option>
                                    <option value="FR">France</option>
                                    <option value="GF">French Guiana</option>
                                    <option value="PF">French Polynesia</option>
                                    <option value="TF">French Southern Territories</option>
                                    <option value="GA">Gabon</option>
                                    <option value="GM">Gambia</option>
                                    <option value="GE">Georgia</option>
                                    <option value="DE">Germany</option>
                                    <option value="GH">Ghana</option>
                                    <option value="GI">Gibraltar</option>
                                    <option value="GR">Greece</option>
                                    <option value="GL">Greenland</option>
                                    <option value="GD">Grenada</option>
                                    <option value="GP">Guadeloupe</option>
                                    <option value="GU">Guam</option>
                                    <option value="GT">Guatemala</option>
                                    <option value="GG">Guernsey</option>
                                    <option value="GN">Guinea</option>
                                    <option value="GW">Guinea-Bissau</option>
                                    <option value="GY">Guyana</option>
                                    <option value="HT">Haiti</option>
                                    <option value="HM">Heard Island and McDonald Islands</option>
                                    <option value="VA">Holy See (Vatican City State)</option>
                                    <option value="HN">Honduras</option>
                                    <option value="HK">Hong Kong</option>
                                    <option value="HU">Hungary</option>
                                    <option value="IS">Iceland</option>
                                    <option value="IN">India</option>
                                    <option value="ID">Indonesia</option>
                                    <option value="IR">Iran, Islamic Republic of</option>
                                    <option value="IQ">Iraq</option>
                                    <option value="IE">Ireland</option>
                                    <option value="IM">Isle of Man</option>
                                    <option value="IL">Israel</option>
                                    <option value="IT">Italy</option>
                                    <option value="JM">Jamaica</option>
                                    <option value="JP">Japan</option>
                                    <option value="JE">Jersey</option>
                                    <option value="JO">Jordan</option>
                                    <option value="KZ">Kazakhstan</option>
                                    <option value="KE">Kenya</option>
                                    <option value="KI">Kiribati</option>
                                    <option value="KP">Korea, Democratic People's Republic of</option>
                                    <option value="KR">Korea, Republic of</option>
                                    <option value="KW">Kuwait</option>
                                    <option value="KG">Kyrgyzstan</option>
                                    <option value="LA">Lao People's Democratic Republic</option>
                                    <option value="LV">Latvia</option>
                                    <option value="LB">Lebanon</option>
                                    <option value="LS">Lesotho</option>
                                    <option value="LR">Liberia</option>
                                    <option value="LY">Libya</option>
                                    <option value="LI">Liechtenstein</option>
                                    <option value="LT">Lithuania</option>
                                    <option value="LU">Luxembourg</option>
                                    <option value="MO">Macao</option>
                                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                                    <option value="MG">Madagascar</option>
                                    <option value="MW">Malawi</option>
                                    <option value="MY">Malaysia</option>
                                    <option value="MV">Maldives</option>
                                    <option value="ML">Mali</option>
                                    <option value="MT">Malta</option>
                                    <option value="MH">Marshall Islands</option>
                                    <option value="MQ">Martinique</option>
                                    <option value="MR">Mauritania</option>
                                    <option value="MU">Mauritius</option>
                                    <option value="YT">Mayotte</option>
                                    <option value="MX">Mexico</option>
                                    <option value="FM">Micronesia, Federated States of</option>
                                    <option value="MD">Moldova, Republic of</option>
                                    <option value="MC">Monaco</option>
                                    <option value="MN">Mongolia</option>
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                    <option value="MM">Myanmar</option>
                                    <option value="NA">Namibia</option>
                                    <option value="NR">Nauru</option>
                                    <option value="NP">Nepal</option>
                                    <option value="NL">Netherlands</option>
                                    <option value="NC">New Caledonia</option>
                                    <option value="NZ">New Zealand</option>
                                    <option value="NI">Nicaragua</option>
                                    <option value="NE">Niger</option>
                                    <option value="NG">Nigeria</option>
                                    <option value="NU">Niue</option>
                                    <option value="NF">Norfolk Island</option>
                                    <option value="MP">Northern Mariana Islands</option>
                                    <option value="NO">Norway</option>
                                    <option value="OM">Oman</option>
                                    <option value="PK">Pakistan</option>
                                    <option value="PW">Palau</option>
                                    <option value="PS">Palestinian Territory, Occupied</option>
                                    <option value="PA">Panama</option>
                                    <option value="PG">Papua New Guinea</option>
                                    <option value="PY">Paraguay</option>
                                    <option value="PE">Peru</option>
                                    <option value="PH">Philippines</option>
                                    <option value="PN">Pitcairn</option>
                                    <option value="PL">Poland</option>
                                    <option value="PT">Portugal</option>
                                    <option value="PR">Puerto Rico</option>
                                    <option value="QA">Qatar</option>
                                    <option value="RE">Réunion</option>
                                    <option value="RO">Romania</option>
                                    <option value="RU">Russian Federation</option>
                                    <option value="RW">Rwanda</option>
                                    <option value="BL">Saint Barthélemy</option>
                                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                                    <option value="KN">Saint Kitts and Nevis</option>
                                    <option value="LC">Saint Lucia</option>
                                    <option value="MF">Saint Martin (French part)</option>
                                    <option value="PM">Saint Pierre and Miquelon</option>
                                    <option value="VC">Saint Vincent and the Grenadines</option>
                                    <option value="WS">Samoa</option>
                                    <option value="SM">San Marino</option>
                                    <option value="ST">Sao Tome and Principe</option>
                                    <option value="SA">Saudi Arabia</option>
                                    <option value="SN">Senegal</option>
                                    <option value="RS">Serbia</option>
                                    <option value="SC">Seychelles</option>
                                    <option value="SL">Sierra Leone</option>
                                    <option value="SG">Singapore</option>
                                    <option value="SX">Sint Maarten (Dutch part)</option>
                                    <option value="SK">Slovakia</option>
                                    <option value="SI">Slovenia</option>
                                    <option value="SB">Solomon Islands</option>
                                    <option value="SO">Somalia</option>
                                    <option value="ZA">South Africa</option>
                                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                                    <option value="SS">South Sudan</option>
                                    <option value="ES">Spain</option>
                                    <option value="LK">Sri Lanka</option>
                                    <option value="SD">Sudan</option>
                                    <option value="SR">Suriname</option>
                                    <option value="SJ">Svalbard and Jan Mayen</option>
                                    <option value="SZ">Swaziland</option>
                                    <option value="SE">Sweden</option>
                                    <option value="CH">Switzerland</option>
                                    <option value="SY">Syrian Arab Republic</option>
                                    <option value="TW">Taiwan, Province of China</option>
                                    <option value="TJ">Tajikistan</option>
                                    <option value="TZ">Tanzania, United Republic of</option>
                                    <option value="TH">Thailand</option>
                                    <option value="TL">Timor-Leste</option>
                                    <option value="TG">Togo</option>
                                    <option value="TK">Tokelau</option>
                                    <option value="TO">Tonga</option>
                                    <option value="TT">Trinidad and Tobago</option>
                                    <option value="TN">Tunisia</option>
                                    <option value="TR">Turkey</option>
                                    <option value="TM">Turkmenistan</option>
                                    <option value="TC">Turks and Caicos Islands</option>
                                    <option value="TV">Tuvalu</option>
                                    <option value="UG">Uganda</option>
                                    <option value="UA">Ukraine</option>
                                    <option value="AE">United Arab Emirates</option>
                                    <option value="GB">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="UM">United States Minor Outlying Islands</option>
                                    <option value="UY">Uruguay</option>
                                    <option value="UZ">Uzbekistan</option>
                                    <option value="VU">Vanuatu</option>
                                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                                    <option value="VN">Viet Nam</option>
                                    <option value="VG">Virgin Islands, British</option>
                                    <option value="VI">Virgin Islands, U.S.</option>
                                    <option value="WF">Wallis and Futuna</option>
                                    <option value="EH">Western Sahara</option>
                                    <option value="YE">Yemen</option>
                                    <option value="ZM">Zambia</option>
                                    <option value="ZW">Zimbabwe</option>
                                </select>

                                <script>

                                </script>
                                <label>Languages</label>
                                <div class="switcher-content">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="pricing-list-container">
                                                <tr class="pricing-list-item pattern">
                                                    <td>
                                                        <div class="fm-input pricing-name">
                                                            <select name="lang1" class="aachosen-select-no-single" id="lang1Select">
                                                                <option value=" ">Select Language</option>
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
                                                        </div>

                                                        <div class="fm-input pricing-ingredients">
                                                            <select name="lang_f1" class="chosen-select-no-single" id="langf1Select">
                                                                <option value="0">Select Fluency</option>
                                                                <option value="1">1(Poor)</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="fm-input pricing-name">
                                                            <select name="lang2" class="aachosen-select-no-single" id="lang2Select">
                                                                <option value=" ">Select Language</option>
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
                                                            <select name="lang_f2" class="chosen-select-no-single" id="langf2Select">
                                                                <option value="0">Select Fluency</option>
                                                                <option value="1">1(Poor)</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="fm-input pricing-name">
                                                            <select name="lang3" class="aachosen-select-no-single" id="lang3Select">
                                                                <option value=" ">Select Language</option>
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
                                                            <select name="lang_f3" class="chosen-select-no-single" id="langf3Select">
                                                                <option value="0">Select Fluency</option>
                                                                <option value="1">1(Poor)</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5(Fluent)</option>
                                                            </select>
                                                        </div>
                                                    </td>

                                                </tr>
                                            </table>
                                            <script type="text/javascript">
                                                $("#regionSelect").val("<?php echo $user['region']?>").attr("selected", "selected");
                                                $("#lang1Select").val("<?php echo $user['lang1']?>").attr("selected", "selected");
                                                $("#langf1Select").val("<?php echo $user['lang_f1']?>").attr("selected", "selected");
                                                $("#lang2Select").val("<?php echo $user['lang2']?>").attr("selected", "selected");
                                                $("#langf2Select").val("<?php echo $user['lang_f2']?>").attr("selected", "selected");
                                                $("#lang3Select").val("<?php echo $user['lang3']?>").attr("selected", "selected");
                                                $("#langf3Select").val("<?php echo $user['lang_f3']?>").attr("selected", "selected");
                                                $(".aachosen-select-no-single").chosen();
                                            </script>
                                        </div>
                                    </div>

                                </div>

                                <button onclick="" class="button margin-top-15">Save Changes</button>
                                </form>
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
<!--                            <!-- Change Password -->
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