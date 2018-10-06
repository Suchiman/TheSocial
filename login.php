<?php
session_start();
include("mysql.php");
$name = $_POST["name"];
$passwort = $_POST["pw"];
include ("pass.php");
if($passwort != "" && $name != ""){
	$sql = mysql_query("SELECT id, name FROM nutzer WHERE name='".$name."'");
	$row = mysql_fetch_array($sql);
	if($row['name']==$name){
		if(passwort_check($row['id'],$passwort)){
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $row['id'];
			mysql_query("UPDATE `nutzer` SET `letzterlogin` = CURRENT_TIMESTAMP WHERE `nutzer`.`id` = '".$row[id]."'");
			include("startseite.php");
		}
		else{
			echo "Falsches Passwort!";
		}
	}
	else{
		echo "Diesen Benutzer gibt es nicht!";
	}
}
else{
	echo "Fehler! Pr&uuml;fe nocheinmal deine Eingaben";
}
mysql_close();
?>