<!Doctype>
<?php     
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

    <div id = "shopping_cart">
        
      <span style = " margin-left: 30px; font-family:calibri; color:white; font-size:21px; line-height:40px; padding:5px;"> Welcome Guest! 
      <b style = "color:yellow">Shopping cart-</b> Total Items: Total Price:  <a href = "cart.php" style = "color:red;">Go to cart </a>
     

     </span>
  

    </div>
     
    <div id = "products_box">     
     
     <?php
    $get_pro = "select * from products";

$run_pro = mysqli_query($con, $get_pro);

while($row_pro = mysqli_fetch_array($run_pro))
{

   $pro_id = $row_pro['product_id'];
   $pro_cat = $row_pro['product_cat'];
   $pro_brand = $row_pro['product_brand'];
   $pro_title = $row_pro['product_title'];
   $pro_price = $row_pro['product_price'];
   $pro_image = $row_pro['product_image'];
   
  echo "
       
       <div id = 'single_product'>

          <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
          
          <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

          <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> Price: $$pro_price </b></p>

          <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
          <a href='index.php?pro_id=$pro_id&pro_price=$pro_price'><button style = 'float:right; font-family:calibri;'>Add to cart</button></a> 


       </div>
  
  
  ";

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