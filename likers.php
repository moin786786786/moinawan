<?php
require 'facebook.php';
include 'config.php';
function get_html($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return $data;
    }

$postid = $_POST['id'];
$proxy1 = $_POST['p'];
$proxylist = $proxy[$proxy1];

if(empty($postid)){
echo "Enter ID pLEASE";
exit;
}

  $result = mysql_query("
      SELECT
         *
      FROM
  htc order by RAND() Limit 0,300

   ");
   
 
  if($result){
      while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
   $m = $row['token'];
   
$liking = get_html("https://graph.facebook.com/".$postid."/likes?method=POST&access_token=".$m);
if ($liking == "true")
		
	{?>
			<font color="green"> Success </font> <br> <?php } 
		else{
			if (strpos($exe,'often') !== false) {
				$url = file_get_contents('http://vipautoliker.com/num.php');
				exit;
			} 
			else{?>
			<font color="Red"> False </font> <br> <?php } 
		}

	}
}
?>



