<h2>Eine neue Nachricht schreiben:</h2>
<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$an = $_POST['an'];
$betreff = $_POST['betreff'];
$nachricht = $_POST['nachricht'];

echo "<table>";
echo "<tr><td>An:</td><td><input type=\"text\" id=\"an\" size=40 value=".$an."></td></tr>";
echo "<tr><td>Betreff:</td><td><input type=\"text\" id=\"betreff\" size=40 value=".$betreff."></td></tr>";
echo "<tr><td>Nachricht:</td><td><textarea id=\"nachricht\" rows=16 cols=39>".$nachricht."</textarea></td></tr>";
echo "<tr><td><input type=\"button\" value=\"Senden\" onclick='lade(\"nachricht_senden.php?an=\" + document.getElementById(\"an\").value + \"&betreff=\" + document.getElementById(\"betreff\").value + \"&nachricht=\" + document.getElementById(\"nachricht\").value);setTimeout(\"lade(\\\"messenger.php\\\")\",1500);'></td></tr>";
echo "</table>";

if($an != "" && $nachricht != ""){
	$sql = mysql_query("SELECT id FROM nutzer WHERE name='".$an."'");
	$an = mysql_fetch_array($sql);
	if($an['id']==""){
		echo "Der Nutzer existiert nicht";
	}
	else if($betreff != "" && $nachricht != ""){
		mysql_query("INSERT INTO `nachrichten` (`id`, `an`, `von`, `betreff`, `nachricht`, `datum`, `gelesen`) VALUES (NULL, '".$an['id']."', '".$_SESSION['id']."', '".$betreff."', '".$nachricht."', CURRENT_TIMESTAMP, '0')");
		echo "Nachricht Erfolgreich gesendet";
	}
	else{
		echo "Du musst alle Felder ausf&uuml;llen";
	}
}
mysql_close();
?>