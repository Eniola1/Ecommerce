<?php 
include ('classes/DB.php');

    $search = "";

    if(isset($_POST['search']))
    {
        $gender = $_POST['phase1'];
        $class = $_POST['phase2'];

        if($class != 'all')
        {
            $paramsarray .= "array(':gender'=>$gender,";
            $search .= "DB::query('SELECT * FROM products WHERE gender=:gender"; 
        }

        elseif($class == 'all')
        {
            $paramsarray .= "array(";
            $search .= "DB::query('SELECT * FROM products WHERE";
        }

        elseif($class == 'materials')
        {
            $class2 = $_POST['phase3'];
            $class8 = $_POST['phase13'];
            $class9 = $_POST['phase14'];
            
            if($class8 == 'all' && $class9 != 'all')
            {
                $paramsarray .= " ':cat1'=>$class, ':cat2'=>$class2, ':cat9'=>$class9";
                $search .= " AND cat1=:cat1 AND cat2=:cat2 AND cat9=:cat9";
            }

            elseif($class8 != 'all' && $class9 == 'all')
            {
                $paramsarray .= " ':cat1'=>$class, ':cat2'=>$class2, ':cat8'=>$class8";
                $search .= " AND cat1=:cat1 AND cat2=:cat2 AND cat8=:cat8";
            }

            elseif($class8 != 'all' && $class9 != 'all')
            {
                $paramsarray .= " ':cat1'=>$class, ':cat2'=>$class2, ':cat8'=>$class8, ':cat9'=>$class9";
                $search .= " AND cat1=:cat1 AND cat2=:cat2 AND cat8=:cat8 AND cat9=:cat9";
            }

            elseif($class8 == 'all' && $class9 == 'all')
            {
                $paramsarray .= " ':cat1'=>$class, ':cat2'=>$class2";
                $search .= " AND cat1=:cat1 AND cat2=:cat2";
            }   
        }

        elseif($class == 'ready-made')
        {
            $class2 = $_POST['phase4'];

            if($class2 == 'clothing')
            {
                $class3 = $_POST['phase5'];
                $class4 = $_POST['phase5a'];
                $class5 = $_POST['phase9'];
                $class8 = $_POST['phase13'];
                $class9 = $_POST['phase14'];

                if($class3 != 'all' && $class4 == 'all')
                {
                    if(class5 == 'cultural')
                    {
                        $class6 = $_POST['phase10'];
                        
                        if(!isset($_POST['phase11']))
                        {
                            if($class6 == 'all')
                            {
                                if($class8 == 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat9'=>$class9";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat9=:cat9";
                                }

                                elseif($class8 != 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat8'=>$class8";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat8=:cat8";
                                }

                                elseif($class8 != 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat8'=>$class8, ':cat9'=>$class9";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat8=:cat8 AND cat9=:cat9";
                                }

                                elseif($class8 == 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5";
                                }
                            }
                        }
                        
                        else
                        {
                            $class7 = $_POST['phase11'];

                            if($class6 != 'all' && $class7 == 'all')
                            {
                                if($class8 == 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat9'=>$class9";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat9=:cat9";
                                }

                                elseif($class8 != 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat8'=>$class8";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat8=:cat8";
                                }

                                elseif($class8 != 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat8'=>$class8, ':cat9'=>$class9";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat8=:cat8 AND cat9=:cat9";
                                }

                                elseif($class8 == 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6";
                                }            
                            }

                            elseif($class6 != 'all' && $class7 != 'all')
                            {
                                if($class8 == 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat7'=>$class7, ':cat9'=>$class9"; 
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat7=:cat7 AND cat9=:cat9";
                                }

                                elseif($class8 != 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat7'=>$class7, ':cat8'=>$class8";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat7=:cat7 AND cat8=:cat8";
                                }

                                elseif($class8 != 'all' && $class9 != 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat7'=>$class7, ':cat8'=>$class8, ':cat9'=>$class9";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat7=:cat7 AND cat8=:cat8 AND cat9=:cat9";
                                }

                                elseif($class8 == 'all' && $class9 == 'all')
                                {
                                    $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat7'=>$class7";
                                    $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat7=:cat7";
                                }            
                            }
                        }
                    }

                    elseif(class5 == 'sports')
                    {
                        $class6 = $_POST['phase12'];
                        $class8 = $_POST['phase13'];
                        $class9 = $_POST['phase14'];
                        
                        if($class6 == 'all')
                        {
                            if($class8 == 'all' && $class9 != 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat9'=>$class9";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat9=:cat9";
                            }

                            elseif($class8 != 'all' && $class9 == 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat8'=>$class8";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat8=:cat8";
                            }

                            elseif($class8 != 'all' && $class9 != 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat8'=>$class8, ':cat9'=>$class9";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat8=:cat8 AND cat9=:cat9";
                            }

                            elseif($class8 == 'all' && $class9 == 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5";
                            }
                        }

                        else
                        {
                            if($class8 == 'all' && $class9 != 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat9'=>$class9";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat9=:cat9";
                            }

                            elseif($class8 != 'all' && $class9 == 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat8'=>$class8";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat8=:cat8";
                            }

                            elseif($class8 != 'all' && $class9 != 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6, ':cat8'=>$class8, ':cat9'=>$class9";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6 AND cat8=:cat8 AND cat9=:cat9";
                            }

                            elseif($class8 == 'all' && $class9 == 'all')
                            {
                                $paramsarray .= " ':cat3'=>$class3, ':cat5'=>$class5, ':cat6'=>$class6";
                                $search .= " AND cat3=:cat3 AND cat5=:cat5 AND cat6=:cat6";
                            }
                        }
                    }
                }
            }

            elseif($class2 == 'accessories')
            {
                $class3 = $_POST['phase6'];
                $class8 = $_POST['phase13'];
                $class9 = $_POST['phase14'];

                if($class3 == 'all')
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2";
                        $search .= " AND cat2=:cat2";
                    }
                }

                else
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3";
                        $search .= " AND cat3=:cat3";
                    }
                }   
            }

            elseif($class2 == 'products')
            {
                $class3 = $_POST['phase7'];
                $class8 = $_POST['phase13'];
                $class9 = $_POST['phase14'];

                if($class3 == 'all')
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2";
                        $search .= " AND cat2=:cat2";
                    }
                }

                else
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3";
                        $search .= " AND cat3=:cat3";
                    }
                }    
            }

            elseif($class2 == 'equipments')
            {
                $class3 = $_POST['phase8'];
                $class8 = $_POST['phase13'];
                $class9 = $_POST['phase14'];
                
                if($class3 == 'all')
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat2=:cat2 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat2'=>$class2";
                        $search .= " AND cat2=:cat2";
                    }
                }

                else
                {
                    if($class8 == 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat9=:cat9";
                    }

                    elseif($class8 != 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8";
                    }

                    elseif($class8 != 'all' && $class9 != 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3, ':cat8'=>$class8, ':cat9'=>$class9";
                        $search .= " AND cat3=:cat3 AND cat8=:cat8 AND cat9=:cat9";
                    }

                    elseif($class8 == 'all' && $class9 == 'all')
                    {
                        $paramsarray .= " ':cat3'=>$class3";
                        $search .= " AND cat3=:cat3";
                    }
                }    
            }
            
            $search .= "',$paramsarray))";
        }
    
    }
    
