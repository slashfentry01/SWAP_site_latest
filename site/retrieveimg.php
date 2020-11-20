<?php
include 'init.php';
 $query = "select image from users where email='test@gmail.com'";
 $result = mysqli_query($conn,$query);
 $row = mysqli_fetch_array($result);
 $image_src = $row['image'];
 echo $image_src;
?>
<img src='<?php print_r("upload/" . $image_src) ?>' >