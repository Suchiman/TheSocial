<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$id = $_SESSION['id'];

if(isset($_POST['nachname'])){

	$nachname = $_POST['nachname'];
	$vorname = $_POST['vorname'];
	$beziehung = $_POST['beziehung'];
	$gbdatum = $_POST['geburtsdatum'];
	$geschlecht = $_POST['geschlecht'];

	switch($geschlecht){
		case "Nicht Festgelegt":
			$geschlecht=0;
			break;
		case "Maennlich":
			$geschlecht=1;
			break;
		case "Weiblich":
			$geschlecht=2;
			break;
		case "Zwitter":
			$geschlecht=3;
			break;
	}
	mysql_query("UPDATE `profil` SET `nachname` = '".$nachname."',`vorname` = '".$vorname."',`geschlecht` = '".$geschlecht."',`beziehung` = '".$beziehung."',`geburtsdatum` = '".$gbdatum."' WHERE `profil`.`id` = '".$id."'");
}

$nutzer = mysql_query("SELECT name, DATE_FORMAT (regdatum, '%d.%m.%Y') AS regdatum FROM nutzer WHERE id = '".$id."'");
$profil = mysql_query("SELECT nachname, vorname, geschlecht, beziehung, geburtsdatum FROM profil WHERE id = '".$id."'");

$profil = mysql_fetch_array($profil);
$nutzer = mysql_fetch_array($nutzer);

$geschlecht = $profil['geschlecht'];

if(file_exists("nutzerbilder/".$id.".jpg")){
	echo "<div>Profilbild:<img src=\"nutzerbilder/".$id.".jpg\" alt=\"Hier sollte ein Nutzerbild zu sehen sein\">";
}
else{
	echo "<div>Profilbild:<img src=\"bilder/Standard.png\" alt=\"Warum fehlt das Standard Bild?\">";
}
echo "<iframe name=\"upload\" style=\"width: 0; height: 0; visibility: hidden;\"></iframe>";
echo "<form action=\"hochladen.php\" method=\"POST\" target=\"upload\" enctype=\"multipart/form-data\"><input type=\"file\" name=\"datei\"><input type=\"submit\" value=\"Hochladen\"></form></div>";
echo "<table>";
echo "<tr><td>Nachname:</td><td><input type='text' id='nachname' value='".$profil['nachname']."'></td></tr>";
echo "<tr><td>Vorname:</td><td><input type='text' id='vorname' value='".$profil['vorname']."'></td></tr>";
echo "<tr><td>Geschlecht:</td><td><select value='".$profil['geschlecht']."' id='geschlecht'><option ";
if($geschlecht==0)echo 'selected';
echo ">Nicht Festgelegt</option><option ";
if($geschlecht==1)echo 'selected';
echo ">Maennlich</option><option ";
if($geschlecht==2)echo 'selected';
echo ">Weiblich</option><option ";
if($geschlecht==3)echo 'selected';
echo ">Zwitter</option></select></td></tr>";
echo "<tr><td>Beziehung:</td><td><input type='text' id='beziehung' value='".$profil['beziehung']."'></td></tr>";
echo "<tr><td>Geburtstag:</td><td><input type='text' id='geburtsdatum' value='".$profil['geburtsdatum']."'></td><td>(YYYY-MM-DD)</td></tr>";
echo "<tr><td><input type=\"button\" value=\"Speichern\" onclick='lade(\"profil_bearbeiten.php?nachname=\" + document.getElementById(\"nachname\").value + \"&vorname=\" + document.getElementById(\"vorname\").value + \"&beziehung=\" + document.getElementById(\"beziehung\").value + \"&geburtsdatum=\" + document.getElementById(\"geburtsdatum\").value + \"&geschlecht=\" + document.getElementById(\"geschlecht\").value)'></td></tr>";
echo "</table>";

mysql_close();
?>