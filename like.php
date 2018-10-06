<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;
include ("mysql.php");

$postid = $_POST['id'];
$userid = $_SESSION['id'];
$like = $_POST['like'];
if($like=='y')
{
	$dislike_check = mysql_query("SELECT id FROM `dislike` WHERE userid = '".$userid."' AND postid = '".$postid."';");
	if(mysql_num_rows($dislike_check) > 0)
	{
		$dislike_id = mysql_fetch_array($dislike_check);
		mysql_query("DELETE FROM `dislike` WHERE (`id`='".$dislike_id['id']."')");
	}
	$sql = mysql_query("SELECT id FROM `like` WHERE userid = '".$userid."' AND postid = '".$postid."';");
	if(mysql_num_rows($sql) > 0)
	{
		return 0;
	}
	else
	{
		mysql_query("INSERT INTO `like` (`userid`, `postid`) VALUES ('".$userid."', '".$postid."')");
	}
}
if($like=='n')
{
	$like_check = mysql_query("SELECT id FROM `like` WHERE userid = '".$userid."' AND postid = '".$postid."';");
	if(mysql_num_rows($like_check) > 0)
	{
		$like_id = mysql_fetch_array($like_check);
		mysql_query("DELETE FROM `like` WHERE (`id`='".$like_id['id']."')");
	}
	$sql = mysql_query("SELECT id FROM `dislike` WHERE userid = '".$userid."' AND postid = '".$postid."';");
	if(mysql_num_rows($sql) > 0)
	{
		return 0;
	}
	else
	{
		mysql_query("INSERT INTO `dislike` (`userid`, `postid`) VALUES ('".$userid."', '".$postid."')");
	}
}
?>