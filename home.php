<?php
include 'class.textio.php';

$text = new textio(true,false);
$out="[h1]Welkom bij Audio Video Ktv Hersteldienst Luc Devolder[/h1]";
$out.="[h2]Ligging[/h2]";
$out.="[p]Audio Video Ktv Hersteldienst Luc Devolder is gelegen in de wijk Nieuwenhove te Oostkamp, daar dit een zeer centrale locatie is in de gemeente Oostkamp kunnen wij ook een zeer snelle bediening garanderen naar de deelgemeenten Oostkamp, Waardamme, Hertsberge en Ruddervoorde.\n";
$out.="De service die geleverd wordt, is natuurlijk niet enkel beperkt tot de gemeente Oostkamp, er wordt altijd gestreefd naar de meest kwalitatieve oplossing voor problemen in gans Vlaanderen, meer specifiek West-Vlaanderen en Oost-Vlaanderen.[/p]";
$out.="[h2]Wat?[/h2]";
$out.="[p]Hebt u kapotte toestellen, problemen bij installatie of gewoon nieuw materiaal nodig, dan kan u altijd bij ons terecht. Kwaliteit wordt zeer hoog in het vaandel gedragen voor al uw toestellen, TV, Flatscreen, TFT, DVD, BluRay, Radio, Cd-speler, Versterker, Boxen, Satellietsysteem, Digitaal Tv.[/p]";
$out.="[h2]Openingsuren[/h2]";
$out.="[p]Ma - Vr: 8.00u tot 20.00u\n";
$out.="Za : 8.00u tot 17.30u\n";
$out.="Zondag gesloten[/p]";

echo $text->textout($out);
?>
