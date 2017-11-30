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
       array_push($places, array(kid => $keyword['kid'], keyword => $keyword['keyword'], location=>$keyword['geo_location'], address=>$keyword['geo_address'], name=>$keyword['geo_name'] ));
    }

    if($row[super_offset]==1){
        array_push($supers, $keyword['keyword']);
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



?>

<?php
session_start();
if($_SESSION['user_sid'] == NULL){
    echo("<script> document.location.href='http://223.195.109.38/lanternproject/index.php';</script>");
}
$u_query1 = "SELECT * FROM `member` WHERE `sid` ='$_SESSION[user_sid]'";
$u_result = mysqli_query($conn, $u_query1);
$u_user = mysqli_fetch_assoc($u_result);?>



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
					<h2><?php echo $lantern['name_first'].' '.$lantern['name_last'];?> <span class="listing-tag" style="color: lawngreen; border-color: lawngreen;">Verified</span></h2>
					<span>
						<a href="#listing-location" class="listing-address">
							<i class="im im-icon-Global-Position"></i><?php echo $lantern['region']?>
</a>
					</span>
					<div class="star-rating" data-rating="4">
						<div class="rating-counter"><a href="#listing-reviews">(1 reviews)</a></div>
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
                            <div id="super" class="showMask" style="margin-top: 10px">
                                <?php
                                    foreach ($supers as $val)
                                        echo "<button class='button' id='super' style='background-color: #aaaaaa'>".$val."</button>";
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

                    <div id="map" data-map-zoom="11">
                        <!-- map goes here -->
                    </div>
                </div>
			</div>

<!--			<!-- Reviews -->
<!--			<div id="listing-reviews" class="listing-section">-->
<!--				<h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(12)</span></h3>-->
<!---->
<!--				<div class="clearfix"></div>-->
<!---->
<!--				<!-- Reviews -->
<!--				<section class="comments listing-reviews">-->
<!---->
<!--					<ul>-->
<!--						<li>-->
<!--							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>-->
<!--							<div class="comment-content"><div class="arrow-comment"></div>-->
<!--								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>-->
<!--									<div class="star-rating" data-rating="5"></div>-->
<!--								</div>-->
<!--								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>-->
<!---->
<!--								<div class="review-images mfp-gallery-container">-->
<!--									<a href="images/review-image-01.jpg" class="mfp-gallery"><img src="images/review-image-01.jpg" alt=""></a>-->
<!--								</div>-->
<!--								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>12</span></a>-->
<!--							</div>-->
<!--						</li>-->
<!---->
<!--						<li>-->
<!--							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>-->
<!--							<div class="comment-content"><div class="arrow-comment"></div>-->
<!--								<div class="comment-by">John Doe<span class="date">May 2017</span>-->
<!--									<div class="star-rating" data-rating="4"></div>-->
<!--								</div>-->
<!--								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>-->
<!--								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>2</span></a>-->
<!--							</div>-->
<!--						</li>-->
<!---->
<!--						<li>-->
<!--							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /></div>-->
<!--							<div class="comment-content"><div class="arrow-comment"></div>-->
<!--								<div class="comment-by">Kathy Brown<span class="date">June 2017</span>-->
<!--									<div class="star-rating" data-rating="5"></div>-->
<!--								</div>-->
<!--								<p>Morbi velit eros, sagittis in facilisis non, rhoncus et erat. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae. Curabitur lacinia neque non metus</p>-->
<!---->
<!--								<div class="review-images mfp-gallery-container">-->
<!--									<a href="images/review-image-02.jpg" class="mfp-gallery"><img src="images/review-image-02.jpg" alt=""></a>-->
<!--									<a href="images/review-image-03.jpg" class="mfp-gallery"><img src="images/review-image-03.jpg" alt=""></a>-->
<!--								</div>-->
<!--								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review <span>4</span></a>-->
<!--							</div>-->
<!--						</li>-->
<!---->
<!--						<li>-->
<!--							<div class="avatar"><img src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&amp;s=70" alt="" /> </div>-->
<!--							<div class="comment-content"><div class="arrow-comment"></div>-->
<!--								<div class="comment-by">John Doe<span class="date">May 2017</span>-->
<!--									<div class="star-rating" data-rating="5"></div>-->
<!--								</div>-->
<!--								<p>Commodo est luctus eget. Proin in nunc laoreet justo volutpat blandit enim. Sem felis, ullamcorper vel aliquam non, varius eget justo. Duis quis nunc tellus sollicitudin mauris.</p>-->
<!--								<a href="#" class="rate-review"><i class="sl sl-icon-like"></i> Helpful Review</a>-->
<!--							</div>-->
<!---->
<!--						</li>-->
<!--					 </ul>-->
<!--				</section>-->
<!---->
<!--				<!-- Pagination -->
<!--				<div class="clearfix"></div>-->
<!--				<div class="row">-->
<!--					<div class="col-md-12">-->
<!--						<!-- Pagination -->
<!--						<div class="pagination-container margin-top-30">-->
<!--							<nav class="pagination">-->
<!--								<ul>-->
<!--									<li><a href="#" class="current-page">1</a></li>-->
<!--									<li><a href="#">2</a></li>-->
<!--									<li><a href="#"><i class="sl sl-icon-arrow-right"></i></a></li>-->
<!--								</ul>-->
<!--							</nav>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="clearfix"></div>-->
<!--				<!-- Pagination / End -->
<!--			</div>-->

            			<!-- Reviews -->
            			<div id="listing-reviews" class="listing-section">
            				<h3 class="listing-desc-headline margin-top-75 margin-bottom-20">Reviews <span>(1)</span> <span></span></h3>

            				<div class="clearfix"></div>

            				<!-- Reviews -->
            				<section class="comments listing-reviews">

            					<ul>
            						<li>
            							<div class="avatar"><img src="./profile_img/21.png" alt="" /></div>
            							<div class="comment-content"><div class="arrow-comment"></div>
            								<div class="comment-by">서경 배<span class="date">November 2017</span>
            									<div class="star-rating" data-rating="4"></div>
            								</div>
            								<p>후기 test1111 님 너무 친절하세요^^</p>

            							</div>
            						</li>

<!--                                    <li>-->
<!--                                        <div class="avatar"><img src="./profile_img/19.png" alt="" /></div>-->
<!--                                        <div class="comment-content"><div class="arrow-comment"></div>-->
<!--                                            <div class="comment-by">test test<span class="date">November 2017</span>-->
<!--                                                <div class="star-rating" data-rating="3"></div>-->
<!--                                            </div>-->
<!--                                            <p>후기 test2222</p>-->
<!---->
<!--                                        </div>-->
<!--                                    </li>-->


            					 </ul>
            				</section>

                            <div id="review-dialog" class="zoom-anim-dialog mfp-hide">
                                <div class="review-dialog-header" style="margin-bottom: 0px">
                                    <h4>Review</h4>
                                </div>

                                <span class="leave-rating-title" style="margin-top: 5px">Your rating for the Lantern</span>

                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Leave Rating -->
                                        <div class="clearfix"></div>
                                        <div class="leave-rating margin-bottom-30">
                                            <input type="radio" name="rating" id="rating-1" value="1"/>
                                            <label for="rating-1" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-2" value="2"/>
                                            <label for="rating-2" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-3" value="3"/>
                                            <label for="rating-3" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-4" value="4"/>
                                            <label for="rating-4" class="fa fa-star"></label>
                                            <input type="radio" name="rating" id="rating-5" value="5"/>
                                            <label for="rating-5" class="fa fa-star"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <form id="add-comment" class="add-comment">
                                    <fieldset>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name:</label>
                                                <input value="<?php echo $u_user['name_first']." ".$u_user['name_last']?>" type="text" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Email:</label>
                                                <input value="<?php echo $u_user['email']?>" type="text" readonly>




                                            </div>
                                        </div>

                                    </fieldset>
                                </form>



                                <div class="message-reply margin-top-0">
                                    <textarea cols="40" rows="3" placeholder="Your message to the Lantern"></textarea>
                                    <button class="button">Write Review</button>
                                </div>
                            </div>
                            <a href="#review-dialog" class="send-message-to-owner button popup-with-zoom-anim"></i> Write Review</a>






            			</div>


		</div>


		<!-- Sidebar
		================================================== -->
		<div class="col-lg-4 col-md-4 margin-top-75 sticky">

			<!-- Book Now -->
			<div class="boxed-widget">
				<h3><i class="fa fa-calendar-check-o "></i> Book a Lantern</h3>
                <div id='calendar'></div>
				<div class="row with-forms  margin-top-0">

					<!-- Date Picker - docs: http://www.vasterad.com/docs/listeo/#!/date_picker -->
					<div class="col-lg-6 col-md-12">
						<input type="text" id="booking-date" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
					</div>
                    <div class="col-lg-6 col-md-12">
                        <input type="text" id="booking-date2" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020">
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
        })

    });

