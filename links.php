<?php
include 'class.textio.php';

$text = new textio(true,false);

$out = "[h1]Audio - Video - Ktv[/h1]";
$out .= "[p]";
$out .= "[url=http://www.philips.be][img]images/logos/logo_philips.gif[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.panasonic.be][img]images/logos/logo_panasonic.gif[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.sony.be][img]images/logos/logo_sony.gif[/img][/url]";
$out .= "\n";
$out .= "[url=http://www.yamaha-online.de][img]images/logos/logo_yamaha.jpg[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.beglec.com][img]images/logos/logo_jb_systems.jpg[/img][/url]";
$out .= "[/p]";
$out .= "[h1]Satelliet[/h1]";
$out .= "[p]";
$out .= "[url=http://www.tv-vlaanderen.be][img]images/logos/logo_tv_vlaanderen.jpg[/img][/url]";
$out .= "[url=http://www.telesat.be][img]images/logos/logo_telesat.jpg[/img][/url]";
$out .= "\n";
$out .= "[url=http://www.lyngsat.com/astra19.html][img]images/logos/logo_astra.gif[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.vantage-digital.com/index.php?a=downloads][img]images/logos/logo_vantage.jpg[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.digitaaltvkijken.be/dtv/nl/default.asp?WebpageId=21][img]images/logos/logo_konig.jpg[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.sabsatellite.nl][img]images/logos/logo_sab.jpg[/img][/url]";
$out .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$out .= "[url=http://www.technomate.com][img]images/logos/logo_technomate.jpg[/img][/url]";
$out .= "[/p]";
$out .= "[h1]Digitaal Tv[/h1]";
$out .= "[p]";
$out .= "[url=http://www.belgacomtv.be][img]images/logos/logo_belgacomtv.jpg[/img][/url]";
$out .= "[url=http://telenet.be/222/0/1/nl/thuis/televisie.html][img]images/logos/logo_telenetdigitaltv.jpg[/img][/url]";
$out .= "[/p]";
$out .= "[h1]Andere links[/h1]";
$out .= "<!-- start code button blue 02: 120x060 --><a href=\"http://oostkamp.start.be\" target=\"_blank\"><img src=\"http://start.startcdn.com/local/be/pr/120x060_lb_be_blue_02.gif\" border=\"0\" alt=\"meest populaire web sites van België\"></a><!-- end code button blue 02: 120x060-->";

echo $text->textout($out);
?>
