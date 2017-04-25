<?php

function tryfors ( $thefile )
{
  $dogood = 10;
  $thexml = simplexml_load_file($thefile) or $dogood = 0;
  if ( $dogood < 5 )
  {
    die("\nSomething went wrong with the file: " . $thefile . ":\n\n");
  }
  
  $numos = count($thexml->item);
  echo $thefile . ": " . $numos . ":\n";
}

?>