?>

<h1>Login to your account</h1>
<form  action = "login.php" method = "post">
<div>
<select name = "phase1">  
    <option id = "phases1">male</option>
    <option id = "phases1">female</option>
    <option id = "phase1" selected>all</option>
</select> <p />
</div>

<div>
<select name = "phase2" id = "sel2">  
    <option id = "phases2a">materials</option>
    <option id = "phases2b">ready-made</option>
    <option id = "phase2" selected>all</option>
</select> <p />
</div>

<div id = "phs3" class = "hiddentext" style = "display:none;">
<select name = "phase3" id = "sel3">  
    <option  id = "phases3a">nylon</option>
    <option  id = "phases3b">polyester</option>
    <option  id = "phases3c">cotton</option>
    <option  id = "phases3d">wool</option>
    <option  id = "phases3e">Adire</option>
    <option  id = "phase3" selected>all</option>
</select> <p />
</div>

<div id = "phs4" class = "hiddentext" style = "display:none;">
<select name = "phase4" id = "sel4">  
    <option id = "phases4a">clothing</option>
    <option id = "phases4b">accessories</option>
    <option id = "phases4c">products</option>
    <option id = "phases4d">equipment</option>
    <<option  id = "phase4" selected>all</option>
</select> <p />
</div>

<div id = "phs5" class = "hiddentext" style = "display:none;">
<select name = "phase5" id = "sel5">  
    <option id = "phases5a">shirt</option>
    <option id = "phases5b">t-shirts</option>
    <option id = "phases5c">shorts</option>
    <option id = "phases5d">trousers</option>
    <option id = "phases5e">jackets</option>
    <option id = "phases5f">underwear</option>
    <option id = "phase5" selected>all</option>
