<?php
/**
 * Created by PhpStorm.
 * User: donghyunkim
 * Date: 2017. 11. 8.
 * Time: PM 11:53
 */
$url = $_GET[url];
$counter = $_GET[counter];
$counter = 4;
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="Generator" content="EditPlus®">
    <script>
            var result1 = Math.floor(Math.random() * 3);
            var meta = document.createElement('meta');
            meta.setAttribute('http-equiv', 'refresh');
            meta.setAttribute('content', result1);
            document.getElementsByTagName('head')[0].appendChild(meta);
    </script>
    <head>
        <meta name="Author" content="">
        <meta name="Keywords" content="">
        <meta name="Description" content="">
        <title>Document</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
<body>
<style>
    #my_frame { width: 100%; height: 100%;}
</style>
<div>

</div>

</script>

<iframe id='my_frame'></iframe>

<script src="//code.jquery.com/jquery.min.js"></script>
<script>
    function open_in_frame(url) {
        $('#my_frame').attr('src', url);

    }
    </script>
<script>
    var resulturl = <?php echo $url;?>;
    open_in_frame(resulturl);



</script>
</body>
</html>
