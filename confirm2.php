<?php 
include ("includes/db.php");
include "functions/functions.php";

if(isset($_GET['email']))
{
    $email = $_GET['email'];
    $name = $_GET['name'];
}

if(isset($_GET['code']))
{
    $code = $_GET['code'];
}

if(isset($_GET['resend']))
{
    $token = rand(10000,100000); 
    
    $update = "UPDATE customers SET token = '$token' WHERE email = '$email'";  
    $run_update = mysqli_query($con, $update);

    phpmailer($name, $email, $token);
    echo "<script>window.open('confirm2.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."', '_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="styles/profile.css"/>
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <div> Enter the confirmation code </div>
    <div> Enter the confirmation code we sent to <?php echo $email; ?> below.</div>
    <div> <a href = "confirm.php?email=<?php echo $email;?>&name=<?php echo $f_name;?>"> Change Email </a> or <a href="confirm2.php?email=<?php echo $email; ?>&name=<?php echo $f_name;?>&resend"> Resend SMS </a>  
    <form action="confirm.php" method="post" enctype = "multipart/form-data">
    <input type="text" name = "code" value = "" placeholder = "confirmation code"> <p/>
    <div> <?php if(isset($_GET['code'])){echo "This activation code is incorrect, try entering the code again or generate a new one";} ?> </div>
    <input type="submit" name = "Next" value = "next"><p/>
    </form>   
</body>

</html>


<?php 

    if(isset($_POST['next']))
    {
        $code = htmlspecialchars($_POST['code']);
        
        $g_token = "SELECT * fROM customers WHERE email = '$email'";
        $run_token = mysqli_query($con, $g_token);

        while($row = mysqli_fetch_array($run_token))
        {
            $token = $row['token'];
        }

        if($code == $token)
        {
            $update = "UPDATE customers SET activation_status = '1' WHERE email = '$email'";  
            $run_update = mysqli_query($con, $update);
            
            echo "<script>window.open('customer_register.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."', '_self')</script>";            
        }  

        else
        {
            echo "<script>window.open('confirm2.php?code', '_self')</script>";
        }
    }
    
?>
