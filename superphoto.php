<?php
/**
 * Created by PhpStorm.
 * User: SuhKyung
 * Date: 2017-11-02
 * Time: 오후 4:40
 */

session_start();
$_SESSION[user_sid];
$pid = $_SESSION['pid'];
$superkeywords = $_SESSION['superkeywords'];
$superkeywords_array = explode(',', $superkeywords);
$path = "/var/super_img/";

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
$data   = array();
$data['success'] = false;

$conn = mysqli_connect('localhost','lantern','lantern','lantern');
$query = "SELECT * FROM `pkrelation` WHERE `pid` =\".$pid.\" ";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$superkeywordname = $_POST['superkeywordname'];

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_FILES['service_image']['name'];
    $size = $_FILES['service_image']['size'];


    if(strlen($name))
    {
        list($txt, $ext) = explode(".", $name);
        if(in_array($ext,$valid_formats))
        {
            if($size<(1024*1024)) // Image size max 1 MB
            {
                $actual_image_name = $pid."_".$superkeywordname.".png";
                $tmp = $_FILES['service_image']['tmp_name'];
                if(move_uploaded_file($tmp, $path.$actual_image_name))
                {
                    $data['success'] = true;
                    $data['url']  = "http://223.195.109.38/lanternproject/super_img/".$actual_image_name;

                    //$data['url']  = "http://223.195.109.38/lanternproject/uploads/1";
                }
                else
                {
                    $data['success'] = false;
                    $data['error'] = "error";
                }

            }
            else
                $data['error'] = "Image file size max 1 MB";
        }
        else
            $data['error'] = "Invalid file format..";
    }
    else
        $data['error'] = "Please select image..!";
}

echo json_encode($data);
echo "
        <script type='text/javascript'>
            location.href='http://223.195.109.38/lanternproject/add_posting_super.php';
        </script>
        ";