<?php 
function getUsername()
{
    $username = "";
    $verified = False;
    $isFollowing = False;
    $posts = "";

    if(isset($_GET['username']))
    {    
        global $con;

        $username = $_GET['username'];

        $userid = "SELECT customer_id FROM customers WHERE customer_name = '$username'"; 
        
        $run_userd = mysqli_query($con, $userid);
        
        $verified = "SELECT * FROM customers WHERE customer_name = '$username'";
        
        $run_ver =  mysqli_query($con, $verified);

        while($rowv = mysqli_fetch_array($run_ver))
        {
            $get_ver = $rowv['verified'];
        }
            
        if(isset($_SESSION['customer_email']))
        {
            $s_mail = $_SESSION['customer_email'];

            $get_foll = "SELECT * FROM customers WHERE customer_email = '$s_mail'";
    
            $run_get = mysqli_query($con, $get_foll);

            while($row = mysqli_fetch_array($run_get))
            {
                $followerid = $row['customer_id'];
            }

            if(isset($_POST['follow']))
            {
                if($userid != $followerid)
                {
                    $check_fol = "SELECT * FROM followers_c WHERE user_id = '$userid' AND follower_id = '$followerid'";
                    
                    $run_check = mysqli_query($con, $check_fol);
                    
                    $num_run = mysqli_num_rows($run_check);

                    if($num_run == 0)
                    {
                        if($followerid == 43) //When flushig database, always remember to leave the verified user out.
                        {
                            $up_cus = "UPDATE customers SET verified=1 WHERE customer_id = $userid'";
                            
                            $run_up = mysqli_query($con, $up_cus);
                        }
                        
                        $ins_fol = "INSERT INTO followers_c(user_id, follower_id) VALUES ('$userid', '$followerid')";
                        
                        $run_ins = mysqli_query($con, $ins_fol);
                    }
        
                    else
                    {
                        echo 'Already following!';
                    }

                    $isFollowing = True;
                }            
            }

            if(isset($_POST['unfollow']))
            {
                if($userid != $followerid)
                {
                    $check_fol = "SELECT * FROM followers_c WHERE user_id = '$userid' AND follower_id = '$followerid'";
                    
                    $run_check = mysqli_query($con, $check_fol);
                    
                    $num_run = mysqli_num_rows($run_check);

                    if($num_run > 0)
                    {
                        if($followerid == 43) //When flushig database, always remember to leave the verified user out.
                        {
                            $up_cus = "UPDATE customers SET verified=1 WHERE customer_id = $userid'";
                            
                            $run_up = mysqli_query($con, $up_cus);
                        }
                        
                        $del_fol = "DELETE FROM followers_c WHERE user_id = '$userid' AND follower_id = '$followerid'";
                        
                        $run_del = mysqli_query($con, $del_fol);
                    }
                            
                    $isFollowing = False;     
                }

            }

        }

        else
        {
            if(isset($_POST['follow']))
            {
                echo "<script>window.open('customer_login.php', '_self')</script>";            
            }

            elseif(isset($_POST['unfollow']))
            {
                echo "<script>window.open('customer_login.php', '_self')</script>";
            }
        }

        $get_pro = "SELECT * FROM products WHERE vendor = '$username'";
        
        $run_gt = mysqli_query($con, $get_pro);
        
        while($row = mysqli_fetch_array($run_gt))
        {
            $pro_vendor = $row['vendor'];  //remember to put vendor's part in product.              
            $pro_id = $row['product_id'];                   
            $pro_cat = $row['product_cat'];                    
            $pro_brand = $row['product_brand'];                    
            $pro_title = $row['product_title'];                    
            $pro_price = $row['product_price'];                   
            $pro_image = $row['product_image'];
        }

        if($get_ver == 0)
        {
            echo "<h2 style = 'font-family:calibri; font-size: 13px; color:white'>$username's Profile</h2>";
        }

        elseif($get_ver == 1)
        {
            echo "<h2 style = 'font-family:calibri; font-size: 20px; color:white'>$username's Profile - Verified</h2>"; 
        }
        
        $posts .= "<form action = 'index.php?username=$username' method = 'post'> ";
        
        if(isset($_SESSION['customer_email']))
        {
            if($userid != $followerid)
            {
                if($isFollowing)
                {
                    $posts .= "<input type = 'submit' name = 'unfollow' value='Unfollow'>"; 
                    
                }
                else
                {
                    $posts .= "<input type = 'submit' name = 'follow' value='Follow'>
                    </form>";                    
                }
            }
        }

        else
        {
            $posts .= "<input type = 'submit' name = 'follow' value='Follow'>";
        }

        echo $posts;

        $get_cat_pro = "select * from products where vendor = '$username'";

        $run_cat_pro = mysqli_query($con, $get_cat_pro);

        $count_cats = mysqli_num_rows($run_cat_pro);

        if($count_cats==0)
        {    
            echo  "<h2 style = 'font-family:calibri; font-size: 23px; color:white'>This Vendor currently has no product! </h2>";
        }

        while($row_cat_pro = mysqli_fetch_array($run_cat_pro))
        {                  
            $pro_id = $row_cat_pro['product_id'];
            $pro_cat = $row_cat_pro['product_cat'];
            $pro_brand = $row_cat_pro['product_brand'];
            $pro_title = $row_cat_pro['product_title'];
            $pro_price = $row_cat_pro['product_price'];
            $pro_image = $row_cat_pro['product_image'];
            

            echo "
                
            <div class='single_product' id='item$pro_id'>

            <h3 style = 'color:white; font-family: calibri; font-size: 22px;' >$pro_title</h3>
                    
            <img src = 'admin_area/product_images/$pro_image' width = '180' height = '180'  style = 'border: 2px solid gray;'/>

            <p style = 'color: white;' font-family: calibri; font-size:22px;'><b> $$pro_price </b></p>
            
            <form action='' method='post'>
            <a href='details.php?pro_id=$pro_id' style = 'float:left; font-family:calibri;'>Details</a>
            <input type='button' style = 'float:right; font-family:calibri;' value='Add to cart' onclick=cart('item$pro_id')>
            <input type='hidden' id='item$pro_id"."_name' value='$pro_title'>
            <input type='hidden' id='item$pro_id"."_price' value='$pro_price'>
            <input type='hidden' id='item$pro_id"."_id' value='$pro_id'>
            </form>
                
            </div>
            
            ";
        }

    }   
    
}  
?>