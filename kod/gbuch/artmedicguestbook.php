<html>
<head>
<title>Gästebuch</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<style type="text/css"><!--
body      {scrollbar-face-color: #000000; scrollbar-shadow-color: #000000; scrollbar-highlight-color: #000000; scrollbar-3dlight-color: #FFFFFF; scrollbar-darkshadow-color: #FFFFFF; scrollbar-track-color: #000000; scrollbar-arrow-color: #FFFFFF}
//--></style>
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" topmargin="20" leftmargin="20">

<table width="100%" border="0" cellspacing="0" cellpadding="2" style="border-collapse:collapse; font-family:Arial; font-size:12pt; font-weight:bold" bgcolor="#000000">
  <tr> 
    <td>
    <p align="center">
    <img border="0" src="../bilder/gaestebuch2.gif" width="407" height="132"></td>
  </tr>
  <tr> 
    <td>
    <p align="right"><a href="index.php?read=1">Neue Kunde tun</a></td>
  </tr>
  <tr> 
    <td> 
      <?
 ############################################################################# 
# artmedic guestbook 3.0# 
# Copyright (c) 2003 Ellen Baitinger, http://www.artmedic.de (kontakt@artmedic.de) # 
# # 
# This program is free software;
# This program is distributed in the hope that it will be useful, # 
# but WITHOUT ANY WARRANTY; without even the implied warranty of # 
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
#Dieses Script kann kostenlos auf privaten und kommerziellen Seiten eingesetzt werden, 
#solange Sie den Link auf artmedic als Hinweis auf die Autorenschaft intakt lassen.
#Das Script darf nicht veräußert werden oder in anderer Weise zu Geld gemacht werden.
#Die Weitergabe des Scripts muss prinzipiell kostenlos erfolgen.
############################################################################# 
require("include.php");

//Eintragen
$edit = $_POST['edit'];
$delete = $_POST['delete'];
if(!isset($edit) and !isset($delete))
{
$text = $_POST['text'];
$name = $_POST['name'];
$homepage = $_POST['homepage'];
$email = $_POST['email'];
$icon = $_POST['icon'];
if (empty ($text)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"3\">Gebt einen Text ein.<br><br><a href=\"javascript:history.go(-1);\">&laquo;&laquo; zurück</A>");}
if (empty ($name)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"3\">Gebt euren Namen ein.<br><br><a href=\"javascript:history.go(-1);\">&laquo;&laquo; zurück</A>");	
	}
if(!empty ($homepage)) {
if(!eregi('^(http|https)://', $homepage)) { 
     die("<font face=\"Arial, Helvetica, sans-serif\" size=\"3\"><b>$homepage</b> ist keine gültige Internetadresse. <br>Gebt eine gültige URL beginnend mit http:// ein oder lasst es sein. 
	 <br><br><a href=\"javascript:history.go(-1);\">&laquo;&laquo; zurück</A></font>");}}
if(!empty ($email)) {
if(!eregi("^[a-z0-9\._-]+@+[a-z0-9\._-]+\.+[a-z]{2,4}$", $email)) { 
     die("<font face=\"Arial, Helvetica, sans-serif\" size=\"3\"><b>$email</b> ist keine gültige E-Mailadresse. <br>Gebt eine gültige Adresse ein oder lasst es sein. 
	 <br><br><a href=\"javascript:history.go(-1);\">&laquo;&laquo; Zurück</A></font>");}}	 
	 
$laenge = strlen($text);
if($laenge >= $textlaenge)
{die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\">Der eingegebene Text ist zu umfangreich.<br> Er darf maximal $textlaenge Zeichen enthalten.");}
//IP-Test, falls aktiviert
if($iptest == "YES")
{
//Zeit prüfen
$time = time();
$ablaufzeit = "$time"-"$iptime";
$pruefung = @file($iplog);
while (list ($line_num, $line) = @each($pruefung)) 
{$zeiten = explode("&&",$line);
if($zeiten[1] <= $ablaufzeit)
{$fp = fopen("$iplog", "r"); 
$contents = fread($fp, filesize($iplog)); 
fclose($fp);
$line=quotemeta($line); 
$string2 = "";
$replace = ereg_replace($line, $string2, $contents);
$fh=fopen("$iplog", "w+");
@flock($fh,2);
fputs($fh, $replace);
@flock($fh,3);
fclose($fh);
}}
//IP prüfen
$ip = $_SERVER['REMOTE_ADDR'];
$zeilen = file($news);
while (list ($line_num, $line) = each ($zeilen)) 
{
$ziffern = explode("&&","$line");
if($ziffern[6]==$ip and $eigene_ip != $ip)
{
echo "<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\">
Du kannst nur einen Kommentar pro Internetsitzung eingeben.<br>
	<a href=\"javascript:history.go(-1);\">
	&laquo;&laquo; zurück</A></b></font>";	
exit;
}}
//IP-Logeintrag
if($ip!=$eigene_ip)
{
$time = time();
$fplog = fopen("$iplog", "a+");
if($fplog){
flock($fplog,2);
fputs ($fplog, "$ip&&$time&&\n");
flock($fplog,3);
fclose ($fplog);}}
}
//Daten eintragen	
$datum = date("d.m.Y");
$uniqid = uniqid("");
$text = stripslashes($text);
$text = wordwrap($text,$umbruch, "<br>",1);
$text = ereg_replace("$", "", $text);
$name = ereg_replace("$", "", $name);
$name = strip_tags("$name");
$name = wordwrap($name,$umbruch, "<br>",1);
$homepage = ereg_replace("$", "", $homepage);
$email = ereg_replace("$", "", $email);
$text = ereg_replace("\n", "<br>", $text);
$text = ereg_replace("\r", "", $text);
if($homepage!="")
{$homepage1 = "<a href=\"$homepage\" target=\"_blank\">Homepage</a>";}
if($email!="")
{$name1 = "<a href=\"mailto:$email\"><font color=\"#FFFFFF\">$name</font></a>";}
else
{$name1 = $name;}
$fp = fopen("$news", "a+");
if($fp){
flock($fp,2);
fputs ($fp, "$datum&&$name1&&$text&&$homepage1&&email&&$icon&&$ip&&$uniqid&&\n");
flock($fp,3);
fclose ($fp);}
include("html.php");
readfile("1.htm");
//Mail to admin
$link = "$deletehtm";
$subject = "neuer gästebucheintrag";
$mailtext = "
Hallo,

