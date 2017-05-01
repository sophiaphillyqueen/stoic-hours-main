<?php

require_once(__DIR__ . "/stoic_has_ind_number.php");

function stoic_hour_poem_stansa ( $stansres )
{
  $ind_default = 0;
  
  if ( stoic_has_ind_number($stansres,'dfl') ) { $ind_default = ((int)($stansres['dfl'] + 0.2)); }
  
  $line_types = array(
    'poem_line_00_ind',
    'poem_line_01_ind',
    'poem_line_02_ind',
    'poem_line_03_ind',
    'poem_line_04_ind',
    'poem_line_05_ind',
  );
  echo "<div class = \"poem_stansa\">\n";
  
  foreach ( $stansres->children() as $substn )
  {
    $substyp = $substn->getName();
    if ( strcmp($substyp,'l') == 0 )
    {
      $indlev = $ind_default;
      if ( stoic_has_ind_number($substn,'ind') )
      {
        $indlev = (int)($substn['ind']);
      }
      echo "<div class = \"" . $line_types[$indlev] . "\">";
      echo the_stoic_in_xml($substn);
      echo "</div>\n";
    }
  }
  
  
  
  echo "</div>\n";
}



?>