<?php

// This is a copy of the bootstrap file used for the official site of these
// Stoic Hours. To put together your own bootstrap file, copy this to your
// web-site and customize all the variables to what they should be on your
// site. Then, from time to time, check this sample bootstrap file to see
// if there is anything that needs to be added (as later versions of the
// program may require site-specific information that can't be yet in this
// version of the bootstrap file).

// What is a bootstrap file? It is the PHP script that is directly invoked
// by the web-server. It first sets all site-custom variables that the
// program needs to know -- and then it invokes the program by using PHP's
// 'require' statement on the 'main_reference.php' in the program's
// directory

// Do NOT edit the provided copy of this file. Copy it to your
// own public web directory and change it _there_.

// Also - your live bootstrap file should NOT be inside this program's
// directory. As a matter of fact -- if at all possible, your live
// bootstrap file should be the only thing within the Public HTML of
// our site, and the program should be located somewhere that the
// web-server will only access it via the bootstrap file.

// ------------------ //
// --  HERE WE GO  -- //
// ------------------ //

// This is the URL from which this bootstrap file can be accessed from the web.
// Customize it to the web-address of wherever you put your bootstrap script.
$url_of_bootstrap = "http://hours.virtualstoa.org/";


$max_backward = 3;  // How many days backward you allow people to view the Hours.
$max_forward = 6;   // How many days forward you allow people to view the Hours.


// This next array is an associative array to locate on your server
// cycle-resource XML files that are, for one reason or another, not
// included in the actual distribution of the Stoic Hours program.
$external_cycle_xml = array(

  // Unfortunately, the poetry file is not currently contained within
  // the distribution. Eventually, it may be made available separately.
  'poetry-main-cycle' => '../../../hidden/res/stoic-poetry/main-cycle.xml',
);


// This next array is an associative array defining default values of
// various form-fields assuming that they are not provided. This array
// needs to be here - but unless you are conducting some weird tests,
// it must remain empty as it currently is.
$over_dfl_val = array();


// Now - having 
require "../../../hidden/res/stoic-hours-main/main_reference.php";

?>