<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gLoginStatus;
global $gValidForm;
$gValidForm = FALSE;

if(isset($_POST['change-password'])) {
    $gValidForm = checkInput();
}

function checkInput() {
    global $gNoUsernameOrEmail, $gNoOldPassword, $gNoNewPassword, $gNoNewPasswordConfirm;
    global $gBlackUsernameOrEmail, $gBlackOldPassword, $gBlackNewPassword, $gBlackNewPasswordConfirm;
    global $gPasswordsMatch;
    global $gInUseUsernameOrEmail;
    global $gInvalidNewPassword;

    $validForm = TRUE;

    $userNameOrEmail = isset($_POST['username-or-email']) ? $_POST['username-or-email'] : "";
    $oldPassword = isset($_POST['old-password']) ? $_POST['old-password'] : "";
    $newPassword = isset($_POST['new-password']) ? $_POST['new-password'] : "";
    $newPasswordConfirm = isset($_POST['new-password-confirm']) ? $_POST['new-password-confirm'] : "";

    $gNoUsernameOrEmail = lib_check::isEmpty($userNameOrEmail);
    if($gNoUsernameOrEmail) {
        $validForm = FALSE;
    }

    $gNoOldPassword  = lib_check::isEmpty($oldPassword);
    if($gNoOldPassword) {
        $validForm = FALSE;
    }

    $gNoNewPassword = lib_check::isEmpty($newPassword);
    if($gNoNewPassword) {
        $validForm = FALSE;
    }

    $gNoNewPasswordConfirm = lib_check::isEmpty($newPasswordConfirm);
    if($gNoNewPasswordConfirm) {
        $validForm = FALSE;
    }

    $gBlackUsernameOrEmail = lib_check::againstWhiteList($userNameOrEmail);
    if($gBlackUsernameOrEmail) {
        $validForm = FALSE;
    }

    $gBlackOldPassword = lib_check::againstWhiteList($oldPassword);
    if($gBlackOldPassword) {
        $validForm = FALSE;
    }

    $gBlackNewPassword = lib_check::againstWhiteList($newPassword);
    if($gBlackNewPassword) {
        $validForm = FALSE;
    }

    $gBlackNewPasswordConfirm = lib_check::againstWhiteList($newPasswordConfirm);
    if($gBlackNewPasswordConfirm) {
        $validForm = FALSE;
    }

    $gPasswordsMatch = lib_check::same($newPassword, $newPasswordConfirm);
    if(!$gPasswordsMatch) {
        $validForm = FALSE;
    }

    $gInUseUsernameOrEmail = lib_check::userInDb(null, $userNameOrEmail, $userNameOrEmail);
    if(!$gInUseUsernameOrEmail) {
        $validForm = FALSE;
    }

    $gInvalidNewPassword = lib_check::validPassword($newPassword);
    if($gInvalidNewPassword) {
        $validForm = FALSE;
    }

    $gCorrectOldPassword = lib_check::userInDb(null, $userNameOrEmail, $userNameOrEmail, $oldPassword);
    if(!$gCorrectOldPassword) {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputUsernameOrEmail() {
    global $gNoUsernameOrEmail, $gBlackUsernameOrEmail, $gInUseUsernameOrEmail;

    if($gNoUsernameOrEmail) {
        echo("<p class='error'>Please enter in a user name or email to continue.</p>");
    } else if($gBlackUsernameOrEmail) {
        echo("<p class='error'>The user name or email entered contained characters that are not allowed.</p>");
    } else if(!$gInUseUsernameOrEmail) {
        echo("<p class='error'>User name or email isn't in our system.</p>");
    }
}

function displayOutputOldPassword() {
    global $gNoOldPassword, $gBlackOldPassword, $gCorrectOldPassword;

    if($gNoOldPassword) {
        echo("<p class='error'>Please enter in your <strong>OLD</strong> password to continue.</p>");
    } else if($gBlackOldPassword) {
        echo("<p class='error'>The <strong>OLD</strong> password entered contained characters that are not allowed.</p>");
    } else if(!$gCorrectOldPassword) {
        echo("<p class='error'>Incorrect <strong>OLD</strong> password entered.</p>");
    }
}

function displayOutputNewPassword() {
    global $gNoNewPassword, $gBlackNewPassword, $gPasswordsMatch;
    global $gPasswordNotCharNum, $gPasswordTooShort, $gPasswordTooLong, $gPasswordNoCapitalLetter, $gPasswordNoLowercaseLetter, $gPasswordNoNumber;

    if($gNoNewPassword) {
        echo("<p class='error'>Please enter in a <strong>NEW</strong> password to continue.</p>");
    } else if($gBlackNewPassword) {
        echo("<p class='error'>The <strong>NEW</strong> password entered contained characters that are not allowed.</p>");
    } else if(!$gPasswordsMatch) {
        echo("<p class='error'>The <strong>NEW</strong> password entered doesn't match the confirmed password.</p>");
    } else if($gPasswordTooShort) {
        echo("<p class='error'>The <strong>NEW</strong> password must be at least 6 characters.</p>");
    } else if($gPasswordTooLong) {
        echo("<p class='error'>The <strong>NEW</strong> password must be less than 20 characters.</p>");
    } else if($gPasswordNotCharNum) {
        echo("<p class='error'>The <strong>NEW</strong> password must not contain special characters.</p>");
    } else if($gPasswordNoCapitalLetter) {
        echo("<p class='error'>The <strong>NEW</strong> password must contain at least one upper case letter.</p>");
    } else if($gPasswordNoLowercaseLetter) {
        echo("<p class='error'>The <strong>NEW</strong> password must contain at least one lower case letter.</p>");
    } else if($gPasswordNoNumber) {
        echo("<p class='error'>The <strong>NEW</strong> password must contain at least one number.</p>");
    }
}

function displayOutputNewPasswordConfirm() {
    global $gNoNewPasswordConfirm, $gBlackNewPasswordConfirm;

    if($gNoNewPasswordConfirm) {
        echo("<p class='error'>Please confirm your <strong>NEW</strong> password to continue.</p>");
    } else if($gBlackNewPasswordConfirm) {
        echo("<p class='error'>The confirmed <strong>NEW</strong> password contains characters that are not allowed.</p>");
    }
}

function sendConfirmationEmail() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $newPassword = isset($_POST['new-password']) ? $_POST['new-password'] : "";

    $user = lib_get::currentUser();

    if($user != NULL) {
        $userName = $user->getUserName();
        $email = $user->getEmail();

        $subject = "Rock the Patch! - Password Change";
        $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Password Change</h2>\r\n\r\n"
            ."\r\n"
            ."The 'Rock the Patch!' user account associated with this email has gone through the change password process and has "
            ."updated their password with a new one. If you have not requested this, please respond to $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a> and let her know.  Below "
            ."is the information we have on file for you:<br/><br/>\r\n"
            ."\r\n"
            ."<strong>User Name:</strong> $userName<br/><br/>\r\n\r\n"
            ."<strong>Email:</strong> $email<br/><br/>\r\n\r\n";

        $success = lib::sendMail($email, $subject, $body);
        if($success) {
            echo("<p><strong><em>EMAIL SUCCESS -- You have been emailed a confirmation that you have changed your password. You can now use this to log in.</em></strong></p>");
        } else {
            echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to email your confirmation that you have changed your password even though your information was valid.  Please try later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>.</em></strong></p>");
        }
        lib_database::updateUserPassword($user->getId(), $newPassword);
    } else {
        log_util::log(LOG_LEVEL_ERROR, "No user to change password for");
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Change Password</div>

        <h1>Change Password</h1>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
        ?>
            <p>Please enter in your existing user name and password and then enter in a password you'd like to replace it with.</p>

            <?php
                if(!$gValidForm) {
            ?>
                <!-- ### START Change Password Form ### -->
                <form action="change-password.php" method="post">
                    <!-- Email account / user name -->
                    <div class="label30">
                        <p><strong>Email / User Name:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="text" name="username-or-email" value="<?php if(isset($_POST['username-or-email'])){ echo($_POST['username-or-email']); } ?>"/></p>
                        <?php
                            if(!$gValidForm && isset($_POST['change-password'])) {
                                displayOutputUsernameOrEmail();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <!-- Old Password -->
                    <div class="label30">
                        <p><strong>Old Password:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="password" name="old-password" value="<?php if(isset($_POST['old-password'])){ echo($_POST['old-password']); } ?>"/></p>
                        <?php
                            if(!$gValidForm && isset($_POST['change-password'])) {
                                displayOutputOldPassword();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <!-- Confirm Password -->
                    <div class="label30">
                        <p><strong>New Password:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="password" name="new-password" value="<?php if(isset($_POST['new-password'])){ echo($_POST['new-password']); } ?>"/></p>

                        <?php
                            if(!$gValidForm && isset($_POST['change-password'])) {
                                displayOutputNewPassword();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <!-- Confirm New Password -->
                    <div class="label30">
                        <p><strong>Confirm Password:</strong></p>
                    </div>
                    <div class="input70">
                        <p><input type="password" name="new-password-confirm" value="<?php if(isset($_POST['new-password-confirm'])){ echo($_POST['new-password-confirm']); } ?>"/></p>
                        <?php
                            if(!$gValidForm && isset($_POST['change-password'])) {
                                displayOutputNewPasswordConfirm();
                            }
                        ?>
                    </div>
                    <div class="clear"></div>

                    <p><input type="submit" name="change-password" value="Change Password" class="button" /></p>
                </form>
                <br/>
                <!-- ### END Deactivate Account Form ### -->

                <div id="progress">
                    <div class="progress-section2">
                        <div class="inprogress-bar">&nbsp;</div>
                        <p>Step 1: Required Info</p>
                    </div>
                    <div class="progress-section2">
                        <div class="unfinished-bar">&nbsp;</div>
                        <p>Step 2: Confirmation</p>
                    </div>
                </div>
                <div class="clear"></div>
            <?php
                } else {
                    sendConfirmationEmail();
            ?>
                <br/>

                <div id="progress">
                    <div class="progress-section2">
                        <div class="finished-bar">&nbsp;</div>
                        <p>Step 1: Required Info</p>
                    </div>
                    <div class="progress-section2">
                        <div class="unfinished-bar">&nbsp;</div>
                        <p>Step 2: Confirmation</p>
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