<?php     
include ("includes/db.php");
include "functions/functions.php";
$c_code = '';
?>

<!Doctype>
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
        
      <span style = " margin-left: 30px; font-family:calibri; color:white; font-size:21px; line-height:40px; padding:5px;"> Welcome Guest! 
      <b style = "color:yellow;">Shopping cart-</b> Total Items: <?php total_items();?> Total Price: <?php total_price(); ?>  <a href = "cart.php" style = "color:red;">Go to cart </a>
      </span>
  
   </div>

<form method = "post" action = "">
<table width = "700" align = "center" bgcolor = "white">
   
   <tr align = "center">
      <td colspan = "4"><h2 style = "font-family:calibri;"> Login or Register to Buy! </h2></td>
   </tr>

   <tr >
      <td style = "font-family:calibri;">Email:</td>
      <td><input type = "text" name = "email"  placeholder = "enter email"/></td>
   </tr>

   <tr>
      <td style = "font-family:calibri;">Password:</td>
      <td><input type = "password" name = "pass" placeholder = "enter password"/></td>
   </tr>

    <tr>
      <td style = "font-family:calibri;">Activation Code:</td>
      <td><input type = "password" name = "code" placeholder = "enter activation code"/></td>
   </tr>

   <tr align = "center">
      <td style = "font-family:calibri; "><a href = "checkout.php?forgot_pass">Forgot Password?</a></td>
   </tr>

   <tr>
      <td><input type = "submit" name = "login" value = "Login"/></td>
   </tr>

</table>

   <h2 style = "float:right; font-family:calibri; font-size:20px; margin-top:-25px; margin-right: 50px; text-decoration:none;"><a href = "customer_register.php"> New? Register Here! </a><h2>

</form>

</div>

</div>


<?php 
if(isset($_POST['login']))
{
   $c_code  = $_POST['code'];
   $c_email = $_POST['email'];
   $c_pass =  md5($_POST['pass']);

   $sel_c = "select * from customers where customer_pass = '$c_pass' AND customer_email = '$c_email'";
   $run_c = mysqli_query($con, $sel_c);
   $check_customer = mysqli_num_rows($run_c);

   if($check_customer == 0)
   {
      echo "<script> alert ('Password or email is incorrect, please try again!')</script>";
      exit();
   }

   $ip = getIp();

   $sel_cart = "select * from cart where ip_add = '$ip'";

   $run_cart = mysqli_query($con, $sel_cart);

   $check_cart = mysqli_num_rows($run_cart);


   while($E_act = mysqli_fetch_array($run_c))
   {
      $c_act = $E_act['activation_status'];
      $c_tok = $E_act['token'];
   }  

   if($check_customer > 0 AND $check_cart == 0)
   {
      if($c_code == $c_tok)
      {
         $checkp = "UPDATE customers SET activation_status = 1 WHERE customer_email = '$c_email' AND customer_pass = '$c_pass'";
         $rpcheck = mysqli_query($con, $checkp);
            
         $_SESSION['customer_email'] = $c_email;
         echo "<script>alert('You logged in successfully, Thanks!')</script>";
         echo "<script>window.open('my_account.php', '_self')</script>"; 
      }

      else
      {
         echo "Your activation code is incorrect, try entering the code again";
      }
   }

 
   if($check_customer > 0 AND $check_cart > 0)
   {
      if($c_code == $c_tok)
      {

         $checkp = "UPDATE customers  SET  activation_status=1 WHERE customer_email = '$c_email' AND customer_pass = '$c_pass'";
         $rpcheck = mysqli_query($con, $checkp);
         
         $_SESSION['customer_email'] = $c_email;
         echo "<script>alert('You logged in successfully, Thanks!')</script>";
         echo "<script>window.open('checkout.php', '_self')</script>"; 
      }

      else
      {
         echo "Your activation code is incorrect, try entering the code again";
      }
   }

}

?>