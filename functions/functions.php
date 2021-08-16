<?php
// Import PHPMailer classes into the global namespace
  // These must be at the top of your script, not inside a function
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

$con = mysqli_connect("localhost","root","","social-commerce");
$output = '';

if(mysqli_connect_errno())
{
  echo "The connection was not established: " . mysqli_connect_error();
}

function searchResult()
{
  if(isset($_POST['search']))
  {
    global $con;

    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);

    $query = "SELECT * FROM products WHERE product_title LIKE '%$searchq%'" or die("could not search!");

    $count = mysqli_query($con, $query);

    $counts = mysqli_num_rows($count);

    if($counts == 0)
    {
      echo " <div style = 'color: white; font-size: 22px; font-family: calibri;'> This Product is currently not available </div>";
    }

   else
   {
    while($row = mysqli_fetch_array($count))
    {
      $pro_id = $row['product_id'];
      $pro_cat = $row['product_cat'];
      $pro_brand = $row['product_brand'];
      $pro_title = $row['product_title'];
      $pro_price = $row['product_price'];
      $pro_image = $row['product_image'];
            

     echo "
          
     <div class='single_product' id='item$pro_id'>

     <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
     
     <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

     <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>

     <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
     <a href='index.php?add_cart=$pro_id&pro_price=$pro_price'>
     <button style = 'float:right; font-family:calibri;'>Add to cart</button></a> 
     <input type='hidden' id='name_"."$pro_id' value='$pro_title'>
     <input type='hidden' id='price_"."$pro_id' value='$pro_price'>
     <input type='hidden' id='id_"."$pro_id' value='$pro_id'>
    
     </div>

     ";
    }  
  }
}

}

function getIp()
{
  $ip = $_SERVER['REMOTE_ADDR'];

  if(!empty($_SERVER['HTTP_CLIENT_IP']))
  {
     $ip = $_SERVER['HTTP_CLIENT_IP'];
  }

  elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }

  return $ip;
}

function cart()
{
  if(isset($_GET['add_cart']))
  {
    global $con;

    $ip = getIp(); 
    $pro_id = $_GET['add_cart'];
    $pro_price = $_GET['pro_price'];
    $check_pro = "select * from cart where ip_add = '$ip' AND p_id = '$pro_id'";
    $run_check = mysqli_query($con, $check_pro);

    if(mysqli_num_rows($run_check) > 0)
    {
      echo ""; 
    }

    else
    {
      //echo 'pro_price = ' . $pro_price; die;
      $insert_pro = "insert into cart (p_id,ip_add,qty,price) values ('$pro_id', '$ip', '1', '$pro_price')";

      $run_pro = mysqli_query($con, $insert_pro);
      
      echo "<script>window.open('index.php','_self')</script>";
    }

  } 

}

//getting the total added items 
/** 
function total_items()
{
  if(isset($_GET['add_cart']))
  {
    global $con;

    $ip = getIp();

    $get_items = "select * from cart where ip_add ='$ip'";

    $run_items = mysqli_query($con, $get_items); 

    $count_items = mysqli_num_rows($run_items);
  }

  else
  {
    global $con;

    $ip = getIp();

    $get_items = "select * from cart where ip_add ='$ip'";

    $run_items = mysqli_query($con, $get_items); 

    $count_items = mysqli_num_rows($run_items);
  }

  echo $count_items;

}

//getting total price of the item in the cart

function total_price()
{
   $total = 0;

   global $con;
   
  $ip = getIp();

  $sel_price = "select * from cart where ip_add = '$ip'";

  $run_price = mysqli_query($con, $sel_price);

  while($p_price = mysqli_fetch_array($run_price))
  {
     $pro_id = $p_price['p_id'];     
     
     $pro_price = "select * from products where product_id = '$pro_id'";

     $run_pro_price = mysqli_query($con, $pro_price); 

     while($pp_price = mysqli_fetch_array($run_pro_price))
     { 
        $product_price = array($pp_price['product_price']);

        $values = array_sum($product_price);

        $total += $values;
     }
  }
  echo "$" .$total;
} 

*/


// getting the categories
function getCats()
{
  global $con;

  $get_cats = "select * from categories";

  $run_cats = mysqli_query($con, $get_cats); 

  while ($row_cats = mysqli_fetch_array($run_cats))
  {
    $cat_id = $row_cats['cat_id'];
    $cat_title = $row_cats['cat_title'];

    echo "<li><a href = 'index.php?cat=$cat_id'>$cat_title</a></li>";
  }

}


