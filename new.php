<?php 

$np = ceil(1000000 /2);

$top = explode(" ", $np);

foreach ($top as $word) {
$fp = substr($word, 0, 1);
echo $fp;
}

?>