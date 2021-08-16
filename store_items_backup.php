<?php
  session_start();

  /**if(isset($_POST['total_cart_items']))
  {
	echo count($_SESSION['name']);
	exit();
  } */

  // using $isUpdate as boolean function to loop through the two functions below
  function itemExist($id) {
    $isUpdate = false;

    for ($i=0; $i<count($_SESSION['id']); $i++) 
    {
      if ($id === $_SESSION['id'][$i])
       {
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
    if(!itemExist($_POST['item_id'])) 
    {
      $_SESSION['id'][]=$_POST['item_id'];
      $_SESSION['name'][]=$_POST['item_name'];
      $_SESSION['qty'][]= 1;
      $_SESSION['price'][]=$_POST['item_price'];
      $_SESSION['src'][]=$_POST['item_src'];
      echo count($_SESSION['name']);
      exit();
    }
  }


  function priceExist($id) {
      $total = 0;
      $isUpdate = false;
      $pp_price = 0;
  
      for ($i=0; $i<count($_SESSION['id']); $i++) 
      {
        if ($id === $_SESSION['id'][$i]) 
        {
          // update the cart
          $_SESSION['qty'][$i] += 1;
          $pp_price = ($_SESSION['qty'][$i]) ** ($_SESSION['price'][$i]);
          $product_price = array($pp_price);
          $values = array_sum($product_price);
          $total += $values;
          $isUpdate = true;
          echo "$" .$total;
          break;
        }
      }
  
      return $isUpdate;
    }

    function totalprice()
    {
      global $pp_price;
      echo $pp_price;
    }


  if(isset($_POST['showcart']))
   {
    for($i=0;$i<count($_SESSION['id']);$i++)
    {
      if(!priceExist($_POST['item_id']))
      {
        $pp_price = (($_SESSION['price'][$i]) ** 1);
       // $product_price = array($pp_price);
        $values = array_sum($product_price);
        $total += $values;
       // echo "<div class='cart_items'>";
        echo "$" .$total; 
       // echo "</div>";
  
    /**echo "<img src='".$_SESSION['src'][$i]."'>";
      echo "<p>".$_SESSION['name'][$i]."</p>";
      echo "<p>".$_SESSION['price'][$i]."</p>";
      echo "<p>".$_SESSION['qty'][$i]."</p>"; 
      */
     }
   }
    exit();	
 }

    /**if(!priceExist($_POST['item_id']))
   { 
      $_SESSION['id'][]=$_POST['item_id'];
      $_SESSION['name'][]=$_POST['item_name'];
      $_SESSION['qty'][]= 1;
      $_SESSION['price'][]=$_POST['item_price'];
      $_SESSION['src'][]=$_POST['item_src'];
      $product_price = array($_SESSION['price']);
      $values = array_sum($product_price);
      $total += $values;
      echo '$"."$total'; 
      exit();
   }**/

 /**function totalprice()
  {
   $total = 0;

   $values = array_sum($_SESSION['price'][$i]);

   $total += $values;

   echo '$"."$total';
 } 
 
**/
  
?>