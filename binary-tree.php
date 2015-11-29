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
    <title>Rock the Patch! v3 - Binary Tree</title>
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
                    document.getElementById("bonus").className  = "current";
                    document.getElementById("binary-tree-creator").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Binary Tree</div>
        <h1>Binary Tree</h1>

        <?php
            if(!isset($_POST['create-tree'])) {
        ?>

        <form method="post" action="binary-tree.php">
            <h2>Step 2: Entering in the Entries</h2>
            <?php
                $total = isset($_COOKIE['binary-tree-num-entries']) ? $_COOKIE['binary-tree-num-entries'] : 0;
                for($i=0;$i<$total;$i++) {
                    echo("<p><strong>Number ".$i.": </strong> <input type='text' name='number".$i."'/></p>");
                }
            ?>
            <p><input type="submit" name="create-tree" value="Final Step: Create Binary Tree" class="button" /></p>
        </form>

        <?php
            } else {
                $numbers = $binaryTree = $inOrder = $preOrder = $postOrder = array ();
                $numbersIndex = $inOrderIndex = $postOrderIndex = $preOrderIndex = 0;
                $temp;
                $allNumbers = TRUE;
                $total = isset($_COOKIE['binary-tree-num-entries']) ? $_COOKIE['binary-tree-num-entries'] : 0;

                $allNumbers = TRUE;
                for($i=0;$i<$total;$i++) {
                    if(is_numeric($_POST['number'.$i])) {
                        //All the entries are numeric
                    } else {
                        $allNumbers = FALSE;
                    }
                }

                if(!$allNumbers) {
                    echo '<form method="post" action="binary-tree.php"><h1>Step 2: Entering in the Entries</h1>';
                    for($i=0;$i<$total;$i++) {
                        if($_POST['number'.$i] != '') {
                            if(is_numeric($_POST['number'.$i])) {
                                $value = $_POST['number'.$i.''];
                                echo("<p><strong>Number ".$i.": </strong> <input type='text' name='number".$i."' value='$value' /></p>");
                            } else {
                                $value = $_POST['number'.$i.''];
                                echo("<p><strong>Number ".$i.": </strong> <input type='text' name='number".$i."' value='$value' /></p>");
                                echo '<p style="color:red">This is not numeric</p>';
                            }
                        } else {
                            echo("<p><strong>Number ".$i.": </strong> <input type='text' name='number".$i."' /></p>");
                            echo '<p style="color:red">This field was left blank</p>';
                        }
                    }
                    echo '<p><input type="submit" name="create-tree" value="Final Step: Create Binary Tree" class="button" /></p></form>';
                } else {
                    echo '<h2>Final Step: Create the Binary Tree</h2>';
                    for($i=0;$i<$total;$i++) {
                        $numbers[$numbersIndex++] = $_POST['number'.$i];
                    }
                    $i=0;
                    while(count($numbers)>1) {
                        for($i=0;$i<count($numbers);$i++) {
                            for($j=0;$j<count($numbers);$j++) {
                                if($numbers[$i] < $numbers[$j]) {
                                    $temp = $numbers[$j];
                                    $numbers[$j] = $numbers[$i];
                                    $numbers[$i] = $temp;
                                }
                            }
                        }
                        $leftChild[0]= $numbers[0];
                        $rightChild[0] = $numbers[1];
                        $parent["P".$i] = $rightChild[0] + $leftChild[0];
                        $node['Parent'] = $rightChild[0] + $leftChild[0];
                        $node['Left Child'] = $leftChild[0];
                        $node['Right Child'] = $rightChild[0];
                        $binaryTree[count($binaryTree)] = $node;
                        array_shift($numbers);
                        array_shift($numbers);
                        $numbers[count($numbers)] = $rightChild[0] + $leftChild[0];
                        $i++;
                    }
                    for($i=0;$i<count($binaryTree);$i++) {
                        print_r("<p><strong> Node at Parent " .$i." is: </strong>");
                        print_r($binaryTree[$i]);
                        print_r("</p>");
                    }

                    for($i=(count($binaryTree)-1);$i>=0;$i--) {
                        $inOrder[$inOrderIndex++] = $binaryTree[$i]['Left Child'];
                        $inOrder[$inOrderIndex++] = $binaryTree[$i]['Parent'];
                        $inOrder[$inOrderIndex++] = $binaryTree[$i]['Right Child'];
                    }

                    print_r("<br/><p><strong>In-Order Traversal of this tree is:</strong>");
                    for($i=0;$i<count($inOrder);$i++) {
                        print_r(" ");
                        print_r($inOrder[$i]);
                        print_r(" : ");
                    }
                    print_r("</p>");


                    for($i=(count($binaryTree)-1);$i>=0;$i--) {
                        $preOrder[$preOrderIndex++] = $binaryTree[$i]['Parent'];
                        $preOrder[$preOrderIndex++] = $binaryTree[$i]['Left Child'];
                        $preOrder[$preOrderIndex++] = $binaryTree[$i]['Right Child'];
                    }

                    print_r("<br/><p><strong>Pre-Order Traversal of this tree is:</strong>");
                    for($i=0;$i<count($preOrder);$i++) {
                        print_r(" ");
                        print_r($preOrder[$i]);
                        print_r(" : ");
                    }
                    print_r("</p>");

                    for($i=(count($binaryTree)-1);$i>=0;$i--) {
                        $postOrder[$postOrderIndex++] = $binaryTree[$i]['Left Child'];
                        $postOrder[$postOrderIndex++] = $binaryTree[$i]['Right Child'];
                        $postOrder[$postOrderIndex++] = $binaryTree[$i]['Parent'];
                    }

                    print_r("<br/><p><strong>Post-Order Traversal of this tree is:</strong>");
                    for($i=0;$i<count($postOrder);$i++) {
                        print_r(" ");
                        print_r($postOrder[$i]);
                        print_r(" : ");
                    }
                    print_r("</p>");
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