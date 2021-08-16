<?php
class Login
{  
    public static function isLoggedIn()
    {
        if(isset($_COOKIE['SNID1']))
        {
            global $con;
            
            $token = sha1($_COOKIE['SNID1']);

            $sel_c = "SELECT * FROM login_token WHERE token = '$token'";
            
            $run_c = mysqli_query($con, $sel_c);

            $check_customer = mysqli_num_rows($run_c);

            if($check_customer > 0)
            {       
                while($row = mysqli_fetch_array($run_c))
                {
                    $userid = $row['user_id'];
                }

                if(isset($_COOKIE['SNID1_']))
                {
                    return $userid;
                }

                else
                {
                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    $h_token = sha1($token);
                    $token2 = sha1($_COOKIE['SNID1']);
                    
                    $insert_c = "INSERT INTO login_token (token, user_id) VALUES ('$h_token','$userid')";
                    $run_c = mysqli_query($con, $insert_c);

                    $delete_customer = "DELETE FROM login_token WHERE token = '$token2'";
                    $run_delete = mysqli_query($con, $delete);

                    setcookie("SNID1", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE); 
                    setcookie("SNID1_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                    return $userid;
                }

            }
        
        }

        return false;
    }
 
}

?>