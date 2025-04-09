<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Setup artmedic guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body leftmargin="10" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr bgcolor="#FFFFFF"> 
    <td height="30" colspan="2">&nbsp;</td>
  </tr>
  <tr bgcolor="#FF6600">
    <td height="19" valign="TOP"><font size="3" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td height="25"><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif"><strong>artmedic
    guestbook 3.0</strong></font></td>
  </tr>
  <tr> 
    <td width="10%" bgcolor="#FF9900" valign="TOP" align="CENTER"><p><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"><strong><a href="index.php">G&auml;stebuch</a></strong></font></p>
    <p><a href="delete.htm"><font size="2" face="Arial, Helvetica, sans-serif">Admin</font></a></p></td>
    <td width="90%" valign="TOP"> <br>
      <?PHP
############################################################################# 
# artmedic guestbook
# Copyright (c) 2003 Ellen Baitinger, http://www.artmedic.de (kontakt@artmedic.de) # 
#  
# This program is free software;
# This program is distributed in the hope that it will be useful, # 
# but WITHOUT ANY WARRANTY; without even the implied warranty of # 
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
#Dieses Script kann kostenlos auf privaten und kommerziellen Seiten eingesetzt und angepasst werden, 
#solange Sie den Link auf artmedic webdesign und die Hinweise auf das Copyright und die Autorenschaft intakt lassen.
#Die Nutzung des Programms erfolgt auf eigene Gefahr. <br>
#Das Programm darf nicht weiterverkauft oder in anderer Weise zu Geld gemacht werden.
############################################################################# 	  	  
if(file_exists("include.php"))
{echo "<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Setup wurde bereits erfolgreich durchgeführt.<br>
Falls Sie Setup erneut ausführen möchten, müssen Sie zunächst die Datei include.php von Ihrem Webserver löschen.";
exit;
}	  
if (!empty($HTTP_POST_VARS)) {extract($HTTP_POST_VARS);}
if (!empty($HTTP_GET_VARS)) {extract($HTTP_GET_VARS);}
$ser =  $_SERVER['SERVER_NAME'];
$path = $_SERVER['SCRIPT_NAME'];
$path = "http://"."$ser"."$path";
$path = ereg_replace("setup.php", "", $path);
$path = ereg_replace("index.php", "", $path);

