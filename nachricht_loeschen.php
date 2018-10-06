<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$nachricht = $_POST['nachricht'];
$sql = mysql_query("SELECT an FROM nachrichten WHERE id = '".$nachricht."'");
$row = mysql_fetch_array($sql);

if($_SESSION['id']==$row['an']){
	mysql_query("DELETE FROM nachrichten WHERE id = '".$nachricht."'");
	echo "Nachricht erfolgreich gel&ouml;scht";
	include("messenger.php");
}
else{
	echo "Halt Stop, du darfst nicht die Nachricht eines anderen zu L&ouml;schen";
}

mysql_close();
?>