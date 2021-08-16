<?php 
include ('./classes/DB.php');
include ('./classes/Login.php');

date_default_timezone_set('Africa/Lagos');

if(DB::query('SELECT * FROM payments WHERE curator = :P1 AND p_status = :stat', array(':P1'=>'N/A', ':stat'=>'pending')))
{
    $se_status = DB::query('SELECT * FROM payments WHERE curator = :P1 AND p_status = :stat', array(':P1'=>'N/A', ':stat'=>'pending'));

    foreach($se_status as $se_stat)
    {
        $id = $se_stat['payment_id'];
        $day = $se_stat['dateTime'];
        $pday_time = date('d-m-Y', strtotime($day));

        if($pday_time == date('d-m-Y', strtotime("-4 days")))
        {
            DB::query('UPDATE payments SET p_status = :stat WHERE id=:id', array(':stat'=>'N/A', ':id'=>$id));
        }
    }
}
?>

<form action="" method="post">
<input type = "text" name = "pid" value = "" placeholder = "id...">
<input type = "submit" name = "login" value = "Login"> 
</form>

<?php

if(isset($_POST['login']))
{
    $id = $_POST['pid'];

    if(DB::query('SELECT * FROM payments WHERE id = :id AND p_status = :stat', array(':id'=>$id, ':stat'=>'pending')))
    {        
        $se_status = DB::query('SELECT * FROM payments WHERE id = :id AND p_status = :stat', array(':id'=>$id, ':stat'=>'pending'));

        foreach($se_status as $se_stat)
        {
            $id = $se_stat['payment_id'];
            $day = $se_stat['dateTime'];
            $title = $se_stat['product_title'];
            $amount = $se_stat['amount'];
            $vendor = $se_stat['vendor'];
            $currency = $se_stat['currency'];

            $post = "<form action = '' method = 'post'>
            <input type = 'text' name = 'title' value = "".$title."" placeholder = ''>
            <input type = 'hidden' name = 'id' value = "".$id."" placeholder = ''>
            <input type = 'text' name = 'amount' value = "".$currency."".$amount."" placeholder = ''>
            <input type = 'text' name = 'vendor' value = "".$vendor."" placeholder = ''>
            <select name = 'cv'>  
            <option>Approved</option>
            <option>N/P</option>
            </select>
            <input type = 'submit' name = 'submit' value = 'submit'> 
            </form>";
            
            echo $post;
        }
    }
}

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $cv = $_POST['cv']; 
    DB::query('UPDATE payments SET p_status = :stat WHERE id=:id', array(':stat'=>'$cv', ':id'=>$id));    
}

?>
