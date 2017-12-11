<?php
session_start();

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$sid = $_SESSION['user_sid'];
if($sid==null){
    Header("Location: ./index.php");
}

$received_list = array();
$sent_list = array();

$query1 = "SELECT * FROM `request` WHERE `lantern_sid`=$sid AND `state`= 0 ORDER BY `time_stamp` DESC "; //신청

$result1 = mysqli_query($conn, $query1);
while ($row1 = mysqli_fetch_assoc($result1)) {
    $query3 = "SELECT * FROM `member` WHERE `sid`=".$row1['traveler_sid'];
    $result3 = mysqli_query($conn, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    $row1['nation'] = $row3['region'];
    array_push($received_list,$row1);
}

$query2 = "SELECT * FROM `request` WHERE `traveler_sid`=$sid ORDER BY `time_stamp` DESC ";
$result2 = mysqli_query($conn, $query2);
while ($row2 = mysqli_fetch_assoc($result2)) {
    $query4 = "SELECT * FROM `member` WHERE `sid`=".$row2['lantern_sid'];
    $result4 = mysqli_query($conn, $query4);
    $row4 = mysqli_fetch_assoc($result4);
    $row2['nation'] = $row4['region'];
    $row2['lantern_name'] = $row4['name_first']." ".$row4['name_last'];
    array_push($sent_list,$row2);
}

?>
<!DOCTYPE html>
<head>
    <style>
        #accept{
            background-color: white;
            color: green;
            border: 1px green solid;
        }
        #delete{
            background-color: white;
            color: red;
            border: 1px red solid;
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
                        <h2>My Requests</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li>My Requests</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Listings -->
                <div class="col-lg-6 col-md-12">

                    <div class="dashboard-list-box margin-top-0">

                        <h4>Received Request</h4>

                        <?php
                        foreach ($received_list as $value){
                            $interests = explode(',',$value['interests']);
                            $interesthtml="";
                            $dates = explode(';',$value['request_dates']);
                            $dateshtml="";
                            foreach ($interests as $val){
                                if($val==""){
                                    break;
                                }
                                $interesthtml = $interesthtml."<button class='button'>".$val."</button>";
                            }
                            foreach ($dates as $val){
                                if($val==""){
                                    break;
                                }
                                $sibal = explode(",", $val);
                                $dateshtml  = $dateshtml."
                                    <div class=\"row margin-top-0\">
                                        <div class=\"col-lg-6 col-md-12\">
                                            <input type=\"date\" data-large-mode=\"true\" readonly value='".$sibal[0]."'>
                                        </div>
                                        <div class=\"col-lg-6 col-md-12\">
                                            <input data-large-mode=\"true\" readonly value='".$sibal[1]." - ".$sibal[2]."'>
                                        </div>
                                     </div>";
                            }

                            print"
                                    <div id=\"small-dialog\" class=\"zoom-anim-dialog mfp-hide rq".$value['rqid']."\">
                                        <div class=\"small-dialog-header\">
                                            <h3>Request from ".$value['traveler_name']."</h3>
                                        </div>
                                        <div class=\"message-reply margin-top-0\">
                                        <div class='profile_img_circle2' style='background-image: url(\"./profile_img/".$value['traveler_sid'].".png\"); float:left;'></div>
                                        <div style=\"margin-left: 140px;\"><h4>".$value['traveler_name']."&emsp;<i class='fa fa-globe'></i>&nbsp;".$value['nation']."</h4><span class=\"date\">".$value['time_stamp']."</span></div>
                                        <br><br><br>
                                        <h4 style=\"margin-bottom: 20px;\">Request Time</h4>
                                        ".$dateshtml."
                                        <h4 style=\"margin-bottom: 20px;margin-top: 20px;\">Interest Keywords</h4>
                                            ".$interesthtml."
                                         <h4 style=\"margin-bottom: 20px;margin-top: 20px;\">Comment</h4>
                                          <p>".$value['comment']."</p>  
                                        </div>
                                        <div style='text-align: center'>
                                        <button class='button ac".$value['rqid']."' id='accept'>Accept Request</button> <button class='button de".$value['rqid']."' id='delete'>Delete Request</button>
                                      </div>
                                    </div>
                                   ";
                        }
                        ?>

                        <ul>
                            <?php
                                foreach ($received_list as $value){
                                    print"<li>
                                <div class=\"comments listing-reviews\">
                                <a href='.rq".$value['rqid']."' class=\"popup-with-zoom-anim\">                                
                                    <ul>
                                        <li>
                                            <div class='profile_img_circle2' style=\"background-image: url('./profile_img/".$value['traveler_sid'].".png'); float:left;\"></div>
                                            <div style='margin-left: 5%;' class=\"comment-content\"><div class=\"arrow-comment\"></div>
                                                <div class=\"comment-by\"><img style='width: 20px;' src='images/travelerlogo.png'>&nbsp;&nbsp;".$value['traveler_name']."<div class=\"comment-by-listing\">&emsp;<i class='fa fa-globe'></i>&nbsp;".$value['nation']."</div> <span class=\"date\">".$value['time_stamp']."</span>
                                                </div>
                                                <p>".substr($value['comment'],0,20)." ....</p>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                                </div>
                            </li>";
                                }
                            ?>

                        </ul>
                    </div>

                </div>

                <!-- Listings -->
                <div class="col-lg-6 col-md-12">
                    <div class="dashboard-list-box margin-top-0">
                        <h4>Request Sent</h4>
                        <?php
                        foreach ($sent_list as $value){
                            $interests = explode(',',$value['interests']);
                            $interesthtml="";
                            $dates = explode(';',$value['request_dates']);
                            $dateshtml="";
                            foreach ($interests as $val){
                                if($val==""){
                                    break;
                                }
                                $interesthtml = $interesthtml."<button class='button'>".$val."</button>";
                            }
                            foreach ($dates as $val){
                                if($val==""){
                                    break;
                                }
                                $sibal = explode(",", $val);
                                $dateshtml  = $dateshtml."
                                    <div class=\"row margin-top-0\">
                                        <div class=\"col-lg-6 col-md-12\">
                                            <input type=\"date\" data-large-mode=\"true\" readonly value='".$sibal[0]."'>
                                        </div>
                                        <div class=\"col-lg-6 col-md-12\">
                                            <input data-large-mode=\"true\" readonly value='".$sibal[1]." - ".$sibal[2]."'>
                                        </div>
                                     </div>";
                            }

                            print"
                                    <div id=\"small-dialog\" class=\"zoom-anim-dialog mfp-hide rqt".$value['rqid']."\">
                                        <div class=\"small-dialog-header\">
                                            <h3>Request to ".$value['lantern_name']."</h3>
                                        </div>
                                        <div class=\"message-reply margin-top-0\">
                                        <div class='profile_img_circle2' style='background-image: url(\"./profile_img/".$value['lantern_sid'].".png\"); float:left;'></div>
                                        <div style=\"margin-left: 140px;\"><h4>".$value['lantern_name']."&emsp;<i class='fa fa-globe'></i>&nbsp;".$value['nation']."</h4><span class=\"date\">".$value['time_stamp']."</span></div>
                                        <br><br><br>
                                        <h4 style=\"margin-bottom: 20px;\">Request Time</h4>
                                        ".$dateshtml."
                                        <h4 style=\"margin-bottom: 20px;margin-top: 20px;\">Interest Keywords</h4>
                                            ".$interesthtml."
                                         <h4 style=\"margin-bottom: 20px;margin-top: 20px;\">Comment</h4>
                                          <p>".$value['comment']."</p>  
                                        </div>
                                    </div>
                                   ";
                        }
                        ?>

                        <ul>
                            <?php
                            foreach ($sent_list as $value){
                                $stateinner="";
                                if($value['state']==2){
                                    print"<li>
                                <div class=\"comments listing-reviews\">
                                <a href='http://223.195.109.38/lanternproject/chat.php'>                                
                                    <ul>
                                        <li>
                                            <div class='profile_img_circle2' style=\"background-image: url('./profile_img/".$value['lantern_sid'].".png'); float:left;\"></div>
                                            <div style='margin-left: 5%;' class=\"comment-content\"><div class=\"arrow-comment\"></div>
                                                <div class=\"comment-by\"><img style='width: 20px;' src='images/lanternloo.png'>&nbsp;&nbsp;".$value['lantern_name']."<div class=\"comment-by-listing\">&emsp;<i class='fa fa-globe'></i>&nbsp;".$value['nation']."</div> <span class=\"date\">".$value['time_stamp']."</span>
                                                </div><div style='float: right;'><button radonly style='background-color: limegreen' class='button'>Accepted<br>Start Chatting</button></div>
                                                <p>".substr($value['comment'],0,20)." ....</p>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                                </div>
                            </li>";
                                }else {
                                    print"<li>
                                <div class=\"comments listing-reviews\">
                                <a href='.rqt" . $value['rqid'] . "' class=\"popup-with-zoom-anim\">                                
                                    <ul>
                                        <li>
                                            <div class='profile_img_circle2' style=\"background-image: url('./profile_img/" . $value['lantern_sid'] . ".png'); float:left;\"></div>
                                            <div style='margin-left: 5%;' class=\"comment-content\"><div class=\"arrow-comment\"></div>
                                                <div class=\"comment-by\"><img style='width: 20px;' src='images/lanternloo.png'>&nbsp;&nbsp;" . $value['lantern_name'] . "<div class=\"comment-by-listing\">&emsp;<i class='fa fa-globe'></i>&nbsp;" . $value['nation'] . "</div> <span class=\"date\">" . $value['time_stamp'] . "</span>
                                                </div>
                                                <p>" . substr($value['comment'], 0, 20) . " ....</p>
                                            </div>
                                        </li>
                                    </ul>
                                </a>
                                </div>
                            </li>";
                                }
                            }
                            ?>

                        </ul>
                    </div>
                </div>


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


</body>
</html>

<script>
    $(document).ready(function () {
       $("button[id=accept]").click(function () {
           if (confirm("accept?") != true) {
           }else {
               var datas =
                   {
                       rqid: $(this).attr('class').split("ac")[1],
                       update_state: 2
                   };
               $.ajax({
                   url: './request_accept.php',
                   type: 'POST',
                   data: datas,
                   dataType: "json",
                   success: function (data, status, xhr) {
                       alert(data);
                       location.href = './request_list.php';
                   }
               });
           }
       });
        $("button[id=delete]").click(function () {
            if (confirm("delete?") != true) {

            }else {


                var datas =
                    {
                        rqid: $(this).attr('class').split("de")[1],
                        update_state: 3
                    };
                $.ajax({
                    url: './request_accept.php',
                    type: 'POST',
                    data: datas,
                    dataType: "json",
                    success: function (data, status, xhr) {
                        console.log(data);
                        location.href = './request_list.php';
                    }
                });
            }

        })
    });

</script>
