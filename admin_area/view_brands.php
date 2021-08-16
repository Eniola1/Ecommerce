<form action = "" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View All Brands Here</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">Brand ID</th>
      <th style = "font-family: calibri;">Brand Title</th>
      <th style = "font-family: calibri;">Edit</th>
      <th style = "font-family: calibri;">Delete</th>
    </tr>

    <?php 
    include("includes/db.php");

    $get_brand = "select * from brands";

    $run_brand = mysqli_query($con, $get_brand);

    $i = 0;

    while($row_brand = mysqli_fetch_array($run_brand))
    {
      $brand_id = $row_brand['brand_id'];
      $brand_title = $row_brand['brand_title'];
      $i++;
     
   ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $brand_title;?></td>
       <td><a href = "index.php?edit_brand=<?php echo $brand_id;?>">Edit</a></td>
        <td><a href = "delete_brand.php?delete_brand=<?php echo $brand_id;?>">Delete</a></td>
  
    </tr>

    <?php } ?>
  
    </table>

    </form>   