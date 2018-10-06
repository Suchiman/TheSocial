<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$lines = 24;
$sql = mysql_query("SELECT von, nachricht, DATE_FORMAT (datum, '%H:%i:%S') AS datum FROM chat ORDER BY id DESC LIMIT ".$lines);
for($i=1;$i<=mysql_num_rows($sql);$i++)
{
	$row = mysql_fetch_array($sql);
	$name = mysql_query("SELECT name FROM nutzer WHERE id=".$row['von']);
	$name = mysql_fetch_array($name);
	$invert[$i] = $row['datum']." ".$name['name'].": ".$row['nachricht']."\n";
}
for($i=$lines;$i>=1;$i--)
{
	echo $invert[$i];
}
?>