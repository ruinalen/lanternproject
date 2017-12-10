<?php
session_start();
if($_SESSION['user_sid'] == NULL){
    echo("<script> document.location.href='http://223.195.109.38/lanternproject/index.php';</script>");
}
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$query1 = "SELECT * FROM `member` WHERE `sid` ='$_SESSION[user_sid]'";
$result = mysqli_query($conn, $query1);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<head>
    <style>

        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .fc-content{
            height: 60px;
        }
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 500px !important;
        }
        /* Optional: Makes the sample page fill the window. */

        .controls {
            margin-top: 10px;
            border: 1px solid transparent;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            height: 32px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;
            width: 300px;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        .pac-container {
            font-family: Roboto;
        }

        #type-selector {
            color: #fff;
            background-color: #4d90fe;
            padding: 5px 11px 0px 11px;
        }

        #type-selector label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }
        #target {
            width: 345px;
        }
    </style>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Lantern</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/colors/main.css" id="colors">





</head>

<body>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxjd5GaNmcZ0uzykr0oFajwo5lOombz40&libraries=places&callback=initAutocomplete" async defer></script>-->


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
                    <li><a href="./profile.php"><i class="sl sl-icon-settings"></i> My Profile</a></li>
                    <!--                    <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages <span class="nav-tag messages">2</span></a></li>-->
                    <li><a href="./request_list.php"><i class="sl sl-icon-star"></i> Request List</a></li>
                    <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages </span></a>
                </ul>

                <ul data-submenu-title="Posting">
                    <li><a href="./posting_view.php"><i class="sl sl-icon-layers"></i> My Posting</a></li>
                    <li><a href="dashboard-add-listing.html"><i class="sl sl-icon-plus"></i> Add Posting</a></li>
                </ul>

                <ul data-submenu-title="Account">
                    <li><a href="./logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
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
                        <h2>Add Posting</h2>
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
                    <form action="insert_posting.php" method="post" id="add-posting-form">
                        <div id="hiddens"></div>
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
                                        <h5>Languages</h5>
                                        <table id="pricing-list-containers" style="width: 100%">
                                            <tr class="pricing-list-item pattern123">
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
                                                        <select name="lang_f1" class="aachosen-select-no-single" id="langf1Select">
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
                                                        <select name="lang_f2" class="aachosen-select-no-single" id="langf2Select">
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
                                                    </div>

                                                    <div class="fm-input pricing-ingredients">
                                                        <select name="lang_f3" class="aachosen-select-no-single" id="langf3Select">
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

                                    </div>

                                    <div class="col-md-6">
                                        <h5>Extras</h5>
                                        <input name="accommodation" type="text" placeholder="Type the Number of Maximum travelers">
                                        <div class="checkboxes in-row margin-bottom-20">

                                            <input id="kid" type="checkbox" name="kid">
                                            <label for="kid"><i class="fa fa-child"></i>  Kid Friendly</label>

                                            <input id="disabled" type="checkbox" name="disabled">
                                            <label for="disabled"><i class="im im-icon-Wheelchair"></i> Disabled Friendly</label>

                                            <input id="ownacar" type="checkbox" name="ownacar">
                                            <label for="ownacar"><i class="im im-icon-Car-2"></i> Own a Car</label>

                                        </div>
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

                                </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="boxed-widget" id="keywords_boxed">

                                            </div>

                                            <div class="checkboxes in-row margin-bottom-20" style="margin-top: 20px;">
                                                <input id="check-a" type="checkbox" name="placecheck" class="geocheck">
                                                <label for="check-a" style="display: block !important; margin-top: 0px!important;">location Keyword?</label>
                                                <input id="check-b" type="checkbox" name="placecheck" class="supercheck">
                                                <label for="check-b" style="display: block !important; margin-top: 0px!important;">Super Keyword?</label>
                                            </div>

                                            <div id="general-input">
                                            <input  id="keyword_g" type="text" placeholder="Keyword" name="keyword0" style="width: 300px; height: auto; float: left; margin: 10px;" />
                                                <div style="height: 100px; margin: auto;"><a href="#" class="button add-pricing-list-item" id="general_keyword_submit">Add Keyword</a></div>
                                            </div>

                                            <div id="keyword_geo_input" style="display: none">
                                                <input id='pac-input' class='controls' type='text' placeholder='Enter a location' style="width: 300px; height: auto; float: left; margin: 10px;"/>
                                                <div style="height: 100px; margin: auto;"><a href="#" class="button add-pricing-list-item" id="geo_keyword_submit">Add Keyword</a></div>
                                                <div id='map'></div>
                                            </div>



                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxjd5GaNmcZ0uzykr0oFajwo5lOombz40&libraries=places&callback=initAutocomplete" async defer></script>

                                            <script>
                                                // This example adds a search box to a map, using the Google Place Autocomplete
                                                // feature. People can enter geographical searches. The search box will return a
                                                // pick list containing a mix of places and predicted search terms.

                                                // This example requires the Places library. Include the libraries=places
                                                // parameter when you first load the API. For example:
                                                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                                                var place123 =
                                                    {
                                                        geo_location : null,
                                                        geo_address: null,
                                                        geo_name: null
                                                    };


                                                function initAutocomplete() {
                                                    var map = new google.maps.Map(document.getElementById('map'), {
                                                        center: {lat: 37.541, lng: 126.986},
                                                        zoom: 13,
                                                        mapTypeId: 'roadmap'
                                                    });



                                                    // Create the search box and link it to the UI element.
                                                    var input = document.getElementById('pac-input');
                                                    var searchBox = new google.maps.places.SearchBox(input);


                                                    var markers = [];
                                                    // Listen for the event fired when the user selects a prediction and retrieve
                                                    // more details for that place.
                                                    searchBox.addListener('places_changed', function() {
                                                        var places = searchBox.getPlaces();

                                                        if (places.length == 0) {
                                                            return;
                                                        }

                                                        // Clear out the old markers.
                                                        markers.forEach(function(marker) {
                                                            marker.setMap(null);
                                                        });
                                                        markers = [];

                                                        // For each place, get the icon, name and location.
                                                        var bounds = new google.maps.LatLngBounds();
                                                        places.forEach(function(place) {
                                                            if (!place.geometry) {
                                                                console.log("Returned place contains no geometry");
                                                                return;
                                                            }
                                                            var address = '';
                                                            if (place.address_components) {
                                                                address = [
                                                                    (place.address_components[0] && place.address_components[0].short_name || ''),
                                                                    (place.address_components[1] && place.address_components[1].short_name || ''),
                                                                    (place.address_components[2] && place.address_components[2].short_name || '')
                                                                ].join(' ');
                                                            }

                                                            var icon = {
                                                                url: place.icon,
                                                                size: new google.maps.Size(71, 71),
                                                                origin: new google.maps.Point(0, 0),
                                                                anchor: new google.maps.Point(17, 34),
                                                                scaledSize: new google.maps.Size(25, 25)
                                                            };

                                                            // Create a marker for each place.
                                                            markers.push(new google.maps.Marker({
                                                                map: map,
                                                                draggable: true,
                                                                title: place.name,
                                                                position: place.geometry.location
                                                            }));

                                                            if (place.geometry.viewport) {
                                                                // Only geocodes have viewport.
                                                                bounds.union(place.geometry.viewport);
                                                            } else {
                                                                bounds.extend(place.geometry.location);
                                                            }

                                                            place123=
                                                                {
                                                                    geo_location : place.geometry.location.toString(),
                                                                    geo_address: place.formatted_address,
                                                                    geo_name: place.name
                                                                };


                                                        });
                                                        map.fitBounds(bounds);
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </div>


                            </div>
                            <!-- Section / End -->

                            <!-- Section -->
                            <div class="add-listing-section margin-top-45">

                            <!-- Headline -->
                            <div class="add-listing-headline">
                                <h3><i class="fa fa-calendar"></i> Available Dates</h3>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id='calendar'></div>
                                </div>

                            </div>

                            </div>

<!--                        <a href="#" class="button preview" onclick="document.getElementById('add-posting-form').submit()" >Next <i class="fa fa-arrow-circle-right"></i></a>-->
                        <a href="#" class="button preview" id="nextpage">Next <i class="fa fa-arrow-circle-right"></i></a>

                </div>
                </form>
            </div>
            </div>
            <!-- Section / End -->
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
<script type="text/javascript" src="scripts/optionsearch.js"></script>
<!-- DropZone | Documentation: http://dropzonejs.com -->
<script type="text/javascript" src="scripts/dropzone.js"></script>

<link href='fullcalendar-3.7.0/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar-3.7.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='fullcalendar-3.7.0/lib/moment.min.js'></script>
<script src='fullcalendar-3.7.0/lib/jquery.min.js'></script>
<script src='fullcalendar-3.7.0/fullcalendar.min.js'></script>

<!-- Opening hours added via JS (this is only for demo purpose) -->
<script>
    $(document).ready(function() {
        var keyword_array = [];

        $("#lang1Select").val("<?php echo $user['lang1']?>").attr("selected", "selected");
        $("#langf1Select").val("<?php echo $user['lang_f1']?>").attr("selected", "selected");
        $("#lang2Select").val("<?php echo $user['lang2']?>").attr("selected", "selected");
        $("#langf2Select").val("<?php echo $user['lang_f2']?>").attr("selected", "selected");
        $("#lang3Select").val("<?php echo $user['lang3']?>").attr("selected", "selected");
        $("#langf3Select").val("<?php echo $user['lang_f3']?>").attr("selected", "selected");

        $(".geocheck").change(function () {
            if($(".geocheck").is(":checked")){
                $("#keyword_geo_input").show();
                $("#general-input").hide();
                google.maps.event.trigger(map, 'resize');
            }else{
                $("#keyword_geo_input").hide();
                $("#general-input").show();
            }
        });

        function view_keywrods(){
            var innerhtml = "";
            for(var i=0; i<keyword_array.length;i++){
                innerhtml+="<button class='button' disabled>";
                innerhtml+=keyword_array[i]['keyword'];
                innerhtml+="</button>";
            }
            $("#keywords_boxed").html(innerhtml);
        }

        function is_super(){
            if($(".supercheck").is(":checked")){
                return 1;
            }
            return 0;
        }

        $("#general_keyword_submit").click(function (e) {
            e.preventDefault();
            var datas =
                {
                    keyword : $("#keyword_g").val(),
                    geo_offset: 0
                };
            $.ajax({
                url: './insert_keyword.php',
                type: 'POST',
                data: datas,
                dataType: "json",
                success : function(data, status, xhr) {
                    console.log(data);
                    keyword_array.push({
                        keyword: data["keyword"],
                        super_offset: is_super()
                    });
                    view_keywrods();
                    $("#keyword_g").val("");

                }
            });
        });



        $("#geo_keyword_submit").click(function () {
            var input = $("#pac-input").val();
            var datas =
                {
                    keyword : input.split(',')[0],
                    geo_offset: 1,
                    geo_location : place123['geo_location'].slice(1, -1),
                    geo_address: place123['geo_address'],
                    geo_name: place123['geo_name']
                };
            $.ajax({
                url: './insert_keyword.php',
                type: 'POST',
                data: datas,
                dataType: "json",
                success : function(data, status, xhr) {
                    console.log(data);
                    keyword_array.push({
                        keyword: data["keyword"],
                        super_offset: is_super()
                    });
                    view_keywrods();
                    $("#pac-input").val("");
                    google.maps.event.trigger(map, 'resize');
                }
            });
        });

        var available_dates="";

        $("#nextpage").click(function () {
            var arr = $('#calendar').fullCalendar( 'clientEvents' );
            for(var i=0; i<arr.length; i++){
                var days = (arr[i]['end']-arr[i]['start'])/(1000*60*60*24);
                for(var j=0; j<days; j++){
                    var d = new Date(arr[i]['start']+(j*1000*60*60*24));
                    available_dates+=(moment(d).format('YYYY-MM-DD')+",");
                }
            }
            alert(available_dates);
            var inner= "";
            for(var i=0; i<keyword_array.length;i++){
                inner += "<input type='hidden' name='keywords_array[]' value='"+keyword_array[i]['keyword']+"'>";
                inner += "<input type='hidden' name='super_array[]' value='"+keyword_array[i]['super_offset']+"'>";
                console.log(keyword_array[i]);
            }
            inner += "<input type='hidden' name='available_dates' value='"+available_dates+"'>";

            $("#hiddens").html(inner);
            $("#add-posting-form").submit();

        });

        var ii=0;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                var eventData;
//                if (title) {
                    eventData = {
                        start: start.format(),
                        end: end.format(),
                        color: 'blue',
                        index: ii
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, false); // stick? = true
//                }
                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [],
            eventClick: function(event, element) {
                $('#calendar').fullCalendar( 'removeEvents',event._id);
            }
        });

    });
</script>





</body>
</html>
