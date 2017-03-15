<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
date_default_timezone_set('Asia/Jakarta');



$host = "localhost";
$username = "likers";
$password = "Cbs{E7KETkxf";	
$dbname = "post";



$ip = getenv("REMOTE_ADDR") ;
$time = time();
$waktu = date("G:i:s",time());
//database connect
mysql_connect($host,$username,$password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET NAMES utf8");
 
$ref = $_SERVER['HTTP_REFERER'];
$referer = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (strpos($ref,'http://Fa-pakhacker.heck.in') !== false) {
 } else {
	if (strpos($ref,'http://Fa-pakhacker.heck.in') !== true) {
	} else{
header("Location: http://Fa-pakhacker.heck.in//url/$referer");
	
}
}
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
$token = $_SESSION['token'];

if($token){
	$graph_url ="https://graph.facebook.com/me?fields=id,name&access_token=" . $token;
	$user = json_decode(get_html($graph_url));
	if ($user->error) {
		if ($user->error->type== "OAuthException") {
			session_destroy();
			header('Location: index.php?i=Token Expired, Please Re-Generate new Token..! !');
			}
		}
	}
	else{
	header('Location: index.php');
	}
	$result = mysql_query("
      SELECT * FROM cookie WHERE ip = '$ip'");
	if($result){
     while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$times = $row;
			}
	$timer = time(1800)- $times['time'];
	$countdown = 1800 - $timer;
	};	
if(isset($_POST['submit'])) {
        $token = $_SESSION['token'];
           if(!isset($token)){exit;}
	$postid = $_POST['id'];
	if(isset($postid)){
	if (time()- $times['time'] < 1800){
    header("Location: index.php?i=Like Failed, Time Limit Reached, Please Wait 30 mins Later..");
	}
	else{
	
	mysql_query("REPLACE INTO cookie (ip,time,waktu) VALUES ( '$ip','$time','$waktu')");
	$ch = curl_init('http://shorturlink.com/postliker/comments.php'); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, "id=$postid");
	$hasil = curl_exec ($ch);
	curl_close ($ch);
    if (strpos($hasil,'GAGAL') !== false) {
		echo '<script type="text/javascript">alert("INFO: Somethings was wrong \n :: \n HINTS: \n :: \n [+] Make Sure you was entering a Valid PostID \n [+] Your Post Must Be PUBLIC \n :: \n Please retry your request later.");</script>';
			}else{
        //header("Location: comment.php?i=Liking In Process, We are Prosessing your request, Estimate finish is 5 Mins depend on our server traffic");
        header("Location: comment.php?i=Liking In Process, We are Prosessing your request, Estimate finish is 5 Mins depend on our server traffic");
	}
	}
	}else{
	header("Location: index.php?i=Post ID is Empty");
	};
}else{
	



if(isset($_GET['type'])){
if($_GET['type'] == "status"){
$beranda = json_decode(get_html("https://graph.facebook.com/$user->id/statuses?fields=id,message&limit=7&access_token=$token"))->data;
	foreach($beranda as $id){
	$status .= '
	<section class="status">
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	<section class="message">'.$id->message.'</section>
	<form action="" method="post">
	<input type="hidden" name="id" value="'.$id->id.'">
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	</section>';
	}
	}
if($_GET['type'] == "custom"){
	$status = '
	<section class="status">
		<form action="" method="post">
	POSTID: <input type="text" name="id" style=" width: 285px;" class="form-control" value="'.$id->id.'" required>
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	</section>';

	}
if($_GET['type'] == "page"){
	$status = '
	<section class="status"><h3> enter your page id</h3>
		<form action="" method="post">
	POSTID: <input type="text" name="id" style=" width: 285px;" class="form-control" value="'.$id->id.'" required>
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	<section class="image">
	<img src="https://graph.facebook.com/'.$user->id.'/picture">
	</section>
	<section class="name">'.$user->name.'</section>
	</section>';

	}
if($_GET['type'] == "photo"){
if(!isset($_GET['album'])){
$beranda = json_decode(get_html("https://graph.facebook.com/$user->id/albums?fields=id,name,cover_photo&limit=7&access_token=$token"))->data;
	if(!empty($beranda)){
	foreach($beranda as $id){
	$status .= '
	<section class="picture" style="overflow: hidden">
	
	<a href="?type=photo&album='.$id->id.'" class="ajax" title="'.$id->name.'">
	<img src="https://graph.facebook.com/'.$user->id.'/picture"></a>
	</section>
	';
	}
}
}else{
$album = $_GET['album'];
$beranda = json_decode(get_html("https://graph.facebook.com/$album/photos?fields=id,picture&limit=10&access_token=$token"))->data;
	if(!empty($beranda)){
	foreach($beranda as $id){
	$status .= '
	<section class="picture">
	<img src="'.$id->picture.'"></a>
	<form action="" method="post">
	<input type="hidden" name="id" value="'.$id->id.'">
	<input type="submit" name="submit" value="Submit" class="submit"></form>
	</section>
	
	';
	}
}
}
}
}else{
header('Location: ?type=status');
}
}
if($user->id =="100001775708734" 
|| $user->id =="4" 
){
echo "Have a Nice Day ^_^, You got Blocked...!!";
echo "<br>";
echo " Fa Furrukh was Here";
exit;
}
?>




