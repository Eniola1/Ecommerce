<?php 
include ('./classes/DB.php');

if(isset($_POST['url']))
{
    $src = $_POST['url'];
    $username = $_POST['username'];
}

$url = explode("/", $src);
$num = count($url) - 1;
echo $num;
$lst = $url[$num];
echo $lst;

$url = str_replace(' ', '', $lst);
$url = preg_replace('/[^A-Za-z0-9\-]/', '', $url);

move_uploaded_file($src,"customer/customer_images/$username.'.'.$url");
$url = $username.'.'.$url;

$update = "UPDATE customers SET customer_image = '$src' WHERE customer_name = '$username'";  
$run_update = mysqli_query($con, $update);

$update = "UPDATE ec_settings SET customer_image = '$src' WHERE username = '$username'";  
$run_update = mysqli_query($con, $update);

?>