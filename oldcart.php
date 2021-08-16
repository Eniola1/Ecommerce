<!Doctype>
<?php     
session_start();
include "functions/functions.php";
?>

<html>
   <head>
   <link rel="stylesheet"  href="styles/index.css" media = "all">
       <title>My Online Shop</title>

   <header><span> My Online Shop </span></header> 
</head>

   <body>
    <div id = "main_wrapper">
    <div id= "menubar"> 
    
     <ul id = "menu">
       <li><a href = "index.php"> Home</a> </li> 
       <li><a href = "all_products.php"> Products</a></li>
       <li><a href = "my_account.php"> My Account</a></li>
       <li><a href = "#"> Sign Up</a></li>
       <li><a href = "#"> Shopping Cart</a></li>
       <li><a href = "#"> Contact Us</a></li>                            
     </ul>

    </div>

    <div id = "content_wrapper">
       <div id = "sidebar">  
       <div id = "sidebar_title"> Categories </div>

        <ul id = "cats"> 
          <?php getCats(); ?>  
       </ul>   

        <div id = "sidebar_title"> Brands</div>
         <ul id = "cats">  
         <?php  getBrands(); ?> 
         </ul>   
        </div>

        <div id = "content_area">
     
        <?php cart(); ?> 
    
        <div id = "shopping_cart">
        
        <span style = " margin-left: 30px; font-family:calibri; color:white; font-size:21px; line-height:40px; padding:5px;">
      
      <?php 
      if(isset($_SESSION['customer_email']))
      {
        echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style = 'color:yellow;'>Your</b>";
      }
      else
      {
        echo "<b>Welcome Guest:</b>";
      }

      ?>
    
      <b style = "color:yellow">Shopping cart-</b> Total Items: <?php //total_items();?> Total Price: <?php //total_price(); ?>  
      <a href = "index.php" style = "color:red;">Back to Shop </a>
     
      <?php 
      if(!isset($_SESSION['customer_email']))
      {
         echo "<a href = 'checkout.php' style = 'color: yellow;'>Login</a> ";
      }

      else
      {
        echo "<a href = 'logout.php' style = 'color: yellow;'>Logout</a> ";
      }
     
     
     ?>

     </span>
  

    </div>

      
    <div id = "products_box">

<?php
  if(isset($_POST['update_cart']))
  {
    $prdArray = array();
    $total = 0;
    if (!empty($_POST['prd']))
     {
      $prdArray = $_POST['prd'];

      for ($i=0; $i < count($prdArray); $i++) {
        $id = $prdArray[$i];
        $qty = $_POST['qty'][$i]; 

        //$_SESSION['qty'][$i] = $qty;
        $update_qty = "update cart set qty = {$qty} where p_id = {$id}";
        //echo $update_qty;die;
        $run_qty = mysqli_query($con, $update_qty);
        
        //$total = $total * $qty;       
      }
    }
  }
?>
<form action = "" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> Update your cart or checkout</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">Remove</th>
      <th style = "font-family: calibri;">Product(s)</th>
      <th style = "font-family: calibri;">Quantity</th>
      <th style = "font-family: calibri;">Amount</th>
      <th style = "font-family: calibri;">Total Price</th>
    </tr>

    <?php

      $total = 0;
      $alltotal = 0;
      global $con;
      
      $ip = getIp();
    
      $sel_price = "select * from cart where ip_add = '$ip'";
      $run_price = mysqli_query($con, $sel_price);
    
      while($p_price = mysqli_fetch_array($run_price))
      {   
          $count = 0;
          
          $pro_id = $p_price['p_id'];
          $pro_qty = $p_price['qty'];
          $pro_price = $p_price['price'];
    
          $pro_pri = "select * from products where product_id = '$pro_id'";
    
          $run_pro_price = mysqli_query($con, $pro_pri); 
    
          while($pp_price = mysqli_fetch_array($run_pro_price))
          { 
            $product_price = array($pp_price['product_price']);
            $product_title = $pp_price['product_title'];
            $product_image = $pp_price['product_image'];
            $single_price =  $pro_price < 1 ? $pp_price['product_price'] : $pro_price; //one line if-else code (choose price from product if cart price hasn't been set)
            $values = $product_price;

            $totalPerRow = $single_price * $pro_qty;

            $alltotal += $totalPerRow; 
        
      ?>

        <tr align = "center">
          <td><input type = "checkbox" name="remove[]" value = "<?php echo $pro_id;?>"/></td>
          <td style="font-family: calibri;">
            <?php echo $product_title; ?><br>
            <img src = "admin_area/product_images/<?php echo $product_image;?>" width = "80" height = "80" />            
          </td>
          <td>
            <input type = "text" size="4" name="qty[]" value = "<?php if (isset($pro_qty)) { echo $pro_qty; } ?>"/>
            <input type = "hidden" size="4" name="prd[]" value = "<?php echo $pro_id; ?>"/>
          </td>  

          <td style = "font-family: calibri;"><?php echo "$". $single_price; ?></td>  

          <td style = "font-family: calibri;"><?php echo "$". $totalPerRow; ?></td> 
                                    
        </tr>

    <?php } } ?>

<tr align = "right">
      <td colspan = "5" style = "font-family: calibri;"><b>Total: </b></td>
      <td "><?php echo "$" . $alltotal; ?></td>
</tr>

<tr align = "center">
    <td colspan = "2"><input type = "submit" name = "update_cart" value = "Update Cart" /></td>
    <td><input type = "submit" name = "continue" value = "Contiue Shopping" /></td>
    <td><button><a href = "checkout.php" style = "text-decoration:none; color:black;">Checkout</a></button></td>

</tr>

</table>


</form>

<?php
global $con;

$ip = getIp();

if(isset($_POST['update_cart']))
{
  foreach($_POST['remove'] as $remove_id)
  {
    $delete_product = "delete from cart where p_id = '$remove_id' AND ip_add = '$ip'";
    
    $run_delete = mysqli_query($con, $delete_product);
  
    if($run_delete)
    {
      echo "<script>window.open('cart.php','_self')</script>";
    }   

  }        
  
}

if(isset($_POST['continue']))
{
  echo "<script>window.open('index.php','_self')</script>";
}

?>     
</div> 
    
    
    </div>
        
    </div>

    <!--content wrapper ends here -->
     
    <div id="footer">
    
      <h2 style = "margin-left:30px; margin-bottom: 40px; font-family:calibri; font-size:22px; color:white;">&copy;2018 by MyOnline Shop</h2>

   </div>
   </div>
   
   </body>


</html>