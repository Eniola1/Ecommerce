<!Doctype>
<?php     
session_start();
include "functions/functions.php";
include ("includes/db.php");

if(isset($_GET['email']))
{
   $email = $_GET['email'];
   $name = $_GET['name'];
}

if(isset($_GET['u_ext']))
{
   $u_ext =  $_GET['u_ext'];
}

if(isset($_GET['u_lngt']))
{
   $u_lngt =  $_GET['u_lgnt'];
}

if(isset($_GET['u_schr']))
{
   $u_lngt =  $_GET['u_schr'];
}

if(isset($_GET['phone_no']))
{
   $phone_no =  $_GET['phone_no'];
}

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
        
      <span style = " margin-left: 30px; font-family:calibri; color:white; font-size:21px; line-height:40px; padding:5px;"> Welcome Guest! 
      <b style = "color:yellow;">Shopping cart-</b> Total Items: <?php //total_items();?> Total Price: <?php //total_price(); ?>  <a href = "cart.php" style = "color:red;">Go to cart </a>
      </span>

   </div>

    
    <form action = "customer_register.php" method = "post" enctype = "multipart/form-data">
    
    <table align = "center" width = "750" bgcolor = "white" cellpadding="6" cellspacing="3">
    
    <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Firstname:</h2></td>
      <td><input type = "text" name = "f_name"/></td>
    </tr>
    
    <div> <?php if(isset($_GET['I_name'])){echo "Invalid name; input the first name registered";} ?> </div>
    
    <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Lastname:</h2></td>
      <td><input type = "text" name = "l_name"/></td>
    </tr>

    <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Username:</h2></td>
      <td><input type = "text" name = "c_name"/></td>
    </tr>

    <div> <?php if(isset($_GET['u_ext'])){echo "This Username already exists, try inputing another one";} ?> </div>
    <div> <?php if(isset($_GET['u_lngth'])){echo "Invalid Username; username must be at least 3 and most 32 characters.";} ?> </div>
    <div> <?php if(isset($_GET['u_schr'])){echo "Invalid Username; username must not contain any special character except, hyphen(-) or underscore(_).";} ?> </div>

    <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Email:</h2></td>
      <td><input type = "text" name = "c_email"/></td>
    </tr>

    <div> <?php if(isset($_GET['I_mail'])){echo "Invalid e-mail; input the E-mail registered";} ?> </div>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Password:</h2></td>
      <td><input type = "password" name = "c_pass"/></td>
    </tr>

    <div> <?php if(isset($_GET['I_pass'])){echo "Password should be at least 8 and most 60 characters, including at least one upper case, one lower case and one special character.";} ?> </div>

   <tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Phone number</h2></td>
       <td><input type = "text" name = "c_contact"/></td>
   </tr>

   <div> <?php if(isset($_GET['phone_no'])){echo "Invalid phone-no; input a valid phone number";} ?> </div>

    <tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Image</h2></td>
       <td><input type = "file" name = "c_image"/></td>
    </tr>

   <tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Country</h2></td>
       <td>
       <select name = "c_country">  
          <option>USA</option>
          <option>UK</option>
          <option>Germany</option>
          <option>Japan</option>
          <option>China</option>
          <option>Nigeria</option>
       </select>
      </td>
    </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Account</h2></td>
      <td>
      <select name = "c_account">  
      <option>Seller</option>
      <option>Buyer</option>
      </select>
      </td>
   </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Select a City</h2></td>
      <td><input type = "text" name = "c_city"/></td>
   </tr>

   <tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;" ><h2>Address</h2></td>
       <td><textarea cols = "20" rows = "10" name = "c_address"></textarea></td>
   </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;" ><h2>Address</h2></td>
      <td><input type="number" name = "day" value="" min="1" max="31" placeholder="Day" required="true"/>
      
      <select name = "month">  
         <option>January</option>
         <option>February</option>
         <option>March</option>
         <option>April</option>
         <option>May</option>
         <option>June</option>
         <option>July</option>
         <option>August</option>
         <option>September</option>
         <option>October</option>
         <option>November</option>
         <option>December</option>
      </select>

    <input type="number" name = "year" value="" min="1900" max="2002" placeholder="Year" required="true"/><p/></td>

   <tr>
      <td><input type = "submit" name = "register" value = "Create Account"/></td>
   </tr> 

  </table> 
 
   </form>  
    
   </div>
        
   </div>

    <!--content wrapper ends here -->
     
    <div id="footer">
    
      <h2 style = "margin-left:30px; margin-bottom: 40px; font-family:calibri; font-size:22px; color:white;">&copy;2018 by MyOnline Shop</h2>

   </div>
    
   </div>
   
   </body>
</html>