</select> <p />
</div>

<div id = "phs5a" class = "hiddentext" style = "display:none;">
<select name = "phase5a" id = "sel5a">  
    <option  id = "phases3a">nylon</option>
    <option  id = "phases3b">polyester</option>
    <option  id = "phases3c">cotton</option>
    <option  id = "phases3d">wool</option>
    <option  id = "phases3e">Adire</option>
    <option  id = "phase3" selected>all</option>
</select> <p />
</div>

<div id = "phs6" class = "hiddentext" style = "display:none;">
<select name = "phase6" id = "sel6">  
    <option id = "phases6a">shoes</option>
    <option id = "phases6b">watches</option>
    <option id = "phases6c">belts</option>
    <option id = "phases6d">bags</option>
    <option id = "phases6e">beads</option>
    <option id = "phase6" selected>all</option>
</select> <p />
</div>

<div id = "phs7" class = "hiddentext" style = "display:none;">
<select name = "phase7" id = "sel7">  
    <option id = "phases7a">facials</option>
    <option id = "phases7b">perfumes</option>
    <option id = "phases7c">oils</option>
    <option id = "phase7" selected>all</option>
</select> <p />
</div>

<div id = "phs8" class = "hiddentext" style = "display:none;">
<select name = "phase8" id = "sel8">  
    <option id = "phases8a">hair</option>
    <option id = "phases8b">face</option>
    <option id = "phases8c">nails</option>
    <option id = "phase8" selected>all</option>
</select> <p />
</div>

<div id = "phs9" class = "hiddentext" style = "display:none;">
<select name = "phase9a" id = "sel9">  
    <option id = "phases9b">coperate</option>
    <option id = "phases9c">casual</option>
    <option id = "phases9d">cultural</option>
    <option id = "phases9e">party</option>
    <option id = "phases9f">beach</option>
    <option id = "phases9g">sports</option>
    <option id = "phase9" selected>all</option>
</select> <p />
</div>

<div id = "phs10" class = "hiddentext" style = "display:none;">
<select name = "phase10" id = "sel10">  
    <option id = "phases10a">African</option>
    <option id = "phases10b">Europe</option>
    <option id = "phases10c">Asian</option>
    <option id = "phases10d">Americas</option>
    <option id = "phases10e">Australia</option>
    <option id = "phase10" selected>all</option>
</select> <p />
</div>

<div id = "phs11" class = "hiddentext" style = "display:none;">
<select name = "phase11" id = "sel11">  
    <option id = "phases11a">Nigeria</option>
    <option id = "phases11b">Kenya</option>
    <option id = "phases11c">Ghana</option>
    <option id = "phases11d">Mozambique</option>
    <option id = "phases11e">Botswana</option>
    <option id = "phase11" selected>all</option>
</select> <p />
</div>

<div id = "phs12" class = "hiddentext" style = "display:none;">
<select name = "phase12" id = "sel12">  
    <option id = "phases12a">football</option>
    <option id = "phases12b">basketball</option>
    <option id = "phases12c">boxing</option>
    <option id = "phases12d">swimming</option>
    <option id = "phases12e">hockey</option>
    <option id = "phases12f">rugby</option>
    <option id = "phase12" selected>all</option>
</select> <p />
</div>