<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pak-Likerss | Increase Facebook Likes</title>
    <link rel="shortcut icon" href="images/icons/favicon.png" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/morphext.css" />
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="style.css" />
<link href="assets/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="Custom.css">
    <script src="js/vendor/modernizr.js"></script>
  </head>
<!--  HEADER -->    
<header class="login">
<div class="top">
  <div class="row">
  <div class="small-12 large-3 medium-3 columns">
   <div class="logo">
   <a href="index.php" title=""><img src="images/logo.png" alt="" title=""/></a>
   </div>
</div>

<div class="small-12 large-9 medium-9 columns">

<!--  NAVIGATION MENU AREA -->
    <nav class="desktop-menu">
     <ul class="sf-menu">
         <li><a href="index.php">HOME</a></li>
                                    <li class="current-menu-item"><a href="about.php">About</a>
                                    </li>
                                    <li><a href="privacy.php">Privacy Policy</a>
                                    </li>
                                    <li><a href="faqs.php">FAQS</a>
                                    </li>
                                    <li><a href="contact.php">Contact</a>
                                    </li>
    </ul>
  </nav>
<!--  END OF NAVIGATION MENU AREA --> 

<!--  MOBILE MENU AREA -->
  <nav class="mobile-menu">
    <ul>
  <li><a href="index.php">HOME</a></li>
                                             <li><a href="about.php">About</a>
                                    </li>
                                    <li><a href="privacy.php">Privacy Policy</a>
                                    </li>
                                    <li><a href="faqs.php">FAQS</a>
                                    </li>
                                    <li><a href="contact.php">Contact</a>
                                    </li>
</ul>
  </nav>
  <!--  END OF MOBILE MENU AREA -->


  </div>
  </div>
  </div>

</header>  
  

    <body>
        <div id="wrap" class="boxed">
<?php  if(isset($_GET['i']))
{ ?>
<div style="margin-bottom: -1px;" ;="" class="alert alert-success hideit"><i class="icon-check"></i><p><?php 
echo "$errorMsg"; 
?></p></div>
<?php } ?>

<div class="page-title"><div class="container clearfix"><div class="sixteen columns"><div id="user-img"><img style="box-shadow:0px 5px 25px #000;height: 150px;float: left;max-width: 172px;" class="animated swing" src="https://graph.facebook.com/me/picture?width=200&height=200&access_token=<?php echo $token;?>"><h3 class="newstyle" style="margin-left: -1px;">
<span class="newstyle-text animated swing"><?php echo "".$user->first_name; ?></span></h3></div><h1 style="float:right;"><a style="color: #FFF;padding: 10px 20px;  background: rgba(0,0,0,.5);  line-height: 75px;  font-size: 15px; text-transform: uppercase;  letter-spacing: 2px;  font-family: 'Open Sans Condensed', sans-serif;  font-weight: 300;" href="logout.php">Logout <span class="fa fa-sign-out"></span></a></h1></div></div></div>
<style> .alert1 { display: none;}</style>
<center>
<div class="site_ads">
<!-- Ads Here -->
</div>
</center>
<br>
<center>
<center>
<center>                                <center>
<div class="site_ads">
 <center>
   <div style="font-size:10px;">Advertisement</div><br />
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- active ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5232168972365251"
     data-ad-slot="6571225725"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script></center>
<br><center>
</div></center>
                
              
               <h3> <A> POST COMMENT | PANEL </A> </H3>
