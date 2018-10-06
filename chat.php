<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
echo "<div class=\"chatcontainer\">";
echo "<textarea readonly id=\"chatbox\" cols=110 rows=24></textarea>";
echo "<br><br>";
echo "Nachricht: <input id=\"chat_message\" type=\"text\" onkeypress=\"senden(event)\">";
echo "</div>";
?>