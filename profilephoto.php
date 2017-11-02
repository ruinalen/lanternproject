<?php

/**
 * Created by PhpStorm.
 * User: SuhKyung
 * Date: 2017-11-02
 * Time: 오후 4:40
 */

session_start();
$_SESSION[user_sid];
$path = "./profile/";

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
$data   = array();
$data['success'] = false;

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
                $actual_image_name = $_SESSION[user_sid].".png";
                $tmp = $_FILES['service_image']['tmp_name'];
                if(move_uploaded_file($tmp, $path."/".$actual_image_name))
                {
                    $data['success'] = true;
                     $data['url']  = "http://223.195.109.38/lanternproject/profile/".$actual_image_name;
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
