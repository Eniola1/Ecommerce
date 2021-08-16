<!Doctype>
<html>
  <head>
  <link rel="stylesheet"  href="styles/index.css" media = "all">

  <div id = "products_box">

  <?php
    if(isset($_POST['update_cart']))
    {
      global $con;
      $ip = getIp();
      $prdArray = array();
      $total = 0;
      if(!empty($_POST['prd']))
      {
        $prdArray = $_POST['prd'];

        for ($i=0; $i < count($prdArray); $i++) {
          $id = $prdArray[$i];
          $qty = $_POST['qty'][$i];
          
          //$_SESSION['qty'][$i] = $qty;
          //$update_qty = "update cart set qty = {$qty} where p_id = {$id} AND ip_add = '$ip'";
          $update_qty = "delete from cart where p_id = '$id' AND ip_add = '$ip'";
          //echo $update_qty;die;
          $run_qty = mysqli_query($con, $update_qty);
          
          //$total = $total * $qty;       
        }
      }

      if($run_qty)
      {
        echo "<script>window.open('cart.php','_self')</script>";
      } 
    }
    
    if(isset($_POST['chk']))
    {
      global $con;
      $ip = getIp();
      $t_price = 0;

      $insert_c = "INSERT INTO checkout(ip_add) VALUES ('$ip')";
      $run_c = mysqli_query($con, $insert_c);

      $get_cid = "select * from checkout where ip_add = '$ip' ORDER BY ID DESC LIMIT 1";
      $run_cid = mysqli_query($con, $get_cid);

      while($row = mysqli_fetch_array($run_cid))
      {
        $cid = $row['id'];
      }

      if(isset($_POST['prd']))
      {
        $prdArray = $_POST['prd'];
        $prdArry = $_POST['prd1'];

        for ($i=0; $i < count($prdArry); $i++) 
        {
          $id = $prdArry[$i];
          $qty = $_POST['qty'][$i];
          $price = $_POST['sprc'][$i];

          $update_c = "update cart set qty = '$qty', price = '$price' where p_id = '$id' AND ip_add = '$ip'";
          $run_c = mysqli_query($con, $update_c);       
        }

        for($i=0; $i < count($prdArray); $i++) 
        {
          $id = $prdArray[$i];

          $get_cp = "select * from cart where p_id = '$id' AND ip_add = '$ip'";
          $run_cp = mysqli_query($con, $get_cp);

          while($row = mysqli_fetch_array($run_cp))
          {
            $qty = $row['qty'];
            $price = $row['price'];
          }

          $r_price = $qty * $price;
          $t_price += $r_price; 
          
          //insert into checkout
          //insert into payment table here.
          $update_c = "update cart set status = '1' where p_id = '$id' AND ip_add = '$ip'";
          $run_c = mysqli_query($con, $update_c);

          $insert_c = "INSERT INTO payments(product_id, qty, price, total_price, ip_add, checkout_id) VALUES ('$id', '$qty', '$price', '$r_price', '$ip', '$cid')";
          $run_c = mysqli_query($con, $insert_c);
          //remember to turn all status back to 0, if payments fails.
          //echo $update_qty;die;  
          //$total = $total * $qty;       
        }
      }

      else
      {
        $prdArray = $_POST['prd1'];

        for ($i=0; $i < count($prdArray); $i++) 
        {
          $id = $prdArray[$i];
          $qty = $_POST['qty'][$i];
          $price = $_POST['sprc'][$i];

          $update_c = "update cart set qty = '$qty', price = '$price', status = '1' where p_id = '$id' AND ip_add = '$ip'";
          $run_c = mysqli_query($con, $update_c);    
          
          $r_price = $qty * $price;
          $t_price += $r_price;

          $insert_c = "INSERT INTO payments(product_id, qty, price, total_price, ip_add, checkout_id) VALUES ('$id', '$qty', '$price', '$r_price', '$ip', '$cid')";
          $run_c = mysqli_query($con, $insert_c);
        }

      }

      $upd_pymnt = "update checkout set amount = '$t_price' where ip_add = '$ip' AND id = '$cid'";
      $run_pymnt = mysqli_query($con, $upd_pymnt);

      echo "<script>window.open('checkout.php','_self')</script>";       
    }
  ?> 

<form action = "index.php?cart" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
  
  <?php
    $total = 0;
    $alltotal = 0;
    global $con;

    $ip = getIp();
  
    $sel_price = "select * from cart where ip_add = '$ip'";
    $run_price = mysqli_query($con, $sel_price);
  
    while($p_price = mysqli_fetch_array($run_price))
    {   
      $count = 0;
      
      $pro_id = $p_price['p_id'];
      $pro_qty = $p_price['qty'];
      $pro_price = $p_price['price'];

      $pro_pri = "select * from products where product_id = '$pro_id'";

      $run_pro_price = mysqli_query($con, $pro_pri); 

      while($pp_price = mysqli_fetch_array($run_pro_price))
      { 
        $product_price = array($pp_price['product_price']);
        $product_title = $pp_price['product_title'];
        $product_image = $pp_price['product_image'];
        $single_price =  $pro_price < 1 ? $pp_price['product_price'] : $pro_price; //one line if-else code (choose price from product if cart price hasn't been set)
        $values = $product_price;

        $totalPerRow = $single_price * $pro_qty;

        $alltotal += $totalPerRow; 

      ?>

      <tr align = "center">
      <td><input type = "checkbox" name="prd[]" value = "<?php echo $pro_id;?>"/></td>
      <td style="font-family: calibri;">
      <?php echo $product_title; ?><br>
      <img src = "admin_area/product_images/<?php echo $product_image;?>" width = "80" height = "80" />            
      </td>
      <td>
      <input type = "text" size="4" name="qty[]" value = "<?php if (isset($pro_qty)) { echo $pro_qty; } ?>"/>
      <input type = "hidden" size="4" name="prd1[]" value = "<?php echo $pro_id; ?>"/>
      </td>   
      
      <td style = "font-family: calibri;"><?php echo "$". $single_price; ?></td> 
      <td><input type = "hidden" size="4" name="sprc[]" value = "<?php echo $single_price; ?>"/></td>  
      </tr>
  <?php } } ?>

<tr align = "center">
  <td colspan = "2"><input type = "submit" name = "update_cart" value = "Delete" /></td>
  <td><input type = "submit" name = "continue" value = "Contiue Shopping" /></td>
  <td><input type = "submit" name = "chk" value = "checkout" /></td>
</tr>

</table>

</form>

  <!--content wrapper ends here -->
     
</div>
   
</body>

</html>
