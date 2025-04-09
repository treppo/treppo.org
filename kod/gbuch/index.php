<html>

<head>
<title>Gästebuch</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
</head>

<body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF" topmargin="20" leftmargin="20">

<?php 
if(!is_file("include.php"))
{include("setup.php");
exit;} 
?>
<table width="100%" height="100%" cellspacing="0" cellpadding="2" style="font-family:Arial; font-size:12pt; color:#FFFFFF; border-collapse:collapse; font-weight:bold" bgcolor="#000000" border="0" bordercolor="#FFFFFF">
  <tr>
    <td colspan="2" height="200">
    <p align="center">
    <img border="0" src="../bilder/gaestebuch2.gif" width="407" height="132"></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;<?php 

	  require("include.php");
	  $daten = file($news);
	  $anzahl = count($daten);
	  echo $anzahl;
	  ?> Kunden</td>
    <td width="50%" align="center">
    <p align="right"><a href="index.php?read=1">Neue Kunde tun</a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp; </td>
  </tr>
  <tr> 
    <td bgcolor="#000000" colspan="2"> 
      <?PHP
	  $read = $_GET['read'];
	  $id = $_GET['id'];
	if(!isset($read) and !isset($id)){
	@readfile("1.htm");}
	if(isset($id))
	{readfile($id);}
	if(isset($read))
	{readfile("eingabe.htm");}
	?> &nbsp;</td>
  </tr>
</table>

</body>

</html>