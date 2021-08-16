<!Doctype>
<html>
<head>
<title>Login Form</title>
</head>

<body>
<form method = "post" action = "">
<table width = "700" align = "center" bgcolor = "white">

   <h2 style = "color:white; color:black; text-align: center;"><?php echo @$_GET['logged_out']; ?></h2>
   
   <tr align = "center">
    <td colspan = "4"><h2 style = "font-family:calibri;"> Admin Login</h2></td>
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
        <td style = "font-family:calibri; "><a href = "checkout.php?forgot_pass">Forgot Password?</a></td>
   </tr>

<tr>
      <td><input type = "submit" name = "login" value = "Login"/></td>
   </tr>

</table>

      <h2 style = "float:right; font-family:calibri; font-size:20px; margin-top:-25px; margin-right: 50px; text-decoration:none;"><a href = "customer_register.php"> New? Register Here! </a><h2>


</form>
</body>
</html>

<?php
session_start();

include ("includes/db.php");

   if(isset($_POST['login']))
   {
      $email = $_POST['email'];
      $pass =  $_POST['pass'];

      $sel_user = "select * from admins where user_email = '$email' AND user_pass = '$pass'";
      $run_user = mysqli_query($con, $sel_user);  

      $check_user = mysqli_num_rows($run_user);

      if($check_user == 0)
      {
         echo "<script>alert('Password or Email is wrong, try again!')</script>";
      }

      else
      {
         $_SESSION['user_email'] = $email;
         echo "<script>window.open('index.php?logged_in=You have successfully logged in!', '_self')</script>";
      }

   }
   
?>


