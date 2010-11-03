<?php
include 'class.textio.php';

$text = new textio(true,false);
$out = "[h1]Genieten van ultieme kwaliteit[/h1]";
$out .= "[p]Genieten van uw televisie en film met nooit geziene beeld- en geluidskwaliteit[/p]";
$out .= "[h2]Satelliet[/h2]";
$out .= "[p]";
$out .= "Dankzij deze rechtstreekse verbinding en de DVB-technologie (Digital Video Broadcasting) die wordt gebruikt, heeft digitale televisie via de satelliet dus via een superieure beeld- en geluidskwaliteit. Zeker in combinatie met een LCD- of Plasmascherm krijgt u een prachtig resultaat, maar ook met uw gewone televisie zult u versteld staan van het perfecte beeld.";
$out .= "[/p]";
$out .= "[p]";
$out .= "[url=http://www.tv-vlaanderen.be][img]images/logos/logo_tv_vlaanderen.jpg[/img][/url]";
$out .= "[url=http://www.telesat.be][img]images/logos/logo_telesat.jpg[/img][/url]";
$out .= "[/p]";
$out .= "[h2]Telefoon, kabel[/h2]";
$out .= "[p]Via de vaste telefoonlijn of uw vaste kabel tv kijken in fantastische kwaliteit[/p]";
$out .= "[p]";
$out .= "[url=http://www.belgacomtv.be][img]images/logos/logo_belgacomtv.jpg[/img][/url]";
$out .= "[url=http://telenet.be/222/0/1/nl/thuis/televisie.html][img]images/logos/logo_telenetdigitaltv.jpg[/img][/url]";
$out .= "[/p]";
echo $text->textout($out);
?>
