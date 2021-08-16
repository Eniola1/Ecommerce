<?php 
   include ("includes/db.php"); 

   $user = $_SESSION['customer_email'];

   $get_customer = "select * from customers where customer_email = '$user'";

   $run_customer = mysqli_query($con, $get_customer);

   $row_customer = mysqli_fetch_array($run_customer);

   $name =  $row_customer['customer_name'];
   $email =  $row_customer['customer_email'];
   $pass =  $row_customer['customer_pass'];
   $country =  $row_customer['customer_country'];
   $city =  $row_customer['customer_city'];
   $contact =  $row_customer['customer_contact'];
   $address =  $row_customer['customer_address'];
   $image = $row_customer['customer_image'];
   $c_id = $row_customer['customer_id'];
?>

   <a href = "edit_account.php?link">link account to fashion shop-social</a>

   <form action = "" method = "post" enctype = "multipart/form-data">
   
   <table align = "center" width = "750" bgcolor = "white" cellpadding="6" cellspacing="3">

   <tr>
      <b><td align = "right" style = "font-family:calibri; font-size:20px;"><h3>Update Your Account:</h3></td><b>
   </tr>
   
   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Name:</h2></td>
      <td><input type = "text" name = "c_name" value = "<?php echo $name;?>"/></td>
   </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Email:</h2></td>
      <td><input type = "text" name = "c_email" value = "<?php echo $email; ?>"/></td>
   </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Password:</h2></td>
      <td><input type = "password" name = "c_pass" value = "<?php echo $pass; ?>"/></td>
   </tr>

   <tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Image</h2></td>
      <td><input type = "file" name = "c_image"/><img src = "customer_images/<?php echo $image; ?>" width = "50" height = "50"/></td>
   </tr>

<tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Country</h2></td>
      <td>
      <select name = "c_country" disabled>  
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
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Select a City</h2></td>
      <td><input type = "text" name = "c_city" value = "<?php echo $city; ?>" </td>
   </tr>

<tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;"><h2>Customer Contact</h2></td>
      <td><input type = "text" name = "c_contact" value = "<?php echo $contact; ?>" /></td>
   </tr>

<tr>
      <td align = "right" style = "font-family:calibri; font-size:12px;" ><h2>Customer Address</h2></td>
      <td><input type = "text" name = "c_address" value = "<?php echo $address; ?>" /></td>
   </tr>

<tr>
      <td><input type = "submit" name = "update" value = "Update Account"/></td>
   </tr>

   </table> 
   
   </form>  

<?php

   if(isset($_GET['link']))
   {
      echo "<script>window.open('link_account.php', '_self')</script>";
   }

   if(isset($_POST['update']))
   {
      $ip = getIp();

      $customer_id = $c_id;

      $c_name = $_POST['c_name'];
      $c_email = $_POST['c_email'];
      $c_pass = $_POST['c_pass'];
      $c_image = $_FILES['c_image']['name'];
      $c_image_tmp = $_FILES['c_image']['tmp_name'];
      $c_city = $_POST['c_city'];
      $c_contact = $_POST['c_contact'];
      $c_address = $_POST['c_address'];
      
      
      move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

      $update_c = "update customers set customer_name = '$c_name', customer_email = '$c_email', customer_pass = '$c_pass', customer_city = '$c_city', customer_contact = '$c_contact', customer_address = '$c_address',
      customer_image = '$c_image' where customer_id = '$customer_id'";

      $run_update = mysqli_query($con, $update_c);

      $run_update)
      {
         echo "<script> alert('Your account successfully Updated.')</script>";
         echo "<scipt>window.open('my_account.php','_self')</script>";
      }
      
   }

?>