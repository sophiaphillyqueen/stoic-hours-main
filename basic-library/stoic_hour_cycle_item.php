<?php

require_once(realpath(__DIR__ . "/stoic_hour_poem_stansa.php"));

function stoic_hour_cycle_item ( $jelico, $thelevel )
{
  $title_levels = array(
    'item_title_level_00',
    'item_title_level_01',
    'item_title_level_02',
  );
  $frame_levels = array(
    'reading_part_frame_00',
    'reading_part_frame_01',
    'reading_part_frame_02',
  );
  $inframe_levels = array(
    'reading_part_inframe_00',
    'reading_part_inframe_01',
    'reading_part_inframe_02',
  );
  if ( the_stoic__xml_lacks_a($jelico,'content') ) { return; };
  
  
  echo "<div class = \"" . $frame_levels[$thelevel] . "\">\n";
  
  if ( the_stoic__xml_has_a($jelico,'title') )
  {
    echo "<div class = \"" . $title_levels[$thelevel] . "\">";
    echo the_stoic_in_xml($jelico->title);
    echo "</div>\n";
  }
  
  echo "<div class = \"" . $inframe_levels[$thelevel] . "\">\n";
  
  $xmlcont = $jelico->content;
  foreach ( $xmlcont->children() as $xmlitem )
  {
    $xmltyp = $xmlitem->getName();
    
    if ( strcmp($xmltyp,'p') == 0 )
    {
      echo "<p>\n" . the_stoic_in_xml($xmlitem) . "\n<p/>\n";
    }
    
    if ( strcmp($xmltyp,'instruct') == 0 )
    {
      echo "<div class = \"instruction_text\">\n" . the_stoic_in_xml($xmlitem) . "\n</div>\n";
    }
    
    if ( strcmp($xmltyp,'raw') == 0 )
    {
      echo "\n" . the_stoic_in_xml($xmlitem) . "\n";
    }
    
    if ( strcmp($xmltyp,'stn') == 0 )
    {
      stoic_hour_poem_stansa($xmlitem);
    }
    
    if ( strcmp($xmltyp,'sub') == 0 )
    {
      stoic_hour_cycle_item($xmlitem,((int)($thelevel + 1.2)));
    }
  }
  
  
  echo "</div>\n";
  
  
  if ( the_stoic__xml_has_a($jelico,'credit') )
  {
    echo '<div class = "credit_section">';
    echo the_stoic_in_xml($jelico->credit);
    echo "</div>\n";
  }
  
  
  echo "</div>\n";
  
}

?>