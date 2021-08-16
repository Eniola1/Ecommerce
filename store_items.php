<?php
session_start();

include ('./classes/DB.php');

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

if(isset($_POST['item_id']))
{ 
  itemExist($_POST['item_id']);
  exit();
}

if(isset($_POST['total_cart_items']))
{
  $price = $_SESSION['tprice'];  
  $item = $_SESSION['itemCount'];
  exit();
}


//using $isUpdate as boolean function to loop through the two functions below
function itemExist($id)
{  
  $ip = getIp();
  $price = $_POST['item_price'];
  $name = $_POST['item_name'];
  $src = $_POST['item_src'];

  if(!DB::query('SELECT * FROM cart WHERE ip_add=:ip', array(':ip'=>$ip)))
  {
    DB::query('INSERT INTO cart VALUES (\'\', :id, :ip, :qty, :price, :vendor, \'\', :t_item, :t_price)', array(':id'=> $id, ':ip'=>$ip, ':qty'=> '1', ':price'=> $price, ':vendor'=>'Enny', ':t_item'=> '1', ':t_price'=> $price));
    $_SESSION['itemCount'] = 1;      
    $_SESSION['tprice'] = $price;     
  }

  else
  {
    if(!DB::query('SELECT * FROM cart WHERE p_id=:id AND ip_add=:ip', array(':id'=>$id, ':ip'=>$ip)))
    {
      $_SESSION['itemCount'] += 1;      
      $_SESSION['tprice'] += $_POST['item_price'] * 1;
      $t_item = $_SESSION['itemCount'];
      $t_price = $_SESSION['tprice'];
      DB::query('INSERT INTO cart VALUES (\'\', :id, :ip, :qty, :price, :vendor, \'\', :t_item, :t_price)', 
      array(':id'=> $id, ':ip'=>$ip, ':qty'=> '1', ':price'=> $price, ':vendor'=>'Enny', ':t_item'=>$t_item, ':t_price'=>$t_price));
    }
    
    elseif(DB::query('SELECT * FROM cart WHERE p_id=:id AND ip_add=:ip', array(':id'=>$id, ':ip'=>$ip)))
    {
      $gets_v = DB::query('SELECT * FROM cart WHERE p_id=:id AND ip_add=:ip', array(':id'=>$id, ':ip'=>$ip));
      foreach($gets_v as $get_v)
      {
        $f_qty = $get_v['qty'];
        $R_qty = $f_qty + 1; 
      }

      $_SESSION['itemCount'] += 1;      
      $_SESSION['tprice'] += $_POST['item_price'] * 1;
      $t_item = $_SESSION['itemCount'];
      $t_price = $_SESSION['tprice'];
      DB::query('UPDATE cart SET qty = :qty  WHERE p_id = :id AND ip_add = :ip', array(':id'=> $id, ':ip' => $ip, ':qty' => $R_qty ));

      $querys = DB::query('SELECT * FROM cart WHERE ip_add=:ip ORDER BY ID DESC LIMIT 1', array(':ip'=>$ip)); 

      foreach($querys as $query)
      {
        $nid = $query['id'];
        DB::query('UPDATE cart SET total_item=:t_item, total_price=:t_price  WHERE id=:id AND ip_add =:ip', array(':id'=>$nid, ':ip'=>$ip, ':t_item'=>$t_item, ':t_price'=>$t_price));
      }
    }
  }
}

?>