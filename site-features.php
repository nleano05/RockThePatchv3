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
    <title>Rock the Patch! v3 - Template</title>
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

    <!-- ### JQuerey Imports ### -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

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
                    document.getElementById("site-features").className = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / About This Site / Site Features</div>

        <h1>Site Features</h1>

        <script type="text/javascript">
            document.ready = function() {
                hidePageElement('just-for-fun');
                hidePageElement('networking');
                hidePageElement('reassurance');
                hidePageElement('security');
                hidePageElement('usability');
                hidePageElement('user-system');
                hidePageElement('web-admin-features');
                hidePageElement('social-features');
                hidePageElement('visibility');
                hidePageElement('other');
            };
        </script>

        <ul>
            <li><a href="#" onclick="return togglePageElementVisibility('just-for-fun')"> Just For Fun >></a>
                <div id="just-for-fun">
                    <ul>
                        <li>Binary Tree Creator</li>
                        <li>BZIP2</li>
                        <li>Ducks</li>
                        <li>Palindrome Checker</li>
                        <li>Rock, Paper, Scissors, Chuck Norris</li>
                        <li>Subnet Calculator</li>
                        <li>String Generator</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('networking')"> Networking >></a>
                <div id="networking">
                    <ul>
                        <li>Social media area</li>
                        <li>Highly visible email</li>
                        <li>RSS Feed</li>
                        <li>Custom Google, Facebook, and Twitter share buttons</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('reassurance')"> Reassurance >></a>
                <div id="reassurance">
                    <ul>
                        <li>Quick links to W3C validation</li>
                        <li>Site testing page</li>
                        <li>Site project and issue tracking pages</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('security')"> Security >></a>
                <div id="security">
                    <ul>
                        <li>An admin can lock out a user until they choose to unlock them</li>
                        <li>Email confirmation for user actions</li>
                        <li>Password encryption</li>
                        <li>Use of HTTPS/SSL and secure cookies</li>
                        <li>User is locked out for 30 mins after 5 unsuccessful login attempts</li>
                        <li>User must confirm their email before they are moved into database</li>
                        <li>Use of prepared statements (PDO::) for database queries</li>
                        <li>Only logged in users see certain pages</li>
                        <li>Only admin users see certain pages</li>
                        <li>Security question and confirmations to help ensure the user action is legitimate</li>
                        <li>Prevention of malicious uploads</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('usability')"> Usability >></a>
                <div id="usability">
                    <ul>
                        <li>Mobile friendly</li>
                        <li>Liquid/responsive flexi design</li>
                        <li>Breadcrumbs for navigation</li>
                        <li>Navigation highlights current place</li>
                        <li>Forms retain information based off $_POST</li>
                        <li>Mobile and full size forms sync values</li>
                        <li>CSS adjusts based on screen size</li>
                        <li>Collapsible sections for some large text areas</li>
                        <li>Auto format dashes for phone number fields</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('user-system')"> User System >></a>
                <div id="user-system">
                    <ul>
                        <li>Ability to edit account information</li>
                        <li>Ability to change an accounts password</li>
                        <li>Ability to deactivate an account</li>
                        <li>Access to downloadable/streaming content</li>
                        <li>Ability to send an error report</li>
                        <li>Ability to send a feature request</li>
                        <li>Ability to receive a temp password to recover an account</li>
                        <li>Ability to recover a username given an email</li>
                        <li>Login and logout ability</li>
                        <li>Ability to register a new account</li>
                        <li>Access to special news</li>
                        <li>Access to streaming audio</li>
                        <li>Access to video blog (html5/flash compatible with .webm, .mp4, and .ogg support)</li>
                        <li>Display of currently logged in user</li>
                        <li>Ability to request admin access</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('web-admin-features')"> Web Admin >></a>
                <div id="web-admin-features">
                    <ul>
                        <li>Error statistics</li>
                        <li>Page Statistics</li>
                        <li>Filterable login Statistics</li>
                        <li>Filterable error log</li>
                        <li>Filterable login log</li>
                        <li>Filterable page flow</li>
                        <li>Filterable page log</li>
                        <li>Ability to clear logs and statistics</li>
                        <li>User demographic information</li>
                        <li>Ability to send email and text blasts</li>
                        <li>Latency checker</li>
                        <li>Access control / IP blocking</li>
                        <li>Ability to lock/unlock user accounts</li>
                        <li>Ability to grant/revoke admin access</li>
                        <li>Ability to enable/disable debug mode for a session</li>
                        <li>Ability to view the login status of users</li>
                        <li>Ability to view PHP info</li>
                        <li>Ability to add, edit, and delete annoyance levels</li>
                        <li>Ability to add, edit, and delete email distribution lists</li>
                        <li>Ability to add, edit, and delete error report categories</li>
                        <li>Ability to add, edit, and delete feature request categories</li>
                        <li>Ability to add, edit, and delete security questions</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('social-features')"> Social >></a>
                <div id="social-features">
                    <ul>
                        <li>Ability to search for friends</li>
                        <li>Ability to add/remove friends</li>
                        <li>Ability to block/unblock users</li>
                        <li>Ability to create and share profiles</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('visibility')"> Visibility >></a>
                <div id="visibility">
                    <ul>
                        <li>Footer automatically displays the time stamp of when the page was last updated</li>
                        <li>Recent updates section</li>
                    </ul>
                </div>
            </li>
            <li><a href="#" onclick="return togglePageElementVisibility('other')"> Other >></a>
                <div id="other">
                    <ul>
                        <li>Back-end web service</li>
                    </ul>
                </div>
            </li>
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