<?php 

   use PHPMailer\PHPMailer\PHPMailer;

   if(isset($_POST['register']))
   {
      $ip = getIp();
      $firstname = $_POST['f_name'];
      $lastname = $_POST['l_name'];
      $c_name = $_POST['c_name'];
      $c_email = $_POST['$c_email'];
      $c_pass =  $_POST['c_pass'];
      //$c_image = $_FILES['c_image']['name'];
      //$c_image_tmp = $_FILES['c_image']['tmp_name'];
      $c_country = $_POST['c_country'];
      $c_city = $_POST['c_city'];
      $c_contact = $_POST['c_contact'];
      $c_address = $_POST['c_address'];
      $c_account = $_POST['c_account'];
      $b_day =  $_POST['day'];
      $b_year = $_POST['year'];
      $b_month = $_POST['month'];
      $phone_no = $_POST['phone_no'];
      $birthday = "$b_day-$b_month-$b_year";
      
      //move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

      //$token = rand(10000,100000);

      /**$insert_c = "insert into customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, 
      customer_city, customer_contact, customer_address, customer_image, token, activation_status) 
      values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address', '$c_image', '$token', '0')";*/

      //validate password strength
      //if(!preg_match('/[a-zA-Z0-9\-]+/', $username)) 
      $uppercase = preg_match('@[A-Z]@', $c_pass);
      $lowercase = preg_match('@[a-z]@', $c_pass);
      $number = preg_match('@[0-9]@', $c_pass);
      $specialChars = preg_match('@[^\w]@', $c_pass);

      $check_cn = "select * from customers where customer_name = '$c_name'";
      $run_cn = mysqli_query($con, $check_cn);
      $count_cn = mysqli_num_rows($run_cn);
      
      if($count_cn == 0)
      {
         if(strlen($c_name) >= 3 && strlen($c_name) <= 32)
         {
            if(!preg_match('/[^A-Za-z0-9_-]/', $c_name))
            {
               if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($c_pass) < 8 || strlen($c_pass) > 60)
               {
                  echo "<script>window.open('create-account.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&I_pass', '_self')</script>";
               }

               else
               {
                  if(preg_match('/^\+[0-9]{1,3}-[0-9]{10}$/', $c_contact))
                  {                    
                     if($email == $c_email)
                     {
                        if($firstname == $name)
                        {
                           $insert_c = "INSERT INTO customers (customer_name, customer_email, customer_pass, customer_country, 
                           account, customer_city, customer_contact, customer_address, customer_image) 
                           VALUES ('$c_name','$c_email','$c_pass','$c_country', '$c_account', '$c_city','$c_contact','$c_address', '$c_image')";
                           $run_c = mysqli_query($con, $insert_c);
                           
                           $insert_ec = "INSERT INTO customers (customer_name, customer_email, customer_pass, customer_country, 
                           account, customer_city, customer_contact, customer_address, customer_image) 
                           VALUES ('$c_name','$c_email','$c_pass','$c_country', '$c_account', '$c_city','$c_contact','$c_address', '$c_image')";
                           $run_ec = mysqli_query($con, $insert_ec);

                           $sel_cart = "select * from cart where ip_add = '$ip'";

                           $run_cart =  mysqli_query($con, $sel_cart);
                           
                           $check_cart = mysqli_num_rows($run_cart);
                           
                           if($check_cart == 0)
                           {
                              //echo "<script>alert('You account has been registered successfully, Thanks!')</script>";
                              echo "<script>window.open('profile_info.php?name=htmlspecialchars($c_name)', '_self')</script>";
                              echo "<script>window.open('customer_login.php', '_self')</script>";
                           }
                        
                           else
                           { 
                              phpmailer($c_name, $c_email, $token);
                              //echo "<script>alert('You account has been registered successfully, Thanks!')</script>";
                              echo "<script>window.open('profile_info.php?name=htmlspecialchars($c_name)', '_self')</script>";
                              echo "<script>window.open('checkout.php', '_self')</script>";
                           }
                        }

                        else
                        {
                           echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&I_name', '_self')</script>";
                        }

                     }

                     else
                     {
                       echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&I_mail=htmlspecialchars($email)', '_self')</script>";
                     }
                  }
            
                  else
                  {
                     echo "<script>window.open('customer_register.php?phone_no=htmlspecialchars($phone_no)', '_self')</script>";
                  }
               }
            }

            else
            {
               echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&u_schr=htmlspecialchars($name)', '_self')</script>";
            }
         }

         else
         {
            echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&u_lngt=htmlspecialchars($name)', '_self')</script>";
         }
   
      }
                 
      else
      {
         echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."&u_ext=htmlspecialchars($name)', '_self')</script>";
      }

   }

?>  