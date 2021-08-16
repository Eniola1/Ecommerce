<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
<input type = "text" name = "pid" value = "" placeholder = "id...">
<input type = "submit" name = "login" value = "Login"> 
</form>

</body>
</html>

<?php 
if(isset($_POST['login']))
{
    $id = $_POST['pid'];

    if(DB::query('SELECT * FROM payments WHERE id = :id  AND curator = :P1 AND p_status = :stat', array(':P1'=>'Approved', ':id'=> $id, ':stat'=>'pending')))
    {
        $se_status = DB::query('SELECT * FROM payments WHERE id = :id AND curator = :P1 AND p_status = :stat', array(':P1'=>'Approved', ':id'=> $id, ':stat'=>'pending'));

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
            <select name = 'cv' placeholder = 'Stationary'>  
            <option>Enroute</option>
            <option>Delivered</option>
            <option>Rejected</option>
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

    DB::query('UPDATE payments SET d_status = :stat WHERE id=:id', array(':stat'=>'$cv', ':id'=>$id));    
}

?>