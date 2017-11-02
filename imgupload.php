<?php
echo "file upload program<br />";
echo "select the file<br />";
?>
<form method="post" action="imgupload2.php" enctype="multipart/form-data">
    <input type="file" size=100 name="upload"><hr>
    <input type="submit" value="send">
</form>