</script>

<!--<div class="setDiv">-->
<!--    <div class="mask"></div>-->
<!--    <div class="window">-->
<!--        <input type="button" href="#" class="close" value="Raw_Octopus"/>-->
<!--        <h4>Try Raw Octopus!!</h4>-->
<!--        <img style="width: 500px" src="images/raw_octopus.jpg"><br>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="setDiv">-->
<!--    <div class="mask"></div>-->
<!--    <div class="window">-->
<!--        <input type="button" href="#" class="close" value="Night_culture"/>-->
<!--        <h4>Want to go crazy with music and alcohol?-->
<!--            Choose me and we will enjoy the night safely</h4>-->
<!--        <img style="width: 500px" src="images/bbq.jpg"><br>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="setDiv">-->
<!--    <div class="mask"></div>-->
<!--    <div class="window">-->
<!--        <input type="button" href="#" class="close" value="Itaewon"/>-->
<!--        <h4>If you want to experience the night life vibe in Itaewon,I am the one to talk to. I also know many restaurants in here.</h4>-->
<!--        <img style="width: 500px" src="images/itaewon.jpg"><br>-->
<!--    </div>-->
<!--</div>-->

<div class="setDiv">
    <div class="mask"></div>
    <div class="window">
        <input type="button" href="#" class="close" value="Workout"/>
        <h4>You miss the old American fashion orkout? You can still enjoy working out here in Korea! I will hook u up to old fashion style gym for a workout.</h4>
        <img style="width: 500px" src="images/workout.jpg"><br>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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