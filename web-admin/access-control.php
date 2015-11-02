<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gIPOverlapDetector;
$validForm = FALSE;

if(isset($_POST['unblock-ip-group'])) {
    $validForm = checkInputUnblockIPGroup();
    if($validForm) {
        $block = FALSE;

        $temp = isset($_POST['blocked-ip-groups']) ? $_POST['blocked-ip-groups'] : "";
        $tempSplit = explode(",", $temp);
        $ip = str_replace(" ", "", str_replace("IP: ", "", $tempSplit[0]));
        $subnet = str_replace(" ", "", str_replace("Subnet: ", "", $tempSplit[1]));

        log_util::log(LOG_LEVEL_DEBUG, "temp: " . $temp);
        log_util::log(LOG_LEVEL_DEBUG, "tempSplit: ", $tempSplit);
        log_util::log(LOG_LEVEL_DEBUG, "ip: " . $ip);
        log_util::log(LOG_LEVEL_DEBUG, "subnet: " . $subnet);

        lib_database::updateIPGroupBlock($ip, $subnet, $block);
    }
}

if(isset($_POST['block-single-ip'])) {
    $validForm = checkInputBlockSingleIP();
    if($validForm) {
        $ip = isset($_POST['block-single-ip-ip']) ? $_POST['block-single-ip-ip'] : "";
        $subnet = "32";

        $networkInfo = lib::subySubnet($ip, $subnet);

        $gIPOverlapDetector = lib_check::IPRangeOverlap($ip, $subnet, TRUE);
        if($gIPOverlapDetector->overlapDetected()) {
            $validForm = FALSE;
        }

        if($validForm) {
            $block = TRUE;
            lib_database::updateIPGroupBlock($ip, $subnet, $block);
        }
    }
}

if(isset($_POST['block-ip-group'])) {
    $validForm = checkInputBlockIPGroup();
    if($validForm) {
        $ip = isset($_POST['block-ip-group-ip']) ? $_POST['block-ip-group-ip'] : "";
        $subnet = isset($_POST['block-ip-group-subnet']) ? $_POST['block-ip-group-subnet'] : "";

        $networkInfo = lib::subySubnet($ip, $subnet);

        $gIPOverlapDetector = lib_check::IPRangeOverlap($ip, $subnet, TRUE);
        if($gIPOverlapDetector->overlapDetected()) {
            $validForm = FALSE;
        }

        if($validForm) {
            $block = TRUE;
            lib_database::updateIPGroupBlock($ip, $networkInfo->getCidr(), $block);
        }
    }
}

$blockedIPGroups = lib_database::getBlockedIPGroups();

