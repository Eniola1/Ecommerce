<?php

echo phpinfo();



<!Doctype>

<div>

<h2 align = "center" style = "font-family: calibri; color: white;"> Chose Method Of Payment:</h2>


<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="bidness@shop.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="amount" value="<?php $total; ?>">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name ="return" value="//www.myonlineshop.com/myshop/paypal_success.php"/>
<input type="hidden" name ="cancel_return" value="//www.myonlineshop.com/myshop/paypal_cancel.php"/>

<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
src="images/payp.png" width = "200" height = "100"
alt="Buy Now">
<img alt="" border="0" width="1" height="1"
src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

</div>



?>