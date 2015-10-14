<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gValidForm;
$gValidForm = FALSE;

if(isset($_POST['zip-chars'])) {
    $gValidForm = checkInputBZIP2();
}

function BZIP2Compression($input) {
    $input = strtolower($input);
    $alphabet = array('a' => 0, 'b' => 1, 'c' => 2, 'd' => 3, 'e' => 4, 'f' => 5, 'g' => 6, 'h' => 7, 'i' => 8, 'j' =>9, 'k' => 10, 'l' => 11, 'm' => 12, 'n' => 13, 'o' => 14, 'p' => 15, 'q' => 16, 'r' => 17, 's' => 18, 't' => 19, 'u' => 20, 'v' => 21, 'w' => 22, 'x' => 23, 'y' => 24, 'z' => 25);
    $cyclicShifts = $moveToFront = $elements = $frequencies = $huffmanCodes = $buffer = $bufferBin = $binaryCodes = $compactedHexAnswer = $binaryTree = $node = $parent = $leftChild = $rightChild = $huffmanOut = array();
    $length = strlen($input);
    $cyclicShiftsIndex = $inOrderIndex = $huffmanOutIndex = $sum = $position = $frequency = 0;
    $cyclicShifts[$cyclicShiftsIndex++] = $input;
    $temp = $input;
    echo("<p><strong>The String We Are Bzipping Is:</strong> " .$temp. "</p>");
    echo("<p><strong>Step 1: <em>The Cyclic Shifts Are:</em></strong></p>");
    for($j=0;$j<$length-1;$j++) {
        $lastChar = substr($temp, -1);
        for($x=$length-1;$x>0;$x--) {
            $substring = substr($temp, $x-1, 1);
            $temp = substr_replace($temp, $substring, $x, 1);
        }
        $temp = substr_replace($temp, $lastChar, 0, 1);
        $cyclicShifts[$cyclicShiftsIndex++] = $temp;
    }

    echo("<ul>");
    for($i=0;$i<$cyclicShiftsIndex;$i++) {
        echo("<li>".$cyclicShifts[$i]."</li>");
    }
    echo("</ul>");

    echo("<p><strong>Step 2: <em>The Cyclic Shifts IN ORDER Are:</em></strong></p>");
    for($i=0;$i<$length;$i++) {
        for($j=0;$j<$length;$j++) {
            $k = strcmp($cyclicShifts[$i], $cyclicShifts[$j]);
            if($k < 0) {
                $temp = $cyclicShifts[$i];
                $cyclicShifts[$i] = $cyclicShifts[$j];
                $cyclicShifts[$j] = $temp;
            }
        }
    }

    echo("<ul>");
    for($i=0;$i<$cyclicShiftsIndex;$i++) {
        echo("<li>".$cyclicShifts[$i]."</li>");
    }
    echo("</ul>");

    print_r("<p><strong>Step 3: <em>Burrows-Wheeler Transform Of The String Is:</em></strong></p>");
    echo("<p>");
    for($i=0;$i<$length;$i++) {
        $temp = substr($cyclicShifts[$i], -1);
        $burrowsWheeler[$i] = $temp;
    }
    for($i=0;$i<$length;$i++) {
        echo(" " . $burrowsWheeler[$i]. " ");
    }
    echo("</p>");
    echo("<p><strong>Step 4: <em>With The Move To Front Transformation, The Values Are:</em></strong></p>");
    echo("<p>");
    for($i=0;$i<$length;$i++) {
        $string1 = $burrowsWheeler[$i];
        foreach($alphabet as $key => $value) {
            $string2 = $key;
            $k = strcmp($string1,$string2);
            if($k == 0) {
                echo(" " .$value. " ");
                $temp = $key;
                $moveToFront[$i] = $alphabet[$key];
                foreach($alphabet as $key1 => $value1) {
                    if($value1 < $value) {
                        $alphabet[$key1] = $alphabet[$key1] + 1;
                    }
                }
                $alphabet[$temp]= 0;
            }
        }
    }
    echo("</p>");
    echo("<p><strong>Step 5: <em>The Huffman Table Is:</em></strong></p>");
    for($i=0;$i<$length;$i++) {
        $inArray = FALSE;
        for($j=0;$j<count($elements);$j++) {
            if($moveToFront[$i] == $elements[$j]) {
                $inArray = TRUE;
            }
        }
        if($inArray != 1) {
            $elements[$j] = $moveToFront[$i];
        }
    }
    $newLength = count($elements);
    for($i=0;$i<$newLength;$i++) {
        for($j=0;$j<$length;$j++) {
            if($moveToFront[$j] == $elements[$i]) {
                $frequency++;
            }
        }
        $frequencies[$i] = $frequency;
        $frequency = 0;
    }
    for($i=0;$i<$newLength;$i++) {
        for($j=0;$j<$newLength;$j++) {
            if($frequencies[$j] > $frequencies[$i]) {
                $temp = $frequencies[$j];
                $frequencies[$j] = $frequencies[$i];
                $frequencies[$i] = $temp;
                $temp = $elements[$j];
                $elements[$j] = $elements[$i];
                $elements[$i] = $temp;
            } else {
                if($frequencies[$j] == $frequencies[$i]) {
                    if($elements[$j] > $elements[$i]) {
                        $temp = $elements[$j];
                        $elements[$j] = $elements[$i];
                        $elements[$i] = $temp;
                    }
                }
            }
        }
    }
    for($i=0;$i<count($elements);$i++) {
        $bufferFreq[$i] = $frequencies[$i];
        $bufferChar[$i] = $elements[$i];
    }
    $i=0;
    while(count($bufferChar)>1) {
        $leftChild[$bufferChar[0]]= $bufferFreq[0];
        $rightChild[$bufferChar[1]] = $bufferFreq[1];
        $parent["P".$i] = $rightChild[$bufferChar[1]] + $leftChild[$bufferChar[0]];
        $node[0] = "P".$i;
        $node[1] = $bufferChar[0];
        $node[2] = $bufferChar[1];
        $binaryTree[count($binaryTree)] = $node;
        array_shift($bufferChar);
        array_shift($bufferChar);
        array_shift($bufferFreq);
        array_shift($bufferFreq);
        $bufferChar[count($bufferChar)] = "P".$i;
        $bufferFreq[count($bufferFreq)] = $parent["P".$i];
        $i++;
    }
    for($i=count($binaryTree)-1;$i>=0;$i--) {
        $inOrder[$inOrderIndex++]= $binaryTree[$i][1];
        $inOrder[$inOrderIndex++]= $binaryTree[$i][0];
        $inOrder[$inOrderIndex++]= $binaryTree[$i][2];
    }
    for($i=0;$i<45;$i++) {
        $huffmanCodes[$i] = '';
    }
    $huffmanCodes[1] = '';
    $huffmanCodes[4] = '0';
    $huffmanCodes[7] = '1';
    $huffmanCodes[10] = '00';
    $huffmanCodes[13] = '01';
    $huffmanCodes[16] = '10';
    $huffmanCodes[19] = '11';
    $huffmanCodes[22] = '000';
    $huffmanCodes[25] = '001';
    $huffmanCodes[28] = '010';
    $huffmanCodes[31] = '011';
    $huffmanCodes[34] = '100';
    $huffmanCodes[37] = '101';
    $huffmanCodes[40] = '110';
    $huffmanCodes[43] = '111';
    for($i=2;$i<count($inOrder);$i=$i+3) {
        $huffmanCodes[$i] = $huffmanCodes[$i-1] . '0';
    }
    for($i=0;$i<count($inOrder);$i=$i+3) {
        $huffmanCodes[$i] = $huffmanCodes[$i+1] . '1';
    }
    for($i=0;$i<count($elements);$i++) {
        for($j=0;$j<count($inOrder);$j++) {
            if((strcmp($elements[$i], $inOrder[$j]) == 0)) {
                $huffmanOut[$huffmanOutIndex++] = $huffmanCodes[$j];
            }
        }
    }
    echo("<table>");
    echo("<tr>");
    echo("<td><p><strong>Move to Front Code</strong></p></td>");
    echo("<td><p><strong>Frequency</strong></p></td>");
    echo("<td><p><strong>Huffman Code for Output</strong></p></td>");
    echo("</tr>");
    for($i=0;$i<$newLength;$i++) {
        echo("<tr>");
        echo("<td><p>".$elements[$i]."</p></td>");
        echo("<td><p>".$frequencies[$i]."</p></td>");
        echo("<td><p>".$huffmanOut[$i]."</p></td>");
        echo("</tr>");
    }
    echo("</table>");
    echo("<p><strong>Step 6: <em>The Binary Version Of The Move To Front Transformation</em></strong></p>");
    echo("<p>");
    for($i=0;$i<count($moveToFront);$i++) {
        for($j=0;$j<count($inOrder);$j++) {
            if(strcmp($moveToFront[$i], $inOrder[$j]) == 0) {
                $binaryCodes[$i] = $huffmanCodes[$j];
                echo($huffmanCodes[$j]);
                echo(" / ");
            }
        }
    }
    echo("</p>");
    echo("<p><strong>Step 7 (THE FINAL ANSWER!! WOOHOO!!): <em>The Binary Move to Front Codes Compacted to Hexadecimal:</em></strong></p>");
    for($i=0;$i<4;$i++) {
        $bufferBin[$i] = '0';
    }
    for($i=0;$i<count($binaryCodes);$i++) {
        $compactedHexAnswer[$i] = '';
    }
    for($i=0;$i<count($binaryCodes);$i++) {
        $length = strlen($binaryCodes[$i]);
        $runs = $length / 4;
        for($j=0;$j<ceil($runs);$j++) {
            for($k=0;$k<4;$k++) {
                $substring = substr($binaryCodes[$i], $position, 1);
                if(strcmp($substring,"1") == 0) {
                    $bufferBin[$k] = '1';
                    $position++;
                } else {
                    $bufferBin[$k] = '0';
                    $position++;
                }
            }
            for($l=3;$l>=0;$l--) {
                if($bufferBin[$l] == '1') {
                    $sum += pow(2,$l);
                }
            }
            $hex = '';
            switch ($sum) {
                case 0:
                    $hex = '0';
                    break;
                case 1:
                    $hex = '1';
                    break;
                case 2:
                    $hex = '2';
                    break;
                case 3:
                    $hex = '3';
                    break;
                case 4:
                    $hex = '4';
                    break;
                case 5:
                    $hex = '5';
                    break;
                case 6:
                    $hex = '6';
                    break;
                case 7:
                    $hex = '7';
                    break;
                case 8:
                    $hex = '8';
                    break;
                case 9:
                    $hex = '9';
                    break;
                case 10:
                    $hex = 'A';
                    break;
                case 11:
                    $hex = 'B';
                    break;
                case 12:
                    $hex = 'C';
                    break;
                case 13:
                    $hex = 'D';
                    break;
                case 14:
                    $hex = 'E';
                    break;
                case 15:
                    $hex = 'F';
                    break;
            }
            $compactedHexAnswer[$i] .= $hex." ";
            $sum = 0;
            for($n=0;$n<4;$n++) {
                $bufferBin[$n] = '0';
            }
        }
        $position = 0;
    }
    echo("<p>");
    for($i=0;$i<count($compactedHexAnswer);$i++) {
        echo(" ");
        echo($compactedHexAnswer[$i]);
        echo("  /  ");
    }
    echo("</p>");
}

