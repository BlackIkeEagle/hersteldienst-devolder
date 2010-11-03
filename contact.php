<?php
include 'class.textio.php';
$contact = $_GET['contact'];

$text = new textio(true,false);

switch($contact){
case "route":
  $out = "[h1]routebeschrijving[/h1]";
  $out .= "[p]";
  $out .= "hier komt de routebescrhijving";
  $out .= "[/p]";
  $out .= "[h1]detailkaartje[/h1]";
  $out .= "[p]";
  $out .= "[img]images/locatie.jpg[/img]\n\n";
  $out .= "[img]images/locatie_detail.jpg[/img]";
  $out .= "[/p]";
  echo $text->textout($out);
  break;
case "mailsend":
  if( isset( $_POST['naam'] ) && $_POST['naam'] != "" && isset( $_POST['tel'] ) && $_POST['tel'] != "" && isset( $_POST['email'] ) && $_POST['email'] != "" && isset( $_POST['bericht'] ) && $_POST['bericht'] != "" ) {
    $toherst = "info@hersteldienst-devolder.be";
    $toclient = $_POST['email'];
    $subject = "www.hersteldienst-devolder.be";
    $message = "mail: ".$_POST['email']."\r\n";
    $message .= "tel: ".$_POST['tel']."\r\n";
    $message .= wordwrap( $_POST['bericht'] , 79 );
    $headersherst = "FROM: ".$toclient."\r\n".
      "Reply-To: ".$toclient."\r\n".
      "X-Mailer: PHP/".phpversion();
    $headersclient = "FROM: ".$toherst."\r\n".
      "Reply-To: ".$toherst."\r\n".
      "X-Mailer: PHP/".phpversion();
    $herst = "";
    $client = "";
    if( mail( $toherst , $subject , $message , $headersherst ) ) {
      $herst = "Mail is successfully sent to Hersteldienst";
    } else {
      $herst = "Mail failed to send to Hersteldienst";
    }
    if( mail( $toclient , $subject , $message , $headersclient ) ) {
      $client = "Mail is successfully sent to ".$_POST['email'];
    } else {
      $client = "Mail failed to send to ".$_POST['email'];
    }
    $out = "[h1]Verzend Email[/h1]";
    $out .= "[p]mail wordt verzonden[/p]";
    $out .= "[p]".$herst."[/p]";
    $out .= "[p]".$client."[/p]";
    $ou = "<script language='javascript'>\n";
    $ou .= "<!--\n";
    $ou .= "window.location.replace('?menu=contact')\n"; 
    $ou .= "// -->\n"; 
    $ou .= "</script>\n";
    echo $text->textout($out);
    echo $ou;
    break;
  }
case "mail":
  $out .= "[h1]Neem contact met ons op[/h1]";
  $out .= "[p]";
  $out .= "<form method='post' action='?menu=contact&contact=mailsend'><table style='padding:0;border:0;'>";
  $out .= "<tr><td class='label'>naam:</td><td><input type='text' name='naam' /></td></tr>";
  $out .= "<tr><td class='label'>telefoon:</td><td><input type='text' name='tel' /></td></tr>";
  $out .= "<tr><td class='label'>email:</td><td><input type='text' name='email' /></td></tr>";
  $out .= "<tr><td class='label'>bericht:</td><td>&nbsp;</td></tr>";
  $out .= "<tr><td colspan='2'><textarea name='bericht' cols='100' rows='15'></textarea></td></tr>";
  $out .= "<tr><td colspan='2'><input class='button' type='submit' value='verzenden' /><input class='button' type='reset' value='wissen' /></td></tr>";
  $out .= "</table>[/p]";
  $out .= "[p]Deze mail dient u ook zelf te ontvangen, als dit niet het geval is probeer dan aub opnieuw[/p]";
  echo $text->textout($out);
  break;
default:
  $out = "[h1]Algemeen[/h1]";
  $out .= "[p]";
  $out .= "Audio Video Ktv Hersteldienst Luc Devolder\nPieter Paul Rubensstraat 11\n8020 Oostkamp [link=http://www.hersteldienst-devolder.be/contact.php?contact=route;inhoud]route[/link]\nOndernemingsnummer: 0673 150 504 \nBTW-nummer: BE 0673 150 504\ntel: 050 82 49 19\n\n";
  $out .= "[/p]";
  $out .= "[h1]Openingsuren[/h1]";
  $out .= "[p]";
  $out .= "Maandag tot en met vrijdag:\n08.00u tot 20.00u\n";
  $out .= "Zaterdag: 08.00u tot 17.30u\n";
  $out .= "Zondag gesloten";
  $out .= "[/p]";
  $out .= "[h1]internet[/h1]";
  $out .= "[p]";
  $out .= "[url]www.hersteldienst-devolder.be[/url]\n";
  $out .= "[link=http://www.hersteldienst-devolder.be/contact.php?contact=mail;inhoud]email[/link]";
  $out .= "[/p]";

  echo $text->textout($out);
  break;
}
?>
