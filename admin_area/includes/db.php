<?php

$con = mysqli_connect("localhost", "root", "", "social-commerce");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MYSQL:" . mysqli_connect_error();
}

$token = rand(10000,100000);
?>