<?php 
  $dogs = json_decode(file_get_contents('dogs.json'));
  echo '<pre>';
  print_r($dogs);
  echo '</pre>';

  foreach($dogs as $dog)
  {
    $age = round($dog->age/12);

    if($dog->fur->sheds == true)
    {
       $sheds = 'that sheds';
    }

    else
    {
      $sheds = 'that does not shed.';
    }
    echo '<li>'.ucfirst($dog->name).' is a '.$age.' year old '.$dog->breed.' with '.$dog->fur->length.' '.$dog->fur->color.' fur '.$sheds.'</li>';
  }
  

?>