<?php

function stoic_has_ind_number ( $theobj, $thefld )
{
  $theval = $theobj[$thefld];
  if ( strcmp($theval,'0') == 0 ) { return true; }
  if ( strcmp($theval,'1') == 0 ) { return true; }
  if ( strcmp($theval,'2') == 0 ) { return true; }
  if ( strcmp($theval,'3') == 0 ) { return true; }
  return false;
}

?>