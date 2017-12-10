<?php
session_start();
$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$pid = $_GET['pid'];
if($pid==null){
    $query = "SELECT * FROM `posting` WHERE `lantern_sid` =".$_SESSION['user_sid']." ORDER BY `pid` desc";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $pid = $row['pid'];
}

$query1 = "SELECT * FROM `posting` WHERE `pid` ='$pid'";
$result1 = mysqli_query($conn, $query1);
$posting = mysqli_fetch_assoc($result1);
$lantern_sid = $posting['lantern_sid'];

$query2 = "SELECT * FROM `member` WHERE `sid`='$lantern_sid'";
$result2 = mysqli_query($conn, $query2);
$lantern = mysqli_fetch_assoc($result2);

$query3 = "SELECT * FROM `pkrelation` WHERE `pid`='$pid'";
$result3 = mysqli_query($conn, $query3);

$supers = array();
$supersinfo = array();
$superphoto1 = array();
$superphoto2 = array();
$superphoto3 = array();
$others = array();
$places = array();

while($row = mysqli_fetch_assoc($result3)){

    $query4 = "SELECT * FROM `keyword` WHERE `kid`='$row[kid]'";
    $result4 = mysqli_query($conn, $query4);
    $keyword = mysqli_fetch_assoc($result4);

    if($keyword['geo_offset']==1){
       array_push($places, array(kid => $keyword['kid'], keyword => $keyword['keyword'], location=>$keyword['geo_location'], address=>$keyword['geo_address'], name=>$keyword['geo_name'] ));
    }

    if($row[super_offset]==1){
        array_push($supers, $keyword['keyword']);
        array_push($supersinfo, $row['super_info']);
        array_push($superphoto1, $row['photo1']);
        array_push($superphoto2, $row['photo2']);
        array_push($superphoto3, $row['photo3']);
    }
    else{
        array_push($others, $keyword['keyword']);
    }

}

$query5 = "SELECT * FROM `pcalendar` WHERE `pid`='$pid'";
$result5 = mysqli_query($conn, $query5);
$dates = mysqli_fetch_assoc($result5);
$ava_dates =  explode(',', $dates['available_dates']);
$reserved_dates = explode(',', $dates['reserved_dates']);
$eventdates = array();

foreach ($ava_dates as $val) {
    array_push($eventdates,array(start=> $val, overlap=> false, rendering=> 'background', color=> 'green'));
}
foreach ($reserved_dates as $val){
    array_push($eventdates,array(start=> $val, overlap=> false, rendering=> 'background', color=> 'black'));
}

///////////////////////////////////////////////////////


if($_SESSION['user_sid'] == NULL){
    echo("<script> document.location.href='http://223.195.109.38/lanternproject/index.php';</script>");
}
$u_query1 = "SELECT * FROM `member` WHERE `sid` ='$_SESSION[user_sid]'";
$u_result = mysqli_query($conn, $u_query1);
$u_user = mysqli_fetch_assoc($u_result);

$reviews_list = array();

$re_query1 = "SELECT * FROM `review` WHERE `receiver_sid` ='$lantern_sid'";
$re_query2 = "SELECT * FROM `review` WHERE `receiver_sid` ='$lantern_sid'";
$re_result = mysqli_query($conn, $re_query1);
$re_result2 = mysqli_query($conn, $re_query2);
$reviewscounter = mysqli_num_rows($re_result);
//$reviews = mysqli_fetch_assoc($re_result);

$total = 0;
while ($reviewtemp = mysqli_fetch_assoc($re_result2)) {
    $total = $total + $reviewtemp['rate'];

}
if($reviewscounter==0){
    $averagescore=0;
}else {
    $averagescore = $total / $reviewscounter;
    $averagescore = round($averagescore);
}


?>

