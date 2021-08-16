<?php 
include ('./classes/DB.php');
include ('./classes/Login.php');

if(DB::query('SELECT * FROM payments WHERE curator = :P1 AND p_status = :stat', array(':P1'=>'Approved', ':stat'=>'pending')))
{
    $se_status = DB::query('SELECT * FROM payments WHERE curator = :P1 AND p_status = :stat', array(':P1'=>'Approved', ':stat'=>'pending'));

    foreach($se_status as $se_stat)
    {
        $id = $se_stat['payment_id'];
        $customer = $se_stat['customer'];
        $address = $se_stat['address'];
        $title = $se_stat['product_title'];
        
        //$day = $se_stat['dateTime'];

        $post = "<form action = '' method = 'post'>
        <input type = 'text' name = 'title' value = "".$title."" placeholder = ''>
        <input type = 'hidden' name = 'id' value = "".$id."" placeholder = ''>
        <input type = 'text' name = 'address' value = "".$address."" placeholder = ''>
        <input type = 'text' name = 'customer' value = "".$customer."" placeholder = ''>
        <a href = 'prdelivery.php'>Pick a merchandise</a>
        </form>";

        echo $post;
    }
}

?>