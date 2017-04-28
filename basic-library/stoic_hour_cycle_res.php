<?php

require_once(realpath(__DIR__ . "/stoic_hour_cycle_item.php"));

function stoic_hour_cycle_res ( $resfile, $year, $month, $dayom, $extra )
{
  // Why do I have it return 'true' when it fails and 'false' when it
  // succeeds? Because, the only thing that I foresee the calling program
  // doing with this return value is determining whether to call an
  // alternative.
  
  $cyclejulor = gregoriantojd($month,$dayom,$year);
  $jldate = $GLOBALS['jldate'];
  
  // No future cycles please
  if ( $cyclejulor > ( $jldate + 0.5 ) ) { return true; }
  
  $worked = 10;
  $xmlrs = simplexml_load_file($resfile) or $worked = 0;
  if ( $worked < 5 ) { return true; }
  
  // The default cycle duration is none other than the
  // length of the resource.
  $ressiz = count($xmlrs->item);
  if ( $ressiz < 0.5 ) { return true; }
  $cyclesize = $ressiz;
  
  // The default cycle duration can be over-ridden by the 'fixcycle' option.
  if ( array_key_exists('fixcycle',$extra) ) { $cyclesize = $extra['fixcycle']; }
  
  $jlelaps = (int)(($jldate - $cyclejulor) + 0.2);
  $jlcyst = ( $jlelaps % $cyclesize );
  if ( array_key_exists('chosen-in-ray',$extra) ) { $jlcyst = $extra['chosen-in-ray']; }
  if ( array_key_exists('chosen-back-ray',$extra) )
  {
    $jlcyst = (int)(($cyclesize - $extra['chosen-back-ray']) + 0.2);
    if ( $jlcyst < 0.5 ) { return true; }
    $jlcyst = (int)($jlcyst - 0.8);
  }
  if ( $jlcyst > ( $ressiz - 0.5 ) ) { return true; }
  
  //if ( the_stoic__xml_lacks_a($xmlrs,'title') ) { return true; }
  //if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'title') ) { return true; }
  if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'content') ) { return true; }
  
  
  ?><div class = "reading_part_frame"><?php
  
  //echo "<h3>";
  //echo the_stoic_in_xml($xmlrs->title);
  //if ( the_stoic__xml_has_a($xmlrs->item[$jlcyst],'title') )
  //{
  //  echo " -- ";
  //  echo the_stoic_in_xml($xmlrs->item[$jlcyst]->title);
  //}
  //echo "</h3>\n";
  
  if ( the_stoic__xml_has_a($xmlrs,'title') )
  {
    echo "<div class = \"big_section_title\">";
    echo the_stoic_in_xml($xmlrs->title);
    echo "</div>\n";
  }
  
  
  stoic_hour_cycle_item($xmlrs->item[$jlcyst],0);
  
  
  if ( the_stoic__xml_has_a($xmlrs,'credit') )
  {
    echo '<div class = "credit_section">';
    echo the_stoic_in_xml($xmlrs->credit);
    echo "</div>\n";
  }
  
  ?></div><?php
  
  
  return false;
}

?>
