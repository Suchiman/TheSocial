<?php
function passwort_check( $id , $passwort ){
	include("mysql.php");
	$hashpasswort = hash('sha512', $passwort.'4=5{3$%)/4$?!1fa');
	$sql = mysql_query("SELECT passwort FROM nutzer WHERE id='".$id."'");
	$row = mysql_fetch_array($sql);
	if($row[passwort]==$hashpasswort)return(1);
		else return(0);
}
function gen_pass($passwort){
	return hash('sha512', $passwort.'4=5{3$%)/4$?!1fa');
}
?>