$name hat sich in Dein Gästebuch eingetragen.
Das hat er geschrieben:

$text

Email: $email
Homepage: $homepage

Wenn Du den Eintrag löschen möchtest,
gehe zu folgender Seite:
$link

Dein Passwort zum Löschen lautet: $password";
@mail("$adminemail", "$subject", "$mailtext", "FROM: $name <$email>");
}

//Einträge löschen
if($edit==1)
{
//Passwortüberprüfung
$pass = $_POST['pass'];
if ($pass != $password)
{die ("<font face=\"Arial, Helvetica, sans-serif\" size=\"2\">das passwort ist nicht korrekt.<br>geh bitte zurück und korrigiere deine eingabe");} 

echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
  <tr> 
    <td bgcolor=\"#000000\"><font face=\"Arial, Helvetica, sans-serif\" size=\"4\">artmedic 
      guestbook</font></td>
  </tr>
  <tr> 
    <td bgcolor=\"#000000\">
      
    
      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\"><tr><td>
	  <font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><b>markiere die zu löschenden einträge und geh auf löschen.</b></font>
<FORM METHOD=\"POST\" action=\"artmedicguestbook.php\">
<input type=\"hidden\" name=\"delete\" value=\"1\"> <input type=\"hidden\" name=\"pass\" value=\"$password\">";
$zeilen=file($news);
while (list ($line_num, $line) = each ($zeilen)) 
{
$ziffern = explode("&&","$line");
while (list($key, $value) = each($ziffern))
{


}echo "<table width=\"100%\"  border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
  <tr>
    <td class=\"rahmen\" bgcolor=\"#000000\" align=\"top\"><input name=\"auswahl[]\" type=\"checkbox\" value=\"$ziffern[7]\"></td>
    <td width=\"100%\" class=\"rahmen\" bgcolor=\"#000000\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">vom
        $ziffern[0]: <b>von $ziffern[1] </b>IP: $ziffern[6]<br> 
    $ziffern[2]</font></td>
  </tr>
</table>";
}
echo "<input type=\"submit\" type=\"button\" value=\"löschen\"></form>
</td></tr>
      </table>
    </td>
  </tr>
</table>";
}
//Löschen ausführen
if($delete==1 and !isset($edit))
{
//Suchen des entsprechenden Datensatzes
$auswahl = $_POST['auswahl'];
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">
  <tr> 
    <td bgcolor=\"#000000\"><font face=\"Arial, Helvetica, sans-serif\" size=\"4\">artmedic 
      guestbook<br></font></td></tr><tr><td bgcolor=\"#000000\"><font face=\"Arial, Helvetica, sans-serif\" size=\"2\">";
for ($i=0; $i<count($auswahl); $i++){

$ip = "$auswahl[$i]";
$ziffernzeilen = file ($news);
while (list ($line_num, $line) = each ($ziffernzeilen)) 
{
$ziffern = explode("&&","$line");
if ($ip == $ziffern[7])
{
$fp = fopen( $news, "r" ); 
$size = filesize( $news ); 
$contents = fread( $fp, $size);
fclose( $fp ); 
$line=quotemeta($line);
$string2 = "";
$replace = ereg_replace($line, $string2, $contents);
$fp = fopen($news, "w+");
flock($fp,2);
fputs($fp, $replace, $size);
flock($fp,3);
fclose($fp);
}}
}

include("html.php");
echo "<br>löschvorgang abgeschlossen: <a href=\"index.php\" target=\"_blank\">html-datei</a> wurde entsprechend aktualisiert.";
//Aktualisierte Anzeige zum weiteren Löschen
echo "</td>
  </tr>
  <tr> 
    <td bgcolor=\"#000000\"><font face=\"Arial, Helvetica, sans-serif\" size=\"2\"><b>weitere einträge 
      löschen:</font> 
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\"><FORM METHOD=\"POST\" action=\"artmedicguestbook.php\">
<input type=\"hidden\" name=\"delete\" value=\"1\"> <input type=\"hidden\" name=\"pass\" value=\"$password\">";


$zeilen=file($news);
while (list ($line_num, $line) = each ($zeilen)) 
{
$ziffern = explode("&&","$line");
while (list($key, $value) = each($ziffern))
{


}echo "<table width=\"100%\"  border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
  <tr>
    <td class=\"rahmen\" bgcolor=\"#000000\" align=\"top\"><input name=\"auswahl[]\" type=\"checkbox\" value=\"$ziffern[7]\"></td>
    <td width=\"100%\" class=\"rahmen\" bgcolor=\"#000000\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Vom
        $ziffern[0]: <b>von $ziffern[1]</b> IP: $ziffern[6]<br> 
    $ziffern[2]</font></td>
  </tr>
</table>";
}
echo "<input type=\"submit\" type=\"button\" value=\"löschen\"></form>
</td></tr>
      </table>
    </td>
  </tr>
</table>";

}
?>
    </td>
  </tr>
</table>


</body>
</html>
