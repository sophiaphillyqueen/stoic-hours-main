<?php stoic_hour_page_start("Compline"); ?>


<?php
$yetgo = true;
if ( $yetgo ) { $yetgo = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,6,4,array()); }
if ( $yetgo ) { $yetgo = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,4,6,array('fixcycle'=>18)); }
?>

<?php
$yetgo = true;
if ( $yetgo ) { $yetgo = stoic_hour_cycle_res(realpath(__DIR__ . '/eoc-instruct.xml'),2017,4,20,array('chosen-in-ray'=>1)); }
?>

<?php stoic_hour_page_stop(); ?>
