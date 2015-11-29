<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gCompClass, $gCompImage, $gCompScore, $gResult, $gRounds, $gTies, $gUserClass, $gUserImage, $gUserScore;

if(isset($_POST["rock_x"])) {
    $gUserChoice = "rock";
} else if(isset($_POST["paper_x"])) {
    $gUserChoice = "paper";
} else if(isset($_POST["scissors_x"])) {
    $gUserChoice = "scissors";
} else {
    $gUserChoice = "";
}

if(isset($_COOKIE["rounds"])) {
    $gRounds  = $_COOKIE["rounds"];
} else {
    $gRounds = 0;
    lib::cookieCreate("rounds", $gRounds);
}

if(isset($_COOKIE["userScore"])) {
    $gUserScore  = $_COOKIE["userScore"];
} else {
    $gUserScore = 0;
    lib::cookieCreate("userScore", $gUserScore);
}

if(isset($_COOKIE["compScore"])) {
    $gCompScore  = $_COOKIE["compScore"];
} else {
    $gCompScore = 0;
    lib::cookieCreate("compScore", $gCompScore);
}

if(isset($_COOKIE["ties"])) {
    $gTies  = $_COOKIE["ties"];
} else {
    $gTies = 0;
    lib::cookieCreate("ties", $gTies);
}

if($gUserChoice != "") {
    $options= array("rock", "paper", "scissors");
    $randNum = mt_rand(0,2);
    $gCompChoice = $options[$randNum];
    $gUserImage = $gUserChoice . ".jpg";
    $gCompImage = $gCompChoice . "-mirror.jpg";

    if($gRounds % 10 == 0 && $gRounds != 0) {
        $gCompClass = "loss";
        $gUserClass = "chuck";
        $gUserImage = "chuck-norris.jpg";
        $gResult = "Draw (+0)";
    } else {
        if($gCompChoice == $gUserChoice) {
            $gCompClass = "draw";
            $gUserClass = "draw";
            $gResult = "Draw (+0)";
            $gTies++;
        } else {
            switch($gUserChoice) {
                case "rock":
                    switch($gCompChoice) {
                        case "paper":
                            $gCompClass = "win";
                            $gUserClass = "loss";
                            $gResult = "Comp Wins :(";
                            $gCompScore++;
                            break;
                        case "scissors":
                            $gCompClass = "loss";
                            $gUserClass = "win";
                            $gResult = "User Wins (+1)";
                            $gUserScore++;
                            break;
                    }
                    break;
                case "paper":
                    switch($gCompChoice) {
                        case "rock":
                            $gCompClass = "loss";
                            $gUserClass = "win";
                            $gResult = "User Wins (+1)";
                            $gUserScore++;
                            break;
                        case "scissors":
                            $gCompClass = "win";
                            $gUserClass = "loss";
                            $gResult = "Comp Wins :(";
                            $gCompScore++;
                            break;
                    }
                    break;
                case "scissors":
                    switch($gCompChoice) {
                        case "rock":
                            $gCompClass = "win";
                            $gUserClass = "loss";
                            $gResult = "Comp Wins :(";
                            $gCompScore++;
                            break;
                        case "paper":
                            $gCompClass = "loss";
                            $gUserClass = "win";
                            $gResult = "User Wins (+1)";
                            $gUserScore++;
                            break;
                    }
                    break;
            }
        }
    }

    $gRounds++;

    lib::cookieCreate("rounds", $gRounds);
    lib::cookieCreate("userScore", $gUserScore);
    lib::cookieCreate("compScore", $gCompScore);
    lib::cookieCreate("ties", $gTies);
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
    <title>Rock the Patch! v3 - Rock, Paper, Scissors</title>
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
        var additionalImages = ["/images/rock-paper-scissors/chuck-norris.jpg",
            "/images/rock-paper-scissors/rock.jpg",
            "/images/rock-paper-scissors/rock-mirror.jpg",
            "/images/rock-paper-scissors/paper.jpg",
            "/images/rock-paper-scissors/paper-mirror.jpg",
            "/images/rock-paper-scissors/scissors.jpg",
            "/images/rock-paper-scissors/scissors-mirror.jpg"];

        preloadImages(additionalImages);
    </script>

    <script type="text/javascript">
        function reset() {
            window.location = "rock-paper-scissors-reset.php"
        }
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
                    document.getElementById("bonus").className  = "current";
                    document.getElementById("rock-paper-scissors").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Bonus / Rock, Paper, Scissors</div>

        <h1>Rock, Paper, Scissors</h1>
        <h2>...Chuck Norris.  The Battle (...of doom)!</h2>

        <div id="rock-paper-scissors-result">
            <?php
                global $gCompChoice, $gCompClass, $gCompImage, $gCompScore, $gResult, $gRounds, $gTies, $gUserClass, $gUserImage, $gUserScore;

                if($gRounds != 0 && $gUserChoice != "") {
                    echo("<p><img src='images/rock-paper-scissors/" . $gUserImage . "' alt='" . $gUserChoice . "' class='" . $gUserClass . "'/> <strong> &nbsp&nbspVS.&nbsp&nbsp</strong>");
                    echo("<img src='images/rock-paper-scissors/" . $gCompImage . "' alt='" . $gCompChoice . "' class='" . $gCompClass. "'></p>");
                }

                echo("<p><strong>Result:</strong> " . $gResult . "</p>");
                echo("<p><em><strong>Scores</strong></em><br/>");
                echo("<em>User wins:</em> " . $gUserScore . " / " . $gRounds. "<br/>");
                echo("<em>Comp wins:</em> " . $gCompScore . " / " . $gRounds . "<br/>");
                echo("<em>Ties:</em> " . $gTies . " / " . $gRounds . "</p>");
                echo("<p><a href='#' onclick='reset();'>Reset?</a></p>");
            ?>
        </div>

        <div id="rock-paper-scissors-choices">
            <form action="rock-paper-scissors.php" method="post" name="rock-paper-scissors">
                <p><strong>Player Choices:</strong></p>

                <div class="float-left">
                    <p><input type="image" src="images/rock-paper-scissors/rock.jpg" alt="Rock" name="rock" title="Rock"/></p>
                    <p>Choose Rock!</p>
                </div>

                <div class="float-left">
                    <p><input type="image" src="images/rock-paper-scissors/paper.jpg" alt="Paper" name="paper" title="Paper"/></p>
                    <p>Choose Paper!</p>
                </div>

                <div class="float-left">
                    <p><input type="image" src="images/rock-paper-scissors/scissors.jpg" alt="Scissors" name="scissors" title="Scissors"/></p>
                    <p>Choose Scissors!</p>
                </div>
                <div class="clear"></div>
            </form>
        </div>
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