function checkInputBZIP2() {
    global $gNoCharsToZip, $gBlackCharsToZip, $gNotLowerCharsToZip;

    $validForm = TRUE;

    $charsToZip = isset($_POST['chars-to-zip']) ? $_POST['chars-to-zip'] : "";
    $charsToZip = strtolower($charsToZip);

    $gNoCharsToZip = lib_check::isEmpty($charsToZip);
    if($gNoCharsToZip) {
        $validForm = FALSE;
    }

    $gBlackCharsToZip = lib_check::againstWhiteList($charsToZip);
    if($gBlackCharsToZip) {
        $validForm = FALSE;
    }

    if(!ctype_lower($charsToZip)) {
        $gNotLowerCharsToZip = TRUE;
        $validForm = FALSE;
    } else {
        $gNotLowerCharsToZip = FALSE;
    }

    return $validForm;
}

function displayOutputCharsToZip() {
    global $gNoCharsToZip, $gBlackCharsToZip, $gNotLowerCharsToZip;

    if($gNoCharsToZip) {
        echo("<p class='error'>Please enter in chars to zip.</p>");
    } else if($gBlackCharsToZip) {
        echo("<p class='error'>The chars entered contain characters that are not allowed.</p>");
    } else if(!$gNotLowerCharsToZip) {
        echo("<p class='error'>The char entered were not all lower case</p>");
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
    <title>Rock the Patch! v3 - BZIP2</title>
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
                <?php require_once("inc/nav-bar.php"); ?>
                <script type="text/javascript">
                    document.getElementById("bonus").className  = "current";
                    document.getElementById("bzip2").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / BZIP2 Compression</div>
        <h1>BZIP2 Compression</h1>

        <form method="post" action="bzip2.php">

            <p><input type="text" name="chars-to-zip" value="<?php if(isset($_POST['chars-to-zip'])) { echo($_POST['chars-to-zip']); }?>"/></p>
            <?php
                if(!$gValidForm && isset($_POST['zip-chars'])) {
                    displayOutputCharsToZip();
                }
            ?>

            <p><input type="submit" name="zip-chars" value="Bzip me some lower case letters dawg!" class="button" /></p>
        </form>

        <?php
            if($gValidForm && isset($_POST['zip-chars'])) {
                BZIP2Compression($_POST['chars-to-zip']);
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