<?php
stoic_hour_page_start("Lauds");


$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,4,20,array()); }


$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/eoc-instruct.xml'),2017,4,20,array('chosen-in-ray'=>0)); }



$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_xres('poetry-main-cycle',2017,4,30,array('fixcycle'=>5)); }
if ( $yetgo ) { $yegto = stoic_hour_cycle_xres('poetry-main-cycle',2017,4,20,array('fixcycle'=>2)); }




stoic_hour_page_stop();
?>
