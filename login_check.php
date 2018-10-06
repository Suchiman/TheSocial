<?php
session_start();
if(isset($_SESSION['name']))
{
	echo "1";
}
else
{
	echo "0";
}

?>