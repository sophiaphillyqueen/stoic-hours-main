<?php

$full_month_name = array('x'
  ,'January','February','March'
  ,'April','May','June'
  ,'July','August','September'
  ,'October','November','December'
);

$full_dayow_name = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');


function obtain_of_qry($varnom,$dflt)
{
  if ( array_key_exists($varnom,$_REQUEST) )
  {
    return($_REQUEST[$varnom]);
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