<html><head>
<?php styling_info('index'); ?>
<title>Stoic Hours: <?php echo big_date_form($jldate); ?></title>
</head><body>

<?php

$jl_yester = (int)($jldate - 0.8);
$jl_tomorr = (int)($jldate + 1.2);

?>

<h1>Stoic Hours for <?php echo big_date_form($jldate); ?></h1>

<ul>

<li>
<?php
stoic_hours_link_win_new(array('jldate' => $jldate,'view' => 'lauds'));
?>
<b>Lauds</b> - Major Hour
<?php stoic_hours_link_end(); ?> (If you immerse in only one hour - it is recommended that it be this one.)
</li>

</ul>


<hr/>

<?php if ( $jldate > ( $jld_prima + 0.5 ) ) { ?>
Previous day: [<?php
stoic_hours_link_win_same(array('jldate' => $jl_yester));
echo big_date_form($jl_yester);
stoic_hours_link_end();
?>]
<br/>
<?php } ?>

<?php if ( $jldate < ( $jld_termi - 0.5 ) ) { ?>
<br/>
Next day: [<?php
stoic_hours_link_win_same(array('jldate' => $jl_tomorr));
echo big_date_form($jl_tomorr);
stoic_hours_link_end();
?>]
<?php } ?>


</body></html>