<div id = "phs13" class = "hiddentext" style = "display:none;">
<select name = "phase13" id = "sel13">  
    <option id = "phases13a">Adidas</option>
    <option id = "phases13b">Nike</option>
    <option id = "phases13c">Tommy hilfiger</option>
    <option id = "phases13d">Polo</option>
    <option id = "phases13e">Puma</option>
    <option id = "phases13f">Raphl lauren</option>
    <option id = "phase13" selected>all</option>
</select> <p />
</div>

<div id = "phs14" class = "hiddentext" style = "display:none;">
<select name = "phase14" id = "sel14">  
    <option id = "phases14a">Vintage</option>
    <option id = "phases14b">Modern</option>
    <option id = "phase14c" selected>all</option>
</select> <p />
</div>

<input type = "submit" name = "search" value = "Search"> 
</form>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
   
    $('#sel2').change(function() {
        if($(this).val() == "materials")
        {
            $('#phs3').prop("class", "");
            $('#phs3').prop("style", "");

            for(let i = 4; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
                $('#phs5a').prop("style", "display:none");
            }    
        }
    });

    $('#sel2').change(function() {
        if($(this).val() == "ready-made")
        {
            $('#phs3').prop("class", "hiddentext");
            $('#phs3').prop("style", "display:none");
            $('#phs4').prop("class", "");
            $('#phs4').prop("style", "");    

            for(let i = 5; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }
        }
    });

    $('#sel2').change(function() {
        if($(this).val() == "all")
        {
            for(let i = 3; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }
        }
    });

    $('#sel4').change(function() {
        if($(this).val() == "clothing")
        {   
            $('#phs5').prop("class", "");
            $('#phs5').prop("style", "");

            $('#phs5a').prop("class", "");
            $('#phs5a').prop("style", "");
            
            $('#phs9').prop("class", "");
            $('#phs9').prop("style", "");
        
            for(let i = 6; i < 9; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            for(let i = 11; i <= 12; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }    

            for(let i = 13; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }
        }
    });

    $('#sel4').change(function() {
        if($(this).val() == "accessories")
        {
            $('#phs5').prop("class", "hiddentext");
            $('#phs5').prop("style", "display:none");
            $('#phs6').prop("class", "");
            $('#phs6').prop("style", "");    

            for(let i = 7; i < 9; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            $('#phs9').prop("class", "");
            $('#phs9').prop("style", "");
            
            for(let i = 11; i <= 12; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            for(let i = 13; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }    
        }
    });

    $('#sel4').change(function() {
        if($(this).val() == "products")
        {
            for(let i = 5; i <= 6; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            $('#phs7').prop("class", "");
            $('#phs7').prop("style", "");    

            $('#phs8').prop("class", "hiddentext");
            $('#phs8').prop("style", "display:none");            

            $('#phs9').prop("class", "");
            $('#phs9').prop("style", "");
            
            for(let i = 11; i <= 12; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            } 

            for(let i = 13; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }   
        }
    });

    $('#sel4').change(function() {
        if($(this).val() == "equipments")
        {
            for(let i = 5; i <= 7; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            $('#phs8').prop("class", "");
            $('#phs8').prop("style", "");    

            $('#phs9').prop("class", "");
            $('#phs9').prop("style", "");
            
            for(let i = 11; i <= 12; i++)
            {
                $('#phs'+i).prop("class", "hiddentext");
                $('#phs'+i).prop("style", "display:none");
            }

            for(let i = 13; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }    
        }
    });

    $('#sel9').change(function() {
        if($(this).val() == "cultural")
        {
            $('#phs10').prop("class", "");
            $('#phs10').prop("style", "");       
        }
    });

    $('#sel9').change(function() {
        if($(this).val() == "sports")
        {
            for(let i = 12; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }      
        }
    });

    $('#sel10').change(function() {
        if($(this).val() == "African")
        {
            $('#phs11').prop("class", "");
            $('#phs11').prop("style", "");

            $('#phs12').prop("class", "hiddentext");
            $('#phs12').prop("style", "display:none");

            for(let i = 13; i <= 14; i++)
            {
                $('#phs'+i).prop("class", "");
                $('#phs'+i).prop("style", "");
            }       
        }
    });

</script>
 