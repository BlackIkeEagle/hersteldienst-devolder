<?php
include 'class.textio.php';

$text = new textio(true,false);

$out = "[h1]Hifi & Professionele audio[/h1]";
$out .= "<div style='height:100px;width:95%;'>";
$out .= "[block][img]images/boxen.jpg[/img]\nboxen[/block]";
$out .= "[block][img]images/stereoketen.jpg[/img]\nstereoketen[/block]";
$out .= "[block][img]images/flightcase.jpg[/img]\nflightcase[/block]";
$out .= "[blockr][url=http://www.yamaha-online.de][img]images/logos/logo_yamaha.jpg[/img][/url]\n[url=http://www.panasonic.be][img]images/logos/logo_panasonic.gif[/img][/url]\n[url=http://www.beglec.com][img]images/logos/logo_jb_systems.jpg[/img][/url][/blockr]";
$out .= "</div>";
$out .= "[h1]Lcd tv & Home cinema[/h1]";
$out .= "<div style='height:100px;width:95%;'>";
$out .= "[block][img]images/lcdtv.jpg[/img]\nlcd tv[/block]";
$out .= "[block][img]images/homecinema.jpg[/img]\nhome cinema[/block]";
$out .= "[blockr][url=http://www.philips.be][img]images/logos/logo_philips.gif[/img][/url]\n[url=http://www.panasonic.be][img]images/logos/logo_panasonic.gif[/img][/url]\n[url=http://www.sony.be][img]images/logos/logo_sony.gif[/img][/url][/blockr]";
$out .= "</div>";
$out .= "[h1]Satelliet[/h1]";
$out .= "<div style='height:100px;width:95%;'>";
$out .= "[block][img]images/satontvanger.jpg[/img]\nsatelliet ontvangers[/block]";
$out .= "[block][img]images/satdish.jpg[/img]\nsatelliet schotels[/block]";
$out .= "[blockr][url=http://www.vantage-digital.com/index.php?a=downloads][img]images/logos/logo_vantage.jpg[/img][/url]\n[url=http://www.digitaaltvkijken.be/dtv/nl/default.asp?WebpageId=21][img]images/logos/logo_konig.jpg[/img][/url][/blockr]";
$out .= "[blockr][url=http://www.sabsatellite.nl/nl/downloads][img]images/logos/logo_sab.jpg[/img][/url]\n[url=http://www.technomate.com/software_updates.php][img]images/logos/logo_technomate.jpg[/img][/url][/blockr]";
$out .= "</div>";

echo $text->textout($out);
?>
