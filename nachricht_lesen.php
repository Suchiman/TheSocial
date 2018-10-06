<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$nachricht = $_POST['nachricht'];
$userid = $_SESSION['id'];

$sql = mysql_query("SELECT von, betreff, nachricht, DATE_FORMAT (datum, '%d.%m.%Y um %H:%i:%S') AS datum, gelesen FROM nachrichten WHERE an='".$userid."' AND id='".$nachricht."'");
$row = mysql_fetch_array($sql);
$von = $row['von'];
$betreff = $row['betreff'];
$datum = $row['datum'];
$dbnachricht = nl2br($row['nachricht']);

if(isset($row['von'])){
	mysql_query("UPDATE `nachrichten` SET `gelesen` = '1' WHERE `nachrichten`.`id` = '".$nachricht."'");
	$ab = mysql_query("SELECT name FROM nutzer WHERE id='".$von."'");
	$absender = mysql_fetch_array($ab);
	$von=$absender['name'];

	echo "<div class=\"message1\">";
	echo $dbnachricht;
	echo "<hr>"; #Trennlinie
	echo "<div style=\"text-align:right;font-size:12px;\">geschrieben von ".$von." am ".$datum."</div>";
	echo "</div>";
}
else{
	echo "Hoppala, da ist wohl etwas schiefgelaufen";
}
echo "<br><a href=\"#\" onclick='lade(\"nachricht_senden.php?an=".$von."&betreff=Re:".$betreff."\")'>Antworten</a>";
mysql_close();
?>