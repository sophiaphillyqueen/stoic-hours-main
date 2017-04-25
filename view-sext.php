<html><head>
<style>
<?php require(realpath(__DIR__ . "/style-main.php")); ?>
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stoic Sext: <?php echo big_date_form($jldate); ?></title>
</head><body>
<h1>Stoic Sext for <?php echo big_date_form($jldate); ?></h1>

<?php stoic_navigator_top(); ?>


<?php
$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/enchiridion.xml'),2017,4,15,array('fixcycle'=>18)); }
?>

<?php
$yetgo = true;
if ( $yetgo ) { $yegto = stoic_hour_cycle_res(realpath(__DIR__ . '/eoc-instruct.xml'),2017,4,20,array('chosen-in-ray'=>0)); }
?>

<?php stoic_navigator_bottom(); ?>

</body>
</html>
