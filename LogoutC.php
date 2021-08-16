<?php 
include("includes/db.php");
include ('classes/Login.php');

    $token = sha1($_COOKIE['SNID1']);

    if(!Login::isLoggedIn())
    {
        die("Not logged in");
    }

    if(Login::isLoggedIn())
    {
        $userId = Login::isLoggedIn();
    }


    if(isset($_POST['alldevices']))
    {
        $del_c = "DELETE FROM login_token WHERE user_id = '$userId'";
        $run_c = mysqli_query($con, $del_c);
    }

    else
    {
        if(isset($_COOKIE['SNID1']))
        {
            $del_c = "DELETE FROM login_token WHERE token = '$token'";
            $run_c = mysqli_query($con, $del_c);
        }
        setcookie('SNID1', '1', time()-3600);
        setcookie('SNID1_', '1', time()-3600);
    }


?>

<h1> Logout of your account </h1>
<p> Are you sure you'd like to logout?</p>

<form action="Logout.php" method="post">
    <input type="checkbox" name="alldevices" value="alldevices"> Logout of all devices?<br />
    <input type="submit" name="confirm" value = "Confirm">
</form>