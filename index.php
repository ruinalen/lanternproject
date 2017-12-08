<?php
session_start();
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
    <header id="header-container">
        <!-- Header -->
        <?php include 'header.php';?>
        <!-- Header / End -->

    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->


    <!-- Banner
    ================================================== -->
    <div class="main-search-container" data-background-image="images/main-search-background02.jpg">
        <div class="main-search-inner">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Find Your Lantern</h2>
                        <h4>Light your own way</h4>
                        <form action="search_result.php"  method="get">
                        <div class="main-search-input">

                            <div class="main-search-input-item">
                                <input type="text" name="keyword" placeholder="What are you looking for?" value=""/>
                            </div>
                            <div class="main-search-input-item location">

<!--                                    <input name="date" id="date" type="date" value="--><?php //echo date("Y-m-d");?><!--" min="--><?php //echo date("Y-m-d");?><!--"-->
<!--                                           max="--><?php //echo date("Y-m-d",strtotime("+12 week"));?><!--" style="width: 80%"/>-->

                                <input name="date" id="date" type="date" value="All"
                                       min="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d",strtotime("+12 week"));?>" style="width: 80%"/>

                                    <a href="#"><i class="fa fa-calendar"></i></a>

                                <!-- 달력 아이콘 누르면 달력 나오게 안되나요-->
                            </div>
                            <button class="button" type="submit">Search</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <h3 class="headline centered margin-top-75">
                    Popular Categories
                    <span>Browse <i>the most desirable</i> categories</span>
                </h3>
            </div>

        </div>
    </div>


    <!-- Categories Carousel -->
    <div class="fullwidth-carousel-container margin-top-25">
        <div class="fullwidth-slick-carousel category-carousel">

            <!-- Item -->
            <div class="fw-carousel-item">

                <!-- this (first) box will be hidden under 1680px resolution -->
                <div class="category-box-container half">
                    <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="images/category-box-01.jpg">
                        <div class="category-box-content">
                            <h3>Hotels</h3>
                            <span>64 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>

                <div class="category-box-container half">
                    <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="images/category-box-02.jpg">
                        <div class="category-box-content">
                            <h3>Shops</h3>
                            <span>14 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>
            </div>

            <!-- Item -->
            <div class="fw-carousel-item">
                <div class="category-box-container">
                    <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="images/category-box-03.jpg">
                        <div class="category-box-content">
                            <h3>Events</h3>
                            <span>67 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>
            </div>

            <!-- Item -->
            <div class="fw-carousel-item">
                <div class="category-box-container">
                    <a href="listings-half-screen-map-grid-1.html" class="category-box" data-background-image="images/category-box-04.jpg">
                        <div class="category-box-content">
                            <h3>Fitness</h3>
                            <span>27 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>
            </div>

            <!-- Item -->
            <div class="fw-carousel-item">
                <div class="category-box-container">
                    <a href="listings-half-screen-map-list.html" class="category-box" data-background-image="images/category-box-05.jpg">
                        <div class="category-box-content">
                            <h3>Nightlife</h3>
                            <span>22 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>
            </div>

            <!-- Item -->
            <div class="fw-carousel-item">
                <div class="category-box-container">
                    <a href="listings-half-screen-map-list.html" class="category-box" data-background-image="images/category-box-06.jpg">
                        <div class="category-box-content">
                            <h3>Eat & Drink</h3>
                            <span>130 listings</span>
                        </div>
                        <span class="category-box-btn">Browse</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <!-- Categories Carousel / End -->



    <!-- Fullwidth Section -->
    <section class="fullwidth margin-top-65 padding-top-75 padding-bottom-70" data-background-color="#f8f8f8">

        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="headline centered margin-bottom-45">
                        Most Visited Places
                        <span>Discover top-rated local businesses</span>
                    </h3>
                </div>

                <div class="col-md-12">
                    <div class="simple-slick-carousel dots-nav">

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-01.jpg" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Tom's Restaurant</h3>
                                        <span>964 School Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="3.5">
                                    <div class="rating-counter">(12 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-02.jpg" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Friday, August 10</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Events</span>
                                        <h3>Sticky Band</h3>
                                        <span>Bishop Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(23 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-03.jpg" alt="">
                                    <div class="listing-item-details">
                                        <ul>
                                            <li>Starting from $59 per night</li>
                                        </ul>
                                    </div>
                                    <div class="listing-item-content">
                                        <span class="tag">Hotels</span>
                                        <h3>Hotel Govendor</h3>
                                        <span>778 Country Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="2.0">
                                    <div class="rating-counter">(17 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-04.jpg" alt="">

                                    <div class="listing-badge now-open">Now Open</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Burger House</h3>
                                        <span>2726 Shinn Street, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="5.0">
                                    <div class="rating-counter">(31 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-05.jpg" alt="">
                                    <div class="listing-item-content">
                                        <span class="tag">Other</span>
                                        <h3>Airport</h3>
                                        <span>1512 Duncan Avenue, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="3.5">
                                    <div class="rating-counter">(46 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->

                        <!-- Listing Item -->
                        <div class="carousel-item">
                            <a href="listings-single-page.html" class="listing-item-container">
                                <div class="listing-item">
                                    <img src="images/listing-item-06.jpg" alt="">

                                    <div class="listing-badge now-closed">Now Closed</div>

                                    <div class="listing-item-content">
                                        <span class="tag">Eat & Drink</span>
                                        <h3>Think Coffee</h3>
                                        <span>215 Terry Lane, New York</span>
                                    </div>
                                    <span class="like-icon"></span>
                                </div>
                                <div class="star-rating" data-rating="4.5">
                                    <div class="rating-counter">(15 reviews)</div>
                                </div>
                            </a>
                        </div>
                        <!-- Listing Item / End -->
                    </div>

                </div>

            </div>
        </div>

    </section>
    <!-- Fullwidth Section / End -->


    <!-- Info Section -->
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="headline centered margin-top-80">
                    Plan The Vacation of Your Dreams
                    <span class="margin-top-25">Explore some of the best tips from around the world from our partners and friends.  Discover some of the most popular listings in Sydney.</span>
                </h2>
            </div>
        </div>

        <div class="row icons-container">
            <!-- Stage -->
            <div class="col-md-4">
                <div class="icon-box-2 with-line">
                    <i class="im im-icon-Map2"></i>
                    <h3>Find Interesting Place</h3>
                    <p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
                </div>
            </div>

            <!-- Stage -->
            <div class="col-md-4">
                <div class="icon-box-2 with-line">
                    <i class="im im-icon-Mail-withAtSign"></i>
                    <h3><?php echo $_SESSION['user_email']?></h3>
                    <p>dd pulvinar, risus in facilisis dignissim, quam nisi hendrerit nulla, id vestibulum metus nullam viverra porta purus.</p>
                </div>
            </div>

            <!-- Stage -->
            <div class="col-md-4">
                <div class="icon-box-2">
                    <i class="im im-icon-Checked-User"></i>
                    <h3>Make a Reservation</h3>
                    <p>Faucibus ante, in porttitor tellus blandit et. Phasellus tincidunt metus lectus sollicitudin feugiat pharetra consectetur.</p>
                </div>
            </div>
        </div>

    </div>
    <!-- Info Section / End -->


    <!-- Recent Blog Posts -->
    <section class="fullwidth border-top margin-top-70 padding-top-75 padding-bottom-75" data-background-color="#fff">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h3 class="headline centered margin-bottom-45">
                        From The Blog
                    </h3>
                </div>
            </div>

            <div class="row">
                <!-- Blog Post Item -->
                <div class="col-md-4">
                    <a href="pages-blog-post.html" class="blog-compact-item-container">
                        <div class="blog-compact-item">
                            <img src="images/blog-compact-post-01.jpg" alt="">
                            <span class="blog-item-tag">Tips</span>
                            <div class="blog-compact-item-content">
                                <ul class="blog-post-tags">
                                    <li>22 August 2017</li>
                                </ul>
                                <h3>Hotels for All Budgets</h3>
                                <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Blog post Item / End -->

                <!-- Blog Post Item -->
                <div class="col-md-4">
                    <a href="pages-blog-post.html" class="blog-compact-item-container">
                        <div class="blog-compact-item">
                            <img src="images/blog-compact-post-02.jpg" alt="">
                            <span class="blog-item-tag">Tips</span>
                            <div class="blog-compact-item-content">
                                <ul class="blog-post-tags">
                                    <li>18 August 2017</li>
                                </ul>
                                <h3>The 50 Greatest Street Arts In London</h3>
                                <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Blog post Item / End -->

                <!-- Blog Post Item -->
                <div class="col-md-4">
                    <a href="pages-blog-post.html" class="blog-compact-item-container">
                        <div class="blog-compact-item">
                            <img src="images/blog-compact-post-03.jpg" alt="">
                            <span class="blog-item-tag">Tips</span>
                            <div class="blog-compact-item-content">
                                <ul class="blog-post-tags">
                                    <li>10 August 2017</li>
                                </ul>
                                <h3>The Best Cofee Shops In Sydney Neighborhoods</h3>
                                <p>Sed sed tristique nibh iam porta volutpat finibus. Donec in aliquet urneget mattis lorem. Pellentesque pellentesque.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Blog post Item / End -->

                <div class="col-md-12 centered-content">
                    <a href="pages-blog.html" class="button border margin-top-10">View Blog</a>
                </div>

            </div>

        </div>
    </section>
    <!-- Recent Blog Posts / End -->


    <!-- Footer
    ================================================== -->
    <div id="footer" class="sticky-footer">
        <!-- Main -->
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6">
                    <img class="footer-logo" src="images/logo00.png" alt="">
                    <br><br>
                    <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
                </div>

                <div class="col-md-4 col-sm-6 ">
                    <h4>Helpful Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Sign Up</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="">Add Listing</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>

                    <ul class="footer-links">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Our Partners</a></li>
                        <li><a href="#">How It Works</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="col-md-3  col-sm-12">
                    <h4>Contact Us</h4>
                    <div class="text-widget">
                        <span>12345 Little Lonsdale St, Melbourne</span> <br>
                        Phone: <span>(123) 123-456 </span><br>
                        E-Mail:<span> <a href="#">office@example.com</a> </span><br>
                    </div>

                    <ul class="social-icons margin-top-20">
                        <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                        <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                        <li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
                    </ul>

                </div>

            </div>

            <!-- Copyright -->
            <div class="row">
                <div class="col-md-12">
                    <div class="copyrights">© 2017 Lantern. All Rights Reserved.</div>
                </div>
            </div>

        </div>

    </div>
    <!-- Footer / End -->


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


<!-- Style Switcher
================================================== -->
<script src="scripts/switcher.js"></script>

<div id="style-switcher">
    <h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

    <div>
        <ul class="colors" id="color1">
            <li><a href="#" class="main" title="Main"></a></li>
            <li><a href="#" class="blue" title="Blue"></a></li>
            <li><a href="#" class="green" title="Green"></a></li>
            <li><a href="#" class="orange" title="Orange"></a></li>
            <li><a href="#" class="navy" title="Navy"></a></li>
            <li><a href="#" class="yellow" title="Yellow"></a></li>
            <li><a href="#" class="peach" title="Peach"></a></li>
            <li><a href="#" class="beige" title="Beige"></a></li>
            <li><a href="#" class="purple" title="Purple"></a></li>
            <li><a href="#" class="celadon" title="Celadon"></a></li>
            <li><a href="#" class="red" title="Red"></a></li>
            <li><a href="#" class="brown" title="Brown"></a></li>
            <li><a href="#" class="cherry" title="Cherry"></a></li>
            <li><a href="#" class="cyan" title="Cyan"></a></li>
            <li><a href="#" class="gray" title="Gray"></a></li>
            <li><a href="#" class="olive" title="Olive"></a></li>
        </ul>
    </div>

</div>
<!-- Style Switcher / End -->




</body>
</html>