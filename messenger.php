<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$sql = mysql_query("SELECT id, von, betreff, DATE_FORMAT (datum, '%H:%i:%S, %d.%m.%Y') AS datum, gelesen FROM nachrichten WHERE an='".$_SESSION['id']."'");
echo "<table>";
echo "<tr>";
echo "<td><h3>Von:</h3></td>";
echo "<td><h3>Betreff:</h3></td>";
echo "<td><h3>Empfangen:</h3></td>";
echo "<td></td>";
echo "</tr>";

for($i=1;$i<=mysql_num_rows($sql);$i++) {
	$row = mysql_fetch_array($sql);
	$id = $row['id'];
	$betreff = $row['betreff'];
	$datum = $row['datum'];
	$absender = mysql_query("SELECT name FROM nutzer WHERE id='".$row[von]."'");
	$von = mysql_fetch_array($absender);
	$von = $von['name'];
	if($row['gelesen']==0){
		echo "<tr style='color:#FFFF00'>";
		echo "<td>".$von."</td>";
		echo "<td><a href=\"#\" onclick='lade(\"nachricht_lesen.php?nachricht=".$id."\")'>".$betreff."</a></td>";
		echo "<td>".$datum."</td>";
		echo "<td><a href=\"#\" onclick='lade(\"nachricht_loeschen.php?nachricht=".$id."\")'>L&ouml;schen</a></td>";
		echo "</tr>";
	}else{
		echo "<tr>";
		echo "<td>".$von."</td>";
		echo "<td><a href=\"#\" onclick='lade(\"nachricht_lesen.php?nachricht=".$id."\")'>".$betreff."</a></td>";
		echo "<td>".$datum."</td>";
		echo "<td><a href=\"#\" onclick='lade(\"nachricht_loeschen.php?nachricht=".$id."\")'>L&ouml;schen</a></td>";
		echo "</tr>";
	}
}
echo "</table>";
echo "<br><br><br>";
echo "<a href=\"#\" onclick='lade(\"nachricht_senden.php\")'>Nachricht Senden</a>";
?>