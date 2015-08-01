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
    <title>Rock the Patch! v3 - Site Testing</title>
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
        var additionalImages = ["/images/icons-and-logos/windows8.png",
            "/images/icons-and-logos/windows7.png",
            "/images/icons-and-logos/kubuntu.png",
            "/images/icons-and-logos/chrome.png",
            "/images/icons-and-logos/firefox.png",
            "/images/icons-and-logos/ie.png",
            "/images/icons-and-logos/opera.png",
            "/images/icons-and-logos/safari.png",
            "/images/icons-and-logos/ipod-touch.png",
            "/images/icons-and-logos/android.png",
            "/images/icons-and-logos/selenium.png",
            "/images/icons-and-logos/intellij.png",
            "/images/icons-and-logos/ie-tester.png"]

        preloadImages(additionalImages);
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
                    document.getElementById("about-this-site").className  = "current";
                    document.getElementById("site-testing").className  = "current";
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
            <?php require_once("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
    </div>
    <!-- ### END content-area-left ### -->
    <!-- ### START content-area ### -->
    <div id="content-area">
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / About This Site / Site Testing</div>
        <h1>Site Testing</h1>

        <p>
            I have PHPUnit and Java based selenium tests hooked up for both UI and unit testing.  I primarily develop
            on a windows machine and check the Big 5 browsers there, but I want to support as much as possible so if
            you are on a different OS and see an issue that I haven't caught please send me a report.  For my Java
            based UI testing package I implemented a page object setup.
        </p>

        <h2>Operating Systems Used</h2>

        <img src="/images/icons-and-logos/windows8.png" alt="Windows 8 Logo" title="Windows 8 Logo" style="width:80px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/windows7.png" alt="Windows 7 Logo" title="Windows 7 Logo" style="width:65px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/kubuntu.png" alt="Kubuntu Logo" title="Kubuntu Logo" style="width:240px;margin:5px 10px;" />

        <ul>
            <li>Windows 8 / 8.1</li>
            <li>Windows 7</li>
            <li>Kubuntu</li>
        </ul>

        <h2>Browsers Used</h2>

        <img src="/images/icons-and-logos/chrome.png" alt="Chrome Logo" title="Chrome Logo" style="float:left;width:65px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/firefox.png" alt="Firefox Logo" title="Firefox Logo" style="float:left;width:65px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/ie.png" alt="IE Logo" title="IE Logo" style="float:left;width:65px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/opera.png" alt="Opera Logo" title="Opera Logo" style="float:left;width:65px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/safari.png" alt="Safari Logo" title="Safari Logo" style="float:left;width:65px;margin:5px 20px;" />

        <div class="clear"></div>

        <ul>
            <li>Chrome</li>
            <li>Firefox</li>
            <li>IE >= 7</li>
            <li>Opera</li>
            <li>Safari</li>
        </ul>


        <h2>Other Devices Used</h2>

        <img src="/images/icons-and-logos/ipod-touch.png" alt="iPod Touch Logo" title="iPod Touch Logo" style="width:75px;margin:5px 0px;" />
        <img src="/images/icons-and-logos/android.png" alt="Android Logo" title="Android Logo" style="width:75px;margin:5px 20px;" />

        <ul>
            <li>Samsung Galaxy S5 with Android 4.4.2 - 5.0</li>
            <li>Samsung Galaxy Note II with Android 4.1.2 - 4.4.2</li>
            <li>32 Gig White iPod Touch</li>
            <li>Motorola Atrix 4G with Android 2.3.6</li>
        </ul>

        <h2>Other Testing Resources Used</h2>

        <img src="/images/icons-and-logos/selenium.png" alt="Selenium Logo" title="Selenium Logo" style="width:90px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/intellij.png" alt="Intellij Logo" title="Intellij Logo" style="width:70px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/ie-tester.png" alt="IETester Logo" title="IETest Logo" style="width:85px;margin:5px 20px;" />

        <ul>
            <li>Selenium 2.4.5</li>
            <li>Intellij 14.+ Ultimate Edition</li>
            <li>IE Tester 0.5.4</li>
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
            <?php require_once("inc/interactions.php"); ?>
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