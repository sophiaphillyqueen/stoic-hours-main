<?php

require_once(realpath(__DIR__ . "/basic-library/stoic_hour_cycle_res.php"));

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
  
  // The open-close tags of the STYLE element are now to be located WITHIN the
  // style-PHP page --- so that text-editors will recognize the CSS content
  // as CSS code.
  echo "\n";
  require(realpath(__DIR__ . '/style-' . $styleid . '.php'));
  echo "\n";
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

function stoic_hour_cycle_xres ( $resname, $year, $month, $dayom, $extra )
{
  $external_cycle_xml = $GLOBALS['external_cycle_xml'];
  if ( !array_key_exists($resname,$external_cycle_xml) ) { return true; }
  $resfile = $external_cycle_xml[$resname];
  return stoic_hour_cycle_res($resfile,$year,$month,$dayom,$extra);
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


function stoic_hour_page_start ( $hourname )
{
  $jldate = $GLOBALS['jldate'];
  ?>
<html><head>
<?php require(realpath(__DIR__ . "/style-main.php")); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'Stoic ' . $hourname . ': ' . big_date_form($jldate); ?></title>
</head><body>
<h1><?php echo 'Stoic ' . $hourname . ' for ' . big_date_form($jldate); ?></h1>
  <?php
  stoic_navigator_top();
}

function stoic_hour_page_stop ( )
{
  stoic_navigator_bottom();
  echo "\n</body>\n</html>\n";
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