function checkInputBlockIPGroup() {
    global $gNoBlockIPGroup, $gNoBlockSubnet, $gBlackBlockIPGroup, $gBlackBlockSubnet, $gValidBlockIPGroup, $gValidBlockSubnet;

    $validForm = TRUE;

    $ip = isset($_POST['block-ip-group-ip']) ? $_POST['block-ip-group-ip'] : "";
    $subnet = isset($_POST['block-ip-group-subnet']) ? $_POST['block-ip-group-subnet'] : "";

    $gNoBlockIPGroup = lib_check::isEmpty($ip);
    if($gNoBlockIPGroup) {
        $validForm = FALSE;
    }

    $gNoBlockSubnet = lib_check::isEmpty($subnet);
    if($gNoBlockSubnet) {
        $validForm = FALSE;
    }

    $gBlackBlockIPGroup = lib_check::againstWhiteList($ip);
    if($gBlackBlockIPGroup) {
        $validForm = FALSE;
    }

    $gBlackBlockSubnet = lib_check::againstWhiteList($subnet);
    if($gBlackBlockSubnet) {
        $validForm = FALSE;
    }

    $gValidBlockIPGroup = lib_check::validIP($ip);
    if(!$gValidBlockIPGroup) {
        $validForm = FALSE;
    }

    $gValidBlockSubnet = lib_check::validSubnet($subnet);
    if(!$gValidBlockSubnet) {
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputBlockSingleIP() {
    global $gNoBlockIP, $gBlackBlockIP, $gValidBlockIP;

    $validForm = TRUE;

    $ip = isset($_POST['block-single-ip-ip']) ? $_POST['block-single-ip-ip'] : "";

    $gNoBlockIP = lib_check::isEmpty($ip);
    if($gNoBlockIP) {
        $validForm = FALSE;
    }

    $gBlackBlockIP = lib_check::againstWhiteList($ip);
    if($gBlackBlockIP) {
        $validForm = FALSE;
    }

    $gValidBlockIP = lib_check::validIP($ip);
    if(!$gValidBlockIP) {
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputUnblockIPGroup() {
    global $gDefaultUnblockIPGroup, $gNoUnblockIPGroup;

    $validForm = TRUE;

    if(isset($_POST['blocked-ip-groups'])) {
        log_util::log(LOG_LEVEL_DEBUG, "blocked-ip-groups WAS NOT empty");

        if($_POST['blocked-ip-groups'] == NO_BLOCKED_IP_GROUPS) {
            $validForm = FALSE;
            $gDefaultUnblockIPGroup = TRUE;
            log_util::log(LOG_LEVEL_DEBUG, "blocked-ip-groups WAS " . NO_BLOCKED_IP_GROUPS);
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "blocked-ip-groups WAS NOT " . NO_BLOCKED_IP_GROUPS);
        }
    } else {
        $validForm = FALSE;
        $gNoUnblockIPGroup = true;
        log_util::log(LOG_LEVEL_DEBUG, "blocked-ip-groups WAS empty");
    }

    return $validForm;
}

function displayOutputBlockIPGroupIP() {
    global $gNoBlockIPGroup, $gBlackIPGroup, $gValidBlockIPGroup, $gIPOverlapDetector;

    if($gNoBlockIPGroup) {
        echo("<p class='error'>Please enter an IP group address to block.</p>");
    } else if($gBlackIPGroup) {
        echo("<p class='error'>The IP group entered contained characters that are not allowed</p>");
    } else if(!$gValidBlockIPGroup) {
        echo("<p class='error'>The IP group entered was not valid</p>");
    } else if($gIPOverlapDetector != NULL && $gIPOverlapDetector->overlapDetected()) {
        if($gIPOverlapDetector->overlapsWithUsersIP()) {
            echo("<p class='error'>Your IP is included in this IP group, you probably shouldn't block yourself</p>");
        } else {
            echo("<p class='error'>The IP group overlaps with another ip group with IP: " . $gIPOverlapDetector->getIPOfOverlap() . " and subnet: "  . $gIPOverlapDetector->getSubnetOfOverlap() . "</p>");
        }
    }
}

function displayOutputBlockIPGroupSubnet() {
    global $gNoBlockSubnet, $gBlockBlockSubnet, $gValidBlockSubnet;

    if($gNoBlockSubnet) {
        echo("<p class='error'>Please enter a subnet for blocking.</p>");
    } else if($gBlockBlockSubnet) {
        echo("<p class='error'>The subnet entered contained characters that are not allowed</p>");
    } else if(!$gValidBlockSubnet) {
        echo("<p class='error'>The subnet entered was not valid</p>");
    }
}

function displayOutputBlockSingleIP() {
    global $gNoBlockIP, $gBlackBlockIP, $gValidBlockIP, $gIPOverlapDetector;

    if($gNoBlockIP) {
        echo("<p class='error'>Please enter an IP address to block.</p>");
    } else if($gBlackBlockIP) {
        echo("<p class='error'>The IP address entered contained characters that are not allowed</p>");
    } else if(!$gValidBlockIP) {
        echo("<p class='error'>The IP address entered was not valid</p>");
    } else if($gIPOverlapDetector != NULL && $gIPOverlapDetector->overlapDetected()) {
        if($gIPOverlapDetector->overlapsWithUsersIP()) {
            echo("<p class='error'>Your IP is included in this IP group, you probably shouldn't block yourself</p>");
        } else {
            echo("<p class='error'>The IP overlaps with another ip group with IP: " . $gIPOverlapDetector->getIPOfOverlap() . " and subnet: "  . $gIPOverlapDetector->getSubnetOfOverlap() . "</p>");
        }
    }
}

function displayOutputUnblockIPGroup() {
    global $gNoUnblockIPGroup, $gDefaultUnblockIPGroup;

    if($gNoUnblockIPGroup) {
        echo("<p class='error'>Please select an IP address to unblock.</p>");
    } else if($gDefaultUnblockIPGroup) {
        echo("<p class='error'>There are currently no IP's to unblock.</p>");
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Access Control</div>
        <h1>Access Control</h1>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
        ?>
                    <p>This page allows administrators to block or unblock a given IP address. Blocked addresses will be
                        redirected to a simple text page and will not be able to see anything on the website.</p>

                    <?php
                        if($validForm && (isset($_POST['block-single-ip']) || isset($_POST['block-ip-group']))) {
                    ?>
                        <p class="error"><strong><em>IPs from <?php echo($networkInfo->getFirstHostIP()) ?> to <?php echo($networkInfo->getLastHostIP()) ?> were just blocked.</em></strong></p>
                    <?php
                        }
                    ?>

                    <!-- ### START Access control Form ### -->
                    <form action="access-control.php" method="post" name="access-control">

                        <!-- Unblock IP / IP Group Section -->
                        <hr/>
                        <h2>Unblock IP / IP Group</h2>
                        <div class='access-control-label'>
                            <p><strong>Currently Blocked IP Groups: </strong></p>
                        </div>
                        <?php
                            $selectedIP = isset($_POST['blocked-ip-groups']) ? $_POST['blocked-ip-groups'] : "";
                            echo("<div class='access-control-input'>");
                            echo("<p><select name='blocked-ip-groups' style='width:100%;'>");
                            foreach($blockedIPGroups as $blockedIPGroup) {
                                if($blockedIPGroup != NO_BLOCKED_IP_GROUPS) {
                                    if($selectedIP == "IP: " . $blockedIPGroup->getIP() . ", Subnet: " . $blockedIPGroup->getSubnet()) {
                                        echo("<option selected='selected'>IP: " . $blockedIPGroup->getIP() . ", Subnet: " . $blockedIPGroup->getSubnet() . "</option>");
                                    } else {
                                        echo("<option>IP: " . $blockedIPGroup->getIP() . ", Subnet: " . $blockedIPGroup->getSubnet() . "</option>");
                                    }
                                } else {
                                    echo("<option selected='selected'>" . $blockedIPGroup . "</option>");
                                }
                            }
                            echo("</select></p>");

                            if(!$validForm && isset($_POST['unblock-ip-group'])) {
                                displayOutputUnblockIPGroup();
                            }

                            echo("</div>");
                        ?>
                        <div class="clear"></div>
                        <p class='float-right'><input type="submit" name="unblock-ip-group" value="Unblock IP Group" class="button" /></p>
                        <div class="clear"></div>

                        <!-- Select block option -->
                        <hr/>
                        <h2>Block IP / IP Group</h2>
                        <?php
                            $blockOption = isset($_POST['block-option']) ? $_POST['block-option'] : "single";
                            if($blockOption == "single") {
                        ?>
                            <p>
                                <input type="radio" name="block-option" value="single" checked="checked" />Block Single IP
                                <input type="radio" name="block-option" value="group" />Block IP Group
                            </p>
                        <?php
                            } else {
                        ?>
                            <p>
                                <input type="radio" name="block-option" value="single" />Block Single IP
                                <input type="radio" name="block-option" value="group" checked="checked" />Block IP Group
                            </p>
                        <?php
                            }
                        ?>

                        <!-- Block Single IP Section -->
                        <?php
                            $blockOption = isset($_POST['block-option']) ? $_POST['block-option'] : "single";
                            if($blockOption == "single") {
                        ?>
                        <div id="block-single" style="display:block;">
                            <?php
                                } else {
                            ?>
                            <div id="block-single" style="display:none;">
                            <?php
                                }
                            ?>
                                <div class="access-control-label">
                                    <p><strong>Single IP Address:</strong></p>
                                </div>
                                <div class="access-control-input">
                                    <p><input type="text" name="block-single-ip-ip" value="<?php if(isset($_POST['block-single-ip-ip'])) { echo($_POST['block-single-ip-ip']); }?>" /></p>
                                    <?php
                                        if(!$validForm && isset($_POST['block-single-ip'])) {
                                            displayOutputBlockSingleIP();
                                        }
                                    ?>
                                </div>
                                <div class="clear"></div>
                                <p class='float-right'><input type="submit" name="block-single-ip" value="Block Single IP" class="button"/></p>
                                <div class="clear"></div>
                            </div>

                            <!-- Block IP Group Section -->
                            <?php
                                $blockOption = isset($_POST['block-option']) ? $_POST['block-option'] : "single";
                                if($blockOption == "group") {
                            ?>
                                    <div id="block-group" style="display:block;">
                            <?php
                                } else {
                            ?>
                                    <div id="block-group" style="display:none;">
                            <?php
                                }
                            ?>
                                    <div class="access-control-label">
                                        <p><strong>IP Address:</strong></p>
                                    </div>
                                    <div class="access-control-input">
                                        <p><input type="text" name="block-ip-group-ip" value="<?php if(isset($_POST['block-ip-group-ip'])) { echo($_POST['block-ip-group-ip']); }?>" /></p>
                                        <?php
                                            if(!$validForm && isset($_POST['block-ip-group'])) {
                                                displayOutputBlockIPGroupIP();
                                            }
                                        ?>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="access-control-label">
                                        <p><strong>Subnet:</strong></p>
                                    </div>
                                    <div class="access-control-input">
                                        <p><input type="text" name="block-ip-group-subnet"  value="<?php if(isset($_POST['block-ip-group-subnet'])) { echo($_POST['block-ip-group-subnet']); }?>"/></p>
                                        <?php
                                            if(!$validForm && isset($_POST['block-ip-group'])) {
                                                displayOutputBlockIPGroupSubnet();
                                            }
                                        ?>
                                    </div>
                                    <div class="clear"></div>

                                    <p class='float-right'>
                                        <input type="submit" name="block-ip-group" value="Block IP Group" class="button" />
                                    </p>
                                    <div class="clear"></div>
                                </div>
                                <hr/>
                    </form>
                    <!-- ### END Access Control Form ### -->
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