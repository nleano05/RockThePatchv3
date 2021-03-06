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
<meta http-equiv="refresh" content="0; url=https://www.rockthepatch.com/update-browser.php">
<![endif]-->

<!-- ### START Head ### -->
<head>
    <!-- ### Basic Page Needs and Meta Data ### -->
    <title>Rock the Patch! v3 - Home</title>
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
         var additionalImages = ["/images/index-slide-show/computer.jpg",
         "/images/index-slide-show/computer2.jpg",
         "/images/index-slide-show/drums.jpg",
         "/images/index-slide-show/guitars.jpg",
         "/images/index-slide-show/guitars2.jpg",
         "/images/index-slide-show/training.jpg"];

         preloadImages(additionalImages);
    </script>

    <!-- ### Javascript for the Slide Show / Gallery on the main page  -->
    <script type="text/javascript">
         $(document).ready(function() {
            galleryDisplay();
         });
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
                    document.getElementById("home").className  = "current";
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
        <div id="gallery">
            <a href="index.php" class="show">
                <img src="/images/index-slide-show/computer2.jpg" title="Computer Programmer" alt="&lt;h3>Programmer&lt;/h3>...with a web development background." width="500" height="200" />
            </a>
            <a href="index.php">
                <img src="/images/index-slide-show/guitars2.jpg" title="Guitarist" alt="&lt;h3>Guitarist&lt;/h3>...who loves PRS, Gibson, Epiphone, Mesa, and Randall." width="500" height="200" />
            </a>
            <a href="index.php">
                <img src="/images/index-slide-show/drums.jpg" title="Drummer"  alt="&lt;h3>Drummer&lt;/h3>...and Drum Off '09 and '10 competitor." width="500" height="200" />
            </a>
            <a href="index.php">
                <img src="/images/index-slide-show/training.jpg" title="Martial Artist" alt="&lt;h3>Martial Artist&lt;/h3>...with multiple awards at various competitions." width="500" height="200" />
            </a>
            <a href="index.php">
                <img src="/images/index-slide-show/guitars.jpg" title="Musician" alt="&lt;h3>Musician&lt;/h3>...and all around music enthusiast." width="500" height="200" />
            </a>
            <a href="index.php">
                <img src="/images/index-slide-show/computer.jpg" title="CS and Math Major" alt="&lt;h3>CS Major and Math Minor&lt;/h3>...who has built multiple PC's." width="500" height="200" />
            </a>
            <div class="caption"><div class="content"></div></div>
        </div>
        <div class="clear"></div>

        <h1>Welcome!</h1>

        <p>Rock the Patch! is a site that lets you explore and get information about me, Patches. I'm
            a Tennessee based software engineer, web developer, martial artist, musician, writer, and artist.
            Find out more about my diverse interests by selecting an area and seeing where it takes you.</p>

        <p>Login as an exclusive 'Rock the Patch!' user to see exclusive content and gain access
            to streaming audio, downloads, and more.</p>

        <h1>About This Site</h1>

        <p>This page was written in what is being termed XHTML5 which is a specific combination of HTML tags and
            attributes that validates with both HTML5 and XHTML 1.1 and also strives to use best practices. It also implements
            OOPHP with some JavaScript, jQuery, RSS 2.0, XSL(T), XML 1.0, and CSS 3.0 thrown in. The goal is to be both functional
            and aesthetically pleasing across multiple platforms...desktops and mobile devices alike.</p>

        <ul>
            <li><a href="/about-the-revamp.php" title="About the Revamp">About the Revamp</a></li>
            <li><a href="/site-map.php" title="Site Map">Site Map</a></li>
            <li><a href="/site-testing.php" title="Site Testing">Site Testing</a></li>
            <li><a href="/site-projects.php" title="Site Projects">Site Projects</a></li>
            <li><a href="/site-features.php" title="Site Features">Site Features</a></li>
            <li><a href="/site-issues.php" title="Site Issues">Site Issues</a></li>
            <li><a href="/kudos.php" title="Kudos">Kudos</a></li>
            <li><a href="/templates.php" title="Templates">Templates</a></li>
            <li><a href="/resources-and-tools.php" title="Resources and Tools">Resources and Tools</a></li>
        </ul>
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