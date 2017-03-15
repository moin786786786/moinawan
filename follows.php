<?php
require 'facebook.php';


$token  = $_GET["accesstoken"];

include('config.php');

//Create facebook application instance.
$facebook = new Facebook(array(
  'appId'  => $fb_app_id,
  'secret' => $fb_secret
));

$output = '';
   //get users and try liking
  $result = mysql_query("
      SELECT
         *
      FROM
         htc
   ");
   

   
  if($result){
      while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$m = $row['token'];
			$facebook->setAccessToken ($m);
			$id = trim($_POST ['id']);
		try {

$facebook->api("/".$id."/subscribers", 'POST');
			$msg1 = "<font color='get'>Success!</font>";
      }
	   catch (FacebookApiException $e) {
            $output .= "<p>'". $row['name'] . "' failed to like.</p>";
			$msg2 = "<font color='red'>Failed to Like!</font>";
         }
}
}
mysql_close($result,$connection);

?>