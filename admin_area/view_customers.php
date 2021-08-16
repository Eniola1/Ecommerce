<form action = "" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View All Customers Here</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">S.N</th>
      <th style = "font-family: calibri;">Name</th>
      <th style = "font-family: calibri;">Email</th>
      <th style = "font-family: calibri;">Image</th>
      <th style = "font-family: calibri;">Delete</th> 
    </tr>

    <?php 
    include("includes/db.php");

    $get_c = "select * from customers";

    $run_c = mysqli_query($con, $get_c);

    $i = 0;

    while($row_c = mysqli_fetch_array($run_c))
    {
      $c_id = $row_c['customer_id'];
      $c_name = $row_c['customer_name'];
      $c_email = $row_c['customer_email'];
      $c_image = $row_c['customer_image'];
      $i++;
     
   ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $c_name;?></td>
        <td><?php echo $c_email;?></td>
        <td><img scr = "../customer/customer_images/<?php echo $c_image;?>" width = "60" height = "60"/></td>
        <td><a href = "delete_c.php?delete_c=<?php echo $c_id;?>">Delete</a></td>
  
    </tr>

    <?php } ?>
  
    </table>

    </form>   