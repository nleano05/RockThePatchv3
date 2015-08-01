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
    <title>Rock the Patch! v3 - Bands and Projects</title>
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
    <link rel="stylesheet" href="/css/tabs.css" type="text/css" media="screen"/>
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

    <!-- ### JQuerey Imports ### -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- ### Common Javascript Library Imports ### -->
    <script type="text/javascript" src="/js/lib.js"></script>
    <script type="text/javascript" src="/js/lib-autoformat.js"></script>
    <script type="text/javascript" src="/js/lib-gallery.js"></script>
    <script type="text/javascript" src="/js/lib-get.js"></script>
    <script type="text/javascript" src="/js/lib-populate.js"></script>
    <script type="text/javascript" src="/js/lib-sync.js"></script>
    <script type="text/javascript" src="/js/lib-toggle.js"></script>
    <script type="text/javascript" src="/js/tabs.js"></script>

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
                    document.getElementById("music-career").className  = "current";
                    document.getElementById("bands-and-projects").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Music Career / Bands and Projects</div>

        <div id="tabs">
            <ul class="tab-set">
                <li class="tab-label"><a href="#tab1" title="Current">Current</a></li>
                <li class="tab-label"><a href="#tab2" title="Previous">Previous</a></li>
                <li class="tab-label"><a href="#tab3" title="Instructors">Instructors</a></li>
            </ul>


            <div id="tab1" class="tab-content">
                <h1>Current Projects</h1>
                <ul>
                    <li><em>Currently working on a demo that will have about 5-7 songs</em></li>
                    <li>Currently looking for other musicians to begin a project or band</li>
                </ul>
                <p><strong>Passive Resistance (2007 - <em>present</em>)</strong><br/>as guitarist</p>
                <p><em>Members:</em></p>
                <ul>
                    <li>Dusty Householder (<em>vocals</em>)</li>
                </ul>
            </div>

            <div id="tab2" class="tab-content">
                <h1>Previous Bands</h1>

                <div class="float-left49">
                    <p><strong>Madhadder Escapade (2011 - 2012)</strong><br/>as bass player</p>
                    <p><em>Memebers:</em></p>
                    <ul>
                        <li>Nate Massery (<em>lead guitar</em>)</li>
                        <li>John Jerrell (<em>rhythm guitar</em>)</li>
                    </ul>
                    <br/>

                    <p><strong>Working Title (2011 - 2011)</strong><br/>as guitarist / drummer</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Eric Root (<em>drums / guitar</em>)</li>
                        <li>Logan Michl (<em>guitar / drums</em>)</li>
                    </ul>
                    <br/>

                    <p><strong>Greencaslte Band (2010 - 2011)</strong><br/>as drummer / guitarist</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Charles Strong (<em>guitar / vocals</em>)</li>
                        <li>Christopher Wilson (<em>bass / guitar</em>)</li>
                        <li>Jordan Stevens (<em>guitar</em>)</li>
                    </ul>
                    <br/>

                    <p><strong>She's Ransom (2008 - 2010)</strong><br/>as drummer</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Josh McKenny (<em>guitar / vocals</em>)</li>
                        <li>Kimberly McCurrey (<em>keyboards</em>)</li>
                        <li>Kris Steagall (<em>bass</em>)</li>
                        <li>Tina McCurrey (<em>vocals</em>)</li>
                    </ul>
                    <br/>
                </div>
                <div class="float-left49">
                    <p><strong>Inside Jokes (2006 - 2007)</strong><br/>as guitarist</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Britney (<em>guitar</em>)</li>
                        <li>Dusty Householder (<em>vocals</em>)</li>
                        <li>Sarah (<em>bass</em>)</li>
                        <li>Sarah Goldstien (<em>vocals</em>)</li>
                    </ul>
                    <p><em>Guest Members:</em></p>
                    <ul>
                        <li>Jake Galle (<em>drums</em>)</li>
                        <li>Justin Lattea (<em>vocals</em>)</li>
                        <li>Nathan Canada (<em>vocals</em>)</li>
                    </ul>
                    <br/>

                    <p><strong>Heart Attack/Untitled (2005 - 2006)</strong><br/>as guitarist</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Brianna Wolfe (<em>guitar</em>)</li>
                        <li>Jacob Borenstein (<em>bass</em>)</li>
                    </ul>
                    <br/>

                    <p><strong>Dysfunctional Revolution (2005)</strong><br/>as guitarist</p>
                    <p><em>Members:</em></p>
                    <ul>
                        <li>Ethan Tenant (<em>guitar</em>)</li>
                        <li>Nathan Canada (<em>vocals</em>)</li>
                        <li>Nick Huster (<em>drums</em>)</li>
                    </ul>
                    <p><strong>Other Artists Worked With</strong></p>
                    <ul>
                        <li>Ben Shortridge (<em>vocals</em>)</li>
                        <li>Brandon Sciotto (<em>vocals / guitar</em>)</li>
                        <li>Brian Rumple (<em>guitar</em>)</li>
                        <li>Clint Rogers (<em>vocals</em>)</li>
                    </ul>
                    <br/>
                </div>

                <div style="clear:both"></div>
            </div>

            <div id="tab3" class="tab-content">
                <h1>Former Guitar Instructors</h1>
                <ul>
                    <li>Ted Kirkindall (2006 - 2007)</li>
                    <li>Tommy Benson (2005 - 2006)</li>
                </ul>
            </div>
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