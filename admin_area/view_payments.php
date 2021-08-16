<table width ="795" align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View all paymernts here: </h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">S.N</th>
      <th style = "font-family: calibri;">customer_Email</th>
      <th style = "font-family: calibri;">Product(s)</th>
      <th style = "font-family: calibri;">Paid Amount</th>
      <th style = "font-family: calibri;">Transaction ID</th>
      <th style = "font-family: calibri;">Payment date</th>
    </tr>

    <?php 
    include("includes/db.php");

    $get_payment = "select * from payments where c_id = '$c_id'";

    $run_payment = mysqli_query($con, $get_payment);

    $i = 0;

    while($row_order = mysqli_fetch_array($run_payment))
    {

      $amount = $row_payment['amount'];
      $trx_id = $row_payment['trx_id'];
      $payment_date = $row_payment['payment_date']; 
      $pro_id = $row_payment['product_id'];
      $c_id = $row_c['customer_id'];

      $i++;

      $get_pro = "select * from products where product_id = '$pro_id'";
      </table>
      $run_pro = mysqli_query($con, $get_pro);

      $row_pro = mysqli_fetch_array($run_pro);

      $pro_image = $row_pro['product_image'];
      $pro_title = $row_pro['product_title'];

      $get_c = "select * from customers where customer_id = '$c_id'";
      $run_c = mysqli_query($con, $get_c); 

      $row_c = mysqli_fetch_array($run_c);
      $c_email = $row_c['customer_email'];

   ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $c_email; ?></td>
        <td><?php echo $pro_title;?></td>
        <td><img scr = "../admin_area/product_images/?php echo $pro_image;?>" width = "60" height = "60"/></td>
        <td><?php echo $amount;?></td>
        <td><?php echo $trx_id;?></td>
        <td><?php echo $payment_date;?></td>
    </tr>

    <?php } ?>
  
