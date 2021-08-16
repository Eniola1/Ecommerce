<?php
if(!isset($_SESSION['user_email']))
{
  echo "<script>window.open('login.php?not_admin=You are not an admin!', '_self')</script>";
}

else
{
?>

<form action = "" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View All Products Here</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">S.N</th>
      <th style = "font-family: calibri;">Title</th>
      <th style = "font-family: calibri;">Image</th>
      <th style = "font-family: calibri;">Price</th>
      <th style = "font-family: calibri;">Edit</th>
      <th style = "font-family: calibri;">Delete</th>
    </tr>

    <?php 
    include("includes/db.php");

    $get_pro = "select * from products";

    $run_pro = mysqli_query($con, $get_pro);

    $i = 0;

    while($row_pro = mysqli_fetch_array($run_pro))
    {
      $pro_id = $row_pro['product_id'];
      $pro_title = $row_pro['product_title'];
      $pro_image = $row_pro['product_image'];
      $pro_price = $row_pro['product_price'];
      $i++;
     
     ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $pro_title;?></td>
        <td><img scr = "product_images/?php echo $pro_image;?>" width = "60" height = "60"/></td>
        <td><?php echo $pro_price;?></td>
        <td><a href = "index.php?edit_pro=<?php echo $pro_id;?>">Edit</a></td>
        <td><a href = "delete_pro.php?delete_pro=<?php echo $pro_id;?>">Delete</a></td>
  
    </tr>

    <?php } ?>
  
    </table>

    </form>   

<?php } ?>