<?php
include("includes/db.php");
?>

<!Doctype>

<div>

<form method = "post" action = "">
<table width = "700" align = "center" bgcolor = "white">
   
    <tr align = "center">
    <td colspan = "4"><h2 style = "font-family:calibri;"> Input Your Fashion shop-social login </h2></td>
    </tr>

    <tr >
      <td style = "font-family:calibri;">Email:</td>
      <td><input type = "text" name = "email"  placeholder = "enter email"/></td>
    </tr>

    <tr>
      <td style = "font-family:calibri;">Password:</td>
      <td><input type = "password" name = "pass" placeholder = "enter password"/></td>
    </tr>

    <tr>
        <td><input type = "submit" name = "login" value = "Login"/></td>
    </tr>

</table>

</form>

</div>

<?php 
if(isset($_POST['login']))
{
    $c_email = $_POST['email'];
    $password = $_POST['pass'];
    $c_pass = password_hash($password, PASSWORD_BCRYPT);

    $sel_c = "select * from users where password = '$c_pass' AND email = '$c_email'";
    
    $run_c = mysqli_query($con, $sel_c);

    $check_customer = mysqli_num_rows($run_c);

    if($check_customer == 0)
    {
        echo "Password or email is incorrect, please try again!";
    }

    else
    { 
        $s_email = $_SESSION['customer_email']; 
        $get_s = "SELECT * FROM customers WHERE customer_email = '$s_email'";
        $run_s = mysqli_query($con, $get_s);
        
        while($row = mysqli_fetch_array($run_s))
        {
            $account = $row['account'];
            $username = $row['customer_name'];
        }
        
        $update_l = "UPDATE users SET account = 'Seller', e_username = '$username' WHERE customer_email = '$c_email'";
        
        echo "Your accounts have been linked successfully, Thanks!";
    }    
}

?>
