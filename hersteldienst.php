<?php
include 'class.textio.php';

$text = new textio(true,false);
$out = "[h1]Herstellingen van alle merken[/h1]";
$out .= "[p]";
$out .= "De herstellingen worden in onze eigen werkplaats uitgevoerd, dankzij een jarenlange ervaring worden deze op een snelle en nauwkeurige manier uitgevoerd.\n";
$out .= "U kunt dan ook bij ons terecht met toestellen van alle merken.\n";
$out .= "[img]images/lcd_4.jpg[/img]";
$out .= "[/p]";

echo $text->textout($out);
?>
