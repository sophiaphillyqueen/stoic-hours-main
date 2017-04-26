# stoic-hours-main
Main module for Stoic Hours

## On Installation
This program is written with the intent that it will be located _outside_ of
the Public HTML directory-tree.
Instead of putting this program _itself_ in the Public HTML directory-tree,
put instead a Bootstrap file there -- that is, a PHP script that _references_
this program.

To create your bootstrap file, simply _copy_ the file __sample-bootstrap-file.php__
to whatever location and filename you want it to have in the Public HTML
directory-tree -- and customize the variables as necessary.

After that, check the sample bootstrap file once in a while to see if there is
anything you need to add to your bootstrap file to accomodate demands of later
versions of this program.