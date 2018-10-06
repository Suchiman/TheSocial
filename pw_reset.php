<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");
include ("pass.php");
$crypted_pw = gen_pass($_POST['pw']);

$sql = mysql_query("SELECT id FROM `nutzer` WHERE name = '".$_POST['user']."'");
$id = mysql_fetch_array($sql);
mysql_query("UPDATE `nutzer` SET `passwort`='".$crypted_pw."' WHERE (`id`='".$id['id']."')");
ini_set(SMTP, "smtp.live.com ");
ini_set(smtp_port, "587");
ini_set(sendmail_from, "sender@live.de");
$sender = "sender@deinedomain.de";
$empfaenger = "sender@live.de";
$betreff = "Hier kommt eine eMail von $sender";
$mailtext = "Moin Someone!\nIch hoffe Deine eMailAdresse $empfaenger existiert noch.";
mail($empfaenger, $betreff, $mailtext, "From: $sender "); 
?>