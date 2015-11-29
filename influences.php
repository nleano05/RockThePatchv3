<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());
?>
<!DOCTYPE html>
<!-- ### Sets the class and language for IE 7,8, and 9 ### -->
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->

<!-- ### Sends users with a older version of IE to a page so they can update ### -->
<!--[if lt IE 7]>
<meta http-equiv="refresh" content="0; url=/update-browser.php">
<![endif]-->

<!-- ### START Head ### -->
<head>
    <!-- ### Basic Page Needs and Meta Data ### -->
    <title>Rock the Patch! v3 - Influences</title>
    <meta name="robots" content="all"/>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="description" content="Rock the Patch! Musician, Programmer, Artist, and More"/>
    <meta name="author" content="Patches"/>
    <meta name="keywords" content="patches, xhtml 1.1, html5, xhtml5, rss, css3, xsl(T), programmer, rock the patch, writer, artist, musician, mobile"/>

    <!--[if lt IE 9]>
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
    <link rel="stylesheet" href="/css/ie7.css" type="text/css" media="screen"/>
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
        preloadImages();
    </script>
</head>
<!-- ### END Head ### -->
<!-- ### START Body ### -->
<body>
<!-- ### START container ### -->
<div class="container">
    <!-- ### START header ### -->
    <div id="header">
        <!-- ### START site-nav -->
        <div id="site-nav">
            <!-- ### START nav-bar ### -->
            <div id="nav-bar">
                <?php require_once("inc/nav-bar.php"); ?>
                <!-- Script to display the current page in the navigation -->
                <script type="text/javascript">
                    document.getElementById("music-career").className  = "current";
                    document.getElementById("influences").className  = "current";
                </script>
            </div>
            <!-- ### END nav-bar ### -->
            <!-- ### START user-nav ### -->
            <div id="user-nav">
                <?php require_once("inc/user-nav.php"); ?>
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
            <?php require("inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START recent-updates ### -->
        <div id="recent-updates">
            <?php require_once("inc/recent-updates.php"); ?>
        </div>
        <!-- ### END recent-updates ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions">
            <?php require("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
    </div>
    <!-- ### END content-area-left ### -->
    <!-- ### START content-area ### -->
    <div id="content-area">
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Music Career / Influences</div>
        <h1>Influences</h1>

        <h2>Bands</h2>

        <div class="float-left49">
            <p><em>A - M</em></p>
            <ul>
                <li>Atreyu</li>
                <li>Adema</li>
                <li>Breaking Benjamin</li>
                <li>Cartel</li>
                <li>Chevelle</li>
                <li>Cold</li>
                <li>Crossfade</li>
                <li>Disturbed</li>
                <li>Dope</li>
                <li>Drowning Pool</li>
                <li>Egypy Central</li>
                <li>Evanescence</li>
                <li>Flyleaf</li>
                <li>Fireflight</li>
                <li>Godsmack</li>
                <li>Halestorm</li>
                <li>Hollywood Undead</li>
                <li>Hoobastank</li>
                <li>Icon For Hire</li>
                <li>Incubus</li>
                <li>Korn</li>
                <li>Maroon 5</li>
                <li>My Darkest Days</li>
            </ul>
        </div>

        <div class="float-left49">
            <p><em>N - Z</em></p>
            <ul>
                <li>Nightwish</li>
                <li>Offspring, The</li>
                <li>Paramore</li>
                <li>Puddle of Mudd</li>
                <li>Ra</li>
                <li>Rage Against The Machine</li>
                <li>Red Hot Chili Peppers</li>
                <li>Rise Against</li>
                <li>Rob Zombie</li>
                <li>Seether</li>
                <li>Sick Puppies</li>
                <li>Sixx: A.M.</li>
                <li>Skillet</li>
                <li>Sonic Syndicate</li>
                <li>Staind</li>
                <li>Ten Years</li>
                <li>Theorey of a Deadman</li>
                <li>Trust Company</li>
                <li>Three Days Grace</li>
                <li>We Are The Fallen</li>
            </ul>
        </div>

        <div class="clear"></div>

        <h2>Artists</h2>

        <div class="float-left49">
            <p><em>A - H</em></p>
            <ul>
                <li>Aaron Lewis</li>
                <li>Adam Gontier</li>
                <li>Adam Levine</li>
                <li>Amy Lee</li>
                <li>Ben Moody</li>
                <li>Corey Taylor</li>
                <li>Dave Grohl</li>
                <li>DJ Ashba</li>
                <li>Gavin Rosedale</li>
                <li>Glenn Hughes</li>
                <li>Hayley Williams</li>
            </ul>
        </div>

        <div class="float-left49">
            <p><em>J - Z</em></p>
            <ul>
                <li>Joe Bonamassa</li>
                <li>Joe Satriani</li>
                <li>John Petrucci</li>
                <li>Kenny Wayne Shepherd</li>
                <li>Mike Portnoy</li>
                <li>P!nk</li>
                <li>Ronnie James Dio</li>
                <li>Shannon Larkin</li>
                <li>Sully Erna</li>
                <li>Synyster Gates</li>
                <li>Toni Iommi</li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>
    <!-- ### END content-area ### -->
    <!-- ### START content-area-right ### -->
    <div id="content-area-right">
        <!-- ### START login ### -->
        <div id="login">
            <?php require("inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions-mobile">
            <?php require("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
        <!-- ### START RSS feed ### -->
        <div id="rss">
            <?php require_once('inc/rss.php'); ?>
        </div>
        <!-- ### END RSS feed ### -->
        <!-- ### START validation ### -->
        <div id="validation">
            <?php require_once("inc/validation.php"); ?>
        </div>
        <!-- ### END validation ### -->
    </div>
    <!-- ### END content-area-right ### -->
    <!-- ### START Footer ### -->
    <div id="footer">
        <?php require_once('inc/footer.php'); ?>
        <div id="footer-background"></div>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-64564354-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </div>
    <!-- ### END Footer ### -->
</div>
<!-- ### END Container ### -->
</body>
<!-- ### END Body ### -->
</html>