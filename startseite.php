<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include("mysql.php");
$mysql = mysql_query("SELECT * FROM nutzer");
$row = mysql_fetch_array($mysql);
if($_POST['text'] != "")mysql_query("INSERT INTO `blog` (`id`, `von`, `nachricht`, `datum`) VALUES (NULL, '".$_SESSION['id']."', '".$_POST['text']."', CURRENT_TIMESTAMP)");
$sql = mysql_query("SELECT DATE_FORMAT (datum, '%H:%i:%S, %d.%m.%y') AS datum, nachricht FROM blog WHERE von=".$_SESSION['id']." ORDER BY id DESC");
echo '<center>Poste etwas: <br><textarea id="text" cols=60 rows=4></textarea><br><input type="button" value="Absenden" onclick="lade(\'startseite.php?text=\'+document.getElementById(\'text\').value)"></center>';
for($i=1;$i<=mysql_num_rows($sql);$i++)
{
	$row = mysql_fetch_array($sql);
	$nachricht = nl2br($row['nachricht']);
	$modulo = ($i%3)+1;
	echo "<br><br><div class=\"message".$modulo."\">";
	echo $nachricht."<br>";
	echo "</div>";
	if($i%2 == 0)
	{
		echo "<div style=\"text-align:left;font-size:10px;\">".$_SESSION['name']." - ".$row['datum']."</div>";
	}
	else
	{
		echo "<div style=\"text-align:right;font-size:10px;\">".$_SESSION['name']." - ".$row['datum']."</div>";
	}
}
?>