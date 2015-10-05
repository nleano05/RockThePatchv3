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
    <title>Rock the Patch! v3 - Registration Confirmation</title>
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
                <?php require_once("../inc/user-nav.php"); ?>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Registration Confirmation</div>

        <h1>Registration Confirmation</h1>

        <?php
			displayRegistrationConfirmation();

            function displayRegistrationConfirmation() {
                $currentUrl = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                $currentUrl = substr_replace($currentUrl, "https://www", 0,  3);

                log_util::log(LOG_LEVEL_DEBUG, "currentUrl: " . lib_get::currentUrl());
				
                if(isset($_GET['email']) && isset($_GET['userName']) && isset($_GET['lastName']) && isset($_GET['firstName'])) {
                    echo("<p>Thank you for confirming your email!  You may now use your email or user name with the password you registered with to log in as an official Rock the Patch! user.</p>");
                    $userInfo = urlParse($currentUrl); // urlParse will return an array with the user's info

                    log_util::log(LOG_LEVEL_DEBUG, "userInfo: ", $userInfo);

                    echo("<p><strong>Email Confirmed:</strong> " . $userInfo['email'] . "</p>");

                    $userAlreadyRegistered = lib_check::userInDb(NULL, $userInfo['email'], NULL, NULL, FALSE);
                    $userReadyToRegister = lib_check::userInDb(NULL, $userInfo['email'], NULL, NULL, TRUE);
					
                    if(!$userAlreadyRegistered) {
                        if($userReadyToRegister) {
                            lib_database::migrateUser($userInfo['email'], $userInfo['userName'], $userInfo['firstName'], $userInfo['lastName']);

                            $subject = "Rock the Patch! - Email Confirmed";
                            $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Email Confirmed</h2>\r\n\r\n"
                                ."\r\n"
                                ."This email was successfully confirmed and the account associated with it is now able to log in as an official Rock the Patch! user."
                                ."<br/><br/>\r\n\r\n"
                                ."<strong>Email Confirmed: </strong> " . $userInfo['email'] . "\r\n\r\n"
                                ."<br/><br/>\r\n\r\n";

                            $success = lib::sendMail($userInfo['email'], $subject, $body);

                            if($success) {
                                echo("<p><strong><em>EMAIL SUCCESS -- Yay! An email notification was sent that confirmation was successful</em></strong></p>");
                            } else {
                                echo("<p><strong><em>EMAIL FAILURE -- Bummer, an email notification <font class='error'>was not</font> send although the information was valid.  Please try again later or contact $masterAdminName at: <a href='mailto:$masterAdminEmail' title='Email $masterAdminName'>$masterAdminEmail</a>.</em></strong></p>");
                            }
                        } else {
                            echo("<p class='error'><strong><em>The given email was not found to complete registration.</em></strong></p>");
                        }
                    } else {
                        echo("<p class='error'><strong><em>The given email has already completed registration.</em></strong></p>");
                    }
                } else {
                    echo("<p style='color:red'>You have incorrectly come across this page, there is no information to process.</p>");
                }
            }

            function urlParse($currentURL) {
                $userInfo = array();
                
				$userInfo['email'] = isset($_GET['email']) ? base64_decode($_GET['email']) : "";
				$userInfo['userName'] = isset($_GET['userName']) ? base64_decode($_GET['userName']) : "";
				$userInfo['firstName'] = isset($_GET['firstName']) ? base64_decode($_GET['firstName']) : "";
				$userInfo['lastName'] = isset($_GET['lastName']) ? base64_decode($_GET['lastName']) : "";

                log_util::log(LOG_LEVEL_DEBUG, "userInfo: ", $userInfo);

                return $userInfo;
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