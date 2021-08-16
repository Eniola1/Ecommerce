<form action = "" method = "post" enctype = "multipart/form-data">

<table align = "center" width = "700" bgcolor = "white">
    <tr align = "center">
      <td colspan = "5"><h2 style = "font-family: calibri;"> View All Categories Here</h2></td>
    </tr>

    <tr align = "center">
      <th style = "font-family: calibri;">Category ID</th>
      <th style = "font-family: calibri;">Category Title</th>
      <th style = "font-family: calibri;">Edit</th>
      <th style = "font-family: calibri;">Delete</th>
    </tr>

    <?php 
    include("includes/db.php");

    $get_cat = "select * from categories";

    $run_cat = mysqli_query($con, $get_cat);

    $i = 0;

    while($row_cat = mysqli_fetch_array($run_cat))
    {
      $cat_id = $row_cat['cat_id'];
      $cat_title = $row_cat['cat_title'];
      $i++;
     
   ?>

    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $cat_title;?></td>
       <td><a href = "index.php?edit_cat=<?php echo $cat_id;?>">Edit</a></td>
        <td><a href = "delete_cat.php?delete_cat=<?php echo $cat_id;?>">Delete</a></td>
  
    </tr>

    <?php } ?>
  
    </table>

    </form>   