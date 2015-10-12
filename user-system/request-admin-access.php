<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gValidForm;
$gValidForm = FALSE;

if(isset($_POST['request-admin-access'])) {
    $gValidForm = checkInput();
}

function sendRequestForAdminAccess() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $reason = isset($_POST['reason']) ? $_POST['reason'] : "";
    $user = lib_get::currentUser();

    $firstName = $user->getFirstName();
    $lastName = $user->getLastName();
    $userName = $user->getUserName();
    $email = $user->getEmail();

    $subject = "Rock the Patch! - Admin Access Request";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Admin Access Request</h2>\r\n\r\n"
        ."\r\n"
        ."The 'Rock the Patch!' user account associated with this email has requested admin access. "
        ."If you have not requested this, please respond to $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a> and let her know.  Below "
        ."is the information we had on file for you:<br/><br/>\r\n"
        ."\r\n"
        ."<strong>First Name:</strong> $firstName<br/><br/>\r\n\r\n"
        ."<strong>Last Name:</strong> $lastName<br/><br/>\r\n\r\n"
        ."<strong>User Name:</strong> $userName<br/><br/>\r\n\r\n"
        ."<strong>Email:</strong> $email<br/><br/>\r\n\r\n"
        ."<strong>Reason:</strong> $reason<br/><br/>\r\n\r\n";

    $success = lib::sendMail($email, $subject, $body, TRUE);
    if($success) {
        echo("<p><strong><em>EMAIL SUCCESS -- You have been emailed a confirmation that you have requested admin access.</em></strong></p>");
    } else {
        echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to email your confirmation that you have requested admin access even though your information was valid.  Please try later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>.</em></strong></p>");
    }
}


function checkInput() {
    global $gNoReason, $gBlackReason;

    $validForm = TRUE;
    $reason = isset($_POST['reason']) ? $_POST['reason'] : "";

    $gNoReason = lib_check::isEmpty($reason);
    if($gNoReason) {
        $validForm = FALSE;
    }

    $gBlackReason = lib_check::againstWhiteList($reason);
    if($gBlackReason) {
        $validForm = FALSE;
    }

    return $validForm;
}


function displayOutputReason() {
    global $gNoReason, $gBlackReason;

    if($gNoReason) {
        echo("<p class='error'>Please enter in a reason to request admin access.</p>");
    } else if($gBlackReason) {
        echo("<p class='error'>The reason entered contain characters that are not allowed.</p>");
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
    <title>Rock the Patch! v3 - Request Admin Access</title>
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
                    if($gLoginStatus ==  STATUS_LOGGED_IN) {
                ?>
                    <!-- Script to display the current page in the navigation -->
                    <script type="text/javascript">
                        document.getElementById("request-admin-access").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Requestion Admin Access</div>
        <h1>Request Admin Access</h1>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
                $isAdmin = lib_check::userIsAdmin();
                if (!$isAdmin) {
                    if (!$gValidForm) {
                        ?>
                        <!-- ### START Request Admin Access Form ### -->
                        <form action="request-admin-access.php" method="post">
                            <p>Reason:</p>

                            <p>
                                <textarea name="reason" style="width:100%;height:125px;" rows="50"
                                          cols="100"><?php if (isset($_POST['reason'])) {
                                        echo($_POST['reason']);
                                    } ?></textarea>
                            </p>
                            <?php
                            if (!$gValidForm && isset($_POST['request-admin-access'])) {
                                displayOutputReason();
                            }
                            ?>

                            <p><input type="submit" value="Request Access" name="request-admin-access" class="button"/>
                            </p>
                        </form>
                        <br/>
                        <!-- ### END Request Admin Access Form ### -->

                        <div id="progress">
                            <div class="progress-section2">
                                <div class="finished-bar">&nbsp;</div>
                                <p>Step 1: Provide Explanation</p>
                            </div>
                            <div class="progress-section2">
                                <div class="inprogress-bar">&nbsp;</div>
                                <p>Step 2: Send Request</p>
                            </div>
                        </div>
                        <div class="clear"></div>

                        <?php
                    } else {
                        sendRequestForAdminAccess();
                        ?>
                        <p>Your request has been sent.</p>

                        <p style='word-break:break-all;'><strong>Reason:</strong> <?php if (isset($_POST['reason'])) {
                                echo($_POST['reason']);
                            } ?></p>

                        <div id="progress">
                            <div class="progress-section2">
                                <div class="finished-bar">&nbsp;</div>
                                <p>Step 1: Provide Explanation</p>
                            </div>
                            <div class="progress-section2">
                                <div class="inprogress-bar">&nbsp;</div>
                                <p>Step 2: Send Request</p>
                            </div>
                        </div>
                        <div class="clear"></div>
        <?php
                    }
                } else {
                    echo("<p><em>" . NOTICE_YOU_ARE_ALREADY_AN_ADMIN . "</em></p>");
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