<?php
session_start();
function logincheck(){
	if(!isset($_SESSION['name'])){ 
		echo "0";
		return false;
	}
	return true;
}
?>