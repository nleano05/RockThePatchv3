<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if (isset($_POST['error-report'])) {
    $validForm = checkInput();
}

function checkInput() {
    global $gNoName, $gNoEmail, $gNoIssue;
    global $gBlackName, $gBlackEmail, $gBlackIssue;
    global $gValidEmail;

    $validForm = TRUE;

    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $issue = isset($_POST['issue']) ? $_POST['issue'] : "";

    $gNoName = lib_check::isEmpty($name);
    if ($gNoName) {
        $validForm = FALSE;
    }

    $gNoEmail = lib_check::isEmpty($email);
    if ($gNoEmail) {
        $validForm = FALSE;
    }

    $gNoIssue = lib_check::isEmpty($issue);
    if ($gNoIssue) {
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

    $gBlackIssue = lib_check::againstWhiteList($issue);
    if ($gBlackIssue) {
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

function displayOutputIssue() {
    global $gNoIssue, $gBlackIssue;

    if($gNoIssue) {
        echo("<p class='error'>Please enter in an issue to continue.</p>");
    } else if($gBlackIssue) {
        echo("<p class='error'>The issue entered contained characters that are not allowed, not sending email.</p>");
    }
}

function sendErrorReport() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $issue = isset($_POST['issue']) ? $_POST['issue'] : "";
    $annoyanceLevel = isset($_POST['annoyance-level']) ? $_POST['annoyance-level'] : "";
    $category = isset($_POST['category']) ? $_POST['category'] : "";
    $screenShot = !empty($_FILES["file"]["name"]) ? $_FILES["file"]["name"] : "No file uploaded for error report";

    $errorReportCategoryInfo = lib_database::getErrorReportCategories($category);


    if(!empty($errorReportCategoryInfo)) {
        $emailDistroInfo = lib_database::getEmailDistros($errorReportCategoryInfo[0]->getDistro());
    }

    $invalidFile = lib_check::upload("../error-reports/");

    if($invalidFile) {
        $file = "../error-reports/" . $_FILES["file"]["name"];
        if(!empty($_FILES["file"]["name"])) {
            $screenShot = "Invalid file was uploaded for error report - '" . $file . "'";
        } else {
            $screenShot = "No file was uploaded for error report";
        }
    }

    $os = lib_get::os();
    $agent = lib_get::agent();
    $fullAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "Full agent not set";

    $subject = "Rock the Patch! - Error Report";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - Error Report</h2>\r\n\r\n"
        ."\r\n"
        ."Patches wants to know what issue you are having on the website! \n\n"
        ."Thanks for reporting your issue and hopefully it'll get fixed soon.  If you're worried \n\n"
        ."that your error report isn't going through or isn't being heard, please feel free to email patches at: \n\n"
        ."<a href='mailto:$gMasterAdminEmail?subject='Rock%20the%20Patch!'%20Error%20Report%20from%20user' title='Email $gMasterAdminName an Error Report' class='reportErrorLink'>$gMasterAdminEmail</a><br/><br/>\n\n"
        ."\n"
        ."<strong>Name:</strong> $name<br/><br/>\n\n"
        ."<strong>Email:</strong> $email<br/><br/>\n\n"
        ."<strong>Issue:</strong> $issue<br/><br/>\n\n"
        ."<strong>Annoyance Level:</strong> $annoyanceLevel<br/><br/>\n\n"
        ."<strong>Category:</strong> $category<br/><br/>\n\n"
        ."<strong>Screen Shot:</strong> $screenShot<br/><br/>\n\n"
        ."<strong>OS:</strong> " . $os['OS'] . "<br/>\n\n"
        ."<strong>OS Version:</strong> " . $os['Version'] . "<br/>\n\n"
        ."<strong>Agent:</strong> " . $agent['Agent'] . "<br/>\n\n"
        ."<strong>Agent Version:</strong> " . $agent['Version'] . "<br/>\n\n"
        ."<strong>Full Agent:</strong> $fullAgent<br/><br/>\n\n";

	$success = FALSE;
    if(!empty($_FILES["file"]["name"])) {
        if($invalidFile) {
            if(!empty($emailDistroInfo) && !empty($emailDistroInfo[0]->emailMembers)) {
                $recipients = $emailDistroInfo[0]->emailMembers;
            } else{
                $recipients = $gMasterAdminEmail;
            }
            $success = lib::sendMail($recipients, $subject, $body, TRUE);
        } else {
            $file = "../error-reports/" . $_FILES["file"]["name"];
            $fileType = $_FILES["file"]["type"];
            if(!empty($emailDistroInfo) && !empty($emailDistroInfo[0]->emailMembers)) {
                $recipients = $emailDistroInfo[0]->emailMembers;
            } else{
                $recipients = $gMasterAdminEmail;
            }
            $success = lib::sendMail($recipients, $subject, $body, TRUE, TRUE, $file, $fileType);
        }
    } else {
        if(!empty($emailDistroInfo) && !empty($emailDistroInfo[0]->emailMembers)) {
            $recipients = $emailDistroInfo[0]->emailMembers;
        } else{
            $recipients = $gMasterAdminEmail;
        }
        $success = lib::sendMail($recipients, $subject, $body, TRUE);
    }
	
	if($success) {
        echo("<p><strong><em>EMAIL SUCCESS -- Yay! An error report email and confirmation has been sent successfully.</em></strong></p>");
    } else {
        echo("<p><strong><em>EMAIL FAILURE -- Bummer, an error report email and confirmation <font class='error'>was not</font> sent although the provided information was valid.  Please try again later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>.</em></strong></p>");
    }

    // TODO - maybe make this more dynamic
    lib::createGitHubIssue("New issue from " . $name, $issue, PATCHES, ERROR_REPORT_MILESTONE_NUMBER, array("Bug", "Found By User"));
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
    <title>Rock the Patch! v3 - Error Report</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Error Report</div>

        <h1>Error Report</h1>

        <?php
            if (!$validForm) {
        ?>
            <form method="post" name="error-report-form" action="/user-system/error-report.php" enctype="multipart/form-data">
                <p><strong>Name:</strong>
                    <input type="text" name="name" style="width:100%;" value="<?php if(isset($_POST['name'])){ echo($_POST['name']); } ?>"/>
                </p>
                <?php
                    if (isset($_POST['error-report'])) {
                        displayOutputName();
                    }
                ?>

                <p><strong>Email:</strong>
                    <input type="text" name="email" style="width:100%;" value="<?php if(isset($_POST['email'])){ echo($_POST['email']); } ?>"/>
                </p>
                <?php
                    if (isset($_POST['error-report'])) {
                        displayOutputEmail();
                    }
                ?>

                <p><strong>Issue:</strong>
                    <textarea name="issue" rows="20" cols="50" style="width:100%;height:40px;">
						<?php if(isset($_POST['issue'])){ echo($_POST['issue']); } ?>
					</textarea>
                </p>
                <?php
                    if (isset($_POST['error-report'])) {
                        displayOutputIssue();
                    }

                    $annoyanceLevels = lib_database::getAnnoyanceLevels();
                    if (!empty($annoyanceLevels)) {
                        echo("<p><strong>Annoyance Level:</strong>");
                        echo("<select name='annoyance-level' style='width:100%;'>");
                        foreach ($annoyanceLevels as $annoyanceLevel) {
                            if ($annoyanceLevel->isDefault()) {
                                echo("<option selected='selected'>" . $annoyanceLevel->getLevel() . " - " . $annoyanceLevel->getName() . "</option>");
                            } else {
                                echo("<option>" . $annoyanceLevel->getLevel() . " - " . $annoyanceLevel->getName() . "</option>");
                            }
                        }
                        echo("</select>");
                        echo("</p>");
                    }

                    $errorReportCategories = lib_database::getErrorReportCategories();
                    if (!empty($errorReportCategories)) {
                        echo("<p><strong>Category:</strong>");
                        echo("<select name='category' style='width:100%;'>");
                        foreach ($errorReportCategories as $errorReportCategory) {
                            if ($errorReportCategory->isDefault()) {
                                echo("<option selected='selected'>" . $errorReportCategory->getName() . "</option>");
                            } else {
                                echo("<option>" . $errorReportCategory->getName() . "</option>");
                            }
                        }
                        echo("</select>");
                        echo("</p>");
                    }
                ?>

                <p><strong>Screen Shot:</strong></p>

                <div class="file-input"><p><input type="file" name="file"/></p></div>
                <p><em><strong>*NOTE*</strong> Only .gif, .jpeg, and .png files that are less than 20MB will be allowed as attachments.</em></p>
                <p><input type="submit" name="error-report" value="Submit Report" class="button"/></p>
            </form>

            <p style="word-break:break-all;">
                Need anything else? Email Patches at: <a href="mailto:<?php global $gMasterAdminEmail;
                echo($gMasterAdminEmail); ?>?subject='Rock%20the%20Patch!'%20Email%20from%20user" title="Email <?php global $gMasterAdminName;echo($gMasterAdminName); ?>"><?php global $gMasterAdminEmail;echo($gMasterAdminEmail); ?></a>
            </p>
        <?php
            } else {
        ?>
                <p>Thanks for reporting your issue!  Your error report has been submitted to Patches and hopefully
                    it'll get fixed soon. <strong>*NOTE*</strong> If you have entered in an incorrect email, she may
                    not be able to reach you. Please don't hesitate to resubmit your issue or email Patches at:
                    <a href="mailto:<?php global $gMasterAdminEmail; echo($gMasterAdminEmail); ?>?subject='Rock%20the%20Patch!'%20Error%20Report%20from%20user" title="Email <?php global $gMasterAdminName; echo($gMasterAdminName); ?> an Error Report" class="reportErrorLink"><?php global $gMasterAdminEmail; echo($gMasterAdminEmail); ?></a>
                    if you don't think it's going through or have any questions.</p>

                <p>You can find up-to-date information about known issues on the <a href="/site-issues.php" title="Site Issues">Site Issues</a> page.</p>
        <?php
				sendErrorReport();
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