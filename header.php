<?php
session_start();
?>
<!-- Header -->

<div id="header">
    <div class="container">

        <!-- Left Side Content -->
        <div class="left-side">

            <!-- Logo -->
            <div id="logo">
                <a href="index.php"><img src="images/logo00.png" alt=""></a>

            </div>

            <!-- Mobile Navigation -->
            <div class="menu-responsive">
                <i class="fa fa-reorder menu-trigger"></i>
            </div>

            <!-- Main Navigation -->
            <nav id="navigation" class="style-1">
                <ul id="responsive">

                    <li><a class="current" href="#">Home</a>
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

                    <li><a href="#">User Panel</a>
                        <ul>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="dashboard-messages.html">Messages</a></li>
                            <li><a href="dashboard-my-listings.html">My Listings</a></li>
                            <li><a href="dashboard-reviews.html">Reviews</a></li>
                            <li><a href="dashboard-bookmarks.html">Bookmarks</a></li>
                            <li><a href="add_posting.php">Add Listing</a></li>
                            <li><a href="profile.php">My Profile</a></li>
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
            <div class="header-widget" id="header-widget-nlogged">
                <a href="#sign-in-dialog" class="sign-in popup-with-zoom-anim"><i class="sl sl-icon-login"></i> Sign In</a>
                <a href="add_posting.php" class="button border with-icon">Add Post <i class="sl sl-icon-plus"></i></a>
            </div>

            <div class="header-widget" id="header-widget-logged">

                <!-- User Menu -->
                <div class="user-menu">
                    <div class="user-name"><?php echo $_SESSION['user_name_first']?><span>
                            <div class="profile_img_circle" style='background-image: url("./profile_img/<?php echo $_SESSION['user_sid']?>.png")'></div></span></div>
                    <ul>
                        <li><a href="dashboard.html"><i class="sl sl-icon-settings"></i> Dashboard</a></li>
                        <li><a href="dashboard-messages.html"><i class="sl sl-icon-envelope-open"></i> Messages</a></li>
                        <li><a href="profile.php"><i class="sl sl-icon-user"></i> My Profile</a></li>
                        <li><a href="logout.php"><i class="sl sl-icon-power"></i> Logout</a></li>
                    </ul>
                </div>

                <a href="add_posting.php" class="button border with-icon">Add Post <i class="sl sl-icon-plus"></i></a>
            </div>
            <script>
                function loginhead(){
                    var element1 = document.getElementById( 'header-widget-nlogged' );
                    var element2 = document.getElementById( 'header-widget-logged' );
                    element1.classList.add( 'header-widget-hide' );
                    element2.classList.remove( 'header-widget-hide' );
                }
                function notloginhead(){
                    var element1 = document.getElementById( 'header-widget-nlogged' );
                    var element2 = document.getElementById( 'header-widget-logged' );
                    element2.classList.add( 'header-widget-hide' );
                    element1.classList.remove( 'header-widget-hide' );
                }

            </script>

            <?php
            if($_SESSION['user_sid'] == NULL){
                echo("<script language='javascript'>notloginhead();</script>");
            }
            else{
                echo("<script language='javascript'>loginhead();</script>");
            }
            ?>
            <!-- Header Widget / End -->

        </div>
        <!-- Right Side Content / End -->




        <!-- Sign In Popup -->
        <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">

            <div class="small-dialog-header">
                <h3>Sign In</h3>
            </div>

            <!--Tabs -->
            <div class="sign-in-form style-1">

                <ul class="tabs-nav">
                    <li class=""><a href="#tab1">Log In</a></li>
                    <li><a href="#tab2">Register</a></li>
                </ul>

                <div class="tabs-container alt">

                    <!-- Login -->
                    <div class="tab-content" id="tab1" style="display: none;">
                        <form method="post" class="login" action="./login.php">

                            <p class="form-row form-row-wide">
                                <label for="email">Email:
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text" name="email" id="email" value="" />
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password">Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password" id="password"/>
                                </label>
                                <span class="lost_password">
										<a href="#" >Lost Your Password?</a>
									</span>
                            </p>

                            <div class="form-row">
                                <input type="submit" class="button border margin-top-5" name="login" value="Login" />
                                <div class="checkboxes margin-top-10">
                                    <input id="remember-me" type="checkbox" name="check">
                                    <label for="remember-me">Remember Me</label>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Register -->
                    <div class="tab-content" id="tab2" style="display: none;">

                        <form method="post" class="register" id="register" action="./register.php">

                            <p class="form-row form-row-wide">
                                <label for="username2"> First name / Last name:
                                    <br>
                                    <i class="im im-icon-Male"></i>
                                    <input type="text" class="input-text-half" name="name_first" id="username1" value=""  style="float: left; margin-right: 1%;"/>
                                    <input type="text" class="input-text-half" name="name_last" id="username2" value=""  />
                                </label>
                            </p>


                            <p class="form-row form-row-wide">
                                <label for="email2">Email Address:
                                    <i class="im im-icon-Mail"></i>
                                    <input type="text" class="input-text" name="email" id="email2" value="" />
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password1">Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password1" id="password1"/>
                                </label>
                            </p>

                            <p class="form-row form-row-wide">
                                <label for="password2">Repeat Password:
                                    <i class="im im-icon-Lock-2"></i>
                                    <input class="input-text" type="password" name="password2" id="password2"/>
                                </label>
                            </p>

                            <input type="submit" class="button border fw margin-top-10" name="register" value="Register" />

                        </form>
                    </div>
                    <script type="text/javascript">
                        window.onload=function(){
                            document.getElementById('register').onsubmit=function(){
                                var pass=document.getElementById('password1').value;
                                var passCheck=document.getElementById('password2').value;

                                if(pass!=passCheck){
                                    alert('비밀번호가 일치하지 않습니다!');
                                    return false;
                                }

                            }
                        }
                    </script>
                </div>
            </div>
        </div>
        <!-- Sign In Popup / End -->

    </div>
</div>
<!-- Header / End -->