<?php session_start; 
$query = $_SERVER['QUERY_STRING'];
include('database-info.php');
if (strpos($query,'name=') !== false) {
    
}
else{
    echo('<script> window.open("index", _self)');
}
?>
<!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<?php echo "<title> $username </title>" ?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
			</header>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1><a href="#"><img src="images/logo2.png"></a></h1>
					<p>The simplest way to request songs</p>
					<?php 
                    ?>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<header class="major">
					<h2>PlayIt4Me</h2>
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
						</div>
					</div>
			</section>

	</body>
</html>