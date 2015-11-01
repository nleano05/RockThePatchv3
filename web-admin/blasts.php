<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if (isset($_POST['send-blast'])) {
    $validForm = checkInput();
}

function checkInput() {
    global $gNoBlastComments, $gBlackBlastComments;

    $validForm = TRUE;

    $blastComments = isset($_POST['blast-comments']) ? $_POST['blast-comments'] : "";

    $gNoBlastComments = lib_check::isEmpty($blastComments);
    if($gNoBlastComments) {
        $validForm = FALSE;
    }

    $gBlackBlastComments = lib_check::againstWhiteList($blastComments);
    if($gBlackBlastComments) {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputBlastComments() {
    global $gNoBlastComments, $gBlackBlastComments;

    if($gNoBlastComments) {
        echo("<p class='error'>Please enter in comments for the blast.</p>");
    } else if($gBlackBlastComments) {
        echo("<p class='error'>The blast comments entered contain characters that are not allowed.</p>");
    }
}

function sendEmailBlast($list) {
    global $gMasterAdminEmail, $gMasterAdminName;

    $blastComments = isset($_POST['blast-comments']) ? $_POST['blast-comments'] : "";

    $fileForBlast =  $_FILES["file"]["name"];

    $invalidFile = lib_check::upload("../files-for-blasts/");

    if($invalidFile) {
        $file = "../files-for-blasts/" . $_FILES["file"]["name"];
        $tmp = explode('.', $_FILES["file"]["name"]);
        $extension = end($tmp);
        if(!empty($_FILES["file"]["name"])) {
            $fileForBlast = "Invalid file was uploaded for blast - '" . $file . "'";
        } else {
            $fileForBlast = "No file was uploaded for blast";
        }

        log_util::log(LOG_LEVEL_DEBUG, "file WAS NOT valid");
        log_util::log(LOG_LEVEL_DEBUG, "file: " . $file);
        log_util::log(LOG_LEVEL_DEBUG, "extension: " . $extension);
        log_util::log(LOG_LEVEL_DEBUG, "fileForBlast: " . $fileForBlast);
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "file WAS valid");
    }

    $subject = "Rock the Patch! - Update Blast";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Update Blast</h2>\r\n\r\n"
        ."\r\n"
        ."The 'Rock the Patch!' user account associated with this email or cell phone is part of the email or text blast list. "
        ."If you would like to unsubscribe, please edit your account information by logging on at <a href='www.rockthepatch.com' title='www.rockthepatch.com'>www.rockthepatch.com</a> "
        ."or respond to Patches at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a> and let her know.  Below "
        ."is the information about the recent update or news that was posted:<br/><br/>\r\n"
        ."\r\n"
        ."<em>\"$blastComments\"</em><br/><br/>\r\n\r\n"
        ."<strong>File For Blast:</strong> <em>\"$fileForBlast\"</em><br/><br/>\r\n\r\n"
        ."<em>***Note*** At this time, text users will not get attachments sent to them.  To see attachments sent with the blast, please sign up for the email list.  Also, not all wireless carriers may be supported.<br/><br/></em>\r\n\r\n";

    if(!empty($_FILES["file"]["name"])) {
        $file = "../files-for-blasts/" . $_FILES["file"]["name"];
        $fileType = $_FILES["file"]["type"];
    } else {
        $file = "";
        $fileType = "";
    }

    log_util::log(LOG_LEVEL_DEBUG, "file: " . $file);
    log_util::log(LOG_LEVEL_DEBUG, "fileType: " . $fileType);

    if(!empty($file)) {
        log_util::log(LOG_LEVEL_DEBUG, "There WAS a file uploaded");

        if($invalidFile) {
            log_util::log(LOG_LEVEL_DEBUG, "The file uploaded IS NOT valid");
            $success = lib::sendMail($list, $subject, $body);
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "The file uploaded IS valid");
            $success = lib::sendMail($list, $subject, $body, FALSE, TRUE, $file, $fileType);
        }
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "There WAS NOT a file uploaded");
        $success = lib::sendMail($list, $subject, $body);
    }

    return $success;
}