<!DOCTYPE html>
<head>
    <style>
        .myProgress {
            width: 40%;
            background-color: grey;
            float: left;
            margin-right:20px;
        }
        .myBar {
            width: 1%;
            height: 30px;
            background-color: #ffb400;
        }

        #calendar {
            width: auto;
            margin: 5%;
            font-size: 12px;
        }
         .setDiv {
             padding-top: 100px;
             text-align: center;
         }
        .mask {
            position:absolute;
            left:0;
            top:0;
            z-index:9999;
            background-color:#000;
            display:none;
        }
        .window {
            display: none;
            background-color: #ffffff;
            height: 50%;
            width: 50%;
            z-index:99999;
        }

        * {box-sizing:border-box}

         /*Slideshow container*/
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor:pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
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
<link rel="stylesheet" href="css/colors/main.css" id="colors">

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
    <header id="header-container">
        <!-- Header -->
        <?php include 'header.php';?>
        <!-- Header / End -->

    </header>
<div class="clearfix"></div>
<!-- Header Container / End -->


<!-- Slider
================================================== -->
<div class="listing-slider mfp-gallery-container margin-bottom-0">
	<a href="images/single-listing-01.jpg" data-background-image="images/raw_octopus.jpg" class="item mfp-gallery" title="Title 1"></a>
	<a href="images/single-listing-02.jpg" data-background-image="images/itaewon.jpg" class="item mfp-gallery" title="Title 3"></a>
	<a href="images/single-listing-03.jpg" data-background-image="images/workout.jpg" class="item mfp-gallery" title="Title 2"></a>
	<a href="images/single-listing-04.jpg" data-background-image="images/bbq.jpg" class="item mfp-gallery" title="Title 4"></a>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row sticky-wrapper">
		<div class="col-lg-8 col-md-8 padding-right-30">

			<!-- Titlebar -->
			<div id="titlebar" class="listing-titlebar">
                <img src="./profile_img/<?php echo $lantern_sid;?>.png" width="50%">
                <br><br>
				<div class="listing-titlebar-title">
                    <?php
                        if($lantern['auth_offset']==1){
                            $authhtml = "<span class=\"listing-tag\" style=\"color: lawngreen; border-color: lawngreen;\">Verified</span>";
                        }else{
                            $authhtml = "<span class=\"listing-tag\" style=\"color: red; border-color: red;\">Verified Not</span>";
                        }
                    ?>
					<h2><?php echo $lantern['name_first'].' '.$lantern['name_last']." ".$authhtml;?></h2>
					<span>
						<a href="#listing-location" class="listing-address">
							<i class="im im-icon-Global-Position"></i><?php echo $lantern['region']?>
</a>
					</span>

					<div class="star-rating" data-rating="
					<?php echo $averagescore ?>

