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

      <b style = "color:yellow;">Shopping cart-</b> Total Items: <?php //total_items();?> Total Price: <?php //total_price(); ?>  <a href = "cart.php" style = "color:red;">Go to cart </a>

     </span>
  

    </div>

   <div id = "products_box">
    
    <?php 
      if(!isset($_SESSION['customer_email']))
      {
        include("customer_login.php");
      }

      else
      {
        include("payment.php");
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