function sendTextBlast($list) {
    global $gMasterAdminEmail, $gMasterAdminName;

    $blastComments = isset($_POST['blast-comments']) ? $_POST['blast-comments'] : "";

    $fileForBlast = "Not applicable for text emails.";

    $subject = "Rock the Patch! - Update Blast";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Update Blast</h2>\r\n\r\n"
        ."\r\n"
        ."The 'Rock the Patch!' user account associated with this email or cell phone is part of the email or text blast list. "
        ."If you would like to unsubscribe, please edit your account information by logging on at <a href='www.rockthepatch.com' title='www.rockthepatch.com'>www.rockthepatch.com</a> "
        ."or respond to Patches at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a> and let her know.  Below "
        ."is the information about the recent update or news that was posted:<br/><br/>\r\n"
        ."\r\n"
        ."<em>\"$blastComments\"</em><br/><br/>\r\n\r\n"
        ."<strong>File For Blast:</strong> <em>\"$fileForBlast\"</em><br/><br/>\r\n\r\n"
        ."<em>***Note*** At this time, text users will not get attachments sent to them.  To see attachments sent with the blast, please sign up for the email list.  Also, not all wireless carriers may be supported.<br/><br/></em>\r\n\r\n";

    $fail = FALSE;
    foreach($list as $key => $value) {
        log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
        log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

        $success = lib::sendMail($value, $subject, $body);
        if(!$success) {
            $fail = TRUE;
        }
    }

    return $fail;
}
?>
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
    <title>Rock the Patch! v3 - Access Control</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Blasts</div>
        <h1>Blasts</h1>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
                    if(!$validForm) {
        ?>
                        <form action="blasts.php" method="post" enctype="multipart/form-data">
                            <p><strong>Email(s) on mailing list:</strong></p>
                            <?php
                                lib_database::getMailingList(true);
                            ?>

                            <p><strong>Number(s) for text blast:</strong></p>
                            <?php
                                lib_database::getTextList(true);
                            ?>

                            <p><strong>Comments for the blast: </strong></p>
                            <p><textarea name="blast-comments" rows="5" cols="1" style="width:100%;height:125px;"></textarea></p>
                            <?php
                                if(isset($_POST['send-blast'])) {
                                    displayOutputBlastComments();
                                }
                            ?>

                            <p><strong>File for blast:</strong></p> <div class="file-input"><p><input type="file" id="file" name="file"/></p></div>
                            <p><em><strong>*NOTE*</strong> Only .gif, .jpeg, and .png files that are less than 20MB will be allowed as attachments.</em></p>
                            <?php
                                if(isset($_POST['send-blast'])) {
                                    $invalidFile = lib_check::upload("../files-for-blasts/");
                                }
                            ?>

                            <p><strong>Mailing Type</strong> </p>
                            <ul>
                                <li><strong><em> Normal: </em></strong> Email and text users who are currently signed up for email/text lists</li>
                                <li><strong><em> Test: </em></strong> Send the blast to certain test devices and email addresses</li>
                                <li><strong><em> All: </em></strong> Email all of the users in the system regardless of mailing preference (no text blast)</li>
                            </ul>
                            <div class='radio-button-holder'>
                                <?php
                                    $mailingType = isset($_POST['mailing-type']) ? $_POST['mailing-type'] : "Normal";
                                    if($mailingType == "Normal") {
                                ?>
                                        <p><input type="radio" name="mailing-type" value="Normal" checked="checked" />Normal</p>
                                        <p><input type="radio" name="mailing-type" value="Test" />Test</p>
                                        <p><input type="radio" name="mailing-type" value="All" />All</p>
                                <?php
                                    } else if($mailingType == "Test") {
                                        ?>
                                        <p><input type="radio" name="mailing-type" value="Normal" />Normal</p>
                                        <p><input type="radio" name="mailing-type" value="Test" checked="checked" />Test</p>
                                        <p><input type="radio" name="mailing-type" value="All" />All</p>
                                <?php
                                    } else if($mailingType == "All") {
                                ?>
                                        <p><input type="radio" name="mailing-type" value="Normal"  />Normal</p>
                                        <p><input type="radio" name="mailing-type" value="Test" />Test</p>
                                        <p><input type="radio" name="mailing-type" value="All" checked="checked" />All</p>
                                <?php
                                    }
                                ?>
                            </div>

                            <p><input type="submit" name="send-blast" value="Send Blast" class="button" /></p>
                        </form>
        <?php       } else {
                        echo("<p><strong>Email(s) on mailing list:</strong></p>");

                        $mailingType = isset($_POST['mailing-type']) ? $_POST['mailing-type'] : "Normal";
                        if($mailingType == "Normal") {
                            $emailList = lib_database::getMailingList(TRUE);
                        } else if($mailingType == "Test") {
                            $emailList = lib_database::getMailingList(TRUE, TRUE);
                        } else {
                            $emailList = lib_database::getAllEmails(TRUE);
                        }

                        echo("<p><strong>Number(s) for text blast:</strong></p>");
                        if($mailingType == "Normal") {
                            $textList = lib_database::getTextList(TRUE);
                        } else if($mailingType == "Test") {
                            $textList = lib_database::getTextList(TRUE, TRUE);
                        }

                        echo("<p><strong>Comments for the blast:</strong></p>");
                        echo("<p>" . $_POST['blast-comments'] . "</p>");

                        $success = sendEmailBlast($emailList);
                        if($success) {
                            echo("<p><strong><em>EMAIL SUCCESS -- We were able to send out the email blast.</em></strong></p>");
                        } else {
                            echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to send out the email blast.</em></strong></p>");
                        }

                        if(isset($textList)) {
                            $fail = sendTextBlast($textList);
                            if(!$fail) {
                                echo("<p><strong><em>EMAIL SUCCESS -- We were able to send out the text blast.</em></strong></p>");
                            } else {
                                echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to send out the text blast.</em></strong></p>");
                            }
                        }
                    }
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