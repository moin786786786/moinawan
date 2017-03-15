<?
$host = "localhost";
$username = "autoreue_react";
$password = "8&l7m?*j";
$dbname = "autoreue_react";
$connection = mysql_connect($host,$username,$password);
if (!$connection)
{
die('SQL ERROR HY MERI JAAN SAHEE LAGA DB WARNA L MERA CHALY GI SITE :D BC :* CSDL: ' . mysql_error());
}
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8");
?>