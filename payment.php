<?php 
  include ('classes/Login.php');
  
  if(Login::isLoggedIn())
  {
    $userId = Login::isLoggedIn();
  }

  $ip = getIp();
  $get_cid = "select * from checkout where ip_add = '$ip' ORDER BY ID DESC LIMIT 1";
  $run_cid = mysqli_query($con, $get_cid);

  while($row = mysqli_fetch_array($run_cid))
  {
    $cid = $row['id'];
    $amount = $row['amount'];
  }

  $get_cid = "select * from customers where customer_id = '$userId'";
  $run_cid = mysqli_query($con, $get_cid);

  while($row = mysqli_fetch_array($run_cid))
  {
    $username = $row['customer_name'];
  }

  $update_c = "update checkout set  username = '$username' where id = '$cid' AND ip_add = '$ip'";
  $run_c = mysqli_query($con, $update_c);

  require_once('stripe/init.php');
  \Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'T-shirt',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost/ecomm/paypal_success.php?id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/ecomm/paypal_cancel.php?id={CHECKOUT_SESSION_ID}',
  ]);

  $id = $session->id;
  
  $insert_c = "INSERT INTO transactions(username, ip_add, amount, pid, cid) VALUES ('$username', '$ip', '$amount', '$id', '$cid')";
  $run_c = mysqli_query($con, $insert_c);
  
  /**$total = 500;  payment gateway successfully added, give dynamic values(amount, title, price) Edit the output of this page
  //(delivey address, qty e.t.c) just subtitute test keys with live keys, check if money entered account, change success and error pages */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
  <h2 align = "center" style = "font-family: calibri; color: white;"> <button id="checkout-button">Checkout</button></h2>
<script>
   var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx'); 
   const btn = document.getElementById("checkout-button");
   btn.addEventListener('click', function(e){
    e.preventDefault();
    stripe.redirectToCheckout({
      sessionId: "<?php echo $session->id; ?>"
    });
  });
</script>

</body>

</html>  
