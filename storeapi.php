<?php 
session_start();

$price = $_SESSION['tprice'];  
$item = $_SESSION['itemCount'];

$json = array('item' => $item,'price' => $price);
$json = json_encode($json);  
echo $json;
?>