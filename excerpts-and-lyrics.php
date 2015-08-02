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
    <title>Rock the Patch! v3 - Excerpts And Lyrics</title>
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

    <!-- ### JQuerey Imports ### -->
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
                    document.getElementById("art-and-writing").className  = "current";
                    document.getElementById("excerpts-and-lyrics").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Art &amp; Writing / Excerpts &amp; Lyrics</div>
        <h1>Excerpts &amp; Lyrics</h1>

        <script type="text/javascript">
            document.ready = function() {
                hidePageElement('excerpt1');
                hidePageElement('excerpt2');
            };
        </script>

        <h2>Excerpts</h2>

        <p><a href="#" onclick="return togglePageElementVisibility('excerpt1')">Excerpt from Cassidy's Nightmare, Chapter 3 >></a></p>
        <div id="excerpt1">
            <blockquote>
                <p>&rdquo;Mitch put on an old jean jacket he had brought with him, as Cassidy was busy fussing with a hoodie.
                    They both decided to put on shades considering the direction they were driving in would face them towards the
                    sun that was beginning to rise.</p>
            </blockquote>
            <blockquote>
                <p>They hurried out to Mitch&#39;s car and tossed the bags into the trunk carelessly.  They both knew it was going to
                    be a long trip ahead.  Between the two of them, they had enough Monster energy drinks and cigarettes to last
                    the near eight-hour road trip.</p>
            </blockquote>
            <blockquote>
                <p>As soon as Cassidy climbed into the car, she reclined the seat and tossed her legs up onto the dash.  It
                    was so familiar to Mitch that it didn&#39;t even cause him to bat an eye...&ldquo;</p>
            </blockquote>
        </div>

        <p><a href="#" onclick="return togglePageElementVisibility('excerpt2')">Excerpt from Cassidy's Nightmare, Unknown Chapter >></a></p>
        <div id="excerpt2">
            <blockquote>
                <p>&ldquo;Not a word was said as the car was racing down the road with its speakers blasting techno.  Ok, I guess
                    it&#39;s going to be one of those days where we don&#39;t talk.  Cassidy&#39;s irritability rose with every second of
                    silence.  This is what would drive her crazy about Mitch, when he didn&#39;t want to talk or while he was working
                    something out, he&#39;d just shut down.  There&#39;d be no communication, only silence and Cassidy was left feeling
                    shut out and helpless.</p>
            </blockquote>
            <blockquote>
                <p>How was she supposed to help or fix something that she didn&#39;t even know about?  How was she supposed to
                    know it wasn&#39;t anything to do with her when every indication pointed to the fact that it was?  God and he gets
                    on my case about having my guard up.</p>
            </blockquote>
            <blockquote>
                <p>She had no urge to struggle or fight with it today, so she clammed up and sat in the passenger seat, hoping
                    they&#39;d finish their errands so they could just go home and hopefully he&#39;d snap out of it.  Although doubtful
                    that her ideal wish was going to happen, Cassidy focused on the list of chores: the bank, the grocery, Mitch&#39;s
                    community college, and dropping by to see a few friends...&rdquo;</p>
            </blockquote>
        </div>

        <h2>Lyrics</h2>

        <p><em>No songs at this time...</em></p>
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