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
    <title>Rock the Patch! v3 - Change Password</title>
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
                        <!-- Script to display the current page in the navigation -->
                        <script type="text/javascript">
                            document.getElementById("account-info").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Account Info</div>

        <h1>Account Info</h1>

        <h2>View Account Info</h2>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
                $user = lib_get::currentUser();
                $securityQuestion = NULL;
                if($user != NULL) {
                    $securityQuestion = lib_database::getSecurityQuestionById($user->getSecurityQuestion());
                }
        ?>
                <p>Below is where you can see your account information and make edits. (<em>This only applies if you are logged in</em>)</p>

                <p><strong>Full Name: </strong>
                    <?php
                        if($user != NULL){
                            echo($user->getLastName() . ", " . $user->getFirstName());
                        }
                    ?>
                </p>

                <p><strong>User Name: </strong>
                    <?php
                        if($user != NULL) {
                            echo($user->getUsername());
                        }
                    ?>
                </p>

                <p><strong>Email: </strong>
                    <?php
                        if($user != NULL) {
                            echo($user->getEmail());
                        }
                    ?>
                </p>

                <p><strong>Password: </strong>
                <?php
                    // Since password encrypted is very long, we're just displaying a set of 10 *'s as a visual place holder for the user
                    // *NOTE* at one point, the old password was display in plain text, but for security, this was changed
                    for($x = 0; $x < 10; $x++) {
                        echo("*");
                    }
                ?>
                </p>

                <p><strong>Cell Phone: </strong>
                    <?php
                        if($user != NULL) {
                            echo($user->getCell());
                        }
                    ?>
                </p>

                <p><strong>Security Question: </strong>
                    <?php
                        if($securityQuestion != NULL) {
                            echo($securityQuestion->getQuestion());
                        }
                    ?>
                </p>

                <p><strong>Part of Mailing List?: </strong>
                    <?php
                        if($user != NULL) {
                            if ($user->getEmailBlasts() == TRUE) {
                                echo("Yes");
                            } else {
                                echo("No");
                            }
                        }
                    ?>
                </p>

                <p><strong>Signed up for text blasts?: </strong>
                    <?php
                        if($user != NULL) {
                            if ($user->getTextBlasts() == TRUE) {
                                echo("Yes");
                            } else {
                                echo("No");
                            }
                        }
                    ?>
                </p>

                <form action='account-info-edit.php' method='post'>
                    <p><input type='submit' value='Edit' class="button" /></p> <br/>
                </form>

                <div id='progress'>
                    <div class='progress-section3'>
                        <div class='inprogress-bar'>&nbsp;</div>
                        <p>Step 1: Account Info</p>
                    </div>
                    <div class='progress-section3'>
                        <div class='unfinished-bar'>&nbsp;</div>
                        <p>Step 2: Edit Account Info</p>
                    </div>
                    <div class='progress-section3'>
                        <div class='unfinished-bar'>&nbsp;</div>
                        <p>Step 3: Confirmation</p>
                    </div>
                </div>
                <div id='clear'></div>
        <?php
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