">
						<div class="rating-counter"><a href="#listing-reviews">(Reviews <span><?php print $reviewscounter; ?></span> )</a></div>
					</div>
				</div>
			</div>

			<!-- Listing Nav -->
			<div id="listing-nav" class="listing-nav-container">
				<ul class="listing-nav">
					<li><a href="#listing-overview" class="active">About the Lantern</a></li>
					<li><a href="#listing-pricing-list">Keywords</a></li>
					<li><a href="#listing-location">Places</a></li>
					<li><a href="#listing-reviews">Reviews</a></li>
					<li><a href="#add-review">Add Review</a></li>
				</ul>
			</div>

			<!-- Overview -->
			<div id="listing-overview" class="listing-section">

				<!-- Description -->

				<p>
                    <?php echo ($lantern['intro']);?>
                </p>

                <!-- Languages -->
                <h3 class="listing-desc-headline">Languages</h3>
                <div class="languages"></div>


				<!-- Amenities -->
				<h3 class="listing-desc-headline">Extras</h3>
				<ul class="listing-features checkboxes margin-top-0">
					<li><i class="fa fa-child"></i>  Kid Friendly</li>
					<li><i class="im im-icon-Wheelchair"></i> Disabled Friendly</li>
					<li><i class="im im-icon-Car-2"></i> Own a Car</li>
                    <li><i class="sl sl-icon-people"></i> Maximum travelers: <?php echo $posting['accommodation']?></li>
				</ul>
			</div>


			<!-- Food Menu -->
			<div id="listing-pricing-list" class="listing-section">
				<h3 class="listing-desc-headline margin-top-70 margin-bottom-30">Keywords</h3>
                    <div class="pricing-list-container">

                        <div class="boxed-widget" >
                            <h5 style="margin-bottom: 10px;">Super Keywords</h5>
                            <?php

                            for ($x = 0; $x < sizeof($supers); $x++) {
                                $supertrim= str_replace(' ','',$supers[$x]);
                                print("
                                <div id=\"super-dialog\" class=\"zoom-anim-dialog mfp-hide ".$supertrim."\">

                                    <div class=\"super-dialog-header\" style=\"margin-bottom: 0px\">
                                        <h4>".$supers[$x]."</h4>
                                    </div>

                                    <div class=\"slideshow-container\">
                                        <div class=\"mySlides fade\">
                                            <div class=\"numbertext\">1 / 3</div>
                                            <img src=\"images/raw_octopus.jpg\" style=\"width:100%\">
                                            <div class=\"text\"></div>
                                        </div>

                                        <div class=\"mySlides fade\">
                                            <div class=\"numbertext\">2 / 3</div>
                                            <img src=\"images/raw_octopus.jpg\" style=\"width:100%\">
                                            <div class=\"text\"></div>
                                        </div>

                                        <div class=\"mySlides fade\">
                                            <div class=\"numbertext\">3 / 3</div>
                                            <img src=\"images/raw_octopus.jpg\" style=\"width:100%\">
                                            <div class=\"text\"></div>
                                        </div>

                                        <a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>
                                        <a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>
                                    </div>
                                    <br>
                                    
                                    <div style=\"text-align:center\">
                                      <span class=\"dot\" onclick=\"currentSlide(1)\"></span> 
                                      <span class=\"dot\" onclick=\"currentSlide(2)\"></span> 
                                      <span class=\"dot\" onclick=\"currentSlide(3)\"></span> 
                                    </div>



                                    <div class=\"message-reply margin-top-10px\">
                                        <!-- Add Comment-->
                                        ".$supersinfo[$x]."
                                    </div>

                                </div>

                            <a href=\".".$supertrim."\" class=\"keyword showing button popup-with-zoom-anim\"></i>".$supers[$x]."</a>
                                
                                
                                
                                
                                ");

                            }

                            ?>
                        </div>

                        <br>
                        <div class="boxed-widget">
                            <h5>Other Keywords</h5>
                            <div id="other" style="margin-top: 10px">
                                <?php
                                foreach ($others as $val)
                                    print "<button class='button'style='background-color: #aaaaaa'>".$val."</button>";
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > 3) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
    }





