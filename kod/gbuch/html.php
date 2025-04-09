<?PHP
//HTML aktualisieren
$daten=file($news);
$daten = array_reverse($daten);
$anzahlzaehler="$anzahl";
$count=count($daten);
$start="0";
$htmlname="1";
$seitenzahl = "$count"/"$anzahl";
if($seitenzahl == "0")
{$seitenzahl = "1";}
$seiten = ceil($seitenzahl);
//Links
for($i=1;$i<=$seiten;$i++){
$li .= "<a href=\"index.php?id=$i.htm\" class=\"fett\">$i</a>  ";
}
$li = "<center>$li</center>";
//HTML
for($i=1;$i<=$seiten;$i++){
$htmldatei="$htmlname".".htm";
//Zunächst alte Daten löschen
$fp = fopen("$htmldatei", "w+");
if($fp){
fputs($fp, $head);
fclose ($fp);}
//Neuer Inhalt
$output = array_slice($daten,$start,$anzahl);      
while (list ($line_num, $line) = each ($output)) 
{ $ziffern = explode("&&",$line);
//Template öffnen
$newstemplate= fopen ("$template","r");
$newshtml = fread($newstemplate, filesize($template));
$newshtml =  ereg_replace("%name%","$ziffern[1]",$newshtml);
$newshtml =  ereg_replace("%date%","$ziffern[0]",$newshtml);
$newshtml =  ereg_replace("%text%","$ziffern[2]",$newshtml);
$newshtml =  ereg_replace("%homepage%","$ziffern[3]",$newshtml);
$newshtml =  ereg_replace("%icon%","$ziffern[5]",$newshtml);
fclose ($newstemplate);


//NewsHTML schreiben
$fp = fopen("$htmldatei", "a+");
if($fp){
flock($fp,2);
fputs ($fp, "$newshtml");
flock($fp,3);
fclose ($fp);}
}
$copy="<table align=\"center\"><tr><td><br>
    <img border=\"0\" src=\"../bilder/wappen.gif\" width=\"126\" height=\"184\"></td></tr></table>";


$fp = fopen("$htmldatei", "a+");
if($fp){
flock($fp,2);
fputs ($fp, "$link"."$li$copy");
flock($fp,3);
fclose ($fp);}

$htmlname++;
$start="$start"+"$anzahlzaehler";
}
echo "<font face=\"Arial, Helvetica, sans-serif\" size=\"4\"><b>Ihr habt Kunde getan</b></font>";


?>