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
    <title>Rock the Patch! v3 - Resources and Tools</title>
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
        var additionalImages = [
            "/images/icons-and-logos/github.png",
            "/images/icons-and-logos/source-tree.png",
            "/images/icons-and-logos/easy-php.png",
            "/images/icons-and-logos/jenkins.png",
            "/images/icons-and-logos/filezilla.png"
        ];

        preloadImages(additionalImages);
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
                    document.getElementById("about-this-site").className  = "current";
                    document.getElementById("resources-and-tools").className  = "current";
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
            <?php require_once("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
    </div>
    <!-- ### END content-area-left ### -->
    <!-- ### START content-area ### -->
    <div id="content-area">
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / About This Site / Icons and Images</div>
        <h1>Resources And Tools</h1>

        <h2>Main Tools</h2>

        <img src="/images/icons-and-logos/github.png" alt="GitHub Logo" title="GitHub Logo" style="float:left;width:75px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/source-tree.png" alt="SourceTree Logo" title="SourceTree Logo" style="float:left;width:65px;margin:15px 20px;" />
         <img src="/images/icons-and-logos/easy-php.png" alt="EasyPHP Logo" title="EasyPHP Logo" style="float:left;width:65px;margin:20px 20px;" />
        <img src="/images/icons-and-logos/jenkins.png" alt="Jenkins Logo" title="Jenkins Logo" style="float:left;width:95px;margin:5px 20px;" />
        <img src="/images/icons-and-logos/filezilla.png" alt="FileZilla Logo" title="FileZilla Logo" style="float:left;width:65px;margin:15px 20px;" />

        <div class="clear"></div>

        <ul>
            <li>GitHub</li>
            <li>Source Tree</li>
            <li>Easy PHP</li>
            <li>Jenkins</li>
            <li>FileZilla</li>
        </ul>

        <h2>Social Media Icons Used</h2>

        <ul>
            <li><a href="http://www.iconsdb.com/" title="Icons DB">Icons DB</a></li>
        </ul>

        <h2>Operating System Logos Used</h2>

        <ul>
            <li>Windows 8 Logo - <em>http://www.uiu4you.com/Portals/1/Images/Windows-8-Logo.png</em></li>
            <li><a href="http://images.wikia.com/dragonball/images/f/f9/Windows7Logo.png" title="Windows 7 Logo">Windows 7 Logo</a></li>
            <li><a href="http://logos.wikia.com/wiki/File:Logo-Kubuntu.png" title="Kubuntu Logo">Kubuntu Logo</a></li>
        </ul>

        <h2>Validation Icons Used</h2>

        <ul>
            <li>Html5 Icon (modified) - <em>http://dev.bowdenweb.com/a/i/cons/icomoon/html5%20(white%20bg).png</em></li>
            <li><a href="http://www.w3.org/QA/Tools/Icons" title="Xhtml 1.1 and CSS Icons">Xhtml 1.1 and CSS Icons</a></li>
        </ul>

        <h2>Browser Icons Used</h2>

        <ul>
            <li>Browser Icons - <em>http://www.freewallpepper.com/</em></li>
        </ul>

        <h2>Other Images and Icons Used</h2>

        <ul>
            <li>IE Tester Icon - <em>http://vadiksoftware.com/category/web-design</em></li>
            <li><a href="http://www.veryicon.com/icons/media/ipod-touch-icon/ipod-touch-starting.html" title="iPod Touch Icon">iPod Touch Icon</a></li>
            <li>Android Icon - <em>http://www.gettyicons.com/free-icon/101/real-vista-mobile-icon-set/free-android-platform-icon-png</em></li>
            <li><a href="http://www.wincustomize.com/explore/objectdock/9171/" title="Filezilla Icon">Filezilla Icon</a></li>
            <li>Notepad++ Icon - <em>http://opensourcesoft.org/software/27-notepad-plugins-and-which-you-really-need/</em></li>
            <li>PDF Icon - <em>http://www.dermalog.de/en/products_solutions/fingerprintscanner/en_lf1.php</em></li>
            <li><a href="http://theartelephant.com/wp-content/uploads/2014/12/Igor-Verniy-02.jpg" title="Duck">Duck</a></li>
            <li><a href="https://upload.wikimedia.org/wikipedia/en/5/5c/Seleniumlogo.png" title="Selenium Icon">Selenium Icon</a></li>
            <li><a href="http://fiji.sc/_images/1/1b/Intellij-idea.png" title="Intellij Icon">Intellij Icon</a></li>
            <li><a href="https://raw.githubusercontent.com/github/media/master/octocats/octocat.png" title="GitHub Icon">GitHub Icon</a></li>
            <li><a href="http://www.unixstickers.com/image/cache/data/stickers/jenkins/Jenkins.sh-600x600.png" title="Jenkins Icon">Jenkins Icon</a></li>
        </ul>

        <h2>Site Used To Create Duck Quack Text</h2>

        <ul>
            <li><a href="http://cooltext.com/" title="Duck Quack Text">Duck Quack Text</a></li>
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
            <?php require_once("inc/interactions.php"); ?>
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