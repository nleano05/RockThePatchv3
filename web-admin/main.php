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
    <title>Rock the Patch! v3 - Web Admin</title>
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
                <?php require_once("../inc/nav-bar.php"); ?>
            </div>
            <!-- ### END nav-bar ### -->
            <!-- ### START user-nav ### -->
            <div id="user-nav">
                <?php
                require_once("../inc/user-nav.php");
                if($gLoginStatus ==  STATUS_LOGGED_IN) {
                    ?>
                    <!-- Script to display the current page in the navigation -->
                    <script type="text/javascript">
                        document.getElementById("web-admin").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Web Admin</div>
        <h1>Web Admin</h1>

        <?php
            $isAdmin = lib_check::userIsAdmin();

            if($gLoginStatus == STATUS_LOGGED_IN) {
                if ($isAdmin) {
        ?>
                    <h2>Admin Pages</h2>

                    <p><strong>Log Pages</strong></p>
                    <ul>
                        <li><a href="../web-admin/error-log.php" title="Error Log">Error Log</a></li>
                        <li><a href="../web-admin/login-log.php" title="Login Log">Login Log</a></li>
                        <li><a href="../web-admin/page-log.php" title="Page Log">Page Log</a></li>
                    </ul>

                    <p><strong>Statistic Pages</strong></p>
                    <ul>
                        <li><a href="../web-admin/error-statistics.php" title="Error Statistics">Error Statistics</a></li>
                        <li><a href="../web-admin/login-statistics.php" title="Login Statistics">Login Statistics</a></li>
                        <li><a href="../web-admin/page-statistics.php" title="Page Statistics">Page Statistics</a></li>
                    </ul>

                    <p><strong>Other Administrative Pages</strong></p>
                    <ul>
                        <li><a href="../web-admin/access-control.php" title="Access Control">Access Control</a></li>
                        <li><a href="../web-admin/account-lock-administration.php" title="Locked Out Users">Account Lock Administration</a></li>
                        <li><a href="../web-admin/edit-admin-access.php" title="Edit Admin Access">Edit Admin Access</a></li>
                        <li><a href="../web-admin/edit-annoyance-levels.php" title="Edit Annoyance Levels">Edit Annoyance Levels</a></li>
                        <li><a href="../web-admin/edit-email-distros.php" title="Edit Email Distros">Edit Email Distros</a></li>
                        <li><a href="../web-admin/edit-error-report-categories.php" title="Edit Error Report Categories">Edit Error Report Categories</a></li>
                        <li><a href="../web-admin/edit-feature-request-categories.php" title="Edit Feature Request Categories">Edit Feature Request Categories</a></li>
                        <li><a href="../web-admin/blasts.php" title="Blasts">Email and Text Blasts</a></li>
                        <li><a href="../web-admin/page-flow.php" title="Page Flow">Page Flow</a></li>
                        <li><a href="../web-admin/php-info.php" title="PHP Info">PHP Info</a></li>
                        <li><a href="../web-admin/latency-checker.php" title="Latency">Latency Checker</a></li>
                        <li><a href="../web-admin/modify-debug-mode.php" title="Modify Debug Mode">Modify Debug Mode</a></li>
                        <li><a href="../web-admin/user-demographic.php" title="User Demographic">User Demographic</a></li>
                        <li><a href="../web-admin/view-login-status.php" title="View Login Status">View Login Status</a></li>
                    </ul>
        <?php
                } else {
                    echo("<p><em>" . NOTICE_MUST_BE_ADMIN . "</em></p>");
                }
            } else {
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