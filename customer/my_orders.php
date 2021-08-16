<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> Your Orders details:</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">S.N</th>
      <th style = "font-family: calibri;">Product(s)</th>
      <th style = "font-family: calibri;">Quantity</th>
      <th style = "font-family: calibri;">Invoice</th>
      <th style = "font-family: calibri;">Order date</th>
      <th style = "font-family: calibri;">status</th>
    </tr>

    <?php 
    include("includes/db.php");

    $user = $_SESSION['customer_email'];

    $get_c = "select * from customers where customer_email = '$user'";

    $run_c = mysqli_query($con, $get_c);

    $row_c = mysqli_fetch_array($run_c);

    $c_id = $row_c['customer_id']; 

    $get_order = "select * from orders where c_id = '$c_id'";

    $run_pro = mysqli_query($con, $get_order);

    $i = 0;

    while($row_order = mysqli_fetch_array($run_pro))
    {
      $order_id = $row_order['order_id'];
      $qty = $row_order['qty'];
      $pro_id = $row_order['p_id'];
      $invoice_no = $row_order['invoice_no'];
      $order_date = $row_order['order_date'];
      $status = $row_order['status'];
      $i++;

      $get_pro = "select * from products where product_id = '$pro_id'";
      </table>
      $run_pro = mysqli_query($con, $get_pro);

      $row_pro = mysqli_fetch_array($run_pro);

      $pro_image = $row_pro['product_image'];
      $pro_title = $row_pro['product_title'];
   ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $pro_title;?></td>
        <td><img scr = "../admin_area/product_images/?php echo $pro_image;?>" width = "60" height = "60"/></td>
        <td><?php echo $qty;?></td>
        <td><?php echo $invoice_no;?></td>
        <td><?php echo $order_date;?></td>
        <td><?php echo $status;?></td>

    </tr>

    <?php } ?>
  
