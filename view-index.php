<html><head>
<?php styling_info('index'); ?>
<title>Stoic Hours: <?php echo big_date_form($jldate); ?></title>
</head><body>

<?php

$jl_yester = (int)($jldate - 0.8);
$jl_tomorr = (int)($jldate + 1.2);

?>

<h1>Stoic Hours for <?php echo big_date_form($jldate); ?></h1>

<p>
What is here is not much --- but remember that it is a work-in-progress, and what
it has to offer will increase.
</p>

<ul>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'lauds'));
?>
<b>Lauds</b> - Major Hour
<?php stoic_hours_link_end(); ?> (If you immerse in only one hour - it is recommended that it be this one.)
</div>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'terce'));
?>
<b>Terce</b>
<?php stoic_hours_link_end(); ?>
</div>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'sext'));
?>
<b>Sext</b> - Major Hour
<?php stoic_hours_link_end(); ?>
</div>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'none'));
?>
<b>None</b>
<?php stoic_hours_link_end(); ?>
</div>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'vespers'));
?>
<b>Vespers</b> - Major Hour
<?php stoic_hours_link_end(); ?>
</div>

<div class = "hour_section">
<?php
stoic_hours_link_win_same(array('jldate' => $jldate,'view' => 'compline'));
?>
<b>Compline</b>
<?php stoic_hours_link_end(); ?>
</div>

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