<h2 style = "text-align:center; font-family:calibri; color:white;">Change Your Password</h2>
<form action = "" method = "post">
<table align = "center" width = "750" bgcolor = "white" cellpadding="6" cellspacing="3">

 <tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Enter Current Password:</h2></td>
       <td><input type = "password" name = "current_pass"></td>
</tr>

<tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Enter New Password:</h2></td>
       <td><input type = "password" name = "new_pass"></td>
</tr>

<tr>
       <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Enter Current Password:</h2></td>
       <td><input type = "password" name = "new_pass_again"></td>
</tr>

 <tr>
   <td><input type = "submit" name = "change_pass" value = "Change Password"/></td>
 </tr>


</table>

</form>

<?php 
include ("includes/db.php");

include ('./classes/Login.php');

if(Login::isLoggedIn())
{
  $userId = Login::isLoggedIn();
}

if(isset($_POST['change_pass']))
{
  $current_pass = md5($_POST['current_pass']);
  $new_pass = md5($_POST['new_pass']);
  $new_again = md5($_POST['new_pass_again']);

  $sel_pass = "select * from customers where customer_pass = '$current_pass' AND customer_id = '$userId'";

  $run_pass = mysqli_query($con, $sel_pass);

  $check_pass = mysqli_num_rows($run_pass);

  if($check_pass == 0)
  {
    echo "<script>alert('Your current password is wrong!')</script>";
    exit();
  }

  if($new_pass != $new_again)
  {
    echo "<script>alert('New Password does not match!')</script>";
    exit();
  }

  else
  {
    $update_pass = "update customers set customer_pass = '$new_pass' where customer_id = '$userId'"; 
    
    $run_update = mysqli_query($con, $update_pass);

    echo "<script>alert('Your Password was successsfully updated!')</script>";
    echo "<script>window.open('my_account.php', '_self')</script>";
  }

}

?>




