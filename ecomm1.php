<?php 
include ('./classes/DB.php');

if(isset($_POST['query']))
{
    $inpText = $_POST['query'];
    $text = explode(" ", $inpText);
    $topic = "";

    foreach($text as $word)
    {
        if(substr($word, 0, 1) == "#")
        {   
            $topic = substr($word, 1);
            $paramsarray = array(':val'=>'%'.$topic.'%');
            $results = DB::query('SELECT * FROM topic_wall WHERE topic LIKE :val', $paramsarray);

            if(DB::query('SELECT * FROM topic_wall WHERE topic LIKE :val', $paramsarray))
            {
                foreach($results as $result)
                {   
                    echo "<a href='topics.php?topic=".htmlspecialchars($result['topic'])."' id = 'list_item'> #".htmlspecialchars($result['topic'])."</a>";
                    echo '<br />'; 
                    echo '<hr />';    
                }
            }

            else
            {
                echo "<p id='none'> No record </p>";
            }
        }
        
        else
        {
            $paramsarray = array(':val'=>'%'.$inpText.'%');
            $results = DB::query('SELECT * FROM users WHERE username LIKE :val', $paramsarray);

            if(DB::query('SELECT * FROM users WHERE username LIKE :val', $paramsarray))
            {
                foreach($results as $result)
                {
                    echo "<a href='profile.php?username=".htmlspecialchars($result['username'])."'>".htmlspecialchars($result['username'])."</a>";
                    echo '<hr />';
                    //remember to add surname and firstname to the user database, so as to get the info and add here directly under the username and profile picture of user.
                }
            }

            else
            {
                echo "<p id='none'> No record </p>";
            }

        }

    }
           
}

?>