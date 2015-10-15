<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

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
    <title>Rock the Patch! v3 - Video Blog</title>
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
                <?php require_once("../inc/nav-bar.php"); ?>
            </div>
            <!-- ### END nav-bar ### -->
            <!-- ### START user-nav ### -->
            <div id="user-nav">
                <?php
                    require_once("../inc/user-nav.php");
                    if($gLoginStatus == STATUS_LOGGED_IN) {
                ?>
                    <script type="text/javascript">
                        document.getElementById("video-blog").className  = "current";
                    </script>
                <?php
                    }
                ?>
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
            <?php require("../inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START recent-updates ### -->
        <div id="recent-updates">
            <?php require_once("../inc/recent-updates.php"); ?>
        </div>
        <!-- ### END recent-updates ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions">
            <?php require("../inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
    </div>
    <!-- ### END content-area-left ### -->
    <!-- ### START content-area ### -->
    <div id="content-area">
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Video Blog</div>

        <h1>Video Blog</h1>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
        ?>
                <script type='text/javascript' src='/js/jwplayer-6.12/jwplayer/jwplayer.js'></script>
                <script type="text/javascript">jwplayer.key="fig1vIEHW84LZXo2SPaUp01lg36DJLjenfBDfg==";</script>

                <div id='mediaplayer'><p>Loading videos...</p></div>

                <script type='text/javascript'>
                    jwplayer('mediaplayer').setup({
                        width: '100%',
                        height: 500,
                        listbar: {
                            position: "right",
                            size: 234
                        },
                        playlist:
                            [
                                {
                                    image: '../images/video-stills/2-Full-Songs.png',
                                    title: '2 Full Songs',
                                    sources:
                                        [
                                            {file: '../video/2-Full-Songs.mp4', type: 'video/mp4' },
                                            {file: '../video/2-Full-Songs.webm', type: 'video/webm' },
                                            {file: '../video/2-Full-Songs.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Introducing.png',
                                    title: 'Introducing',
                                    sources:
                                        [
                                            {file: '../video/Introducing.mp4', type: 'video/mp4' },
                                            {file: '../video/Introducing.webm', type: 'video/webm' },
                                            {file: './video/Introducing.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Acoustic-jam.png',
                                    title: 'Acoustic Jam',
                                    sources:
                                        [
                                            {file: '../video/Acoustic-jam.mp4', type: 'video/mp4' },
                                            {file: '../video/Acoustic-jam.webm', type: 'video/webm' },
                                            {file: '../video/Acoustic-jam.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Madhadder-escapade.png',
                                    title: 'Madhadder-escapade',
                                    sources:
                                        [
                                            {file: '../video/Madhadder-escapade.mp4', type: 'video/mp4' },
                                            {file: '../video/Madhadder-escapade.webm', type: 'video/webm' },
                                            {file: '../video/Madhadder-escapade.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/New-riffs-and-bass.png',
                                    title: 'New-riffs-and-bass',
                                    sources:
                                        [
                                            {file: '../video/New-riffs-and-bass.mp4', type: 'video/mp4' },
                                            {file: '../video/New-riffs-and-bass.webm', type: 'video/webm' },
                                            {file: '../video/New-riffs-and-bass.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Staccato-upon-staccato.png',
                                    title: 'Staccato-upon-staccato',
                                    sources:
                                        [
                                            {file: '../video/Staccato-upon-staccato.mp4', type: 'video/mp4' },
                                            {file: '../video/Staccato-upon-staccato.webm', type: 'video/webm' },
                                            {file: '../video/Staccato-upon-staccato.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Timid-staccato-vs-the-legato-ego.png',
                                    title: 'Timid-staccato-vs-the-legato-ego',
                                    sources:
                                        [
                                            {file: '../video/Timid-staccato-vs-the-legato-ego.mp4', type: 'video/mp4' },
                                            {file: '../video/Timid-staccato-vs-the-legato-ego.webm', type: 'video/webm' },
                                            {file: '../video/Timid-staccato-vs-the-legato-ego.ogg', type: 'video/ogg' }
                                        ]
                                },
                                {
                                    image: '../images/video-stills/Zakk-wylde.png',
                                    title: 'Zakk-wylde',
                                    sources:
                                        [
                                            {file: '../video/Zakk-wylde.mp4', type: 'video/mp4' },
                                            {file: '../video/Zakk-wylde.webm', type: 'video/webm' },
                                            {file: '../video/Zakk-wylde.ogg', type: 'video/ogg' }
                                        ]
                                }
                            ]
                    });
                </script>

                <div id="clear"></div>
                <div class="screen-size">
                    <p><em>This page uses <strong>JWPlayer</strong> and supports both <strong>.mp4</strong>, <strong>.ogg</strong>, and <strong>.webm</strong> video files.  It also uses HTML5 or Flash
                            depending on what your system/browser is capable of.</em></p>
                </div>
        <?php
            }else {
                echo("<p><em>" . NOTICE_MUST_BE_LOGGED_IN . "</em></p>");
            }
        ?>
    </div>
    <!-- ### END content-area ### -->
    <!-- ### START content-area-right ### -->
    <div id="content-area-right">
        <!-- ### START login ### -->
        <div id="login">
            <?php require("../inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions-mobile">
            <?php require("../inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
        <!-- ### START RSS feed ### -->
        <div id="rss">
            <?php require_once('../inc/rss-secondary.php'); ?>
        </div>
        <!-- ### END RSS feed ### -->
        <!-- ### START validation ### -->
        <div id="validation">
            <?php require_once("../inc/validation.php"); ?>
        </div>
        <!-- ### END validation ### -->
    </div>
    <!-- ### END content-area-right ### -->
    <!-- ### START Footer ### -->
    <div id="footer">
        <?php require_once('../inc/footer.php'); ?>
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