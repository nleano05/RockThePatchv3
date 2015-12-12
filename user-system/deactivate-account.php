<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if(isset($_POST['deactivate-account'])) {
    $validForm = checkInput();
}

function checkInput() {
    global $gNoUserNameOrEmail, $gNoPassword, $gNoPasswordConfirm;
    global $gBlackUserNameOrEmail, $gBlackPassword, $gBlackPasswordConfirm;
    global $gPasswordsMatch;
    global $gIsCurrentUser;
    global $gInUseUserNameOrEmail;
    global $gCorrectPassword;

    $validForm = TRUE;

    $userNameOrEmail = isset($_POST['username-or-email']) ? strtolower($_POST['username-or-email']) : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $passwordConfirm = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : "";

    $gNoUserNameOrEmail = lib_check::isEmpty($userNameOrEmail);
    if($gNoUserNameOrEmail) {
        $validForm = FALSE;
    }

    $gNoPassword = lib_check::isEmpty($password);
    if($gNoPassword) {
        $validForm = FALSE;
    }

    $gNoPasswordConfirm = lib_check::isEmpty($passwordConfirm);
    if($gNoPasswordConfirm) {
        $validForm = FALSE;
    }

    $gBlackUserNameOrEmail = lib_check::againstWhiteList($userNameOrEmail);
    if($gBlackUserNameOrEmail) {
        $validForm = FALSE;
    }

    $gBlackPassword = lib_check::againstWhiteList($password);
    if($gBlackPassword) {
        $validForm = FALSE;
    }

    $gBlackPasswordConfirm = lib_check::againstWhiteList($passwordConfirm);
    if($gBlackPasswordConfirm) {
        $validForm = FALSE;
    }

    $gPasswordsMatch = lib_check::same($password, $passwordConfirm);
    if(!$gPasswordsMatch) {
        $validForm = FALSE;
    }

    $currentUser = lib_get::currentUser();

    $gInUseUserNameOrEmail = lib_check::userInDb(NULL, $userNameOrEmail, $userNameOrEmail, NULL, FALSE);
    if(!$gInUseUserNameOrEmail) {
        $validForm = FALSE;
    }

    if($currentUser != NULL && ($userNameOrEmail = $currentUser->getEmail() || $userNameOrEmail == $currentUser->getUserName())) {
        $gIsCurrentUser = TRUE;
    } else {
        $gIsCurrentUser = FALSE;
        $validForm = FALSE;
    }

    if($currentUser != NULL) {
        $passwordFromDatabase = lib::decrypt($currentUser->getId() . "_pass");
        $gCorrectPassword = lib_check::same($password, $passwordFromDatabase);
        if(!$gCorrectPassword) {
            $validForm = FALSE;
        }
    } else {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputUserNameOrEmail() {
    global $gNoUserNameOrEmail, $gBlackUserNameOrEmail, $gInUseUserNameOrEmail, $gIsCurrentUser;

    if($gNoUserNameOrEmail) {
        echo("<p class='error'>Please enter in an your user name or email to continue.</p>");
    } else if($gBlackUserNameOrEmail) {
        echo("<p class='error'>The user name or email entered contained characters that are not allowed.</p>");
    } else if(!$gInUseUserNameOrEmail) {
        echo("<p class='error'>The user name or email isn't registered in the 'Rock the Patch!' system.</p>");
    } else if(!$gIsCurrentUser) {
        echo("<p class='error'>You can't deactivate the account of another user.</p>");
    }
}

function displayOutputPassword() {
    global $gNoPassword, $gBlackPassword, $gCorrectPassword, $gPasswordsMatch;

    if($gNoPassword) {
        echo("<p class='error'>Please enter in your password to continue.</p>");
    } else if($gBlackPassword) {
        echo("<p class='error'>The password entered contained characters that are not allowed.</p>");
    } else if(!$gPasswordsMatch) {
        echo("<p class='error'>The passwords you have entered do not match.</p>");
    } else if(!$gCorrectPassword) {
        echo("<p class='error'>Incorrect old password entered.</p>");
    }
}

function displayOutputPasswordConfirm() {
    global $gNoPasswordConfirm, $gBlackPasswordConfirm;

    if($gNoPasswordConfirm) {
        echo("<p class='error'>Please confirm your password to continue.</p>");
    } else if($gBlackPasswordConfirm) {
        echo("<p class='error'>The confirmed password entered contained characters that are not allowed.</p>");
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
    <title>Rock the Patch! v3 - Deactivate Account</title>
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
                        document.getElementById("deactivate-account").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Deactivate Account</div>

        <h1>Deactivate Account</h1>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
                if(!$validForm) {
        ?>
                <p>Please enter in your email/user name and password, then click the 'Deactivate Account' button to cease being a 'Rock the Patch!' member.</p>

                <!-- ### START Deactivate Account Form ### -->
                <form action="deactivate-account.php" method="post">
                    <!-- Email account / user name -->
                    <div class="label30">
                        <p><strong>Email / User Name:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="text" name="username-or-email" value="<?php if(isset($_POST['username-or-email'])){ echo($_POST['username-or-email']); } ?>"/></p>
                        <?php
                            if(isset($_POST['deactivate-account'])) {
                                displayOutputUsernameOrEmail();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <!-- Password -->
                    <div class="label30">
                        <p><strong>Password:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="password" name="password" value="<?php if(isset($_POST['password'])){ echo($_POST['password']); } ?>"/></p>
                        <?php
                            if(isset($_POST['deactivate-account'])) {
                                displayOutputPassword();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <!-- Password Confirm -->
                    <div class="label30">
                        <p><strong>Confirm Password:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="password" name="password-confirm" value="<?php if(isset($_POST['password-confirm'])){ echo($_POST['password-confirm']); }?>"/></p>
                        <?php
                            if(isset($_POST['deactivate-account'])) {
                                displayOutputPasswordConfirm();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <p><input type="submit" name="deactivate-account" value="Deactivate" class="button" /></p>
                </form>
                <br/>
                <!-- ### END Deactivate Account Form ### -->


                <div id="progress">
                    <div class="progress-section3">
                        <div class="inprogress-bar">&nbsp;</div>
                        <p>Step 1: Account Info</p>
                    </div>
                    <div class="progress-section3">
                        <div class="unfinished-bar">&nbsp;</div>
                        <p>Step 2: Confirmation</p>
                    </div>
                    <div class="progress-section3">
                        <div class="unfinished-bar">&nbsp;</div>
                        <p>Step 3: Complete</p>
                    </div>
                </div>
                <div class="clear"></div>

        <?php
            } else {
        ?>
                <p>Are you really sure you want to deactivate your 'Rock the Patch!' account.  You'll no longer have access to the special news, videos, downloads,
                    and other cool features that are exclusive to members?</p>
                <form action="deactivate-account-confirm.php" method="post">
                    <p>
                        <input type='radio' name='confirm' value='yes' /> Yes
                        <input type='radio' name='confirm' value='no' /> No
                    </p>
                    <p>Please leave some remarks about why you are leaving below:</p>
                    <p>
                        <textarea type="textarea" name="comments" style="width:100%;height:125px;"></textarea>
                    </p>
                    <p><input type="submit" name="deactivate-account-confirm" value="Finish Deactivation" class="button" /></p>
                </form>
                <p id="clear"></p>

                <div id="progress">
                    <div class="progress-section3">
                        <div class="finished-bar">&nbsp;</div>
                        <p>Step 1: Account Info</p>
                    </div>
                    <div class="progress-section3">
                        <div class="inprogress-bar">&nbsp;</div>
                        <p>Step 2: Confirmation</p>
                    </div>
                    <div class="progress-section3">
                        <div class="unfinished-bar">&nbsp;</div>
                        <p>Step 3: Complete</p>
                    </div>
                </div>
                <div class="clear"></div>
        <?php
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