<?php
session_start();
$pid = $_SESSION['pid'];
$superkeywords = $_SESSION['superkeywords'];
$superkeywords_array = explode(',', $superkeywords);

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$query = "SELECT * FROM `pkrelation` WHERE `pid` =\".$pid.\" ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
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
                            $('#super_img_area').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }


            </script>

            <script type="text/javascript">
                $(document).ready(function() {

                    $("#superphoto").submit( function(e){
                        e.preventDefault();

                        var datas, xhr;

                        datas = new FormData();
                        datas.append( 'service_image', $( '#service_image' )[0].files[0] );

                        $.ajax({
                            url: './superphoto.php', //업로드할 url
                            contentType: 'multipart/form-data',
                            type: 'POST',
                            data: datas,
                            dataType: 'json',
                            mimeType: 'multipart/form-data',

                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    });

                });

            </script>

            <div class="row">
                <div class="col-lg-12">

                    <div id="add-listing">

                        <?php
                        foreach ($superkeywords_array as $super) {


                            if($super==null)
                            {
                                break;
                            }
                            $splitjoin = str_replace(" ", "", $super);
                        $inner="";
                                if(@file('http://223.195.109.38/lanternproject/super_img/'.$pid.'_'.$splitjoin.'.png')){
                                  $inner=   '<img id="super_img_area" src="./super_img/'.$pid.'_'.$splitjoin.'.png" alt="">';
                                }
                                else{
                                    $default = "default";
                                    $inner='<img id="super_img_area" src="/lanternproject/profile_img/'.$default.'.png" alt="">';
                                }

                            print("
                            
                            <!-- Section -->
                        <div style='position: relative; width: 80%; vertical-align: middle; margin: auto;'class=\"add-listing-section margin-top-45\" id='".$super."'>

                            <!-- Headline -->
                            <div class=\"add-listing-headline\">
                                <h3><i class=\"sl sl-icon-picture\"></i> ".$super."</h3>
                            </div>");


                            print("


                            <!-- Dropzone -->
                            <form id=\"superphoto\" method=\"post\" class=\"profile\" enctype=\"multipart/form-data\" action=\"./superphoto.php\">
                  ".$inner."
                                <!-- Avatar -->
                                <div class=\"edit-profile-photo\">
                
                                    <div class=\"change-photo-btn\">
                                        <div class=\"photoUpload\">
                                      
                                            <span><i class=\"fa fa-upload\"></i> SELECT PHOTO</span>
                                            <input id=\"service_image\" name=\"service_image\"  type=\"file\" class=\"upload\" />
                                        </div>       
                                    </div>
                                </div>

                                <button onclick=\"document.getElementById('superphoto').submit()\" class=\"button margin-top-15\">PROFILE PHOTO UPLOAD</button>
                                <div class=\"col-md-0\">
                                     
                                     <input name = 'superkeywordname' value='".$splitjoin."' type=\"text\" style = \"opacity: 0\" readonly>
                                </div>
                            </form>
                            
                            

                            <!-- Description -->
                            <div class=\"form\">
                                <h5>Description</h5>
                                <textarea class=\"WYSIWYG\" name='summary' cols=\"35\" rows=\"3\" id='summary".$splitjoin."' spellcheck=\"true\"></textarea>
                            </div>
                            
                            <a href=\"#\" class=\"button preview\" id='".$super."'>Upload <i class=\"fa fa-arrow-circle-right\"></i></a>

                        </div>
                        <!-- Section / End -->
                 
                            
                            ");

                        }
                        ?>



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
<script>
     $(document).ready(function () {

        $(".preview").click(function (e) {
            e.preventDefault();

            var superkeyword = $(this).attr('id');
            var split = superkeyword.split(' ').join('');

            var datas =
                {
                keyword : superkeyword,
                super_info: $("#summary" +split).val()
                };
            $.ajax({
                url: './insert_super.php',
                type: 'POST',
                data: datas,
                dataType: "json",
                success : function(data, status, xhr) {
//                    alert(data);
                }

            });

            var datas2;

            datas2 = new FormData();
//            datas2.append( 'service_image', $('#drop_'+split) );

            var myDropzone = new Dropzone ($("#drop_"+split));
            var filess = myDropzone.files.getAcceptedFiles();

            alert(filess[0]);

//            $.ajax({
//                url: './profilephoto.php', //업로드할 url
//                contentType: 'multipart/form-data',
//                type: 'POST',
//                data: datas2,
//                dataType: 'json',
//                mimeType: 'multipart/form-data',
//
//                cache: false,
//                contentType: false,
//                processData: false
//            });

        });
    })

</script>