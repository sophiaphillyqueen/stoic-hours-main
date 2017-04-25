<?php

$full_month_name = array('x'
  ,'January','February','March'
  ,'April','May','June'
  ,'July','August','September'
  ,'October','November','December'
);

$full_dayow_name = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');


function styling_info ( $styleid )
{
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
  
  echo "<style>\n";
  require(realpath(__DIR__ . '/style-' . $styleid . '.php'));
  echo "\n</style>\n";
}


function obtain_of_qry($varnom,$dflt)
{
  if ( array_key_exists($varnom,$_REQUEST) )
  {
    return($_REQUEST[$varnom]);
  }
  $over_dfl_val = $GLOBALS['over_dfl_val'];
  if ( array_key_exists($varnom,$over_dfl_val) )
  {
    return($over_dfl_val[$varnom]);
  }
  return $dflt;
}

function obtain_of_mcqry($varnom,$dflt,$others)
{
  $given = obtain_of_qry($varnom,$dflt);
  
  foreach ( $others as $othero )
  {
    if ( strcmp($given,$othero) == 0 ) { return $othero; }
  }
  
  // If none of the other multiple-choice options was retrieved,
  // the default is returned.
  return $dflt;
}

function big_date_form($jldt)
{
  $full_dayow_name = $GLOBALS['full_dayow_name'];
  $full_month_name = $GLOBALS['full_month_name'];
  
  $reta = $full_dayow_name[jddayofweek($jldt)];
  $reta .= ', ';
  
  $datery = explode('/',jdtogregorian($jldt));
  $month_int = (int)($datery[0]);
  $reta .= $full_month_name[$month_int];
  $reta .= ' ' . ((int)($datery[1])) . ', ' . $datery[2];
  
  return $reta;
}

function url_with_query ( $theurl, $theqry )
{
  $reto = $theurl;
  $seper = '?';
  
  foreach ( $theqry as $nom => $val )
  {
    $reto .= $seper . urlencode($nom) . '=' . urlencode($val);
    $seper = '&';
  }
  
  return $reto;
}

function pass_to_page ( $theqry )
{
  return url_with_query($GLOBALS['url_of_bootstrap'], $theqry);
}

function the_stoic__xml_lacks_a ( $therange, $thetarg )
{
  return( count($therange->$thetarg) < 0.5 );
}

function the_stoic__xml_has_a ( $therange, $thetarg )
{
  return( count($therange->$thetarg) > 0.5 );
}

function the_stoic__xml_count_a ( $therange, $thetarg )
{
  return( count($therange->$thetarg) );
}

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
  if ( $jlcyst > ( $ressiz - 0.5 ) ) { return true; }
  
  if ( the_stoic__xml_lacks_a($xmlrs,'title') ) { return true; }
  //if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'title') ) { return true; }
  if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'content') ) { return true; }
  
  ?><div class = "reading_part_frame"><?php
  
  echo "<h3>";
  echo the_stoic_in_xml($xmlrs->title);
  if ( the_stoic__xml_has_a($xmlrs->item[$jlcyst],'title') )
  {
    echo " -- ";
    echo the_stoic_in_xml($xmlrs->item[$jlcyst]->title);
  }
  echo "</h3>\n";
  
  $xmlcont = $xmlrs->item[$jlcyst]->content;
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
  }
  
  
  if ( the_stoic__xml_has_a($xmlrs,'credit') )
  {
    echo '<div class = "credit_section">';
    echo the_stoic_in_xml($xmlrs->credit);
    echo "</div>\n";
  }
  
  ?></div><?php
  
  
  return false;
}


function return_to_index_view ( )
{
  $jldate = $GLOBALS['jldate'];
  echo "\n<hr/>\n";
  stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'index'));
  echo "Return to This Day's Index";
  stoic_hours_link_end();
  echo "\n<hr/>\n";
}

function stoic_navigator_top ( )
{
  return_to_index_view();
}

function stoic_navigator_bottom ( )
{
  return_to_index_view();
}



function the_stoic_in_xml ( $xmlsrc )
{
  $retval = '';
  $fulldomxml = dom_import_simplexml($xmlsrc);
  $fulldomdoc = $fulldomxml->ownerDocument;
  
  foreach ( $fulldomxml->childNodes as $eachone )
  {
    $retval .= $fulldomdoc->saveXML($eachone);
  }
  
  return $retval;
}


function stoic_hours_link_win_same ( $theqry )
{
  echo('<a href = "' . pass_to_page($theqry) . '">');
}

function stoic_hours_link_win_new ( $theqry )
{
  echo('<a href = "' . pass_to_page($theqry) . '" target = "_blank">');
}

function stoic_hours_link_end ( )
{
  echo('</a>');
}




?>