</script>
			<!-- Food Menu / End -->


			<!-- Location -->
			<div id="listing-location" class="listing-section">
				<h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Places</h3>
                <div id="map-container" style="width:auto;" class="fullwidth-home-map">

                    <div id="map" data-map-zoom="11">
                        <!-- map goes here -->
                    </div>
                </div>
			</div>

            <!--  Review  -->

            <div id="listing-reviews" class="listing-section">
                <h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(<?php print($reviewscounter); ?>)</span> <span></span></h3>

                <div class="clearfix"></div>

                <!-- Reviews -->
                <section class="comments listing-reviews">

                    <ul>
                        <?php
                            while ($reviews = mysqli_fetch_assoc($re_result)) {
                                print ("
                                            <li>
                                                <div class=\"avatar\"><img src=\"./profile_img/".$reviews['writer_sid'].".png\" alt=\"\" /></div>
                                                <div class=\"comment-content\"><div class=\"arrow-comment\"></div>
                                                    <div class=\"comment-by\">".$reviews['writer_name'].
                                                    "<span class=\"date\">".$reviews['write_date']."</span>
                                                        <div class=\"star-rating\" data-rating=\"".$reviews['rate']."\"></div>
                                                    </div>
                                                    <p>".$reviews['comment']."</p>
        
                                                </div>
                                            </li>
                                        ");
                            }
                        ?>
                     </ul>
                </section>

                <!-- Reviews Posting-->
                    <div id="review-dialog" class="zoom-anim-dialog mfp-hide">
                        <form method = "post" action="./write_review.php" id = "form1">
                        <div class="review-dialog-header" style="margin-bottom: 0px">
                            <h4>Review</h4>
                        </div>

                            <!-- Rating Section-->
                        <span class="leave-rating-title" style="margin-top: 5px">Your rating for the Lantern</span>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Leave Rating -->
                                <div class="clearfix"></div>
                                <div class="leave-rating margin-bottom-30">
                                    <input type="radio" name="rating" id="rating-1" value="5"/>
                                    <label for="rating-1" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating-2" value="4"/>
                                    <label for="rating-2" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating-3" value="3"/>
                                    <label for="rating-3" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating-4" value="2"/>
                                    <label for="rating-4" class="fa fa-star"></label>
                                    <input type="radio" name="rating" id="rating-5" value="1"/>
                                    <label for="rating-5" class="fa fa-star"></label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                            <!-- Demographcis-->
                        <div id="add-comment" class="add-comment">
                            <fieldset>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name:</label>
                                        <input name = "writer_name" value="<?php echo $u_user['name_first']." ".$u_user['name_last']?>" type="text" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Email:</label>
                                        <input value="<?php echo $u_user['email']?>" type="text" readonly>
                                    </div>

                                    <div class="col-md-6" style="display: none">
                                        <label>LanternID:</label>
                                        <input name = "Lantern_sid" value="<?php echo $lantern_sid?>" type="text" readonly>
                                    </div>

                                    <div class="col-md-6" style="display: none">
                                        <label>TravelerID:</label>
                                        <input name = "Traveler_sid" value="<?php echo $u_user['sid']?>" type="text" readonly>
                                    </div>
                                </div>

                            </fieldset>
                        </div>

                        <div class="message-reply margin-top-0">
                            <!-- Add Comment-->
                            <textarea name = "comment" cols="40" rows="3" placeholder="Your message to the Lantern"></textarea>
                        </div>


                </form>

                        <button type = "submit" form = "form1" class="button" value = "Post Review">Post Review</button>

                    </div>

                <a href="#review-dialog" class="send-message-to-owner button popup-with-zoom-anim"> Write Review</a>


            </div>

		</div>


		<!-- Sidebar ================================================= -->
		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

			<!-- Book Now -->
			<div class="boxed-widget">
				<h3><i class="fa fa-calendar-check-o "></i> Book a Lantern</h3>
                <div id='calendar'></div>
				<div class="row with-forms  margin-top-0">
					<div class="col-lg-6 col-md-12">
						<input type="date" id="booking-date" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
					</div>
                    <div class="col-lg-6 col-md-12">
                        <input type="date" id="booking-date2" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
                    </div>
				</div>

				<!-- progress button animation handled via custom.js -->
                <div id="request-form" class="zoom-anim-dialog mfp-hide" style="max-width:60%; height: auto; ">
                    <form method = "post" action="./write_request.php" id = "form2">
                        <div class="request-form-header" style="margin-bottom: 0px">
                            <h4>Request Form</h4>
                        </div>
                        <h4 style="margin-bottom: 20px;margin-top: 20px;">Request Time</h4>
                        <div id="request-days-time"></div>
                        <h4 style="margin-bottom: 20px;margin-top: 50px;">Select Interest Keywords</h4>
                        <div id="request-keywords" style="background-color: #f9f9f9">
                            <?php
                            foreach ($supers as $val)
                                echo "<button class='like-button'><span class='like-icon' id='".$val."'></span>".$val."</button>";
                            foreach ($others as $val)
                                echo "<button class='like-button'><span class='like-icon' id='".$val."'></span>".$val."</button>";
                            ?>
                        </div>
                        <h4 style="margin-bottom: 20px;margin-top: 50px;">Comments to <?php echo $lantern['name_first'];?></h4>
                        <div id="request-comments">
                            <textarea name = "comment" cols="40" rows="3" placeholder="Your message to the Lantern"></textarea>
                        </div>

                    </form>
                    <button id="rebutton" form = "form2" class="button" value = "Post Request"> Send Request </button>
                </div>

				<a href = "#request-form" class="send-message-to-owner button popup-with-zoom-anim fullwidth margin-top-5" id="booknowbutton"><span>Book Now</span></a>
			</div>
			<!-- Book Now / End -->


			<!-- Contact -->
			<div class="boxed-widget margin-top-35">
				<h3><i class="sl sl-icon-pin"></i> Contact</h3>
				<ul class="listing-details-sidebar">
                    <li><i class="sl sl-icon-phone"></i> <?php echo $lantern['phone_num'];?></li>
					<li><i class="fa fa-envelope-o"></i> <a href="#"><?php echo $lantern['email'];?></a></li>
				</ul>

				<ul class="listing-details-sidebar social-profiles">
					<li><a href="#" class="facebook-profile"><i class="fa fa-facebook-square"></i> Facebook</a></li>
					<li><a href="#" class="twitter-profile"><i class="fa fa-twitter"></i> Twitter</a></li>
					<!-- <li><a href="#" class="gplus-profile"><i class="fa fa-google-plus"></i> Google Plus</a></li> -->
				</ul>

			</div>
			<!-- Contact / End-->



			<div class="listing-share margin-top-40 margin-bottom-40 no-border">
				<button class="like-button"><span class="like-icon"></span> Bookmark this listing</button>
				<span>159 people bookmarked this place</span>
					<div class="clearfix"></div>
			</div>

		</div>
		<!-- Sidebar / End -->

	</div>
</div>


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


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
<?php include 'map.php';?>

<link href='fullcalendar-3.7.0/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar-3.7.0/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='fullcalendar-3.7.0/lib/moment.min.js'></script>
<script src='fullcalendar-3.7.0/lib/jquery.min.js'></script>
<script src='fullcalendar-3.7.0/fullcalendar.min.js'></script>



<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
<link href="css/plugins/datedropper.css" rel="stylesheet" type="text/css">
<script src="scripts/datedropper.js"></script>
<script>$('#booking-date').dateDropper();</script>
<script>$('#booking-date2').dateDropper();</script>

</body>
</html>

<script>
    $(document).ready(function(){
        var langf1 = <?php echo ($lantern['lang_f1']);?>*20;
        var langf2 = <?php echo ($lantern['lang_f2']);?>*20;
        var langf3 = <?php echo ($lantern['lang_f3']);?>*20;

        var innerText ="";

        move(1, langf1);
        move(2, langf2);
        move(3, langf3);


        function move(i, percent) {
            var fluency = "";
            var lang = "";
            switch (percent) {
                case 0  : return; break;
                case 20 : fluency = "Poor"; break;
                case 40  : fluency = "Basic"; break;
                case 60  : fluency = "Conversational"; break;
                case 80  : fluency = "Advanced"; break;
                case 100  : fluency = "Fluent"; break;
                default   : break;
            }

            switch (i){
                case 1: lang = "<?php echo ($lantern['lang1']);?>"; break;
                case 2: lang = "<?php echo ($lantern['lang2']);?>"; break;
                case 3: lang = "<?php echo ($lantern['lang3']);?>"; break;
                default: break;
            }

            innerText += "<h5>"+lang+"</h5><div class = 'myProgress'> <div class='myBar' id='myBar"+i+"'>" +
                "</div></div><div style='float:left'>"+fluency+"</div><br>";

        }
        $(".languages").html(innerText);
        $("#myBar1").css('width',langf1+'%');
        $("#myBar2").css('width',langf2+'%');
        $("#myBar3").css('width',langf3+'%');


        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            events: <?php echo json_encode($eventdates) ;?>
        });


//        $("#super").click(function(){
//            $("#modal1").modal();
//        });

        $("#writereview").click(function () {
            location.href ="http://223.195.109.38/lanternproject/write_review.php";
        });

        $("#booknowbutton").click(function () {
            var ava = <?php echo json_encode($ava_dates) ;?>;
            var start = new Date( $("#booking-date").val());
            var end =new Date( $("#booking-date2").val());
            var timeDiff = Math.abs(start - end);
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            var inner="";

           var day = new Date();
           for(var i=0; i<=diffDays; i++) {
               day.setDate(start.getDate() + i);
               if(!ava.includes(moment(day).format('YYYY-MM-DD'))){
                    alert("There is unavailable date in your request!");
                    window.location.reload();
               }
               inner+="<div class=\"row with-forms  margin-top-0\">\n" +
                   "                                <div class=\"col-lg-4 col-md-12\">\n" +
                   "                                <input name=\"rday-"+i+"\" type=\"text\" readonly value=\""+moment(day).format('YYYY-MM-DD')+"\">\n" +
                   "                                </div>\n" +
                   "                                <div class=\"col-lg-4 col-md-12\">\n" +
                   "                                <select name ='rtime-start-"+i+"' class=\"chosen-select\" data-placeholder=\"Opening Time\">\n" +
                   "                                    <option label=\"Start Time\"></option>\n" +
                   "                                    <option>1 AM</option>\n" +
                   "                                    <option>2 AM</option>\n" +
                   "                                    <option>3 AM</option>\n" +
                   "                                    <option>4 AM</option>\n" +
                   "                                    <option>5 AM</option>\n" +
                   "                                    <option>6 AM</option>\n" +
                   "                                    <option>7 AM</option>\n" +
                   "                                    <option>8 AM</option>\n" +
                   "                                    <option>9 AM</option>\n" +
                   "                                    <option>10 AM</option>\n" +
                   "                                    <option>11 AM</option>\n" +
                   "                                    <option>12 AM</option>\n" +
                   "                                    <option>1 PM</option>\n" +
                   "                                    <option>2 PM</option>\n" +
                   "                                    <option>3 PM</option>\n" +
                   "                                    <option>4 PM</option>\n" +
                   "                                    <option>5 PM</option>\n" +
                   "                                    <option>6 PM</option>\n" +
                   "                                    <option>7 PM</option>\n" +
                   "                                    <option>8 PM</option>\n" +
                   "                                    <option>9 PM</option>\n" +
                   "                                    <option>10 PM</option>\n" +
                   "                                    <option>11 PM</option>\n" +
                   "                                    <option>12 PM</option>\n" +
                   "                                </select>\n" +
                   "                                </div>\n" +
                   "                                <div class=\"col-lg-4 col-md-12\">\n" +
                   "                                    <select name ='rtime-end-"+i+"' class=\"chosen-select\" data-placeholder=\"Closing Time\">\n" +
                   "                                        <option label=\"End Time\"></option>\n" +
                   "                                        <option>1 AM</option>\n" +
                   "                                        <option>2 AM</option>\n" +
                   "                                        <option>3 AM</option>\n" +
                   "                                        <option>4 AM</option>\n" +
                   "                                        <option>5 AM</option>\n" +
                   "                                        <option>6 AM</option>\n" +
                   "                                        <option>7 AM</option>\n" +
                   "                                        <option>8 AM</option>\n" +
                   "                                        <option>9 AM</option>\n" +
                   "                                        <option>10 AM</option>\n" +
                   "                                        <option>11 AM</option>\n" +
                   "                                        <option>12 AM</option>\n" +
                   "                                        <option>1 PM</option>\n" +
                   "                                        <option>2 PM</option>\n" +
                   "                                        <option>3 PM</option>\n" +
                   "                                        <option>4 PM</option>\n" +
                   "                                        <option>5 PM</option>\n" +
                   "                                        <option>6 PM</option>\n" +
                   "                                        <option>7 PM</option>\n" +
                   "                                        <option>8 PM</option>\n" +
                   "                                        <option>9 PM</option>\n" +
                   "                                        <option>10 PM</option>\n" +
                   "                                        <option>11 PM</option>\n" +
                   "                                        <option>12 PM</option>\n" +
                   "                                    </select>\n" +
                   "                                </div>\n" +
                   "                            </div>";
            }
            inner+="<input type='hidden' name='request-dates-count' value="+(diffDays+1)+">";
            $("#request-days-time").html(inner);
        });

        var interests="";

        $(".like-button").click(function () {
            var key = $(this).children().attr('id')+",";
            if($(this).children().attr('class')=="like-icon liked"){
               interests+=(key);
            }else{
               interests = interests.replace(key,"");
            }
        });


        $("#rebutton").click( function req_check(){
            $("#request-days-time").append("<input type='hidden' name='interests' value='"+interests+"'>");
            $("#request-days-time").append("<input type='hidden' name='pid' value='<?php echo $pid?>'>");
            $("#request-days-time").append("<input type='hidden' name='lantern_sid' value='<?php echo $lantern_sid?>'>");
        });
    });
    


