<?php

require_once(realpath(__DIR__ . "/basic-library.php"));

$jldanchor = unixtojd(time());
$jld_prima = (int)(($jldanchor - $max_backward) + 0.2);
$jld_termi = (int)(($jldanchor + $max_forward) + 0.2);

// Find Julian day-count - defaulting to today.
$jldate = obtain_of_qry('jldate','x');
$rawjldate = $jldate;
if ( strcmp($rawjldate,'x') == 0 ) { $jldate = $jldanchor; }

// START TO MAKE SURE IT'S NOT OUT OF BOUNDS

if ( $jldate < ( $jld_prima - 2.5 ) )
{ ?>
<html><body><h1>WE DO NOT GO THAT FAR BACK</h1></body></html>
<?php exit(0); }

if ( $jldate > ( $jld_termi + 2.5 ) )
{ ?>
<html><body><h1>WE DO NOT GO THAT FAR BACK</h1></body></html>
<?php exit(0); }

// END OF MAKE SURE IT'S NOT OUT OF BOUNDS

// Get ID code of the page-within-day
$pgvidc = obtain_of_mcqry('view','index',array
  ('lauds','terce','sext','none','vespers','compline')
);

// Any additional preparations before we go to the page-specific view:
require(realpath(__DIR__ . "/before-we-go.php"));

// And now ... to the page-specific view
require(realpath(__DIR__ . "/view-" . $pgvidc . ".php"));

?>