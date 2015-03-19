<?php session_start; 
require_once 'Mobile-Detect-2.8.12/Mobile_Detect.php';
$detect = new Mobile_Detect;

?>
<!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>DJ For Us</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
<!--		<script src="js/skel-layers.min.js"></script>-->
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1><a href="#"><img src="images/logo2.png" width="50%" height="100%"></a></h1>
					<p>The simplest way to request songs</p>
					<?php 
                    if($_SESSION['loggedin'] == false) {
                        echo('<ul class="actions">
						<li><a href="#content" class="button big special">Sign Up</a></li>
						<li><a href="#content" class="button big special">log in</a></li>
					</ul>');
                        
                    }
                    else{
                        echo('<p>Welcome, ' . $_SESSION['username'] . '</p>
                        <br>
                        <li><a href="#content" class="button big special">My Profile</a></li>');
                    }
                    if(!$detect->isMobile() || !$detect->isTablet()){
                        echo '<p>It seems as if you are accessing this site from a non-mobile device. Keep in mind this is developed for mobile devices.</p>';
                    }
                    ?>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<header class="major">
					<h2>INSERT NAME HERE</h2>
					<p>The easiest way to interact with your crowd</p>
				</header>
				<div class="container">
					<div class="row">
						<div class="4u">
							<section class="special box">
								<i class="icon fa-area-chart major"></i>
								<h3>no apps</h3>
								<p>Don't force your audience to download apps in order to use the service. Just give them your URL, and let the song request flood in!</p>
							</section>
						</div>
						<div class="4u">
							<section class="special box">
								<i class="icon fa-refresh major"></i>
								<h3>simple</h3>
								<p>Don't want to play a song? Simply press the Remove button and poof! It's gone!</p>
							</section>
						</div>
						</div>
					</div>
			</section>

	</body>
</html>