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
    <title>Rock the Patch! v3 - Site Map</title>
    <meta name="robots" content="all"/>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="description" content="Rock the Patch! Musician, Programmer, Artist, and More"/>
    <meta name="author" content="Patches"/>
    <meta name="keywords"
          content="patches, xhtml 1.1, html5, xhtml5, rss, css3, xsl(T), programmer, rock the patch, writer, artist, musician, mobile"/>

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
                    document.getElementById("about-this-site").className = "current";
                    document.getElementById("site-map").className = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / About This Site / Site Map</div>

        <h1>Site Map</h1>

        <div class="float-left49">
            <h2>For All Users</h2>
            <ul>
                <li><a href="/" title="Home">Home</a></li>
                <li><a href="/about-patches.php" title="About Patches">About Patches</a></li>
                <li><a href="/about-the-revamp.php" title="About The Revamp">About The Revamp</a></li>
                <li>About This Site
                    <ul>
                        <li><a href="/site-map.php" title="Site Map">Site Map</a></li>
                        <li><a href="/site-testing.php" title="Site Testing">Site Testing</a></li>
                        <li><a href="/site-projects.php" title="Site Projects">Site Projects</a></li>
                        <li><a href="/site-features.php" title="Site Features">Site Features</a></li>
                        <li><a href="/site-issues.php" title="Site Issues">Site Issues</a></li>
                        <li><a href="/kudos.php" title="Kudos">Kudos</a></li>
                        <li><a href="/templates.php" title="Templates">Templates</a></li>
                        <li><a href="/resources-and-tools.php" title="Resources and Tools">Resources And Tools</a></li>
                    </ul>
                </li>
                <li>Tech Work
                    <ul>
                        <li><a href="/programming.php" title="Programming">Programming</a></li>
                        <li><a href="/web-development.php" title="Web Development">Web Development</a></li>
                    </ul>
                </li>
                <li>Music Career
                    <ul>
                        <li><a href="/bands-and-projects.php" title="Bands and Projects">Bands and Projects</a></li>
                        <li><a href="/equipment.php" title="Equipment">Equipment</a></li>
                        <li><a href="/influences.php" title="Influences">Influences</a></li>
                        <li><a href="/brand-preferences.php" title="Brand Preferences">Brand Preferences</a></li>
                        <li><a href="/wish-list.php" title="Wish List">Wish List</a></li>
                    </ul>
                </li>
                <li>Art &amp; Writing
                    <ul>
                        <li><a href="/excerpts-and-lyrics.php" title="Excerpts &amp; Lyrics">Excerpts &amp; Lyrics</a></li>
                        <li><a href="/art-gallery.php" title="Art Gallery">Art Gallery</a></li>
                    </ul>
                </li>
                <li>Bonus
                    <ul>
                        <li><a href="/binary-tree-creator.php" title="Binary Tree Creator">Binary Tree Creator</a></li>
                        <li><a href="/bzip2.php" title="BZIP2">BZIP2</a></li>
                        <li><a href="/ducks.php" title="Ducks">Ducks</a></li>
                        <li><a href="/palindrome-checker.php" title="Palindrome Checker">Palindrome Checker</a></li>
                        <li><a href="/rock-paper-scissors.php">Rock, Paper, Scissors, Chuck Norris</a></li>
                        <li><a href="/subnet-calculator.php">Subnet Calculator</a></li>
                    </ul>
                </li>
                <li><a href="/martial-arts.php" title="Martial Arts">Martial Arts</a></li>
                <li><a href="/recent-updates-log.php" title="Recent Updates Log">Recent Updates Log</a></li>
                <li><a href="/user-system/register.php" title="Register">Register</a></li>
                <li><a href="/user-system/forgot-password.php" title="Forgot Password">Forgot Password</a></li>
                <li><a href="/user-system/forgot-username.php" title="Forgot Username">Forgot Username</a></li>
                <li><a href="/" title="Log In">Log in</a></li>
            </ul>
        </div>

        <div class="float-left49">
            <?php
            $isAdmin = lib_check::userIsAdmin();

            if($gLoginStatus == STATUS_LOGGED_IN) {
        ?>
                <h2>For 'Rock the Patch!' Users</h2>

                <ul>
                    <li><a href="/user-bonuses/special-news.php" title="Special News">Special News</a></li>
                    <li><a href="/user-bonuses/video-blog.php" title="Video Blog">Video Blog</a></li>
                    <li><a href="/user-bonuses/downloads.php" title="Downloads">Downloads</a></li>
                    <li><a href="/user-bonuses/music.php" title="Streaming Audio">Streaming Audio</a></li>
                    <li><a href="/user-system/change-password.php" title="Change Password">Change Password</a></li>
                    <li><a href="/user-system/deactivate-account.php" title="Deactivate Account">Deactivate Account</a></li>
                    <li><a href="/user-system/account-info.php" title="Account Info">Account Info</a></li>
                    <li><a href="/user-system/request-admin-access.php" title="Request Admin Access">Request Admin Access</a></li>
                    <li><a href="/user-system/logout.php" title="Logout">Logout</a></li>
                </ul>

                <h2>Social</h2>

                <ul>
                    <li><a href="../social/main.php" title="Social Main Page">Social Main Page</a></li>
                    <li><a href="../social/profile.php<?php echo("?id=".lib_get::currentUser()->getId()) ?>" title="Mt Profile">My Profile</a></li>
                    <li><a href="../social/search-users.php" title="Search Users">Search Users</a></li>
                    <li><a href="../social/my-friends.php" title="My Friends">My Friends</a></li>
                </ul>
                <?php
                    if($isAdmin) {
                    ?>
                    <h2>For Admin Users</h2>

                    <ul>
                        <li><a href="../web-admin/main.php" title="Web Admin Main Page">Web Admin Main Page</a></li>
                        <li>Log Pages
                            <ul>
                                <li><a href="../web-admin/error-log.php" title="Error Log">Error Log</a></li>
                                <li><a href="../web-admin/login-log.php" title="Login Log">Login Log</a></li>
                                <li><a href="../web-admin/page-log.php" title="Page Log">Page Log</a></li>
                            </ul>
                        </li>
                        <li>Statistic Pages
                            <ul>
                                <li><a href="../web-admin/error-statistics.php" title="Error Statistics">Error Statistics</a></li>
                                <li><a href="../web-admin/login-statistics.php" title="Login Statistics">Login Statistics</a></li>
                                <li><a href="../web-admin/page-statistics.php" title="Page Statistics">Page Statistics</a></li>
                            </ul>
                        </li>
                        <li>Other Administrative Pages
                            <ul>
                                <li><a href="../web-admin/access-control.php" title="Access Control">Access Control</a></li>
                                <li><a href="../web-admin/account-lock-administration.php" title="Account Lock Administration">Account Lock Administration</a></li>
                                <li><a href="../web-admin/edit-admin-access.php" title="Edit Admin Access">Edit Admin Access</a></li>
                                <li><a href="../web-admin/edit-annoyance-levels.php" title="Edit Annoyance Levels">Edit Annoyance Levels</a></li>
                                <li><a href="../web-admin/edit-email-distros.php" title="Edit Email Dsitros">Edit Email Distros</a></li>
                                <li><a href="../web-admin/edit-error-report-categories.php" title="Edit Error Report Categories">Edit Error Report Categories</a></li>
                                <li><a href="../web-admin/edit-feature-request-categories.php" title="Edit Feature Request Categories">Edit Feature Request Categories</a></li>
                                <li><a href="../web-admin/blasts.php" title="Blasts">Email and Text Blasts</a></li>
                                <li><a href="../web-admin/page-flow.php" title="Page Flow">Page Flow</a></li>
                                <li><a href="../web-admin/php-info.php" title="PHP Info">PHP Info</a></li>
                                <li><a href="../web-admin/latency-checker.php" title="Latency Checker">Latency Checker</a></li>
                                <li><a href="../web-admin/modify-debug-mode.php" title="Modify Debug Mode">Modify Debug Mode</a></li>
                                <li><a href="../web-admin/user-demographic.php" title="User Demographic">User Demographic</a></li>
                                <li><a href="../web-admin/view-login-status.php" title="View Login Status">View Login Status</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php
                }
            }
            ?>
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