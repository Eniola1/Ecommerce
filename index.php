<!Doctype>
<?php     
session_start();
include "functions/functions.php";
include "functions/function.php";

include ('./classes/Login.php');

if(Login::isLoggedIn())
{
  echo $userId = Login::isLoggedIn();
}

?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

  $(document).ready(function(){

    $.ajax({
      type:'post',
      url:'store_items.php',
      data:{
    
      },
      success:function(response) {

      }
    });

    $.get('/ecomm/storeapi.php')
        .done(data => {
            console.log(data);
            const parseData = JSON.parse(data);
            document.getElementById("total_items").value=parseData.item;
            document.getElementById("total_price").value=parseData.price;
        });

    $("#search").keyup(function()
    {
      var searchText = $(this).val();
      if(searchText!='')
      {
        $.ajax({
            url:'ecomm1.php',
            method:'post',
            data:{query:searchText},
            success:function(response)
            {
              $("#show-list").html(response);
            }
        })
      }

      else
      {
        $("#show-list").html('');
      }
    });

    $(document).on('click', 'a', function()
    {
        $("#search").val($(this).text());
        $("#show-list").html('');
    });

  });

  function cart(id)
  {
    console.log('HERE >>>>>>>>>>>>>>>>>>>>>>>>>>>' + id);
    var ele=document.getElementById(id);
    var img_src=ele.getElementsByTagName("img")[0].src;
    var name=document.getElementById(id + "_name").value;
    var price=document.getElementById(id + "_price").value;
    var id = document.getElementById(id + "_id").value;
    const url = 'localhost/ecomm/storeapi.php';

    $.ajax({
      type:'post', 
      url:'store_items.php',
      data:{
        item_src:img_src,
        item_name:name,
        item_price:price,
        item_id:id,
      },
      
      success:function(response) {
        
      } 
    });

    $.get('/ecomm/storeapi.php')
      .done(data => {
          console.log(data);
          const parseData = JSON.parse(data);
          document.getElementById("total_items").value=parseData.item;
          document.getElementById("total_price").value=parseData.price;
      });
  } 

  /* function show_cart()
  {
    $.ajax({
    type:'post',
    url:'store_items.php',
    data:{
      showcart:"cart"
    },
    success:function(response) {
      document.getElementById("product_box").value=response;
      document.getElementById("product_box").innerHTML=response;
      //$("#mycart").slideToggle();
    } 
    }); 
  } */

</script>
 
	
</script>
  
<html>
   <head>
   <link rel="stylesheet"  href="styles/index.css" media = "all">
   <meta charset = "utf-8">
   <meta name = "viewport" content = "width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <title>My Online Shop</title>

   <header><span> My Online Shop </span></header> 
   </head>

   <body>
    <div id = "main_wrapper">
    <div id= "menubar"> 
    
      <ul id = "menu">
        <li><a href = "index.php"> Home </a> </li> 
        <li><a href = "all_products.php"> Products </a> </li>
        <li><a href = "my_account.php"> My Account </a> </li>
        <li><a href = "#"> Sign Up </a> </li>
        <li><a href = "cart.php"> Shopping Cart </a> </li> 
        <li><a href = "#"> Contact Us </a></li>
        
        <div id = "big" style = "float: right; margin-right: 700px; line-height: 30px; margin-top: 8px;">
        <form action = "index.php" method = "post">
            <div id = "see"> Search:
              <input type = "text" name = "search" id = "search" value ="" placeholder = "Search for products"/>
              <input type = "submit" name = "search" Value = "Search">
            </div> 
        </form>
        </div>
      </ul>
    
    </div>   

     <div id = "content_wrapper">
       <div id = "sidebar">  
       <div id = "sidebar_title"> Categories </div>

        <ul id = "cats"> 
            
          <?php getCats(); ?>
           
        </ul>   
    
      <div id = "sidebar_title"> Brands</div>

       <ul id = "cats"> 
    
         <?php  getBrands(); ?>
   
       </ul>   

    </div>

    <div id = "content_area">
     
    <?php cart(); ?> 
    
    <div id = "shopping_cart">
        
      <span style = " margin-left: 40px; font-family:calibri; color:white; font-size:21px; line-height:40px; padding:5px;"> 

      <?php 
      if(isset($_SESSION['customer_email']))
      {
        echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style = 'color:yellow; margin-top: 5px;'>Your</b>";
      }

      else
      {
        echo "<b>Welcome Guest:</b>";
      }
      
      ?>

     <b style = "color:yellow; margin-top: -4px;">Shopping cart-</b> Total Items:<?php tot_items();?>
     Total Price:<?php tot_price();?><?php pcart();?>
      
     <?php 
      if(!isset($_SESSION['customer_email']))
      {
        echo "<a href = 'checkout.php' style = 'color: yellow;'>Login</a>";
      }

      else
      {
        echo "<a href = 'logout.php' style = 'color: yellow;'>Logout</a> ";
      }
          
     ?>
       
   </span>

   </div>
     
   <div id = "products_box">
   <?php
    if(!isset($_GET['cart']))
    {      
      getPro(); 
      getCatPro(); 
      getBrandPro();
      getUsername();  
    }

    else 
    {
     include "cart.php";
    } 

    ?>

   </div>

   <div class="list-group" id="show-list">
 
   </div>

   </div>
        
   </div>

    <!--content wrapper ends here -->
     
    <div id="footer">
      <h2 style = "margin-left:30px; margin-bottom: 40px; font-family:calibri; font-size:22px; color:white;">&copy;2018 by MyOnline Shop</h2>
   </div>
   
   
  </body>


</html>