function getBrands()
{
  global $con;

  $get_brands = "select * from brands";

  $run_brands = mysqli_query($con, $get_brands); 

  while ($row_brands = mysqli_fetch_array($run_brands))
  {
    $brand_id = $row_brands['brand_id'];
    $brand_title = $row_brands['brand_title'];

    echo "<li><a href = 'index.php?brand=$brand_id'>$brand_title</a></li>";      
  }

}


function getPro()
{
  if(!isset($_GET['cat']))
  {
    if(!isset($_GET['brand']))
    {
      if(!isset($_POST['search']))
      {
        if(!isset($_GET['username']))
        {
        
          global $con;

          $rp = 2;

          //$get_pro = "select * from products order by RAND() LIMIT 0,6";
          $get_pro = "SELECT * FROM products";

          $run_pro = mysqli_query($con, $get_pro); 

          $nr = mysqli_num_rows($run_pro);

          $np = ceil( $nr / $rp);

          $arr = "<form action = '' method = 'post'>
          <input type = 'submit' name = 'left' value = '<'>";
          echo $arr;

          if(!isset($_POST['right']) && !isset($_POST['left']))
          {
            $ip = getIp();

            $sel_ip = "SELECT * FROM arrow WHERE user_ip = '$ip'";
            $get_ip = mysqli_query($con, $sel_ip);
            $num_ip = mysqli_num_rows($get_ip);

            if($num_ip > 0)
            {
              $fls_ip = "UPDATE arrow SET P_left = 0, P_right = 0 WHERE user_ip = '$ip'";
              $fl_ip = mysqli_query($con, $fls_ip);
            }

            else
            {
              $ins_ip = "INSERT INTO arrow(user_ip, P_left, P_right) VALUES ('$ip','0','0')";
              $run_fl = mysqli_query($con, $ins_ip);
            }

            for($page=1; $page<=3; $page++)
            {
              echo '<a href="index.php?page='.$page.'"> '.$page.'</a>';
            }

          }

          if(isset($_POST['right']))
          {
            $ip = getIp();

            $up_rg = "UPDATE arrow SET P_right = P_right+1 WHERE user_ip = '$ip'";
            $run_up = mysqli_query($con, $up_rg);
            $get_all = "SELECT * FROM arrow WHERE user_ip = '$ip'";
            $run_get = mysqli_query($con, $get_all);

            while($all = mysqli_fetch_array($run_get))
            {
              $g_right = $all['P_right'];
              $g_left = $all['P_left'];
              $n = $g_right - $g_left;

              if($n <= 0)
              {
                for($page=1; $page<=3; $page++)
                {
                  echo '<a href="index.php?page='.$page.'"> '.$page.'</a>';
                }
              }

              else
              {
                $d = $n+1;

                $p = 3 * $d;

                for($page=($p-2); $page<=$p; $page++)
                {
                  echo '<a href="index.php?page='.$page.'"> '.$page.'</a>';
                }
              
              }

            }

          }

          if(isset($_POST['left']))
          {     
            $ip = getIp();
            
            $up_rg = "UPDATE arrow SET P_left = P_left+1 WHERE user_ip = '$ip'";
            $run_ur = mysqli_query($con, $up_rg);
            $get_all = "SELECT * FROM arrow WHERE user_ip = '$ip'";
            $run_get = mysqli_query($con, $get_all);

            while($all = mysqli_fetch_array($run_get))
            {
              $g_right = $all['P_right'];
              $g_left = $all['P_left'];
              $n = $g_right - $g_left;

              if($n <= 0)
              {
                for($page=1; $page<=3; $page++)
                {
                  echo '<a href="index.php?page='.$page.'"> '.$page.'</a>';
                }
              }

              else
              {
                $d = $n+1;

                $p = 3 * $d;

                for($page=($p-2); $page<=$p; $page++)
                {
                  echo '<a href="index.php?page='.$page.'"> '.$page.'</a>';
                }

              }
            
            }

          }

          $arrl =  "<form action = '' method = 'post'>
          <input type = 'submit' name = 'right' value = '>'>";
          echo $arrl;


          if(isset($_GET['page']))
          {
            $page = $_GET['page'];
            $n = $page;
            $st_limit = ($n-1)*$rp;

            $get_st = "SELECT * FROM products  LIMIT ".$st_limit.','.$rp;
            $result = mysqli_query($con, $get_st);

            while ($row = mysqli_fetch_array($result))
            {
              $pro_id = $row['product_id'];
              $pro_cat = $row['product_cat'];
              $pro_brand = $row['product_brand'];
              $pro_title = $row['product_title'];
              $pro_price = $row['product_price'];
              $pro_image = $row['product_image'];

              echo "

                <div class='single_product' id='item$pro_id'>

                <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
                    
                <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

                <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>
                
                <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
                <input type='button' style = 'float:right; font-family:calibri;' value='Add to cart' onclick=cart('item$pro_id')> 
                <input type='hidden' id='item$pro_id"."_name' value='$pro_title'>
                <input type='hidden' id='item$pro_id"."_price' value='$pro_price'>
                <input type='hidden' id='item$pro_id"."_id' value='$pro_id'>
                </a>

                </div>
              
              ";
            }
        
          }

          else
          {
            
            $gets_pro = "select * from products order by RAND() LIMIT 0,6";

            $runs_pro = mysqli_query($con, $gets_pro);
            
            while($row_pro = mysqli_fetch_array($runs_pro))
            {        
              $pro_id = $row_pro['product_id'];
              $pro_cat = $row_pro['product_cat'];
              $pro_brand = $row_pro['product_brand'];
              $pro_title = $row_pro['product_title'];
              $pro_price = $row_pro['product_price'];
              $pro_image = $row_pro['product_image'];
              
              echo "

                <div class='single_product' id='item$pro_id'>

                <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
                    
                <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

                <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>
                
                <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
                <input type='button' style = 'float:right; font-family:calibri;' value='Add to cart' onclick=cart('item$pro_id')> 
                <input type='hidden' id='item$pro_id"."_name' value='$pro_title'>
                <input type='hidden' id='item$pro_id"."_price' value='$pro_price'>
                <input type='hidden' id='item$pro_id"."_id' value='$pro_id'>
                </a>

                </div>
              
              ";
            }  

          }

        }

      }

    }

  }

}

