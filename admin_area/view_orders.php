<table width ="795" align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View all orders here: </h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">S.N</th>
      <th style = "font-family: calibri;">customer_Email</th>
      <th style = "font-family: calibri;">Product(s)</th>
      <th style = "font-family: calibri;">Quantity</th>
      <th style = "font-family: calibri;">Invoice</th>
      <th style = "font-family: calibri;">Order date</th>
      <th style = "font-family: calibri;">Action</th>
    </tr>

    <?php 
    include("includes/db.php");

    $get_order = "select * from orders where c_id = '$c_id'";

    $run_pro = mysqli_query($con, $get_order);

    $i = 0;

    while($row_order = mysqli_fetch_array($run_pro))
    {
      $order_id = $row_order['order_id'];
      $qty = $row_order['qty'];
      $pro_id = $row_order['p_id'];
      $c_id = $row_order['c_id'];
      $invoice_no = $row_order['invoice_no'];
      $order_date = $row_order['order_date'];
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
        <td><?php echo $qty;?></td>
        <td><?php echo $invoice_no;?></td>
        <td><?php echo $order_date;?></td>
        <td><a href = "index.php?confirm_order=<?php echo $order_id; ?>">Complete Order</a></td>

    </tr>

    <?php } ?>

  </table>


<?php 

    if(isset($_GET['confirm_order']))
    {
       $get_id = $_GET['confirm_order'];
       $status = 'completed';

       $update_order = "update orders set status = '$status' where order_id = '$order_id'";

       $run_update = mysqli_query($con, $update_order);

       if($run_update)
       {
          echo "<script>alert('Order was Updated')</script>";
          echo "<script>window.open('index.php?view_orders','_self')</script>";         
       }

    }

?>