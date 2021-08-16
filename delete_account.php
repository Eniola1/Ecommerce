<br>

<h2 style = "align: center; font-family:calibri; color: white;"> Do you really want to delete? </h2>

<form action = "" method = "post">

<input type = "submit" name = "yes" value = "Yes"/>
<input type = "submit" name = "no" value = "No"/>

</form>

<?php 
include ("includes/db.php");

  $user = $_SESSION['customer_email'];

  if(isset($_POST['yes']))
  {
      $delete_customer = "delete from customers where customer_email = '$user'";
      $run_delete = mysqli_query($con, $delete);

      echo "<script> alert('we are really sorry, your account has been deleted!')</script>";
      echo "<script> window.open('index.php', '_self')</script>";
  }

  if(isset($_POST['no']))
  {
      echo "<script> window.open('my_account.php','_self')</script>";

  }



?>