function getCatPro()
{
  if(isset($_GET['cat']))
  {
   $cat_id = $_GET['cat'];

   global $con;

   $get_cat_pro = "select * from products where product_cat = '$cat_id'";

   $run_cat_pro = mysqli_query($con, $get_cat_pro);

   $count_cats = mysqli_num_rows($run_cat_pro);

   if($count_cats==0)
   {    
      echo  "<h2 style = 'font-family:calibri; font-size: 23px; color:white'>There is no product in this category! </h2>";
   }

   while($row_cat_pro = mysqli_fetch_array($run_cat_pro))
   {
               
      $pro_id = $row_cat_pro['product_id'];
      $pro_cat = $row_cat_pro['product_cat'];
      $pro_brand = $row_cat_pro['product_brand'];
      $pro_title = $row_cat_pro['product_title'];
      $pro_price = $row_cat_pro['product_price'];
      $pro_image = $row_cat_pro['product_image'];
      

     echo "
          
     <div class='single_product' id='item$pro_id'>

        <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
             
        <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

        <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>
        
        <form action='' method='post'>
        <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
        <input type='button' style = 'float:right; font-family:calibri;' value='Add to cart' onclick=cart('item$pro_id')> 
        <input type='hidden' id='item$pro_id"."_name' value='$pro_title'>
        <input type='hidden' id='item$pro_id"."_price' value='$pro_price'>
        <input type='hidden' id='item$pro_id"."_id' value='$pro_id'>
        </form>
         
        </div>
     
     ";
    } 
  }

}


function getBrandPro()
{ 
  if(isset($_GET['brand']))
  { 
    $brand_id = $_GET['brand'];

    global $con;

    $get_brand_pro = "select * from products where product_brand = '$brand_id'";

    $run_brand_pro = mysqli_query($con, $get_brand_pro);

    $count_brands = mysqli_num_rows($run_brand_pro);

    if($count_brands==0)
    {    
      echo  "<h2 style = 'font-family:calibri; font-size: 23px; color:white'>There is no product associated to this brand! </h2>";
    }

    while($row_brands_pro = mysqli_fetch_array($run_brand_pro))
    {
    
      $pro_id = $row_brands_pro['product_id'];
      $pro_cat = $row_brands_pro['product_cat'];
      $pro_brand = $row_brands_pro['product_brand'];
      $pro_title = $row_brands_pro['product_title'];
      $pro_price = $row_brands_pro['product_price'];
      $pro_image = $row_brands_pro['product_image'];

      echo "
            
      <div class='single_product' id='item$pro_id'>

        <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
              
        <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

        <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>
      
        <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>

        <input type='button' style = 'float:right; font-family:calibri;' value='Add to cart' onclick=cart('item$pro_id')> 
        <input type='hidden' id='item$pro_id"."_name' value='$pro_title'>
        <input type='hidden' id='item$pro_id"."_price' value='$pro_price'>
        <input type='hidden' id='item$pro_id"."_id'  value='$pro_id'>
        
      </div>
        
    ";
      
  }

 }

}

