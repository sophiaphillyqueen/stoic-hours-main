<?php

require_once(realpath(__DIR__ . "/basic-library.php"));

// Find Julian day-count - defaulting to today.
$jldate = obtain_of_qry('jldate',unixtojd(time()));

// Get ID code of the page-within-day
$pgvidc = obtain_of_mcqry('view','index',array
  ('lauds','terce','sext','none','vespers','compline')
);

// Any additional preparations before we go to the page-specific view:
require(realpath(__DIR__ . "/before-we-go.php"));

// And now ... to the page-specific view
require(realpath(__DIR__ . "/view-" . $pgvidc . ".php"));

?>