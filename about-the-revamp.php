<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

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
    <title>Rock the Patch! v3 - About The Revamp</title>
    <meta name="robots" content="all"/>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="description" content="Rock the Patch! Musician, Programmer, Artist, and More"/>
    <meta name="author" content="Patches"/>
    <meta name="keywords"
          content="patches, xhtml 1.1, html5, xhtml5, rss, css3, xsl(T), programmer, rock the patch, writer, artist, musician, mobile"/>

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
                <!-- Script to display the current page in the navigation -->
                <script type="text/javascript">
                    document.getElementById("about-the-revamp").className = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / About The Revamp</div>

        <h1>About the Revamp</h1>

        <br/>

        <p>What is v3? Simple answer: the third revision of this website. The much longer story is a complete and
            total reboot of the site focused on clearing up the majority of poor backend legacy code that had
            accumulated
            over the course of 4-5 years of the code base being in existence and learning so much along the way. Below
            I've touched on the big improvements and changes.</p>

        <br/>

        <hr/>

        <h2>Type enforcement</h2>

        <p>
            Objects now verify and take into account the data type they are expecting to help weed out bad data being
            passed around. Along with the use
            of PDO it's now much harder if not impossible to get an incorrect data type for a field
            in the database. I may eventually add this into functions and other aspects of the site depending on how
            well it goes with the object models.
        </p>

        <hr/>

        <h2>Better in-line documentation</h2>

        <p>
            I'm now forcing myself to use annotations and proper Docs that will tell
            other developers or anyone else looking at the code about the functions, classes,
            history, expected parameters, possible returns, exceptions thrown,
            and other important notes.
        </p>

        <hr/>

        <h2>Visibility and scope taken into account</h2>

        <p>
            A big motivator for the revamp was how horrible scope and visibility of variables
            and functions were in the v1 and v2 versions. With v3 I closed a lot of loop holes
            by cutting down the use of global variables and narrowing visibility where I could.
        </p>

        <hr/>

        <h2>More object oriented conventions</h2>

        <p>
            I had no idea how to truly write code in an object oriented fashion with PHP when I first
            started the site, so with this version I really went all-out and started using object classes
            and a much less procedural approach.
        </p>

        <hr/>

        <h2>Automated tests</h2>

        <p>
            Any developer in today's world should know the value of regression testing, so when I set
            out for v3 I hooked up Selenium and integrated both PHPUnit and Java based UI tests
            right into the package.
        </p>

        <hr/>

        <h2>Major database and backend improvements</h2>

        <p>
            Along with everything listed above, I reworked the database tables to each have a primary key
            which trickled down into making the logic to update information much easier. I had been
            wanting to do this for a long time, but now I can update any object based on just it's id
            instead of querying for ridiculous field value matching shenanigans.
        </p>

        <hr/>

        <h2>Cleaner and more Interactive UI</h2>

        <p>
            I'm admittedly not a UI or design gal, but I at least attempted to improve the UI and usability
            of the site. I tried to keep things as simple and as clean as possible. I also tried to stick
            closer to Material Design standards with colors and other recommendations. I also gave a lot
            of hover states to elements with this version.
        </p>

        <hr/>

        <h2>Use of constants and config files</h2>

        <p>
            Now that I know how to define constants in PHP, a lot of the code that was comparing string values
            manually and quite messy has really been cleaned up. I also use Jenkins for continuous deployment
            and continuous integration testing and it has a plug-in that allows me to provide config files so
            I can worry less about accidentally checking in OAuth or Database credentials into source on GitHub
            by mistake.
        </p>

        <hr/>

        <h2>Better debug mode</h2>

        <p>
            Not only is debug mode on all of the pages now to help track down issues when necessary, logging now
            takes into account level so you can now see errors and warning pop out instead of them getting lost
            in the abyss of output. It's also way easer for me to log out objects and other data which is awesome
            for me as well :)
        </p>

        <hr/>

        <h2>Better resource management</h2>

        <p>
            I started using require_once and other techniques to cut down on resource usage to improve the performance
            of the site and have reworked a lot of the code to be less taxing and cleaner when iterating through data.
        </p>

        <hr/>

        <h2>Better relative linking</h2>

        <p>
            Since I didn't have multiple environments before, moving towards having a dev, staging, integration, and
            production environments has helped weed out how many relative linking problems.
        </p>

        <hr/>
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