$ee = ereg_replace("www.", "", $ser);
$ee = "kontakt@"."$ee";			  
if(!$fertig) {
?>      <form name="form1" method="post" action="setup.php">
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr bgcolor="#FF6600"> 
            <td colspan="2"><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif"><strong>Setup 
              </strong></font></td>
          </tr>
          <tr> 
            <td width="313" bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Scripturl</font></td>
            <td width="529"><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="scripturl" type="text" value="<?php echo $path; ?>" size="60" id="scripturl2">
              </font></td>
          </tr>
          <tr> 
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">E-Mail
                 des Administrators/<br>
                 admin-email
            </font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="adminemail" type="text" id="email2" value="<?php echo $ee; ?>" size="60">
              </font></td>
          </tr>
          <tr> 
            <td height="26" bgcolor="#FFCC66"><p><font size="2" face="Arial, Helvetica, sans-serif">Administratorpasswort/<br>
              admin-password
            </font> </p></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="password1" type="password" id="password12">
              </font></td>
          </tr>
          <tr> 
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Passwort
                 wiederholen/<br>
                 repeat password
            </font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif"> 
              <input name="password2" type="password" id="password22">
              </font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Anzahl
            der angezeigten Eintr&auml;ge pro Seite</font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="anzahl" type="text" id="anzahl" value="10">
            </font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Max.
            Textl&auml;nge eines Eintrags in Zeichen</font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="laenge" type="text" id="laenge" value="900">
            </font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Nach wieviel Zeichen soll der Kommentartext
            umgebrochen werden?</font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="umbruch" type="text" id="umbruch" value="100">
            </font></td>
          </tr>
          <tr> 
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
            <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">IP-Sperre aktivieren</font></td>
            <td valign="top" bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="ipsperre" type="radio" value="YES" checked>
              Ja 
              <input type="radio" name="ipsperre" value="">
              Nein</font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">IP-Sperrzeit
                f&uuml;r die Anmeldung in Sekunden eingeben/<br>
time of IP-lock in seconds</font></td>
            <td valign="top" bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="sperrzeit" type="text" id="sperrzeit" value="3600">
Vorgabe = 1 h             </font></td>
          </tr>
          <tr>
            <td bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">Eigene IP-Adresse (falls fix)</font></td>
            <td valign="top" bgcolor="#FFCC66"><font size="2" face="Arial, Helvetica, sans-serif">
              <input name="eigene_ip" type="text" id="eigene_ip" value="127.0.0.1">
    </font></td>
          </tr>
          <tr> 
            <td bgcolor="#FFCC66" align="CENTER"><font size="2" face="Times New Roman, Times, serif">&nbsp;</font> 
              <font face="Times New Roman, Times, serif">&nbsp;              </font></td>
            <td bgcolor="#FFCC66"><font face="Times New Roman, Times, serif">
              <input name="submit" type="submit" value="Gäatebuch installieren / Install guestbook">
&nbsp;&nbsp;
<input name="reset" type="reset" value="Zur&uuml;cksetzen / Reset">
<input name="fertig" type="hidden" value="1" id="fertig">
            </font></td>
          </tr>
        </table>
      </form>
            <?PHP
}
else
{
if($fertig)
{
if (empty ($scripturl)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>
	Geben Sie bitte die Webadresse (URL) des Homepagemakers ein (mit / am Ende .");}
if (empty ($adminemail)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Geben Sie bitte Ihre E-Mail ein");}
if (empty ($password1)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Geben Sie bitte ein Administratorpasswort ein");}
if (empty ($password2)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Wiederholen Sie bitte die erste Passworteingabe");}
if($password1!=$password2)
{die ("<font face=\"Arial, Helvetica, sans-serif\" size=\"2\">Die beiden Passwörter stimmen nicht überein.
<br>Gehen Sie bitte zurück und korrigieren Sie Ihre Eingabe"); } 
if (empty ($anzahl)) {  
    die ("<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>
	Legen Sie bitte die Anzahl der angezeigten Einträge pro Seite fest.");}	

$guest = md5(time());
$iplog = rand();

//Template einlesen
$temp = "includetemp.php";		
$includetemplate= fopen ($temp,"r");
$includetext = fread($includetemplate,filesize($temp));
$includetext =  ereg_replace("%scripturl%","$scripturl",$includetext);
$includetext =  ereg_replace("%adminemail%","$adminemail",$includetext);
$includetext =  ereg_replace("%password%","$password1",$includetext);
$includetext =  ereg_replace("%guest%","$guest",$includetext);
$includetext =  ereg_replace("%sperrzeit%","$sperrzeit",$includetext);
$includetext =  ereg_replace("%iplog%","$iplog",$includetext);
$includetext =  ereg_replace("%iptest%","$ipsperre",$includetext);
$includetext =  ereg_replace("%ip%","$eigene_ip",$includetext);
$includetext =  ereg_replace("%anzahl%","$anzahl",$includetext);
$includetext =  ereg_replace("%laenge%","$laenge",$includetext);
$includetext =  ereg_replace("%umbruch%","$umbruch",$includetext);
fclose($includetemplate);

//Includedatei schreiben
$includedatei = "include.php";
$include = @fopen($includedatei, "w+");
@fputs($include, "$includetext");
@fclose($include);

//Userdatei anlegen
$f = "$guest"."_daten.txt";
$userfile = fopen($f, "w+");
fclose($userfile);
@chmod($f, 0766);

//Logdatei anlegen
if($ipsperre=="YES")
{
$f = "$iplog"."_iplog.txt";
$userfile = fopen($f, "w+");
fclose($userfile);
@chmod($f, 0766);
}

if(file_exists("include.php"))
{echo "<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Setup wurde erfolgreich durchgeführt.<br>Setup was successfull";}
else
{echo "<b><font face=\"Arial, Helvetica, sans-serif\" size=\"2\" color=red>Setup ist fehlgeschlagen. <br>
Die Datei include.php konnnte nicht geschrieben werden. <br><br>
Haben Sie das Verzeichnis mit CHMOD 777 freigegeben? <br>Ansonsten überprüfen Sie Ihre php.ini-Einstellungen.
<br><br><br>Setup failed!<br>
Please check file-permissions of your script-directories: CHMOD 777";}
}}
?>
    </td>
  </tr>
  <tr bgcolor="#FF9900">
    <td colspan="2" align="CENTER" valign="TOP">&nbsp;</td>
  </tr>
</table>
</body>
</html>
