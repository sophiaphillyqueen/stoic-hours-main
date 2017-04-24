<html><head>
<title>Stoic Lauds: <?php echo big_date_form($jldate); ?></title>
</head><body>
<h1>Stoic Lauds for <?php echo big_date_form($jldate); ?></h1>

<hr/>

<?php
stoic_hour_cycle_res_simple(relpath(__DIR__ . '/enchiridion.xml'),2017,4,20);
);
?>

<hr/>

</body>
</html>
