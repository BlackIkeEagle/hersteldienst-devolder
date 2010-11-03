<?php
switch( $menu ) {
case 'hersteldienst':
  include 'hersteldienst.php';
  break;
case 'verkoop':
  include 'verkoop.php';
  break;
case 'digitaal_tv':
  include 'digitaal_tv.php';
  break;
case 'koopjes':
  include 'koopjes.php';
  break;
case 'contact':
  include 'contact.php';
  break;
case 'links':
  include 'links.php';
  break;
case 'home':
default:
  include 'home.php';
  break;
}
?>
