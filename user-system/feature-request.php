<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if (isset($_POST['feature-request'])) {
    $validForm = checkInput();
}

function checkInput() {
    global $gNoName, $gNoEmail, $gNoRequest;
    global $gBlackName, $gBlackEmail, $gBlackRequest;
    global $gValidEmail;

    $validForm = TRUE;

    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $request = isset($_POST['request']) ? $_POST['request'] : "";

    $gNoName = lib_check::isEmpty($name);
    if ($gNoName) {
        $validForm = FALSE;
    }

    $gNoEmail = lib_check::isEmpty($email);
    if ($gNoEmail) {
        $validForm = FALSE;
    }

    $gNoRequest = lib_check::isEmpty($request);
    if ($gNoRequest) {
        $validForm = FALSE;
    }

    $gBlackName = lib_check::againstWhiteList($name);
    if ($gBlackName) {
        $validForm = FALSE;
    }

    $gBlackEmail = lib_check::againstWhiteList($email);
    if ($gBlackEmail) {
        $validForm = FALSE;
    }

    $gBlackRequest = lib_check::againstWhiteList($request);
    if ($gBlackRequest) {
        $validForm = FALSE;
    }

    $gValidEmail = lib_check::validEmail($email);
    if (!$gValidEmail) {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputName() {
    global $gNoName, $gBlackName;

    if($gNoName) {
        echo("<p class='error'>Please enter a name to continue.</p>");
    } else if($gBlackName) {
        echo("<p class='error'>The name entered contained characters that are not allowed, not sending email.</p>");
    }
}

function displayOutputEmail() {
    global $gNoEmail, $gBlackEmail, $gValidEmail;

    if($gNoEmail) {
        echo("<p class='error'>Please enter an email to continue.</p>");
    } else if($gBlackEmail) {
        echo("<p class='error'>The email entered contained characters that are not allowed, not sending email.</p>");
    } else if(!$gValidEmail) {
        echo("<p class='error'>The email entered was not a valid email, not sending email.</p>");
    }
}

function displayOutputRequest() {
    global $gNoRequest, $gBlackRequest;

    if($gNoRequest) {
        echo("<p class='error'>Please enter in a request to continue.</p>");
    } else if($gBlackRequest) {
        echo("<p class='error'>The request entered contained characters that are not allowed, not sending email.</p>");
    }
}

function sendFeatureRequest() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $request = isset($_POST['request']) ? $_POST['request'] : "";
    $category = isset($_POST['category']) ? $_POST['category'] : "";

    $featureRequestCategoryInfo = lib_database::getFeatureRequestCategories($category);

    if(!empty($featureRequestCategoryInfo) && !empty($featureRequestCategoryInfo[0])) {
        $emailDistroInfo = lib_database::getEmailDistros($featureRequestCategoryInfo[0]->getDistro());
    }

    $subject = "Rock the Patch! - Feature Request";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Feature Request</h2>\r\n\r\n"
        ."\r\n"
        ."Patches is excited to hear your thoughts and what can be improved on the website! \r\n\r\n"
        ."Thanks for your contribution and hopefully it can become a reality.  If you're worried \r\n\r\n"
        ."that your request isn't going through or isn't being heard, please feel free to email patches at: \r\n\r\n"
        ."<a href='mailto:$gMasterAdminEmail?subject='Rock%20the%20Patch!'%20Feature%20request%20from%20user' title='Email $gMasterAdminName a Feature Request' class='reportErrorLink'>$gMasterAdminEmail</a><br/><br/>\r\n\r\n"
        ."\r\n"
        ."<strong>Name:</strong> $name<br/><br/>\r\n\r\n"
        ."<strong>Email:</strong> $email<br/><br/>\r\n\r\n"
        ."<strong>Category:</strong> $category<br/><br/>\r\n\r\n"
        ."<strong>Request:</strong> $request<br/><br/>\r\n\r\n";

    if(!empty($emailDistroInfo) && !empty($emailDistroInfo[0]->emailMembers)) {
        $recipients = $emailDistroInfo[0]->emailMembers;
    } else{
        $recipients = $gMasterAdminEmail;
    }

    $success = lib::sendMail($recipients, $subject, $body, TRUE);
	if($success) {
        echo("<p><strong><em>EMAIL SUCCESS -- Yay! A feature request email and confirmation has been sent successfully.</em></strong></p>");
    } else {
        echo("<p><strong><em>EMAIL FAILURE -- Bummer, a feature request email and confirmation <font class='error'>was not</font> sent although the provided information was valid.  Please try again later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>.</em></strong></p>");
    }
	
	// TODO - maybe make this more dynamic
    lib::createGitHubIssue("New request from " . $name, $request, PATCHES, FEATURE_REQUEST_MILESTONE_NUMBER, array(TODO, "Requested By User"));
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
    <title>Rock the Patch! v3 - Feature Request</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Feature Request</div>

        <h1>Feature Request</h1>

        <?php
        if (!$validForm) {
            ?>
            <form method="post" name="feature-request-form" action="/user-system/feature-request.php">
                <p><strong>Name:</strong>
                    <input type="text" name="name" style="width:100%;" value="<?php if(isset($_POST['name'])){ echo($_POST['name']); } ?>"/>
                </p>
                <?php
                if (isset($_POST['feature-request'])) {
                    displayOutputName();
                }
                ?>

                <p><strong>Email:</strong>
                    <input type="text" name="email" style="width:100%;" value="<?php if(isset($_POST['email'])){ echo($_POST['email']); } ?>"/>
                </p>
                <?php
                if (isset($_POST['feature-request'])) {
                    displayOutputEmail();
                }
                ?>

                <p><strong>Request:</strong>
                    <textarea name="request" rows="20" cols="50" style="width:100%;height:40px;">
						<?php if(isset($_POST['request'])){ echo($_POST['request']); } ?>
					</textarea>
                </p>
                <?php
                    if (isset($_POST['feature-request'])) {
                        displayOutputRequest();
                    }

                    $featureRequestCategories = lib_database::getFeatureRequestCategories();
                    if(!empty($featureRequestCategories)) {
                        echo("<p><strong>Category:</strong>");
                        echo("<select name='category' style='width:100%;'>");
                        foreach($featureRequestCategories as $featureRequestCategory) {
                            if($featureRequestCategory->isDefault()) {
                                echo("<option selected='selected'>" . $featureRequestCategory->getName() . "</option>");
                            } else {
                                echo("<option>" . $featureRequestCategory->getName() . "</option>");
                            }
                        }
                        echo("</select>");
                        echo("</p>");
                    }
                ?>

                <p><input type="submit" name="feature-request" value="Submit Request" class="button"/></p>
            </form>

            <p style="word-break:break-all;">
                Need anything else? Email Patches at: <a href="mailto:<?php global $gMasterAdminEmail;
                echo($gMasterAdminEmail); ?>?subject='Rock%20the%20Patch!'%20Email%20from%20user" title="Email <?php global $gMasterAdminName;echo($gMasterAdminName); ?>"><?php global $gMasterAdminEmail;echo($gMasterAdminEmail); ?></a>
            </p>
            <?php
        } else {
            ?>
                <p>Thanks for your contribution!  Your request has been submitted to Patches and she'll get back
                    to you about your idea!  <strong>*NOTE*</strong> If you have entered in an incorrect email, she may
                    not be able to reach you. Please don't hesitate to resubmit your idea or email Patches at:
                    <a href="mailto:<?php global $gMasterAdminEmail; echo($gMasterAdminEmail); ?>?subject='Rock%20the%20Patch!'%20Feature%20request%20from%20user" title="Email <?php global $gMasterAdminName; echo($gMasterAdminName); ?> a Feature Request" class="reportErrorLink"><?php global $gMasterAdminEmail; echo($gMasterAdminEmail); ?></a>
                    if you don't think it's going through or have issues.

                  <p>You can find up-to-date information about upcoming and current projects on the <a href="/site-projects.php" title="Site Project">Site Projects</a> page.</p>
        <?php
                sendFeatureRequest();
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