<?php
include("includes/db.php");
?>

<!Doctype>

<div>

<form action="" method="post" enctype = "multipart/form-data">
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

   <tr align = "center">
        <td style = "font-family:calibri; "><a href = "forgot_password.php">Forgot Password?</a></td>
   </tr>

   <div> <?php if(isset($_GET['user_pass'])){echo "The Email or Password inputed is incorrect, try entering the correct one.";} ?> </div>

   <tr>
         <td><input type = "submit" name = "login" value = "Login"/></td>
   </tr>

</table>

   <h2 style = "float:right; font-family:calibri; font-size:20px; margin-top:-25px; margin-right: 50px; text-decoration:none;"><a href = "customer_register.php"> New? Register Here! </a><h2>

</form>

</div>

<?php 
if(isset($_POST['login']))
{
   $c_email = $_POST['email'];
   $c_pass =  md5($_POST['pass']);

   $sel_c = "select * from customers where customer_pass = '$c_pass' AND customer_email = '$c_email'";
   
   $run_c = mysqli_query($con, $sel_c);

   $check_customer = mysqli_num_rows($run_c);

   if($check_customer == 0)
   { 
      echo "<script>window.open('customer_login.php?user_pass', '_self')</script>";  
   }

   else
   {
      $cstrong = True;
      $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
      $h_token = sha1($token);
      $user_id = "select * from customers where customer_email = '$c_email'";
      $run_user = mysqli_query($con, $user_id);

      while($row = mysqli_fetch_array($run_user))
      {
         $user_id = $row['customer_id'];
      }

      $insert_c = "INSERT INTO login_token (token, user_id) VALUES ('$h_token','$user_id')";
      $run_c = mysqli_query($con, $insert_c);

      setcookie("SNID1", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE); //expires after 7 days
      setcookie("SNID1_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE); //second cookie expires after 3 days forcing you to get another one
     
      $ip = getIp();

      $sel_cart = "select * from cart where ip_add = '$ip'";

      $run_cart = mysqli_query($con, $sel_cart);

      $check_cart = mysqli_num_rows($run_cart);

      if($check_customer > 0 AND $check_cart == 0)
      { 
         $_SESSION['customer_email'] = $c_email;
         echo "<script>alert('You logged in successfully, Thanks!')</script>";
         echo "<script>window.open('my_account.php', '_self')</script>";
      }

      elseif ($check_customer > 0 AND $check_cart > 0)
      {
         $_SESSION['customer_email'] = $c_email;
         echo "<script>alert('You logged in successfully, Thanks!')</script>";
         echo "<script>window.open('checkout.php', '_self')</script>";
      }
   }    
}

?>
