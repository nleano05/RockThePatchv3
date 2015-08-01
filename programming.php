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
    <title>Rock the Patch! v3 - Programming</title>
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
                    document.getElementById("tech-work").className = "current";
                    document.getElementById("programming").className = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Tech Work / Programming</div>

        <h1>Programming</h1>

        <h2>Operating Systems and Languages Worked With</h2>

        <p><strong>Operating Systems:</strong> Windows, Mac OS(X), Linux (<em>Backtrack >3, CentOS, Fedora, Kubuntu,
                Mint Linux, Ubuntu</em>), and Unix</p>

        <p><strong>Programming Languages:</strong> Assembly Language, C, C++, HTML (XHTML), Java, JavaScript, Perl, PHP
            / OOPhp, Python,
            Visual Basic.NET, and Visual C#.NET</p>

        <p><em>Also have worked with Alice, Haskell, Flash MX, MS SQL, MyPHP Admin, MySQL, Selenium, SWI Prolog, Swift, XML, and
                XSL(T)</em></p>

        <p><strong>Software/Tool Experience:</strong> Active@ ISO Burner, Adobe Acrobat Pro, Alice,
            Any Video Converter, Audacity, AutoHotKey, EasyPHP, Fiddler, Filezilla, GIMP, IE Tester, Jenkins, JCreator, Magic
            Disc, Microsoft Office Suite, Notepad++, Open Office, Perforce, Postman, Putty, SourceTree, Test Complete,
            Windows (Live) Movie Maker, WireShark, various other Microsoft products, and various recreational software
            programs</p>

        <p><strong>IDE Experience:</strong> Adobe CS5 Web Premium Suite, Android Studio, Blue J, Dev++, Intellij,
            JCreator, Microsoft SharePoint Designer 2007, Microsoft Visual Studio.NET 2003-2013</p>

        <h2>Notable Programming Projects</h2>

        <ul>
            <li>Binary Tree Creator - <em>PHP</em> (<a href="/binary-tree-creator.php" title="Binary Tree Creator">Check
                    it out online now</a>)
            </li>
            <li>BZIP2 Compression - <em>PHP</em> (<a href="/bzip2.php" title="BZIP2">Check it out online now</a>)</li>
            <li>Checkers - <em>Visual C#</em></li>
            <li>Kill All Running Browsers - <em>Perl</em></li>
            <li>Library Login - <em>Visual Basic.NET</em></li>
            <li>Resource Manager - <em>Java</em> (<a href="/user-bonuses/downloads.php"
                                                     title="Download ResourceManager.jar">Available for download</a>)
            </li>
            <li>Resource Optimizer - <em>Perl</em></li>
            <li>Rock, Paper, Scissors, Chuck Norris - <em>HTML and PHP</em> (<a href="/rock-paper-scissors.php"
                                                                                title="Play Rock, Paper, Scissors">Play
                    Online Now</a>)
            </li>
            <li>Sticky Notes - <em>Visual C#</em></li>
            <li>Subnet Calculator - <em>PHP</em> (<a href="/subnet-calculator.php" title="Subnet Calculator">Check it
                    out online now</a>)
            </li>
            <li>Tic Tac Toe with mock AI - <em>Visual C#</em> (<a href="/user-bonuses/downloads.php"
                                                                  title="Download Tic Tac Toe">Available for
                    download</a>)
            </li>
            <li>War (the card game) - <em>Visual Basic.NET</em></li>
        </ul>

        <h2>Work and Other Experience</h2>

        <p><strong>Positions Held</strong></p>

        <ul>
            <li>Android Developer</li>
            <li>Automated tester for VoIP company</li>
            <li>Assistant Web Developer</li>
        </ul>

        <p><strong>Responsibilities</strong></p>

        <ul>
            <li>Mobile app development</li>
            <li>Automated tester that maintained 340+ regression tests for Telephony, SIP Sec, and SoftPhone</li>
            <li>Worked with Layar and Layar API to make an augmented reality layer for ISU</li>
            <li>Trained faculty and students on how to use SharePoint Designer to maintain parts of ISU's web site</li>
            <li>Worked with Adobe Acrobat to create fillable .pdf forms</li>
        </ul>

        <p><strong>Networking Experience</strong></p>

        <ul>
            <li>Have set up multiple networks with laptops, desktops, mobile devices, and gaming systems</li>
            <li>Some CISCO training through New Horizons and work with CISICO iOS Devices</li>
            <li>Some work with AudioCodes Mediant M1K Gateways</li>
        </ul>

        <p><strong>Other Skills and Experience</strong></p>

        <ul>
            <li>Work with AudioCodes and Polycom Phones</li>
            <li>Knowledge of SIP and VoIP technology</li>
            <li>Basic knowledge of TLS</li>
            <li>Former member of Business Professionals of America with multiple awards</li>
            <li>Built and upgraded two of my own personal computers with custom components</li>
            <li>Have helped service and clean several computers</li>
        </ul>

        <h2>Academic Work</h2>

        <p style="margin-left:15px;"><em>Academic Work</em></p>

        <ul>
            <li>B.S. in Computer Science and Math Minor from ISU received May 2012</li>
            <li>Rewrote and implemented Library Login program for JELCC</li>
            <li>Have worked with ALICE software to create a short animated video</li>
            <li>Wrote manuals at JELCC for using Microsoft Access databases with Visual C# and Visual Basic.NET</li>
            <li>Wrote program to switch .CSV from Windows Server to Novell format for JELCC</li>
        </ul>

        <p style="margin-left:15px;">Notable Courses Taken:</p>

        <ul>
            <li>Algorithms</li>
            <li>Assembly Language</li>
            <li>Databases</li>
            <li>Data Structures</li>
            <li>Formal Methods</li>
            <li>Linux Administration</li>
            <li>Web Programming I</li>
            <li>Web Programming II</li>
        </ul>

        <h2>Honorable Mentions</h2>

        <ul>
            <li>Nominated for Women in Technology Raising Star award</li>
        </ul>
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