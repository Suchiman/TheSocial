<?php
session_start();
include("konfiguration.php");
mysql_connect($mysql_server,$mysql_nutzer,$mysql_passwort);
mysql_select_db("thesocial");
?>