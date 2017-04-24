<html><head>
<style>
<?php require(realpath(__DIR__ . "/style-main.php")); ?>
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Stoic Lauds: <?php echo big_date_form($jldate); ?></title>
</head><body>
<h1>Stoic Lauds for <?php echo big_date_form($jldate); ?></h1>

<hr/>

<?php
stoic_hour_cycle_res_simple(realpath(__DIR__ . '/enchiridion.xml'),2017,4,20);
?>

<hr/>

</body>
</html>
