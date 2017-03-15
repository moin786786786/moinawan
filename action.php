<?php
ob_start();
session_start();
require("../incfiles/config.php"); 
if ($_POST) 
{
	$type = trim($_POST['reaction']);
	if ($_POST['reaction'] =="tatbot") 
	{
		 @mysql_query("DELETE FROM CamXuc WHERE idfb = '".$_SESSION[idfb]."'");
		 header('Location: ../index.php?i=');
		die();
	}
	elseif ($_POST['capnhat'] == "capnhat") 
	{
		@mysql_query("UPDATE CamXuc SET camxuc = '" . $type . "' WHERE idfb = '".$_SESSION[idfb]."'");
		header('Location: ../index.php?i= ');
		die();
	}
	else
	{
		@mysql_query("INSERT INTO CamXuc SET idfb = '".addslashes($_SESSION[idfb])."', ten = '".addslashes($_SESSION[ten])."', camxuc = '".addslashes($type)."', matoken = '".addslashes($_SESSION[matoken])."'");
		header('Location: ../index.php?i=');
		die();
	}
}
else
{
	die("WELCOM TO AWAN BOTTERX");
}