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
    <title>Rock the Patch! v3 - Site Projects</title>
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
                <?php require_once("inc/nav-bar.php"); ?>
                <!-- Script to display the current page in the navigation -->
                <script type="text/javascript">
                    document.getElementById("about-this-site").className  = "current";
                    document.getElementById("site-projects").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Site Projects</div>
        <h1>Site Projects</h1>

        <p>For a full list of project issues please check: <a href="https://github.com/isuPatches/RockThePatch/issues/" title="https://github.com/isuPatches/RockThePatch/issues/">https://github.com/isuPatches/RockThePatch/issues/</a> and filter on the 'Project' label.</p>

        <h2>Opened Project Milestones</h2>

        <?php
        $milestones = lib_get::gitHubMilestones(OPEN);
        $milestonesAsObject = json_decode($milestones);

        log_util::log(LOG_LEVEL_DEBUG, "milestones: ", $milestones);
        log_util::log(LOG_LEVEL_DEBUG, "milestonesAsObject: ", $milestonesAsObject);

        if(!empty($milestonesAsObject)) {
            if(empty($milestonesAsObject->message)) {
                echo("<ul>");
                foreach($milestonesAsObject as $milestone){
                    echo("<li>");
                    echo("<p>");
                    echo("<span style='font-size:1.1em;font-weight:bold;'>" . $milestone->title . "</span><br/>");
                    echo("<a href='" . $milestone->html_url . "' title='" . $milestone->html_url . "'>" . $milestone->html_url . "</a>");
                    echo("</p>");
                    echo("</li>");
                }
                echo("</ul>");
            } else {
                echo("<p><strong>GitHub API message</strong>: " . $milestonesAsObject->message . "</p>");
            }
        } else {
            echo("<p></em>No GitHub Milestones to view at this time...</em></p>");
        }
        ?>

        <h2>Opened Project Issues</h2>

        <?php
        $issues = lib_get::gitHubIssues(OPEN, TODO);
        $issuesAsObject = json_decode($issues);

        log_util::log(LOG_LEVEL_DEBUG, "issues: ", $issues);
        log_util::log(LOG_LEVEL_DEBUG, "issuesAsObject: ", $issuesAsObject);

        if(!empty($issuesAsObject)) {
            if(empty($issuesAsObject->message)) {
                echo("<ul>");
                foreach($issuesAsObject as $issue){
                    echo("<li>");
                    echo("<p>");
                    echo("<span style='font-size:1.1em;font-weight:bold;'>" . $issue->title . "</span><br/>");
                    echo("<a href='" . $issue->html_url . "' title='" . $issue->html_url . "'>" . $issue->html_url . "</a><br/>");
                    echo("Created at: " . $issue->created_at . "<br/>");
                    echo("Updated at: " . $issue->updated_at);
                    echo("</p>");
                    echo("<p>");
                    foreach($issue->labels as $label) {
                        echo("<span style='display:inline-block;color:#111;padding:5px;margin:5px;background:#" . $label->color . ";' >" . $label->name . "</span>");
                    }
                    echo("</p>");
                    echo("</li>");
                }
                echo("</ul>");
            } else {
                echo("<p><strong>GitHub API message</strong>: " . $issuesAsObject->message . "</p>");
            }
        } else {
            echo("<p></em>No GitHub issues to view at this time...</em></p>");
        }
        ?>
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