</script>

<div class="setDiv">
    <div class="mask"></div>
    <div class="window">
        <input type="button" href="#" class="close" value="Workout"/>
        <h4>You miss the old American fashion orkout? You can still enjoy working out here in Korea! I will hook u up to old fashion style gym for a workout.</h4>
        <img style="width: 500px" src="images/workout.jpg"><br>
    </div>
</div>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
<script type="text/javascript">
    function wrapWindowByMask(){
        // 화면의 높이와 너비를 변수로 만듭니다.
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        // 마스크의 높이와 너비를 화면의 높이와 너비 변수로 설정합니다.
        $('.mask').css({'width':maskWidth,'height':maskHeight});

        // fade 애니메이션 : 1초 동안 검게 됐다가 80%의 불투명으로 변합니다.
        $('.mask').fadeIn(1000);
        $('.mask').fadeTo("slow",0.8);

        // 레이어 팝업을 가운데로 띄우기 위해 화면의 높이와 너비의 가운데 값과 스크롤 값을 더하여 변수로 만듭니다.
        var left = ( $(window).scrollLeft() + ( $(window).width() - $('.window').width()) / 2 );
        var top = ( $(window).scrollTop() + ( $(window).height() - $('.window').height()) / 2 );

        // css 스타일을 변경합니다.
        $('.window').css({'left':left,'top':top, 'position':'absolute'});

        // 레이어 팝업을 띄웁니다.
        $('.window').show();
    }

    $(document).ready(function(){
        // showMask를 클릭시 작동하며 검은 마스크 배경과 레이어 팝업을 띄웁니다.
        $('.showMask').click(function(e){
            // preventDefault는 href의 링크 기본 행동을 막는 기능입니다.
            e.preventDefault();
            wrapWindowByMask();
        });

        // 닫기(close)를 눌렀을 때 작동합니다.
        $('.window .close').click(function (e) {
            e.preventDefault();
            $('.mask, .window').hide();
        });

        // 뒤 검은 마스크를 클릭시에도 모두 제거하도록 처리합니다.
        $('.mask').click(function () {
            $(this).hide();
            $('.window').hide();
        });
    });
</script>