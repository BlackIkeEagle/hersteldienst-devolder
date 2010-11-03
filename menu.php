<?php
$menu = $_GET['menu'] ? $_GET['menu'] : "home";
echo "<a href=\"?menu=home\" title=\"Klik hier om naar de home pagina te gaan\"><div".($menu == "home" ? " id='selected'" : "").">home</div></a>\n";
echo "<a href=\"?menu=hersteldienst\" title=\"Klik hier om naar hersteldienst te gaan\"><div".($menu == "hersteldienst" ? " id='selected'" : "").">hersteldienst</div></a>\n";
echo "<a href=\"?menu=verkoop\" title=\"Klik hier voor verkoop\"><div".($menu == "verkoop" ? " id='selected'" : "").">verkoop</div></a>\n";
echo "<a href=\"?menu=digitaal_tv\" title=\"Klik hier voor digitaal tv\"><div".($menu == "digitaal_tv" ? " id='selected'" : "").">digitaal tv</div></a>\n";
//echo "<a href=\"?menu=koopjes\" title=\"Klik hier voor koopjes\"><div".($menu == "koopjes" ? " id='selected'" : "").">koopjes</div></a>\n";
echo "<a href=\"?menu=contact\" title=\"Klik hier om contact op te nemen\"><div".($menu == "contact" ? " id='selected'" : "").">contact</div></a>\n";
echo "<a href=\"?menu=links\" title=\"Klik hier voor de links\"><div".($menu == "links" ? " id='selected'" : "").">links</div></a>\n";
?>