function tot_items()
{
  global $con; 

  $ip = getIp();
  
  $query = "SELECT * FROM cart WHERE ip_add='$ip' ORDER BY ID DESC LIMIT 1";

  $count = mysqli_query($con, $query);

  $counts = mysqli_num_rows($count);

  while($row = mysqli_fetch_array($count))
  {
    $items = $row['total_item'];
  }

  if($counts == 0)
  {
    $_SESSION['itemCount'] = 0;
    echo "<input type='button' class='tot' id='total_items' value='0'>";
  }

  else
  {
    $_SESSION['itemCount'] = $items;
    echo "<input type='button' class='tot' id='total_items' value='".$items."'>";
  }
}

function tot_price()
{
  global $con;
  
  $ip = getIp(); 

  $query = "SELECT * FROM cart WHERE ip_add='$ip' ORDER BY ID DESC LIMIT 1";

  $count = mysqli_query($con, $query);

  $counts = mysqli_num_rows($count);

  while($row = mysqli_fetch_array($count))
  {
    $price = $row['total_price'];
  }
    
  if($counts == 0)
  {
    $_SESSION['tprice'] = 0;
    echo "<input type='button' class='tot' id='total_price' value='$0'>";
  }

  else
  {
    $_SESSION['tprice'] = $price;
    echo "<input type='button' class='tot' id='total_price' value='$".$price."'>";
  }
  
}

function pcart()
{
  if(isset($_GET['cart']))
  {
    echo "<a href = 'index.php' style = 'color: red; margin-right:15px;'> Back to shop </a>";
  }

  else
  {
    echo "<a href = 'index.php?cart' style = 'color: red; margin-right:15px;'> Go to cart </a>";
  }

}


function Phpmailer($name, $email, $token)
{  
  //Load Basic classes autoloader
  require 'phpmailer/PHPMailer/PHPMailer-master/src/Exception.php';
  require 'phpmailer/PHPMailer/PHPMailer-master/src/PHPMailer.php';
  require 'phpmailer/PHPMailer/PHPMailer-master/src/SMTP.php';
  require 'credential.php';

  global $con;

  global $token;

  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
     global $con;
     global $token;

      //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = HOST;  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = EMAIL;                 // SMTP username
      $mail->Password = PASS;                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to
  
      $mail->SMTPOptions = array(
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
          )
      );
       
      //Recipients
      $mail->setFrom(EMAIL, 'Mailer');
      $mail->addAddress($email, 'Enny');     // Add a recipient
      
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Please Verify your Email';
      $mail->Body    = "Dear {$name} . ' Your activation code is {$token} Please verify your account";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
      $mail->send();
      echo 'You have been registered. A confirmation code has been sent to your account. Please verify your account';
    }
    
    catch (Exception $e) {
    echo 'Something went wrong, please try again.';
  }
}

function Phpmailers($name, $email, $token)
{  
  require 'phpmailer/PHPMailer/PHPMailer-master/src/Exception.php';
  require 'phpmailer/PHPMailer/PHPMailer-master/src/PHPMailer.php';
  require 'phpmailer/PHPMailer/PHPMailer-master/src/SMTP.php';
  require 'credential.php';

  global $con;

  global $token;

  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
  try {
     global $con;
     global $token;

     //Server settings
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = HOST;  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = EMAIL;                 // SMTP username
      $mail->Password = PASS;                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to
  
      $mail->SMTPOptions = array(
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name' => false,
              'allow_self_signed' => true
          )
      );
      
  
      //Recipients
      $mail->setFrom(EMAIL, 'Mailer');
      $mail->addAddress($email, 'Enny');     // Add a recipient
      
      //Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Please Verify your Email';
      //$mail->Body    = "Dear {$user} . ' Your activation code is {$token} Please verify your account";
      $mail->Body    = "Dear {$name} . 'Your have ordered some products on our website, please find your order details below, your order will
                        be processed shortly... //give details of customer's order here.";
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
      $mail->send();
      echo 'You have been registered. A confirmation code has been sent to your account. Please verify your account';
    }

     catch (Exception $e) {
      echo 'Something went wrong, please try again.';
    }
  }

?>