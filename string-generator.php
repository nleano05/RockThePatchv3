<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$networkInfo = NULL;
$validForm = FALSE;

if(isset($_POST['generate-strings'])) {
    $validForm = checkInput();
}

function checkInput() {
    global $gNoNumberOfStrings, $gBlackNumberOfStrings, $gNumericNumberOfStrings;
    global $gNoNumberOfCharactersInEachString, $gBlackNumberOfCharactersInEachString, $gNumericNumberOfCharactersInEachString;

    $validForm = TRUE;

    $numberOfStrings = isset($_POST['number-of-strings']) ? $_POST['number-of-strings'] : "";
    $numberOfCharactersInEachString = isset($_POST['number-of-characters-in-each-string']) ? $_POST['number-of-characters-in-each-string'] : "";

    $gNoNumberOfStrings = lib_check::isEmpty($numberOfStrings);
    if($gNoNumberOfStrings) {
        $validForm = FALSE;
    }

    $gBlackNumberOfStrings = lib_check::againstWhiteList($numberOfStrings);
    if($gBlackNumberOfStrings) {
        $validForm = FALSE;
    }

    $gNumericNumberOfStrings = is_numeric($numberOfStrings);
    if(!$gNumericNumberOfStrings) {
        $validForm = FALSE;
    }

    $gNoNumberOfCharactersInEachString = lib_check::isEmpty($numberOfCharactersInEachString);
    if($gNoNumberOfCharactersInEachString) {
        $validForm = FALSE;
    }

    $gBlackNumberOfCharactersInEachString = lib_check::againstWhiteList($numberOfCharactersInEachString);
    if($gBlackNumberOfCharactersInEachString) {
        $validForm = FALSE;
    }

    $gNumericNumberOfCharactersInEachString = is_numeric($numberOfCharactersInEachString);
    if(!$gNumericNumberOfCharactersInEachString) {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputNumberOfStrings() {
    global $gNoNumberOfStrings, $gBlackNumberOfStrings, $gNumericNumberOfStrings;

    if($gNoNumberOfStrings) {
        echo("<p class='error'>Please enter in a number of strings to generate.</p>");
    } else if($gBlackNumberOfStrings) {
        echo("<p class='error'>The number of strings to generate contains characters that are not allowed.</p>");
    } else if(!$gNumericNumberOfStrings) {
        echo("<p class='error'>The number of strings to generate was not numeric</p>");
    }
}

function displayOutputNumberOfCharactersInEachString() {
    global $gNoNumberOfCharactersInEachString, $gBlackNumberOfCharactersInEachString, $gNumericNumberOfCharactersInEachString;

    if($gNoNumberOfCharactersInEachString) {
        echo("<p class='error'>Please enter in number of characters in each string.</p>");
    } else if($gBlackNumberOfCharactersInEachString) {
        echo("<p class='error'>The number of characters in each string contains characters that are not allowed.</p>");
    } else if(!$gNumericNumberOfCharactersInEachString) {
        echo("<p class='error'>The number of characters in each string in stings was not numeric</p>");
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
    <title>Rock the Patch! v3 - String Generator</title>
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
                <?php require_once("inc/nav-bar.php"); ?>
                <script type="text/javascript">
                    document.getElementById("string-generator").className  = "current";
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
        <h1>String Generator</h1>

        <!-- START string generator form -->
        <form action="string-generator.php" method="post" name="string-generator">
            <div class="label30">
                <p><strong>Number of strings:</strong></p>
            </div>
            <div class="input70">
                <p><input type="text" name="number-of-strings" value="<?php if(isset($_POST['number-of-strings'])) { echo($_POST['number-of-strings']); }?>" /></p>
                <?php
                    if(!$validForm && isset($_POST['generate-strings'])) {
                        displayOutputNumberOfStrings();
                    }
                ?>
            </div>
            <div class="clear"></div>

            <div class="label30">
                <p><strong>Number of characters in strings:</strong></p>
            </div>
            <div class="input70">
                <p><input type="text" name="number-of-characters-in-each-string" value="<?php if(isset($_POST['number-of-characters-in-each-string'])) { echo($_POST['number-of-characters-in-each-string']); }?>" /></p>
                <?php
                    if(!$validForm && isset($_POST['generate-strings'])) {
                        displayOutputNumberOfCharactersInEachString();
                    }
                ?>
            </div>
            <div class="clear"></div>

            <p class='float-right'><input type="submit" name="generate-strings" value="Generate Strings" class="button" /></p>
            <div class="clear"></div>
        </form>
        <!-- END string generator form -->

        <?php
            if($validForm && isset($_POST['generate-strings'])) {
        ?>
            <hr/>
        <?php
                $numberOfStrings = isset($_POST['number-of-strings']) ? $_POST['number-of-strings'] : "";
                $numberOfCharactersInEachString = isset($_POST['number-of-characters-in-each-string']) ? $_POST['number-of-characters-in-each-string'] : "";

                for($i = 0; $i < $numberOfStrings; $i++) {
                    echo("<p>" . lib::generateRandomString($numberOfCharactersInEachString) . "</p>");
                }
            }
        ?>

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