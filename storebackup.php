<?php
  session_start();

  if(isset($_POST['total_cart_items']))
  {
	echo count($_SESSION['name']);
	exit();
  }

  // using $isUpdate as boolean function to loop through the two functions below
  function itemExist($id) {
    $isUpdate = false;

    for ($i=0; $i<count($_SESSION['id']); $i++) {
      if ($id === $_SESSION['id'][$i]) {
        // update the cart
        $_SESSION['qty'][$i] += 1;
        $isUpdate = true;
        echo count($_SESSION['name']);
        break;
      }
    }
    
    return $isUpdate;
  }

  if(isset($_POST['item_src']))
  {
    if (!itemExist($_POST['item_id'])) {
      $_SESSION['id'][]=$_POST['item_id'];
      $_SESSION['name'][]=$_POST['item_name'];
      $_SESSION['qty'][]= 1;
      $_SESSION['price'][]=$_POST['item_price'];
      $_SESSION['src'][]=$_POST['item_src'];
      echo count($_SESSION['name']);
      exit();
    }
  }

  
  if(isset($_POST['showcart']))
  {
    for($i=0;$i<count($_SESSION['id']);$i++)
    {
      echo "<div class='cart_items'>";
      echo "<img src='".$_SESSION['src'][$i]."'>";
      echo "<p>".$_SESSION['name'][$i]."</p>";
      echo "<p>".$_SESSION['price'][$i]."</p>";
      echo "<p>".$_SESSION['qty'][$i]."</p>";
      echo "</div>";
    }
    exit();	
  }
?>