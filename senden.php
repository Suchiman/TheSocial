<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

mysql_query("INSERT INTO `chat` (`id`, `von`, `nachricht`, `datum`) VALUES (NULL, '".$_SESSION['id']."', '".$_POST['nachricht']."', CURRENT_TIMESTAMP)")
?>