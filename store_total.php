<?php
  session_start();
  
  if(isset($_POST['item_src']))
  { 
    $_SESSION['store_total'] += $_POST['item_price'] * 1;

    echo $_SESSION['store_total'];

    exit();
  }
  
?>