<?php 
  include "functions/functions.php";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  global $con;
  $ip = getIp();

  if(isset($_GET['id']))
  {
    $id = $_GET['id'];
  }

  $get_cid = "select * from transactions where ip_add = '$ip' ORDER BY ID DESC LIMIT 1";
  $run_cid = mysqli_query($con, $get_cid);

  while($row = mysqli_fetch_array($run_cid))
  {
    $pid = $row['pid'];
    $c_id = $row['cid'];
    $status = $row['status'];
  }

  if(($pid == $id) && ($status == ''))
  {
    $update_t = "update transactions set status = 'failed' where pid = '$id' AND ip_add = '$ip' AND cid = '$c_id'";
    $run_t = mysqli_query($con, $update_t);
    
    $update_p = "update payments set status = 'failed' where checkout_id = '$c_id' AND ip_add = '$ip'";
    $run_p = mysqli_query($con, $update_p);

    $update_c = "update cart set status = '0' where ip_add = '$ip'";
    $run_c = mysqli_query($con, $update_c);
    
    //Phpmailers($c_name, $c_email, $token);
    echo "<h2>Welcome:" .$_SESSION['customer_email']."</h2>";
    echo "<h3>Your Payment was not Successful, Go to your account</h3>";
    echo "<a href = 'http://www.onlineshop.com/myshop/customer/my_account.php'>Go to your account</a>";
  }
?>
