<?php
session_start();
$name = $_SESSION['name'];
session_unset();
session_destroy(); 
echo "Logout Erfolgreich, bis zum n&auml;chsten mal ".$name."<br>";
echo '<a href="#" onclick="lade(\'startseite.php\')">Zur&uuml;ck zur Hauptseite</a>'
?>