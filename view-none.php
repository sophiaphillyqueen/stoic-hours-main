<?php stoic_hour_page_start("None"); ?>


<?php
$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,5,14,array()); }
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,4,12,array('fixcycle'=>18)); }
?>

<?php
$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/eoc-instruct.xml'),2017,4,20,array('chosen-in-ray'=>0)); }
?>

<?php stoic_hour_page_stop(); ?>
