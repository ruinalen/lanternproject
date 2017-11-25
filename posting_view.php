<?php
$pid = $_GET['pid'];
$conn = mysqli_connect('localhost','lantern','lantern','lantern');

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
$others = array();
$places = array();

while($row = mysqli_fetch_assoc($result3)){

    $query4 = "SELECT * FROM `keyword` WHERE `kid`='$row[kid]'";
    $result4 = mysqli_query($conn, $query4);
    $keyword = mysqli_fetch_assoc($result4);

    if($keyword['geo_offset']==1){
       array_push($places, $keyword);
    }
    if($row[super_offset]==1){
        array_push($supers, $keyword['keyword']);
    }
    else{
        array_push($others, $keyword['keyword']);
    }
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
    </style>



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
	<a href="images/single-listing-01.jpg" data-background-image="images/single-listing-01.jpg" class="item mfp-gallery" title="Title 1"></a>
	<a href="images/single-listing-02.jpg" data-background-image="images/single-listing-02.jpg" class="item mfp-gallery" title="Title 3"></a>
	<a href="images/single-listing-03.jpg" data-background-image="images/single-listing-03.jpg" class="item mfp-gallery" title="Title 2"></a>
	<a href="images/single-listing-04.jpg" data-background-image="images/single-listing-04.jpg" class="item mfp-gallery" title="Title 4"></a>
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
					<h2><?php echo $lantern['name_first'].' '.$lantern['name_last'];?> <span class="listing-tag" style="color: lawngreen; border-color: lawngreen;">Verified</span></h2>
					<span>
						<a href="#listing-location" class="listing-address">
							<i class="im im-icon-Global-Position"></i><?php echo $lantern['region']?>
</a>
					</span>
					<div class="star-rating" data-rating="5">
						<div class="rating-counter"><a href="#listing-reviews">(31 reviews)</a></div>
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
                            <h5>Super Keywords</h5>
                            <div id="super" style="margin-top: 10px">
                                <?php
                                    foreach ($supers as $val)
                                        echo "<button class='button' style='background-color: #aaaaaa'>".$val."</button>";
                                ?>
                            </div>
                        </div>
                        <br>
                        <div class="boxed-widget">
                            <h5>Other Keywords</h5>
                            <div id="other" style="margin-top: 10px">
                                <?php
                                foreach ($others as $val)
                                    echo "<button class='button'style='background-color: #aaaaaa'>".$val."</button>";
                                ?>

                            </div>
                        </div>

                    </div>
                </div>


			<!-- Food Menu / End -->


			<!-- Location -->
			<div id="listing-location" class="listing-section">
				<h3 class="listing-desc-headline margin-top-60 margin-bottom-30">Places</h3>
                <div id="map-container" style="width:auto;" class="fullwidth-home-map">

                    <div id="map" data-map-zoom="9">
                        <!-- map goes here -->
                    </div>
                </div>
			</div>

			<!-- Reviews -->
			<div id="listing-reviews" class="listing-section">
				<h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>

				<div class="clearfix"></div>

				<!-- Reviews -->
				<section class="comments listing-reviews">

					<ul>
						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>

								<div class="review-images mfp-gallery-container">
									<a href="images/review-image-01.jpg" class="mfp-gallery"><img src="images/review-image-01.jpg" alt=""></a>
								</div>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>12</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">John Doe<span class="date">May 2017</span>
									<div class="star-rating" data-rating="4"></div>
								</div>
								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>2</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>

								<div class="review-images mfp-gallery-container">
									<a href="images/review-image-02.jpg" class="mfp-gallery"><img src="images/review-image-02.jpg" alt=""></a>
									<a href="images/review-image-03.jpg" class="mfp-gallery"><img src="images/review-image-03.jpg" alt=""></a>
								</div>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>4</span></a>
							</div>
						</li>

						<li>
							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>
							<div class="comment-content"><div class="arrow-comment"></div>
								<div class="comment-by">John Doe<span class="date">May 2017</span>
									<div class="star-rating" data-rating="5"></div>
								</div>
								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>
								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review</a>
							</div>

						</li>
					 </ul>
				</section>

				<!-- Pagination -->
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12">
						<!-- Pagination -->
						<div class="pagination-container margin-top-30">
							<nav class="pagination">
								<ul>
									<li><a href="#" class="current-page">1</a></li>
									<li><a href="#">2</a></li>
									<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<!-- Pagination / End -->
			</div>

		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

			<!-- Book Now -->
			<div class="boxed-widget">
				<h3><i class="fa fa-calendar-check-o "></i> Book a Table</h3>
				<div class="row with-forms  margin-top-0">

					<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
					<div class="col-lg-6 col-md-12">
						<input type="text" id="booking-date" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
					</div>

					<!-- Time Picker - docs: http://www.vasterad.com/docs/listeo/#!/time_picker -->
					<div class="col-lg-6 col-md-12">
						<input type="text" id="booking-time" value="9:00 am">
					</div>

				</div>

				<!-- progress button animation handled via custom.js -->
				<button class="progress-button button fullwidth margin-top-5"><span>Book Now</span></button>
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

				<!-- Reply to review popup -->
				<div id="small-dialog" class="zoom-anim-dialog mfp-hide">
					<div class="small-dialog-header">
						<h3>Send Message</h3>
					</div>
					<div class="message-reply margin-top-0">
						<textarea cols="40" rows="3" placeholder="Your message to Burger House"></textarea>
						<button class="button">Send Message</button>
					</div>
				</div>

				<a href="#small-dialog" class="send-message-to-owner button popup-with-zoom-anim"><i class="sl sl-icon-envelope-open"></i> Send Message</a>
			</div>
			<!-- Contact / End-->


<!--			<!-- Opening Hours -->
<!--			<div class="boxed-widget opening-hours margin-top-35">-->
<!--				<div class="listing-badge now-open">Now Open</div>-->
<!--				<h3><i class="sl sl-icon-clock"></i> Opening Hours</h3>-->
<!--				<ul>-->
<!--					<li>Monday <span>9 AM - 5 PM</span></li>-->
<!--					<li>Tuesday <span>9 AM - 5 PM</span></li>-->
<!--					<li>Wednesday <span>9 AM - 5 PM</span></li>-->
<!--					<li>Thursday <span>9 AM - 5 PM</span></li>-->
<!--					<li>Friday <span>9 AM - 5 PM</span></li>-->
<!--					<li>Saturday <span>9 AM - 3 PM</span></li>-->
<!--					<li>Sunday <span>Closed</span></li>-->
<!--				</ul>-->
<!--			</div>-->
<!--			<!-- Opening Hours / End


			<!-- Share / Like -->
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



<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
<link href="css/plugins/datedropper.css" rel="stylesheet" type="text/css">
<script src="scripts/datedropper.js"></script>
<script>$('#booking-date').dateDropper();</script>

<!-- Time Picker - docs: http://www.vasterad.com/docs/listeo/#!/time_picker -->
<script src="scripts/timedropper.js"></script>
<link rel="stylesheet" type="text/css" href="css/plugins/timedropper.css">
<script>
this.$('#booking-time').timeDropper({
	setCurrentTime: false,
	meridians: true,
	primaryColor: "#f91942",
	borderColor: "#f91942",
	minutesInterval: '15'
});

var $clocks = $('.td-input');
	.each($clocks, function(clock){
        clock.value = null;
    });
</script>





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



    });
</script>