<?php 
include("includes/db.php");
?>

<!Doctype>
<html>
<head>
    <title>Inserting Products</title>
</head>

<body>

  <form action = "insert_product.php" method = "post" enctype = "multipart/form-data">
  
  <table align = "center" width = "750" border = "2" style = "margin-left: -280px; margin-top: 20px;">

  <tr align = "center">
     <td colspan = "8"><h2 style = "font-family: calibri;">Insert New Product Here</h2></td>
  </tr>

  <tr align = "center">
      <td style = "font-family: calibri;"><b>Product Title:</b></td>
      <td><input type = "text" name = "product_title" size = "60" required = "true" /></td> 
  </tr>

  <tr align = "center">
      <td style = "font-family: calibri;"><b>Product Category:</b></td>
      <td>
      <select name = "product_cat">
      <option>Select a Category</option>
      
       <?php 
       
       $get_cats = "select * from categories";

      $run_cats = mysqli_query($con, $get_cats); 

      while ($row_cats = mysqli_fetch_array($run_cats))
      {
          $cat_id = $row_cats['cat_id'];
          $cat_title = $row_cats['cat_title'];
    
          echo "<option value='$cat_id'>$cat_title</option>";
      }
          
 ?>

</select>
  </td>
  </tr>

  <tr align = "center">
      <td style = "font-family: calibri;"><b>Product Brand:</b></td>
      <td>
      <select name = "product_brand">
      <option>Select a Brand</option>
      <?php 

      $get_brands = "select * from brands";

      $run_brands = mysqli_query($con, $get_brands); 
  
      while ($row_brands = mysqli_fetch_array($run_brands))
      {
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];
   
        echo "<option value='$brand_id'>$brand_title</option>";        
      }
  
    ?>  
      </td> 
  </tr>

<tr align = "center">
      <td style = "font-family: calibri;"><b>Product Image:</b></td>
      <td><input type = "file" name = "product_image"/></td> 
  </tr>

<tr align = "center">
      <td style = "font-family: calibri;"><b>Product Price:</b></td>
      <td><input type = "text" name = "product_price"/></td> 
  </tr>

<tr align = "center">
      <td style = "font-family: calibri;"><b>Product Description:</b></td>
      <td><textarea  name = "product_desc" col = "20" rows ="10"></textarea></td> 
  </tr>

<tr align = "center">
      <td style = "font-family: calibri;"><b>Product Keywords:</b></td>
      <td><input type = "text" name = "product_keywords" size = "50" /></td> 
</tr>

<tr align = "center">
      <td colspan = "8"><input type = "submit" name = "insert_post" value = "Insert Product Now"/></td> 
  </tr>


  </table> 


  </form>


</body>


</html>


<?php 

if(isset($_POST['insert_post']))
{
  //getting the text data from the fields
  $product_title = $_POST['product_title'];
  $product_cat = $_POST['product_cat'];
  $product_brand = $_POST['product_brand'];
  $product_price = $_POST['product_price'];
  $product_desc = $_POST['product_desc'];
  $product_keywords = $_POST['product_keywords'];

  //getting the image from the fields 

  $product_image = $_FILES['product_image']['name'];
  $product_img_tmp = $_FILES['product_image']['tmp_name'];
  
  move_uploaded_file($product_img_tmp,"product_images/$product_image");

  $text = explode(" ", $product_keywords);

  $topic = "";

  $topics = "";

  foreach ($text as $word)
  {    
    if(substr($word, 0, 1) == "#")// i.e if first character of the word is the # sign
    {
      $topic .= substr($word, 1).",";
      $topics .= substr($word, 1)." ";
    }
  }
  
  $insert_product = "insert into products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords,topics)
  values ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords','$topic')";             
  
  $insert_pro = mysqli_query($con, $insert_product);

  $top = explode(" ", $topics);

  for($i=0; $i < count($top); $i++)
  {
    $piece = $top[$i];
    echo $num = $i+1;
    print_r($piece);

    $get_tops = "SELECT * FROM  topic_wall WHERE topic = '$piece'";
    $run_tops = mysqli_query($con, $get_tops);
    $num_tops = mysqli_num_rows($run_tops);

    if($num_tops == 0)
    {
      $ins_tops = "INSERT INTO topic_wall(topic) VALUES('$piece')"; 
      $run_ins = mysqli_query($con, $ins_tops);
    }
  }

  if ($insert_pro)
  {
    echo "<script> alert('Product Has Been Inserted!')</script>";
    echo "<script>window.open('index.php?insert_product','_self')</script>";
  }
  
}

?>
