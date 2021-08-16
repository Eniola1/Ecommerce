<!Doctype>
<?php     
session_start();
include "functions/functions.php";
?>

<html>
   <head>
   <link rel="stylesheet"  href="styles/index.css" media = "all">
   <script src="js/jquery-3.3.1.min.js"></script>
       <title>My Online Shop</title>

   <header><span> My Online Shop </span></header> 
</head>

   <body>
    <div id = "main_wrapper">
    <div id= "menubar"> 
    
     <ul id = "menu">
       <li><a href = "index.php"> Home </a> </li> 
       <li><a href = "all_products.php"> Products </a> </li>
       <li><a href = "my_account.php"> My Account </a> </li>
       <li><a href = "#"> Sign Up </a> </li>
       <li><a href = "#"> Shopping Cart </a> </li>
       <li><a href = "#"> Contact Us </a> </li>
                                 
     </ul>

     

    </div>

    

    <div id = "content_wrapper">
       <div id = "sidebar">  
       <?php if (isset($_SESSION['customer_email'])) { ?>
          <div id = "sidebar_title"> My Account </div>
          <ul id = "cats" >
       <?php } ?> 
       
        <?php 
        if (isset($_SESSION['customer_email']))
         {
          $user = $_SESSION['customer_email'];

          $get_img = "select * from customers where customer_email = '$user'";

          $run_img = mysqli_query($con, $get_img);

          $row_img = mysqli_fetch_array($run_img);
          
          $c_image = $row_img['customer_image'];

          $c_name = $row_img['customer_name'];

          echo "<img src = 'customer/customer_images/$c_image' width = '150' height = '150'";
        }
        
        ?>

       <?php if (isset($_SESSION['customer_email'])) { ?>  
          <li style = "font-family: calibri; font-size: 15px; margin-left: -15px; padding: 5px;" ><a href = "my_account.php?my_orders">My Orders</a></li>
       
          <li style = "font-family: calibri; font-size: 15px; margin-left: -15px; padding: 5px;"><a href = "my_account.php?edit_account">Edit Account</a></li>
          <li style = "font-family: calibri; font-size: 8px; margin-left: -25px;"><a href = "my_account.php?change_pass">Change Password</a></li>
          <li style = "font-family: calibri; font-size: 15px; margin-left: -24px; padding: 5px;"><a href = "my_account.php?delete_account">Delete Account</a></li>
       </ul>
    <?php } ?>   
    

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
      if(isset($_SESSION['customer_email']) && (!empty($_SESSION['customer_email'])))
      {
        echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style = 'color:yellow;'>Your</b>";
      }

      else
      {
      echo "<b>Welcome Guest:</b>";
      }

      ?>

      <b style = "color:yellow;">Shopping cart-</b> Total Items: <?php //total_items();?> Total Price: <?php //total_price(); ?>  <a href = "cart.php" style = "color:red; padding: 5px;">Go to cart </a>
      
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
    if (!isset($_SESSION['customer_email'])) {
        include "customer_login.php";
    } else if(!isset($_GET['my_orders'])) {
      if(!isset($_GET['edit_account']))
      {
        if(!isset($_GET['change_pass']))
      {
        if(!isset($_GET['delete_account']))
      { 
        echo "
        <h2 style = ' font-family:calibri; font-size:25px; color: white;'>Welcome:  $c_name </h2>
        '<h3 style = 'font-family:calibri; color: white;'><b> You can see the progress of your order by clicking this link 
        <a href = 'my_account.php?my_orders'>link</a></b></h3>";
       }
      }
    } 
  }
?>

   <?php 
   if(isset($_GET['edit_account']))
   {
     include ("edit_account.php");
   }
   
   if(isset($_GET['change_pass']))
   {
     include ("change_pass.php");
   }

   if(isset($_GET['delete_account']))
   {
     include ("delete_account.php");
   }

   if(isset($_GET['my_orders']))
   {
     include ("my_orders.php");
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