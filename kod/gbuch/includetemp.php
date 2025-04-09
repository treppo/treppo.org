<?PHP
//Variablen editieren:

//Persönliches Passwort festlegen 
$password = "%password%";
//Admin-Emailadresse
$adminemail = "%adminemail%";
//URL zu delete.htm
$deletehtm = "%scripturl%delete.htm";
//Nach wieviel Zeichen soll der Kommentartext umgebrochen werden?
$umbruch = "%umbruch%";
//Beschränkung der Textlänge pro Kommentar
$textlaenge = "%laenge%";

//Datenfile festlegen
$news = "%guest%_daten.txt";
//Name der Templatedatei
$template = "template.htm";
//Name der IP-Logdatei, bitte ändern
$iplog = "%iplog%_iplog.txt";

//Anzahl der anzuzeigenden Einträge pro Seite
$anzahl = "%anzahl%";

//Name der Startseite
$index = "index.php";

//IP-Überprüfung bei Eintrag aktivieren oder deaktivieren
//YES für aktivieren eingeben
$iptest = "%iptest%"; 
//Zeitdauer der IP-Sperre in Sekunden
$iptime = "%sperrzeit%";
//Eigene IP-Nummer ausnehmen falls IP-Test aktiviert
$eigene_ip = "%ip%";
?>