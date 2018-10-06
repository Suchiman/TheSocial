<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");
echo 'Suche: <input type="text" id="suche"> <input type="button" value="Suchen" onclick="lade(\'leute.php?suche=\'+document.getElementById(\'suche\').value)"><br>';
if(isset($_POST['suche'])){
	$sql = mysql_query("SELECT id, name FROM nutzer WHERE name LIKE '%".$_POST['suche']."%' ORDER BY name ASC");
	for($i=1;$i<=mysql_num_rows($sql);$i++) {
		$row = mysql_fetch_array($sql);
		echo "<a href=\"#\" onclick=\"lade('profil.php?nutzer=".$row['id']."')\">".$row['name']."</a><br>";
	}
}
?>