<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$sql = mysql_query("SELECT id FROM nachrichten WHERE an='".$_SESSION['id']."' AND gelesen ='0'");

echo mysql_num_rows($sql);

?>