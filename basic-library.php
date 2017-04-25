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

function stoic_hour_cycle_res_simple ( $resfile, $year, $month, $dayom )
{
  $cyclejulor = gregoriantojd($month,$dayom,$year);
  $jldate = $GLOBALS['jldate'];
  
  // No future cycles please
  if ( $cyclejulor > $jldate ) { return false; }
  
  $worked = 10;
  $xmlrs = simplexml_load_file($resfile) or $worked = 0;
  if ( $worked < 5 ) { return false; }
  
  $ressiz = count($xmlrs->item);
  if ( $ressiz < 0.5 ) { return false; }
  
  $jlelaps = (int)(($jldate - $cyclejulor) + 0.2);
  $jlcyst = ( $jlelaps % $ressiz );
  
  if ( the_stoic__xml_lacks_a($xmlrs,'title') ) { return false; }
  if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'title') ) { return false; }
  if ( the_stoic__xml_lacks_a($xmlrs->item[$jlcyst],'content') ) { return false; }
  
  echo "<h3>";
  echo the_stoic_in_xml($xmlrs->title);
  echo " -- ";
  echo the_stoic_in_xml($xmlrs->item[$jlcyst]->title) . "</h3>\n";
  
  
  $xmlcont = $xmlrs->item[$jlcyst]->content;
  foreach ( $xmlcont->children() as $xmlitem )
  {
    $xmltyp = $xmlitem->getName();
    if ( strcmp($xmltyp,'p') == 0 )
    {
      echo "<p>\n" . the_stoic_in_xml($xmlitem) . "\n<p/>\n";
    }
  }
  
  
  if ( the_stoic__xml_has_a($xmlrs,'credit') )
  {
    echo '<div class = "credit_section">';
    echo the_stoic_in_xml($xmlrs->credit);
    echo "</div>\n";
  }
  
  
  
  
  return true;
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