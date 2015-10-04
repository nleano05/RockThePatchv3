<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gLoginStatus;

if(isset($_POST['login-debug-mode'])) {
    if($gLoginStatus == STATUS_LOGGED_OUT) {
        log_util::log(LOG_LEVEL_DEBUG, "Not logged in, attempting to log in");
        login(TRUE, TRUE);
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "Logged in, redirecting to referer");
        lib::redirect(FALSE, NULL, FALSE, "/index.php");
    }
} else {
    if($gLoginStatus == STATUS_LOGGED_OUT) {
        log_util::log(LOG_LEVEL_DEBUG, "Not logged in, attempting to log in");
        login(TRUE, FALSE);
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "Logged in, redirecting to referer");
        lib::redirect(FALSE, NULL, FALSE, "/index.php");
    }
}

function displayOutputLogin() {
    global $gLoginStatus, $gAccountLocked, $gUser;

    $userNameOrEmail = isset($_POST['login-user-name-or-email']) ? strtolower($_POST['login-user-name-or-email']) : "";
    $password = isset($_POST['login-password']) ? $_POST['login-password'] : "";

    log_util::log(LOG_LEVEL_DEBUG, "userNameOrEmail: " . $userNameOrEmail);
    log_util::log(LOG_LEVEL_DEBUG, "password: " . $password);

    if($gLoginStatus == STATUS_LOGGED_IN) {
        echo("<h1>Login - SUCCESS</h1>");
        echo("<p><strong>Congrats! You were successfully logged in.</strong></p>");

        $referer = lib_get::referer();
        if($referer != null && !lib_check::endsWith("/user-system/login.php", $referer)) {
            lib::redirect(FALSE, NULL, TRUE, NULL);
        } else {
            echo("<p><strong><em>The referer was the login page so you are not being redirected...</em></strong></p>");
        }
    } else {
        echo("<h1>Login - FAILURE!</h1>");

        if($gAccountLocked != NULL && $gAccountLocked->getLocked()) {
            if($gAccountLocked->getType() != LOCK_TYPE_ADMIN) {
                echo("<p><strong>Failure Reason:</strong><br/> Sorry, the account was <em><strong>LOCKED</strong></em>, please try again 30 mins from: " . $gUser->getTimeLocked() . " GMT.</p>");
                echo("<p><strong>Time remaining: </strong>" . round((30 - ($gAccountLocked->getTimeDifference() / 60))) . " mins</p>");
            } else {
               echo("<p><strong>Failure Reason:</strong><br/> Sorry, the account was <em><strong>LOCKED</strong></em>, by an administrator.  Please contact them to get unlocked.</p>");
            }
        } else if(!empty($userNameOrEmail) && !empty($password)) {
            echo("<p><strong>Failure Reason:</strong><br/> Incorrect username or password was given...please try again.</p>");
        } else if(empty($userNameOrEmail) && empty($password)) {
            echo("<p><strong>Failure Reason:</strong><br/> No username and password were given...please try again.</p>");
        } else if(empty($userNameOrEmail)){
            echo("<p><strong>Failure Reason:</strong><br/> No username was given...please try again.</p>");
        } else if(empty($password)) {
            echo("<p><strong>Failure Reason:</strong><br/> No password was given...please try again.</p>");
        } else {
            echo("<p><strong>Failure Reason:<strong><br/> Something freakishly bizarre has happened...userNameOrEmail: " . $userNameOrEmail . ", password: " . $password . ".  Please contact Patches.</p>");
        }

        if($gUser != NULL) {
            if ($gAccountLocked != NULL && !$gAccountLocked->getLocked()) {
                echo("<p><strong>Login Attempts:</strong> " . $gUser->getConsecutiveFailedLoginAttempts() . " <em>(You will only be given 5 before you are locked out for 30 mins)</em></p>");
            } else {
                echo("<p><strong>Login Attempts:</strong> " . $gUser->getConsecutiveFailedLoginAttempts() . "</p>");
            }
        }

        $referer = lib_get::referer();

        if($referer != null && !lib_check::endsWith("/user-system/login.php", $referer)) {
            lib::redirect(TRUE, NULL, TRUE, NULL);
        } else {
            echo("<p><strong><em>The referer was the login page so you are not being redirected...</em></strong></p>");
        }
    }

    log_util::logDivider();
}

function login($sendHeaders = TRUE, $noDebugModeOutput = FALSE) {
    global $gAccountLock, $gCredentialsOk, $gLoginStatus, $gUser;

    $userName = $email = isset($_POST['login-user-name-or-email']) ? strtolower($_POST['login-user-name-or-email']) : "";
    $password = isset($_POST['login-password']) ? $_POST['login-password'] : NULL;
    $gUser  = lib_database::getUser(NULL, $userName, $email, $password, false, $noDebugModeOutput);

    if(!$noDebugModeOutput) {
        log_util::log(LOG_LEVEL_DEBUG, "userName: " . $userName);
        log_util::log(LOG_LEVEL_DEBUG, "email: " . $email);
        log_util::log(LOG_LEVEL_DEBUG, "password: " . $password);
        log_util::log(LOG_LEVEL_DEBUG, "gUser: ", $gUser);
    }

    if($gUser != null) {
        $gAccountLock = lib_check::userIsLocked($email, $userName, $noDebugModeOutput);
        $gCredentialsOk = TRUE;
        $loginToken = lib::encrypt(STATUS_LOGGED_OUT, $gUser->getId() . "_login", $noDebugModeOutput);
        lib::cookieCreate(COOKIE_LOGIN_STATUS_KEY, $loginToken, $sendHeaders, $noDebugModeOutput);

        if ($gCredentialsOk && !$gAccountLock->getLocked()) {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "Login DID succeed");
            }

            $gLoginStatus = STATUS_LOGGED_IN;
            lib::encrypt(STATUS_LOGGED_IN, $gUser->getId() . "_login", $noDebugModeOutput);
            lib::cookieCreate(COOKIE_LOGIN_STATUS_KEY, base64_encode($gUser->getId() . "_login"), $sendHeaders, $noDebugModeOutput);

            lib_database::updateUserLockAttributes($gUser->getId(), TRUE);
            lib_database::writeLoginLogAndStatistics($gUser->getId(), TRUE);
        } else {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "Login DID NOT succeed");
            }

            lib_database::updateUserLockAttributes($gUser->getId(), FALSE);
            lib_database::writeLoginLogAndStatistics($gUser->getId(), FALSE);
        }
    } else {
        log_util::log(LOG_LEVEL_WARNING, "User WAS null");
        $gCredentialsOk = FALSE;
    }

    if(!$noDebugModeOutput) {
        log_util::logDivider();
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
    <title>Rock the Patch! v3 - Login</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Login</div>

        <?php
            displayOutputLogin();
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