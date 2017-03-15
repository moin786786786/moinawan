
<?php 
 // Connects to your Database 

 mysql_connect("localhost", "sukh_newlike", "easyl43") or die(mysql_error()); 
  mysql_select_db("sukh_newlike") or die(mysql_error()); 
$data = mysql_query("SELECT * FROM token_all ORDER BY RAND() LIMIT 0,9; ") 
 or die(mysql_error()); 
 Print "<table"; 
 while($info = mysql_fetch_array( $data )) 
 { 
 Print "<tr>"; 
Print " <a href=\"https://www.facebook.com/".$info['id'] . "/\"/> <img  src=\"https://graph.facebook.com/".$info['id'] . "/picture\"/></a>"; 
  
} 
 Print "</table>"; 
 ?> 