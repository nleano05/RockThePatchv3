<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

function displayLatency() {
    $urlBASE = $urlUSERS = $urlADMIN = array();

    array_push($urlBASE, lib_get::baseUrl() . "index.php");
    array_push($urlBASE, lib_get::baseUrl() . "about-patches.php");
    array_push($urlBASE, lib_get::baseUrl() . "about-the-revamp.php");
    array_push($urlBASE, lib_get::baseUrl() . "site-map.php");
    array_push($urlBASE, lib_get::baseUrl() . "site-testing.php");
    array_push($urlBASE, lib_get::baseUrl() . "site-projects.php");
    array_push($urlBASE, lib_get::baseUrl() . "site-features.php");
    array_push($urlBASE, lib_get::baseUrl() . "site-issues.php");
    array_push($urlBASE, lib_get::baseUrl() . "kudos.php");
    array_push($urlBASE, lib_get::baseUrl() . "templates.php");
    array_push($urlBASE, lib_get::baseUrl() . "resources.php");
    array_push($urlBASE, lib_get::baseUrl() . "programming.php");
    array_push($urlBASE, lib_get::baseUrl() . "web-development.php");
    array_push($urlBASE, lib_get::baseUrl() . "bands-and-projects.php");
    array_push($urlBASE, lib_get::baseUrl() . "equipment.php");
    array_push($urlBASE, lib_get::baseUrl() . "influences.php");
    array_push($urlBASE, lib_get::baseUrl() . "brand-preferences.php");
    array_push($urlBASE, lib_get::baseUrl() . "wish-list.php");
    array_push($urlBASE, lib_get::baseUrl() . "excerpts-and-lyrics.php");
    array_push($urlBASE, lib_get::baseUrl() . "art-gallery.php");
    array_push($urlBASE, lib_get::baseUrl() . "martial-arts.php");
    array_push($urlBASE, lib_get::baseUrl() . "recent-updates-log.php");
    array_push($urlBASE, lib_get::baseUrl() . "binary-tree-creator.php");
    array_push($urlBASE, lib_get::baseUrl() . "bzip2.php");
    array_push($urlBASE, lib_get::baseUrl() . "ducks.php");
    array_push($urlBASE, lib_get::baseUrl() . "palindrome-checker.php");
    array_push($urlBASE, lib_get::baseUrl() . "rock-paper-scissors.php");
    array_push($urlBASE, lib_get::baseUrl() . "user-system/register.php");
    array_push($urlBASE, lib_get::baseUrl() . "user-system/forgot-password.php");
    array_push($urlBASE, lib_get::baseUrl() . "user-system/forgot-username.php");

    array_push($urlUSERS, lib_get::baseUrl() . "user-bonuses/special-news.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-bonuses/video-blog.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-bonuses/downloads.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-bonuses/streaming-audio.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-system/change-password.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-system/deactivate-account.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-system/account-info.php");
    array_push($urlUSERS, lib_get::baseUrl() . "user-system/request-admin-access.php");

    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/add-or-edit-update.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/error-statistics.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/login-statistics.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/page-statistics.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/error-log.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/login-log.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/page-log.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/user-demographic.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/page-flow.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/blasts.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/access-control.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/account-lock-administration.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/edit-admin-access.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/edit-annoyance-levels.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/edit-email-distros.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/edit-error-report-categories.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/edit-feature-request-categories.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/modify-debug-mode.php");
    array_push($urlADMIN, lib_get::baseUrl() . "web-admin/php-info.php");

    sort($urlBASE, SORT_REGULAR);
    sort($urlUSERS, SORT_REGULAR);
    sort($urlADMIN, SORT_REGULAR);


    displayLatencySection($urlBASE, "Base Pages");
    displayLatencySection($urlUSERS, "User Pages");
    displayLatencySection($urlADMIN, "Admin Pages");
}

function displayLatencySection($pages, $header) {
    echo("<hr/><h2>$header</h2>");
    foreach($pages as $value) {
        $currentURL = lib_get::currentUrl();
        // Added for EasyPHP
        if(strpos($currentURL, '127.0.0.1') !== FALSE) {
            $urlToPing = str_replace("www.rockthepatch.com", "", $value);
        } else {
            $urlToPing = $value;
        }
        echo("<p><em><a href='" . $urlToPing ."'>" . $urlToPing . "</a></em><br/>");
        // For each page we ping it 3 times
        for($x = 0; $x < 3; $x++) {
            lib::ping($urlToPing);
            $pingVal = lib::ping($urlToPing);
            if($pingVal < 10) {
                echo("<strong>" . $pingVal ."</strong> ms; ");
            } else {
                echo("<strong><span class='error'>" . $pingVal ."</span></strong> ms; ");
            }
        }
        echo("</p>");
    }
}
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
    <title>Rock the Patch! v3 - Latency Checker</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Latency Checker</div>
        <h1>Latency Checker</h1>

        <?php
            $isAdmin = lib_check::userIsAdmin();
            if($gLoginStatus == STATUS_LOGGED_IN) {
                if ($isAdmin) {
                    displayLatency();
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