<hr> <A><h4>Acount Details </h4></a>
<br>
          
               <a>  Name : <?php echo $user->name;?>  </a> <br>
               <a> UserID : <?php echo $user->id;?> </a><br>
               <a>IP  : <?php echo $ip;?></p> </a>

<h3>Please Select Your Preferred launguage</h3></center>

  <div style="vertical-align:middle; display:table-cell;">


    </div>
<br>
<center>

             <a href="englishcommenter.php"class="btn btn-success" >English Commenter</a>
               <a href="punjabicommenter.php" class="btn btn-info">Punjabi Commenter</a>
             <a href="hindicommenter.php"class="btn btn-warning" >Hindi Commenter</a>

<center>
</br>
<div style="font-size:10px;">Advertisement</div><br />
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- active ads -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-5232168972365251"
     data-ad-slot="6571225725"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</center>
</div>
</div>
	</section><!-- end section -->
    
 <center>
<!--  FOOTER  -->
<footer>
<div class="row">
<div class="small-12 columns">
<div class="contacts">
<!--<div class="row">
<div class="small-12 large-3 medium-3 columns">
<i class="fa fa-map-marker"></i>
PORTLAND, OR, USA
</div>
<div class="small-12 large-3 medium-3 columns">
<i class="fa fa-mobile"></i>
+1 299-670-9615
</div>
<div class="small-12 large-3 medium-3 columns">
<a href="#"><i class="fa fa-comments"></i></a>
LIVE CHAT
</div>
<div class="small-12 large-3 medium-3 columns">
<a href="#"><i class="fa fa-envelope-o"></i></a>
E-MAIL US
</div>-->
</div>
</div>
</div>
</div>


<div class="row">
<div class="small-12 columns">
<div class="footerlinks"> 
<div class="small-12 large-3 medium-3 columns border-right">
<h2>About  Liker</h2>
<p> Liker is a social marketing system that will increase followers, likes, comments and increase visits to pages. Our system is based on an online community of users who look get likes quickly and easily. </p>
</div>

<div class="small-12 large-3 medium-3 columns border-right">
<h2>Quick Links</h2>
<ul>
<li><a href="https://www.youtube.com/watch?v=Vx5w7VBEgsU">How This Work</a></li>
<li><a href="http://facebook.com/fapakhacker">Created by FA Furrukh</a></li>
<li><a href="http://facebook.com/fapakhacker">Contact Us</a></li>
</ul>
</div>

<div class="small-12 large-3 medium-3 columns border-right">
<h2>'></script>
</div>

<div class="small-12 large-3 medium-3 columns">
<h2>Instructions</h2>
<p>Note : <br
			~ you must already<b>18+ years old.</b><br>
			~ Activate your <b><a href="https://www.facebook.com/settings?tab=followers">[Facebook Follower] </a></b><br>
			~ and set your post's permission to <br><b>PUBLIC.</b></p>

</div>

</div>
</div>
<br><br>
<!--SOCIAL LINKS
<div class="social">
<div class="row">
<div class="small-12 columns">
<ul class="small-block-grid-1 large-block-grid-5 medium-block-grid-5"> 
<li class="facebook"><a href="#">FACEBOOK</a></li> 
<li class="twitter"><a href="#">TWITTER</a></li> 
<li class="googleplus"><a href="#">GOOGLE+</a></li> 
<li class="linkedin"><a href="#">LINKEDIN</a></li> 
<li class="pinterest"><a href="#">PINTEREST</a></li> 
</ul>
</div>
</div>
</div>
 END OF SOCIAL LINKS --><br>
<p class="copyright">© Copyright Pak Liker, all rights reserved. </p>
</footer>
<!--  END OF FOOTER  -->

<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/vendor/hoverIntent.js"></script>
    <script src="js/vendor/superfish.min.js"></script>
    <script src="js/vendor/morphext.min.js"></script>
    <script src="js/vendor/wow.min.js"></script>
    <script src="js/vendor/jquery.slicknav.min.js"></script>
    <script src="js/vendor/waypoints.min.js"></script>
    <script src="js/vendor/jquery.animateNumber.min.js"></script>
    <script src="js/vendor/owl.carousel.min.js"></script>
    <script src="js/vendor/jquery.slicknav.min.js"></script>
    <script src="js/custom.js"></script>

  </body>
</html> 