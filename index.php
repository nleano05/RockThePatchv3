<?php
	session_save_path('/tmp');
	
	include("php-main/lib.php");
	include("php-main/cookie.php");
	
	$timeModified = gmdate("F d, Y h:m:s", getlastmod());
?>
<!DOCTYPE html>
    <!-- ### Sets the class and language for IE 7,8, and 9 ### -->
	<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
	<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
	<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
	<!--[if (gte IE 9)|!(IE)]><!--><html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->

	<!-- ### Sends users with a older version of IE to a page so they can update ### -->
	<!--[if lt IE 7]>
		<meta http-equiv="refresh" content="0; url=https://www.rockthepatch.com/update-browser.php">
	<![endif]-->
	
	<!-- ### START Head ### -->
	<head>
		<!-- ### Basic Page Needs and Meta Data ### -->
		<title>Rock the Patch! - Home Page</title>
		<meta name="robots" content="all" /> 
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
		<meta name="description" content="Rock the Patch! Musician, Programmer, Artist, and More"/>		
		<meta name="author" content="Patches" />
		<meta name="keywords" content="patches, xhtm 1.1, html5, xhtml5, rss, css3, xsl(T), programmer, rock the patch, writer, artist, musician, mobile"/>
		
		<!--[if lt IE 9]>
			<!--suppress JSUnresolvedLibraryURL -->
			<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- ### Mobile Specific Meta Needs ###-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<!-- ### CSS Imports ### -->
		<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="/css/adjust.css" type="text/css" media="all"/>
		<link rel="stylesheet" href="/css/print.css" type="text/css" media="print"/>

		<!-- ### Style Adjustments for IE 7 ### -->
		<!--[if IE 7]>
			<style>
				#nav-bar ul li{display:inline;}
				#nav-bar ul li:hover ul{position:absolute;margin-top:34px;margin-left:-171px;}
				#user-nav ul li{display:inline;}
			</style>
		<![endif]-->
		
		<!-- ### Favicons ### -->
		<link rel="shortcut icon" href="/images/icons-and-logos/favicon.ico"/>
	    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon.png"/>
	    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon-72x72.png"/>
	    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon-114x114.png"/>
		
		<!-- ### JQuerey Imports ###, JSUnresolvedLibraryURL, JSUnresolvedLibraryURL -->
		<!--suppress JSUnresolvedLibraryURL -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<!-- ### Common Javascript Library Imports ### -->
		<script type="text/javascript" src="/js/lib.js"></script>
		<script type="text/javascript" src="/js/lib-autoformat.js"></script>
		<script type="text/javascript" src="/js/lib-gallery.js"></script>
		<script type="text/javascript" src="/js/lib-get.js"></script>
		<script type="text/javascript" src="/js/lib-populate.js"></script>
		<script type="text/javascript" src="/js/lib-sync.js"></script>
		<script type="text/javascript" src="/js/lib-toggle.js"></script>
		
		<!-- ### Javascript to preload images on the page ### -->
		<script type="text/javascript">
			// TODO - re-enable this once I have an images and stuff again
			// var additionalImages = new Array(
					// "/images/index-slide-show/computer.jpg",
					// "/images/index-slide-show/computer2.jpg",
					// "/images/index-slide-show/drums.jpg",
					// "/images/index-slide-show/guitars.jpg",
					// "/images/index-slide-show/guitars2.jpg",
					// "/images/index-slide-show/training.jpg"
			// );
			
			// preloadImages(additionalImages);
		</script>
		
		<!-- ### Javascript for the Slide Show / Gallery on the main page  -->
		<script type="text/javascript">
			// TODO - Re-enable this once I have images and a slide show again
			// $(document).ready(function() 
			// {		
				// galleryDisplay();
			// });
		</script>
	</head>
	<!-- ### END Head ### -->
	<!-- ### START Body ### -->
	<body>
		<!-- ### START container ### -->
		<div class="container">
			<!-- ### START header ### -->
			<div id="header">
				<!-- ### START banner-image ### -->
					<!-- TODO - Re-enable this -->
					<!-- <div id="banner-image"><img src="images/banner.png" title="Banner Image" alt="Banner Image" style="width:100%;height:100%;"/></div> -->
				<!-- ### END banner-image ### -->
				<!-- ### START site-nav -->
				<div id="site-nav">
					<!-- ### START nav-bar ### -->
					<div id="nav-bar">
						<?php include("inc/nav-bar.php"); ?>
						<!-- Script to display the current page in the navigation -->
						<script type="text/javascript">
							// TODO - Re-enable this once I have a nav bar again
							//document.getElementById("home").className  = "current";
						</script>
					</div>
					<!-- ### END nav-bar ### -->
					<!-- ### START user-nav ### -->
					<div id="user-nav">
						<?php include("inc/user-nav.php"); ?>
					</div>
					<!-- ### END user-nav ### -->
				</div>
				<!-- ### END site-nav -### -->
			</div>
			<!-- ### END header ### -->
			<!-- ### START content-area-left ### -->
			<div id="content-area-left">
				<!-- ### START login-mobile ### -->
					<div id="login-mobile">
						<?php include("inc/login.php"); ?>
					</div>
				<!-- ### END login ### -->
				<!-- ### START recent-updates ### -->
				<div id="recent-updates">
					<h1>Recent Updates</h1>
					
					<h2 style="text-align:center;">Winter Cleaning</h2>
					
					<p>
						I haven't posted a recent update on here for a very long time.  I am still actively
						working on this site if you couldn't tell by the 'Last Updated' time stamp in the
						footer of every page.  It's been slow going and no really new or cool features have
						been worked on as of recent...
						<em><a href="/recent-updates-log.php" title="Recent Updates Log">...continue reading</a></em>					
					</p>

					<p><strong>Date Posted:</strong> 02/01/2014</p>
					
					<p><em><a href="/recent-updates-log.php" title="Recent Updates Log">Want to see more?</a></em></p>
				</div>
				<!-- ### END recent-updates ### -->
				<!-- ### START error-report ### -->
				<div id="error-report">
					<?php include("inc/error-report.php"); ?>
				</div>
				<!-- ### END error-report ### -->
			</div>
			<!-- ### END content-area-left ### -->
			<!-- ### START content-area ### -->
			<div id="content-area">
				
			</div>
			<!-- ### END content-area ### -->
			<!-- ### START content-area-right ### -->
			<div id="content-area-right">
				<!-- ### START login ### -->
				<div id="login">
					<?php include("inc/login.php"); ?>
				</div>
				<!-- ### END login ### -->
				<!-- ### START error-report-mobile ### -->
				<div id="error-report-mobile">
					<?php include("inc/error-report.php"); ?>
				</div>
				<!-- ### END error-report ### -->
				<!-- ### START feature-request ### -->
				<div id="feature-request">
					<?php include("inc/feature-request.php"); ?>
				</div>
				<!-- ### END feature-request ### -->
				<!-- ### START RSS feed ### -->
				<div id="rss">
					<?php include('inc/rss-index.php'); ?>
				</div>
				<!-- ### END RSS feed ### -->
			</div>
			<!-- ### END content-area-right ### -->
			<!-- ### START Footer ### -->
			<div id="footer">
				<?php include('inc/footer.php'); ?>
				<div id="footer-background"></div>
				<script type="text/javascript">
					var _gaq = _gaq || [];
					_gaq.push(['_setAccount', 'UA-64564354-1']);
					_gaq.push(['_trackPageview']);

					(function() 
					{
						var ga = document.createElement('script'); ga.type = 'text/javascript'; 
						ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
					})();
				</script>
			</div>	
			<!-- ### END Footer ### -->
		</div>
		<!-- ### END Container ### -->
	</body>
	<!-- ### END Body ### -->
</html>