<?php 
include ("includes/db.php");
include "functions/functions.php";

if(isset($_GET['email']))
{
    $mail = $_GET['email'];
    $name = $_GET['name'];

    if(isset($_POST['next']))
    {
        $email = htmlspecialchars($_POST['email']);
        $token = rand(10000,100000);

        $ch_email = "SELECT * fROM customers WHERE email = '$email'";
        $run_chk = mysqli_query($con, $g_token);
        $count_chk = mysqli_num_rows($run_chk);
                     
        if($count_chk == 0)
        {
            $update = "UPDATE customers SET email = '$email', token = '$token' WHERE email = '$mail'";  
            $run_update = mysqli_query($con, $update);
            
            phpmailer($name, $email, $token);
            echo "<script>window.open('confirm2.php?email=htmlspecialchars($email)&name=".htmlspecialchars($name)."', '_self')</script>";
        } 
        
        else
        {
            echo "<script>window.open('confirm1.php?mail=htmlspecialchars($email)&name=".htmlspecialchars($name)."&E_mail=".htmlspecialchars($email)."', '_self')</script>";
        }
    }
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
    <form action="confirm.php" method="post" enctype = "multipart/form-data">
    <input type="text" name = "name" value = "<?php if(isset($_GET['name'])){echo $name = $_GET['name'];} ?>" placeholder = "Name"> <p/>
    <input type="email" name = "email" value = "" placeholder = "someone@somesite.com"><p/>
    <div> <?php if(isset($_GET['E_mail'])){echo "This Email is already in use";} ?> </div>
    <input type="submit" name = "Next" value = "next"><p/>
    </form>   
</body>

</html>

<?php 
    
    use PHPMailer\PHPMailer\PHPMailer;
         
    if(!isset($_GET['email']))
    {
        if(isset($_POST['next']))
        {
            $f_name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($email);
            $token = rand(10000,100000);

            $ch_email = "SELECT * fROM customers WHERE email = '$email'";
            $run_chk = mysqli_query($con, $g_token);
            $count_chk = mysqli_num_rows($run_chk);

            if($count_chk == 0)
            {
                $insert_c = "INSERT INTO customers (customer_email, f_name, token) VALUES ('$email','$f_name','$token')";
                $run_c = mysqli_query($con, $insert_c);

                phpmailer($f_name, $email, $token);
                echo "<script>window.open('confirm2.php?email=htmlspecialchars($email)&name=".htmlspecialchars($f_name)."', '_self')</script>";
            } 
        
            else
            {
                echo "<script>window.open('confirm.php?mail=htmlspecialchars($email)&name=".htmlspecialchars($name)."&E_mail=".htmlspecialchars($email)."', '_self')</script>";
            }
        }
    }
    
?>