<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$nid = $_POST['nutzer'];
$sid = $_SESSION['id'];

if(isset($nid)){
	$nutzer = mysql_query("SELECT name, DATE_FORMAT (regdatum, '%d.%m.%Y') AS regdatum, DATE_FORMAT (letzterlogin, '%H:%i:%S, %d.%m.%Y') AS letzterlogin FROM nutzer WHERE id = '".$nid."'");
	$profil = mysql_query("SELECT nachname, vorname, geschlecht, beziehung, DATE_FORMAT (geburtsdatum, '%d.%m.%Y') AS geburtsdatum FROM profil WHERE id = '".$nid."'");
	$editable = 0;
}
else{
	$nutzer = mysql_query("SELECT name, DATE_FORMAT (regdatum, '%d.%m.%Y') AS regdatum, DATE_FORMAT (letzterlogin, '%H:%i:%S, %d.%m.%Y') AS letzterlogin FROM nutzer WHERE id = '".$sid."'");
	$profil = mysql_query("SELECT nachname, vorname, geschlecht, beziehung, DATE_FORMAT (geburtsdatum, '%d.%m.%Y') AS geburtsdatum FROM profil WHERE id = '".$sid."'");
	$editable = 1;
}

$profil = mysql_fetch_array($profil);
$nutzer = mysql_fetch_array($nutzer);

switch($profil['geschlecht']){
	case 0:
	$geschlecht = "Nicht angegeben";
	break;
	case 1:
	$geschlecht = "M&auml;nnlich";
	break;
	case 2:
	$geschlecht = "Weiblich";
	break;
	case 3:
	$geschlecht = "Zwitter";
	break;
}
if($editable)$id=$sid;
	else $id=$nid;
if(file_exists("nutzerbilder/".$id.".jpg")){
	echo "<a href=\"nutzerbilder/".$id.".jpg\"><img class=\"bild\" src=\"nutzerbilder/".$id.".jpg\" height=200px alt=\"Hier sollte ein Nutzerbild zu sehen sein\"></a><br>";
}
else{
	echo "<img class=\"bild\" src=\"bilder/Standard.png\" alt=\"Warum fehlt das Standard Bild?\"><br>";
}
echo "<div class=\"profil_info\"><table>";
echo "<tr><td class=\"profil_nenner\">Nutzer:</td><td> ".$nutzer['name']."</td></tr>";
if($profil['nachname']!="")echo "<tr><td class=\"profil_nenner\">Nachname:</td><td> ".$profil['nachname']."</td></tr>";
if($profil['vorname']!="")echo "<tr><td class=\"profil_nenner\">Vorname:</td><td> ".$profil['vorname']."</td></tr>";
if($profil['geschlecht']!="")echo "<tr><td class=\"profil_nenner\">Geschlecht:</td><td> ".$geschlecht."</td></tr>";
if($profil['geburtsdatum']!="00.00.0000")	echo "<tr><td class=\"profil_nenner\">Geburtstag:</td><td> ".$profil['geburtsdatum']."</td></tr>";
if($profil['beziehung']!="")	echo "<tr><td class=\"profil_nenner\">Beziehung:</td><td> ".$profil['beziehung']."</td></tr>";
echo "<tr><td class=\"profil_nenner\">Registriert am:</td><td> ".$nutzer['regdatum']."</td></tr>";
echo "<tr><td class=\"profil_nenner\">Zuletzt eingeloggt:</td><td> ".$nutzer['letzterlogin']."</td></tr>";
echo "</table>";
if($editable==1)
{
	echo "<br><a href=\"#\" onclick='lade(\"profil_bearbeiten.php\")'>Profil Bearbeiten</a></div>";
	$sql = mysql_query("SELECT DATE_FORMAT (datum, '%H:%i:%S, %d.%m.%y') AS datum, id, nachricht FROM blog WHERE von=".$sid." ORDER BY id DESC");
}
if($editable==0)
{
	echo "<br><a href=\"#\" onclick=\"lade('nachricht_senden.php?an=".$nutzer['name']."');\">Nachricht schreiben</a></div>";
	$sql = mysql_query("SELECT DATE_FORMAT (datum, '%H:%i:%S, %d.%m.%y') AS datum, id, nachricht FROM blog WHERE von=".$nid." ORDER BY id DESC");
}
for($i=1;$i<=mysql_num_rows($sql);$i++) {
	$row = mysql_fetch_array($sql);
	$likes = mysql_num_rows(mysql_query("SELECT id FROM `like` WHERE postid = '".$row['id']."';"));
	$dislikes = mysql_num_rows(mysql_query("SELECT id FROM `dislike` WHERE postid = '".$row['id']."';"));
	$nachricht = nl2br($row['nachricht']);
	$modulo = ($i%3)+1;
	echo "<br><br><div class=\"message".$modulo."\">";
	echo $nachricht."<br>";
	echo "</div>";
	if($i%2 == 0)
	{
		echo "<div style=\"text-align:left;font-size:10px;\">".$nutzer['name']." - ".$row['datum'];
		if($editable==0)
		{
			echo "<img src=\"bilder/mag.png\" height=14px onclick=\"like(".$row['id'].");lade('profil.php?nutzer=".$nid."');\"> <img src=\"bilder/mag_nicht.png\" onclick=\"dislike(".$row['id'].");lade('profil.php?nutzer=".$nid."');\" height=14px>Das gef&auml;llt ".$likes." Usern und ".$dislikes." nicht.";
		}
		echo "</div>";
	}
	else
	{
		echo "<div style=\"text-align:right;font-size:10px;\">".$nutzer['name']." - ".$row['datum'];
		if($editable==0)
		{
			echo "<img src=\"bilder/mag.png\" height=14px onclick=\"like(".$row['id'].");lade('profil.php?nutzer=".$nid."');\"> <img src=\"bilder/mag_nicht.png\" onclick=\"dislike(".$row['id'].");lade('profil.php?nutzer=".$nid."');\" height=14px>Das gef&auml;llt ".$likes." Usern und ".$dislikes." nicht.";
		}
		echo "</div>";
	}
}

mysql_close();
?>