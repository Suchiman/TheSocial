<?php
$name = $_POST["name"];
$passwort = $_POST["pw1"];
$passwort2 = $_POST["pw2"];
$email = $_POST["email"];

include("mysql.php");
include("pass.php");

if($passwort == $passwort2 && $name != ""){
	$hashpasswort = gen_pass($passwort);
	$sql = mysql_query("SELECT name FROM nutzer WHERE name='".$name."'");
	$row = mysql_fetch_array($sql);
	if($row[name]==$name){
		echo "Der Nutzername existiert bereits, sry";
	}
	else{
		mysql_query("INSERT INTO `nutzer` (`id`, `name`, `passwort`, `email`, `regdatum`) VALUES (NULL, '".$name."', '".$hashpasswort."', '".$email."', CURRENT_TIMESTAMP)");
		$sql = mysql_query("SELECT id FROM nutzer WHERE name='".$name."'");
		$row = mysql_fetch_array($sql);
		mysql_query("INSERT INTO `profil` (`id`, `nachname`, `vorname`, `geschlecht`, `beziehung`, `geburtsdatum`) VALUES ('".$row[id]."', '', '', '', '', '')");
		echo "Registrierung erfolgreich abgeschlossen! Willkommen bei the social<br>";
		echo 'Du kannst dich jetzt Rechts oben einloggen';
	}
}
else{
	echo "Fehler! Pr&uuml;fe nocheinmal deine Eingaben";
}
?>