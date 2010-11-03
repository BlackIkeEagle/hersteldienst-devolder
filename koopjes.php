<?php
include 'class.textio.php';

$text = new textio(true,false);
$out="[h1]Koopjes[/h1]";
$out.="[p]Er zijn momenteel geen koopjes[/p]";

echo $text->textout( $out );
?>
