<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$postKeys = array_keys($_POST);
log_util::log(LOG_LEVEL_DEBUG, "post: ", $_POST);
log_util::log(LOG_LEVEL_DEBUG, "postKeys: ", $postKeys);

$validForm = FALSE;

global $gUpdate;
global $gUpdateId;

if(isset($_GET['id'])) {
    $gUpdateId = $_GET['id'];
    $gUpdate = lib_database::getUpdateById($gUpdateId);
}

if (isset($_POST['save-update'])) {
    $validForm = checkInput();
    if($validForm) {
        if (empty($gUpdate)) {
            $gUpdate = new Update();
        }
        $gUpdate->setTitle($_POST['update-title']);
        $gUpdate->setText($_POST['update-body']);
        $gUpdate->setDate($_POST['update-date']);
        log_util::log(LOG_LEVEL_DEBUG, "update: ", $gUpdate);
        lib_database::writeUpdate($gUpdate);
    }
}

function checkInput(){
    $validForm = TRUE;

    global $gNoTitle, $gNoBody, $gNoDate, $gBlackTitle;

    $updateTitle = isset($_POST['update-title']) ? $_POST['update-title'] : "";
    $updateBody = isset($_POST['update-body']) ? $_POST['update-body'] : "";
    $updateDate = isset($_POST['update-date']) ? $_POST['update-date'] : "";

    $gNoTitle = lib_check::isEmpty($updateTitle);
    if($gNoTitle) {
        $validForm = FALSE;
        log_util::log(LOG_LEVEL_DEBUG, "title WAS empty");
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "title WAS NOT empty");
    }

    $gNoBody = lib_check::isEmpty($updateBody);
    if($gNoBody) {
        $validForm = FALSE;
        log_util::log(LOG_LEVEL_DEBUG, "body WAS empty");
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "body WAS NOT empty");
    }

    $gNoDate = lib_check::isEmpty($updateDate);
    if($gNoDate) {
        $validForm = FALSE;
        log_util::log(LOG_LEVEL_DEBUG, "date WAS empty");
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "date WAS NOT empty");
    }

    $gBlackTitle = lib_check::againstWhiteList($updateTitle);
    if($gBlackTitle) {
        $validForm = FALSE;
        log_util::log(LOG_LEVEL_DEBUG, "title DID NOT match the white list");
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "title DID match the white list");
    }

    return $validForm;
}

function displayOutputTitle() {
    global $gNoTitle, $gBlackTitle;

    if($gNoTitle) {
        echo("<p class='error'>Please enter in a title for the update.</p>");
    } else if ($gBlackTitle) {
        echo("<p class='error'>The title entered contains characters that are not allowed.</p>");
    }
}

function displayOutputBody() {
    global $gNoBody;

    if($gNoBody) {
        echo("<p class='error'>Please enter in text for the update.</p>");
    }
}

function displayOutputDate() {
    global $gNoDate;

    if($gNoDate) {
        echo("<p class='error'>Please select a date for the update.</p>");
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
    <?php
        if($gUpdate == NULL || empty($gUpdate)) {
            echo("<title>Rock the Patch! v3 - Add Update</title>");
        } else {
            echo("<title>Rock the Patch! v3 - Edit Update</title>");
        }
    ?>
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

    <!-- ### JQuery import for date picker ### -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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
        <?php
            if($gUpdate == NULL || empty($gUpdate)) {
        ?>
                <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Add Update</div>
                <h1>Add Update</h1>
        <?php
            } else {
        ?>
                <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Edit Update</div>
                <h1>Edit Update</h1>
        <?php
            }
        ?>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
        ?>
            <?php
                if(!empty($gUpdateId)){
                    echo("<form action='add-or-edit-update.php?id=$gUpdateId' method='post' name='add-or-edit-update-form'>");
                } else {
                    echo("<form action='add-or-edit-update.php' method='post' name='add-or-edit-update-form'>");
                }

            ?>
                <p><strong>Update Title:</strong></p>
                <p><input type="text" name="update-title" value="<?php if(isset($_POST['update-title'])) { echo($_POST['update-title']); } else if(!empty($gUpdate) && !empty($gUpdate->getTitle())){ echo($gUpdate->getTitle()); } ?>"/></p>
                <?php
                    if(!$validForm && isset($_POST['save-update'])) {
                        displayOutputTitle();
                    }
                ?>

                <p><strong>Update:</strong></p>
                <p><textarea name="update-body" rows="5" cols="1" style="width:100%;height:125px;"><?php if(isset($_POST['update-body'])) { echo($_POST['update-body']); } else if(!empty($gUpdate) && !empty($gUpdate->getText())) { echo($gUpdate->getText()); }?></textarea></p>
                <?php
                    if(!$validForm && isset($_POST['save-update'])) {
                        displayOutputBody();
                    }
                ?>

                <p><strong>Date:</strong></p>
                <p><input id="update-date" name="update-date" type="text"  value="<?php if(isset($_POST['update-date'])) { echo($_POST['update-date']); } else if(!empty($gUpdate) && !empty($gUpdate->getDate())){ echo($gUpdate->getDate()); } ?>"></p>
                <?php
                    if(!$validForm && isset($_POST['save-update'])) {
                        displayOutputDate();
                    }
                ?>

                <p><input type='submit' name='save-update' value='Save Update' class='button' /></p>
            </form>

            <script type="text/javascript">
                 $('#update-date').datepicker();
            </script>

        <?php
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