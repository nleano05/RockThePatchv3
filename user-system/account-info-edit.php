<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gLoginStatus;
global $gValidForm;
global $gUser;

$gValidForm = FALSE;
$gUser = lib_get::currentUser();

if(isset($_POST['account-info-edit'])) {
    $gValidForm = checkInput();
}

function checkInput() {
    global $gNoFirstName, $gNoLastName, $gNoUserName, $gNoEmail, $gNoEmailConfirm, $gNoOldPassword, $gNoNewPassword, $gNoNewPasswordConfirm, $gNoSecurityQuestion, $gNoAnswer, $gNoAnswerConfirm, $gNoCellPhone;
    global $gBlackFirstName, $gBlackLastName, $gBlackUserName, $gBlackEmail, $gBlackEmailConfirm, $gBlackOldPassword, $gBlackNewPassword, $gBlackNewPasswordConfirm, $gBlackAnswer, $gBlackAnswerConfirm, $gBlackCellPhone;
    global $gCorrectOldPassword;
    global $gFirstNameTooLong, $gLastNameTooLong, $gUserNameTooLong;
    global $gEmailInUse, $gUserNameInUse;
    global $gEmailInRegistration, $gUserNameInRegistration;
    global $gAnswersMatch, $gEmailsMatch, $gPasswordsMatch;
    global $gValidEmail, $gValidPassword, $gValidCellPhone;
    global $gUser;

    $validForm = TRUE;

    $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : "";
    $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : "";
    $userName = isset($_POST['username']) ? $_POST['username'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $emailConfirm = isset($_POST['email-confirm']) ? $_POST['email-confirm'] : "";
    $oldPassword = isset($_POST['old-password']) ? $_POST['old-password'] : "";
    $newPassword = isset($_POST['new-password']) ? $_POST['new-password'] : "";
    $newPasswordConfirm = isset($_POST['new-password-confirm']) ? $_POST['new-password-confirm'] : "";
    $securityQuestion = isset($_POST['security-question']) ? $_POST['security-question'] : "";
    $answer = isset($_POST['answer']) ? $_POST['answer'] : "";
    $answerConfirm = isset($_POST['answer-confirm']) ? $_POST['answer-confirm'] : "";
    $cellPhone = isset($_POST['cell-phone']) ? $_POST['cell-phone'] : "";
    $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";

    $gNoFirstName = lib_check::isEmpty($firstName);
    if($gNoFirstName) {
        $validForm = FALSE;
    }

    $gNoLastName = lib_check::isEmpty($lastName);
    if($gNoLastName) {
        $validForm = FALSE;
    }

    $gNoUserName = lib_check::isEmpty($userName);
    if($gNoUserName) {
        $validForm = FALSE;
    }

    $gNoEmail = lib_check::isEmpty($email);
    if($gNoEmail) {
        $validForm = FALSE;
    }

    if(strtolower($email.trim(" ", "")) != strtolower($gUser->getEmail().trim(" " , ""))) {
        $gNoEmailConfirm = lib_check::isEmpty($emailConfirm);
        if($gNoEmailConfirm) {
            $validForm = FALSE;
        }

        $gBlackEmailConfirm  = lib_check::againstWhiteList($emailConfirm);
        if($gBlackEmailConfirm) {
            $validForm = FALSE;
        }
    }

    $gNoOldPassword = lib_check::isEmpty($oldPassword);
    if($gNoOldPassword) {
        $validForm = FALSE;
    }

    if($useOldPassword == "no") {
        $gNoNewPassword = lib_check::isEmpty($newPassword);
        if($gNoNewPassword) {
            $validForm = FALSE;
        }

        $gNoNewPasswordConfirm = lib_check::isEmpty($newPasswordConfirm);
        if($gNoNewPasswordConfirm) {
            $validForm = FALSE;
        }
    }

    $gNoAnswer = lib_check::isEmpty($answer);
    if($gNoAnswer) {
        $validForm = FALSE;
    }

    if(strtolower($answer.trim(" ", "")) != strtolower($gUser->getSecurityQuestionAnswer().trim(" " , ""))) {
        $gNoAnswerConfirm = lib_check::isEmpty($answerConfirm);
        if($gNoAnswerConfirm) {
            $validForm = FALSE;
        }

        $gBlackAnswerConfirm  = lib_check::againstWhiteList($answerConfirm);
        if($gBlackAnswerConfirm) {
            $validForm = FALSE;
        }
    }

    $gNoCellPhone  = lib_check::isEmpty($cellPhone);
    if($gNoCellPhone) {
        $validForm = FALSE;
    }

    if($securityQuestion == SELECT_SECURITY_QUESTION) {
        $gNoSecurityQuestion = TRUE;
        $validForm = FALSE;
    }

    $gBlackFirstName  = lib_check::againstWhiteList($firstName);
    if($gBlackFirstName) {
        $validForm = FALSE;
    }

    $gBlackLastName  = lib_check::againstWhiteList($lastName);
    if($gBlackLastName) {
        $validForm = FALSE;
    }

    $gBlackUserName  = lib_check::againstWhiteList($userName);
    if($gBlackUserName) {
        $validForm = FALSE;
    }

    $gBlackEmail = lib_check::againstWhiteList($email);
    if($gBlackEmail) {
        $validForm = FALSE;
    }

    $gBlackOldPassword = lib_check::againstWhiteList($oldPassword);
    if($gBlackOldPassword) {
        $validForm = FALSE;
    }

    if($useOldPassword == "no") {
        $gBlackNewPassword = lib_check::againstWhiteList($newPassword);
        if($gBlackNewPassword) {
            $validForm = FALSE;
        }

        $gBlackNewPasswordConfirm = lib_check::againstWhiteList($newPasswordConfirm);
        if($gBlackNewPasswordConfirm) {
            $validForm = FALSE;
        }

        $gPasswordsMatch  = lib_check::same($newPassword, $newPasswordConfirm);
        if(!$gPasswordsMatch) {
            $validForm = FALSE;
        }

        $gValidPassword = lib_check::validPassword($newPassword);
        if(!$gValidPassword) {
            $validForm = FALSE;
        }
    }

    $gBlackAnswer  = lib_check::againstWhiteList($answer);
    if($gBlackAnswer) {
        $validForm = FALSE;
    }

    $gBlackCellPhone  = lib_check::againstWhiteList($cellPhone);
    if($gBlackCellPhone) {
        $validForm = FALSE;
    }

    $user = lib_database::getUser($gUser->getId(), NULL, NULL, $oldPassword);
    if($user != NULL) {
        $oldPasswordFromDatabase = lib::decrypt($user->getId() . "_pass");
        $gCorrectOldPassword = lib_check::same($oldPassword, $oldPasswordFromDatabase);
        if(!$gCorrectOldPassword) {
            $validForm = FALSE;
        }
    } else {
        $gCorrectOldPassword = FALSE;
        $validForm = FALSE;
    }

    $gFirstNameTooLong = lib_check::stringLength($firstName, 40, ">");
    if($gFirstNameTooLong) {
        $validForm = FALSE;
    }

    $gLastNameTooLong = lib_check::stringLength($lastName, 40, ">");
    if($gLastNameTooLong) {
        $validForm = FALSE;
    }

    $gUserNameTooLong = lib_check::stringLength($userName, 40, ">");
    if($gUserNameTooLong) {
        $validForm = FALSE;
    }

    if($gUser != NULL && strtolower($email) != strtolower($gUser->getEmail())) {
        $gEmailInUse = lib_check::userInDb(NULL, $email, NULL, NULL, FALSE);
        if($gEmailInUse) {
            $validForm = FALSE;
        }
    }

    if($gUser != NULL && strtolower($userName) != strtolower($gUser->getUserName())) {
        $gUserNameInUse = lib_check::userInDb(NULL, NULL, $userName, NULL, FALSE);
        if($gUserNameInUse) {
            $validForm = FALSE;
        }
    }

    if($gUser != NULL && strtolower($email.trim(" ", "")) != strtolower($gUser->getEmail().trim(" " , ""))) {
        $gEmailsMatch  = lib_check::same(strtolower($email), strtolower($emailConfirm));
        if(!$gEmailsMatch ) {
            $validForm = FALSE;
        }
    }

    if($gUser != NULL && strtolower($answer.trim(" ", "")) != strtolower($gUser->getSecurityQuestionAnswer().trim(" " , ""))) {
        $gAnswersMatch = lib_check::same($answer, $answerConfirm);
        if(!$gAnswersMatch) {
            $validForm = FALSE;
        }
    }

    $gValidCellPhone = lib_check::validPhone($cellPhone);
    if(!$gValidCellPhone) {
        $validForm = FALSE;
    }

    $gEmailInRegistration = lib_check::userInDb(NULL, $email, NULL, NULL, TRUE);
    if($gEmailInRegistration) {
        $validForm = FALSE;
    }

    $gUserNameInRegistration = lib_check::userInDb(NULL, NULL, $userName, NULL, TRUE);
    if($gUserNameInRegistration) {
        $validForm = FALSE;
    }

    $gValidEmail = lib_check::validEmail($email);
    if(!$gValidEmail) {
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputFirstName() {
    global $gNoFirstName, $gBlackFirstName, $gFirstNameTooLong;

    if($gNoFirstName) {
        echo("<p class='error'>Please enter in a first name to continue.</p>");
    } else if($gBlackFirstName) {
        echo("<p class='error'>First name contained characters that are not allowed.</p>");
    } else if($gFirstNameTooLong) {
        echo("<p class='error'>Your first name may not have more than 40 chars.</p>");
    }
}

function displayOutputLastName() {
    global $gNoLastName, $gBlackLastName, $gLastNameTooLong;

    if ($gNoLastName) {
        echo("<p class='error'>Please enter in a last name to continue.</p>");
    } else if ($gBlackLastName) {
        echo("<p class='error'>Last name contained characters that are not allowed.</p>");
    } else if ($gLastNameTooLong) {
        echo("<p class='error'>Your last name may not have more than 40 chars.</p>");
    }
}

function displayOutputUsername(){
    global $gNoUserName, $gBlackUserName, $gUserNameInUse, $gUserNameInRegistration, $gUserNameTooLong;

    if($gNoUserName) {
        echo("<p class='error'>Please enter in a user name to continue.</p>");
    } else if($gBlackUserName) {
        echo("<p class='error'>User Name contained characters that are not allowed.</p>");
    } else if($gUserNameInUse) {
        echo("<p class='error'>That user name is already in use, please try another.</p>");
    } else if($gUserNameInRegistration) {
        echo("<p class='error'>That user name is already in the middle of the registration process, please try another.</p>");
    } else if($gUserNameTooLong) {
        echo("<p class='error'>Your first name may not have more than 40 chars.</p>");
    }
}

function displayOutputEmail() {
    global $gNoEmail, $gBlackEmail, $gEmailInUse, $gEmailInRegistration, $gEmailsMatch, $gValidEmail;

    if($gNoEmail) {
        echo("<p class='error'>Please enter in an email to continue.</p>");
    } else if($gBlackEmail) {
        echo("<p class='error'>Email contained characters that are not allowed.</p>");
    } else if($gEmailInUse) {
        echo("<p class='error'>That email is already in use, please try another.</p>");
    } else if($gEmailInRegistration) {
        echo("<p class='error'>That email is already in the middle of the registration process, please try another.</p>");
    } else if(!$gEmailsMatch) {
        echo("<p class='error'>The emails you have entered are not the same.</p>");
    } else if(!$gValidEmail) {
        echo("<p class='error'>The email you have entered is not valid.  Please make sure it contains the @ symbol and is correct.</p>");
    }
}

function displayOutputEmailConfirm() {
    global $gNoEmailConfirm, $gBlackEmailConfirm;

    if($gNoEmailConfirm) {
        echo("<p class='error'>Please confirm your email to continue.</p>");
    } else if($gBlackEmailConfirm) {
        echo("<p class='error'>User Email confirmation contained characters that are not allowed.</p>");
    }
}

function displayOutputOldPassword() {
    global $gNoOldPassword, $gBlackOldPassword, $gCorrectOldPassword;

    if($gNoOldPassword) {
        echo("<p class='error'>Please enter in your <strong>OLD</strong> password to continue.</p>");
    } else if($gBlackOldPassword) {
        echo("<p class='error'>The <strong>OLD</strong> password entered contained characters that are not allowed.</p>");
    } else if(!$gCorrectOldPassword) {
        echo("<p class='error'>Incorrect <strong>OLD</strong> password entered.</p>");
    }
}

function displayOutputNewPassword() {
    global $gNoPassword, $gBlackPassword, $gPasswordsMatch;
    global $gPasswordNotCharNum, $gPasswordTooShort, $gPasswordTooLong, $gPasswordNoCapitalLetter, $gPasswordNoLowercaseLetter, $gPasswordNoNumber;

    if($gNoPassword) {
        echo("<p class='error'>Please enter in a password to continue.</p>");
    } else if($gBlackPassword) {
        echo("<p class='error'>Password contained characters that are not allowed.</p>");
    } else if(!$gPasswordsMatch) {
        echo("<p class='error'>The passwords you have entered are not the same.</p>");
    } else if($gPasswordTooShort) {
        echo("<p class='error'>The password must be at least 6 characters.</p>");
    } else if($gPasswordTooLong) {
        echo("<p class='error'>The password must be less than 20 characters.</p>");
    } else if($gPasswordNotCharNum) {
        echo("<p class='error'>The password must not contain special characters.</p>");
    } else if($gPasswordNoCapitalLetter) {
        echo("<p class='error'>The password must contain at least one upper case letter.</p>");
    } else if($gPasswordNoLowercaseLetter) {
        echo("<p class='error'>The password must contain at least one lower case letter.</p>");
    } else if($gPasswordNoNumber) {
        echo("<p class='error'>The password must contain at least one number.</p>");
    }
}

function displayOutputNewPasswordConfirm() {
    global $gNoNewPasswordConfirm, $gBlackNewPasswordConfirm;

    if($gNoNewPasswordConfirm) {
        echo("<p class='error'>Please confirm your password to continue.</p>");
    } else if($gBlackNewPasswordConfirm) {
        echo("<p class='error'>Password confirmation contained characters that are not allowed.</p>");
    }
}

function displayOutputCellPhone() {
    global $gNoCellPhone, $gBlackCellPhone, $gValidCellPhone;

    if($gNoCellPhone) {
        echo("<p class='error'>Please enter in a cell phone number to continue.</p>");
    } else if($gBlackCellPhone) {
        echo("<p class='error'>Cell phone contained characters that are not allowed.</p>");
    } else if(!$gValidCellPhone) {
        echo("<p class='error'>Please enter in a VALID cell phone number to continue.</p>");
    }
}

function displayOutputSecurityQuestion() {
    global $gNoSecurityQuestion;

    if($gNoSecurityQuestion) {
        echo("<p class='error'>Please choose a security question.</p>");
    }
}

function displayOutputAnswer() {
    global $gNoAnswer, $gBlackAnswer, $gAnswersMatch;
    global $gUser;

    if($gNoAnswer) {
        echo("<p class='error'>Please enter in an answer to the security question to continue.</p>");
    } else if($gBlackAnswer) {
        echo("<p class='error'>Answer to security question contained characters that are not allowed.</p>");
    }

    $answer = isset($_POST['answer']) ? $_POST['answer'] : "";

    if($gUser != NULL && strtolower($answer.trim(" ", "")) != strtolower($gUser->getSecurityQuestionAnswer().trim(" " , ""))) {
        if(!$gAnswersMatch) {
            echo("<p class='error'>The answers you have entered are not the same.</p>");
        }
    }
}

function displayOutputAnswerConfirm() {
    global $gNoAnswerConfirm, $gBlackAnswerConfirm;

    if($gNoAnswerConfirm) {
        echo("<p class='error'>Please confirm your answer to continue.</p>");
    } else if($gBlackAnswerConfirm) {
        echo("<p class='error'>Answer confirmation contained characters that are not allowed.</p>");
    }
}

function displayOutputEmailBlasts() {
    global $gUser;

    if(!empty($_POST['text'])) {
        echo("<p><input type='checkbox' name ='email-blasts' checked='checked' />Be part of the electronic mailing list<em> (You'll receive emails whenever the site is updated or there is a special event.</em>)</p>");
    } else {
        echo("<p><input type='checkbox' name ='email-blasts' />Be part of the electronic mailing list<em> (You'll receive emails whenever the site is updated or there is a special event.</em>)</p>");
    }
}

function displayOutputTextBlasts() {
    global $gUser;

    if(!empty($_POST['text'])) {
        echo("<p><input type='checkbox' name ='text-blasts' checked='checked' />Sign up for text blasts<em> (You'll receive text messages whenever the site is updated or there is a special event.  The text rates of your carrier will apply.</em>)</p>");
    } else {
        echo("<p><input type='checkbox' name ='text-blasts' />Sign up for text blasts<em> (You'll receive text messages whenever the site is updated or there is a special event.  The text rates of your carrier will apply.</em>)</p>");
    }
}

function sendConfirmationEmail() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $userName = isset($_POST['username']) ? $_POST['username'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";

    $subject = "Rock the Patch! - Account Info Edited";
    $body = "<h2 style='color:#e44d26;'>Rock The Patch! - Account Info Edited</h2>\r\n\r\n"
        ."\r\n"
        ."Your Rock the Patch! user account with exclusive access to downloads, special news, and videos has had its information changed."
        ." If you have not requested this, please email Patches at: <a href='$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>"
        ." Below is some information about the account modified:<br/><br/>\r\n"
        ."\r\n"
        ."<strong>User Name:</strong> $userName<br/><br/>\r\n\r\n"
        ."<strong>Email:</strong> $email<br/><br/>\r\n\r\n";

    $success = lib::sendMail($email, $subject, $body);
    if($success) {
        echo("<p><strong><em>EMAIL SUCCESS -- You have been emailed a confirmation that you have changed your account info. You can now use this to log in.</em></strong></p>");
    } else {
        echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to email your confirmation that you have changed your account info even though your information was valid.  Please try later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='$gMasterAdminEmail'>$gMasterAdminEmail</a>.</em></strong></p>");
    }
}

function updateUserInDb() {
    global $gUser;

    if($gUser != NULL) {
        $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : "";
        $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : "";
        $userName = isset($_POST['username']) ? $_POST['username'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";

        $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";
        if ($useOldPassword == "yes") {
            $passwordOut = $gUser->getPassword();
        } else {
            $passwordTemp = isset($_POST['new-password']) ? $_POST['new-password'] : "";
            $passwordOut = lib::encrypt($passwordTemp, $gUser->getId() . "_pass");
        }

        $securityQuestion = isset($_POST['security-question']) ? $_POST['security-question'] : "";
        $answer = isset($_POST['answer']) ? $_POST['answer'] : "";
        $cellPhone = isset($_POST['cell-phone']) ? $_POST['cell-phone'] : "";

        if (!empty($_POST['email-blasts'])) {
            $emailBlasts = 1;
        } else {
            $emailBlasts = 0;
        }

        if (!empty($_POST['text-blasts'])) {
            $textBlasts = 1;
        } else {
            $textBlasts = 0;
        }

        lib_database::updateUser($gUser->getId(), $firstName, $lastName, $userName, $email, $passwordOut, $securityQuestion, $answer, $emailBlasts, $textBlasts, $cellPhone);
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
    <title>Rock the Patch! v3 - Change Password</title>
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
                    if($gLoginStatus == STATUS_LOGGED_IN) {
                ?>
                    <!-- Script to display the current page in the navigation -->
                    <script type="text/javascript">
                        document.getElementById("account-info").className  = "current";
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Account Info</div>

        <h1>Account Info</h1>

        <h2>Edit Account Info</h2>

        <?php
            if($gLoginStatus == STATUS_LOGGED_IN) {
                $securityQuestion = NULL;
                if ($gUser != NULL) {
                    $securityQuestion = lib_database::getSecurityQuestionById($gUser->getSecurityQuestion());
                }

                if (!$gValidForm) {
        ?>
                    <p>Below is where you can see your account information and make edits.</p>

                    <form action='account-info-edit.php' name="account-info-edit" method='post'>
                    <hr/>
                    <p><em><strong>OLD Full Name: </strong>
                    <?php
                        if($gUser != NULL) {
                            echo($gUser->getLastName() . ", " . $gUser->getFirstName() . "</em></p>");
                        }  else {
                            echo("</em></p>");
                        }
                    ?>
                    <div class='label30'>
                        <p><strong>NEW First Name:</strong></p>
                    </div>
                    <div class='input70'>
                        <p><input type='text' name='first-name' value="<?php if(isset($_POST['first-name'])){ echo($_POST['first-name']);} else if($gUser != null) { echo($gUser->getFirstName()); } ?>"/>
                        </p>
                        <?php
                            if(isset($_POST['account-info-edit'])) {
                                displayOutputFirstName();
                            }
                        ?>
                    </div>
                    <div class='clear'></div>
                    <div class='label30'>
                        <p><strong>NEW Last Name:</strong></p>
                    </div>
                    <div class='input70'>
                        <p><input type='text' name='last-name' value="<?php if(isset($_POST['last-name'])){ echo($_POST['last-name']);} else if($gUser != null) { echo($gUser->getLastName()); } ?>"/>
                        </p>
                        <?php
                            if(isset($_POST['account-info-edit'])) {
                                displayOutputLastName();
                            }
                        ?>
                    </div>
                    <div class='clear'></div>

                    <hr/>
                    <p><em><strong>OLD User Name: </strong>
                    <?php
                        if($gUser != NULL) {
                            echo($gUser->getUserName() . "</em></p>");
                        }  else {
                            echo("</em></p>");
                        }
                    ?>
                    <div class='label30'>
                        <p><strong>NEW Requested User Name:</strong></p>
                    </div>
                    <div class='input70'>
                    <p><input type='text' name='username' value="<?php if(isset($_POST['username'])){ echo($_POST['username']); } else if($gUser != null) { echo($gUser->getUserName()); } ?>" /></p>
                    <?php
                        if(isset($_POST['account-info-edit'])) {
                            displayOutputUsername();
                        }
                    ?>
                    </div>
                    <div class='clear'></div>

                    <hr/>
                    <p id="old-email"><em><strong>OLD Email: </strong>
                        <?php
                            if($gUser != NULL) {
                                echo($gUser->getEmail() . "</em></p>");
                            } else {
                                echo("</em></p>");
                            }
                        ?>
                        <div class='label30'>
                            <p><strong>NEW User Email:</strong></p>
                        </div>
                        <div class='input70'>
                            <p><input type='text' name='email' value="<?php if(isset($_POST['email'])){ echo($_POST['email']); } else if($gUser != null) { echo($gUser->getEmail()); } ?>"/>
                            </p>
                            <?php
                                $email = isset($_POST['email']) ? $_POST['email'] : "";
                                if($gUser != NULL && strtolower($email.trim(" ", "")) != strtolower($gUser->getEmail().trim(" " , "")) && isset($_POST['account-info-edit'])) {
                                    displayOutputEmail();
                                }
                            ?>
                        </div>
                        <div class='clear'></div>
                        <div id="email-confirm">
                            <div class='label30'>
                                <p><strong>Confirm NEW User Email:</strong></p>
                            </div>
                            <div class='input70'>
                                <p><input type='text' name='email-confirm' value="<?php if(isset($_POST['email-confirm'])){ echo($_POST['email-confirm']); } ?>"/>
                                </p>
                                <?php
                                    $email = isset($_POST['email']) ? $_POST['email'] : "";
                                    if($gUser != NULL && strtolower($email.trim(" ", "")) != strtolower($gUser->getEmail().trim(" " , "")) && isset($_POST['account-info-edit'])) {
                                        displayOutputEmailConfirm();
                                    }
                                ?>
                            </div>
                        </div>
                        <div class='clear'></div>
                        <hr/>

                        <p><strong>Password: </strong></p>
                        <?php
                            $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";
                            if ($useOldPassword == "yes") {
                        ?>
                            <p>
                                <input type="radio" name="use-old-password" value="yes" checked="checked">Reuse old
                                password
                                <input type="radio" name="use-old-password" value="no">Set a new password
                            </p>
                        <?php
                            } else {
                        ?>
                            <p>
                                <input type="radio" name="use-old-password" value="yes">Reuse old password
                                <input type="radio" name="use-old-password" value="no" checked="checked">Set a new
                                password
                            </p>
                        <?php
                            }
                        ?>
                        <div id="set-new-password">
                            <div class='label30'>
                                <p><strong>Confirm OLD Password:</strong></p>
                            </div>
                            <div class='input70'>
                                <p><input type='password' name='old-password' value="<?php if(isset($_POST['old-password'])){ echo($_POST['old-password']); } ?>"/></p>
                                <?php
                                    $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";
                                    if($useOldPassword == "no" && isset($_POST['account-info-edit'])) {
                                        displayOutputOldPassword();
                                    }
                                ?>
                            </div>
                            <div class='clear'></div>
                            <div class='label30'>
                                <p><strong>NEW Password:</strong></p>
                            </div>
                            <div class='input70'>
                                <p><input type='password' name='new-password' value="<?php if(isset($_POST['new-password'])){ echo($_POST['new-password']); } ?>"/></p>
                                <?php
                                $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";
                                if ($useOldPassword == "no" && isset($_POST['account-info-edit'])) {
                                    displayOutputNewPassword();
                                }
                                ?>
                            </div>
                            <div class='clear'></div>
                            <div class='label30'>
                                <p><strong>Confirm NEW Password:</strong></p>
                            </div>
                            <div class='input70'>
                                <p><input type='password' name='new-password-confirm' value="<?php if(isset($_POST['new-password-confirm'])){ echo($_POST['new-password-confirm']); } ?>"/></p>
                                <?php
                                $useOldPassword = isset($_POST['use-old-password']) ? $_POST['use-old-password'] : "yes";
                                if ($useOldPassword == "no" && isset($_POST['account-info-edit'])) {
                                    displayOutputNewPasswordConfirm();
                                }
                                ?>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <hr/>

                        <p><em><strong>OLD Cell Phone: </strong>
                        <?php
                            if ($gUser != NULL) {
                                echo($gUser->getCell() . "</em></p>");
                            } else {
                                echo("</em></p>");
                            }
                        ?>
                        <div class='label30'>
                            <p><strong>NEW Cell Phone Number:</strong><br/>(<em>format: xxx-xxx-xxxx</em>)</p>
                        </div>
                        <div class='input70'>
                            <p><input type='text' id="cell-phone" name='cell-phone' value="<?php if(isset($_POST['cell-phone'])){ echo($_POST['cell-phone']); } else if($gUser != null) { echo($gUser->getCell()); } ?>" maxlength='12'/></p>
                            <?php
                                if(isset($_POST['account-info-edit'])) {
                                    displayOutputCellPhone();
                                }
                            ?>
                        </div>
                        <div class='clear'></div>
                        <hr/>

                        <p><em><strong>OLD Security Question: </strong>
                        <?php
                            if($securityQuestion != null) {
                                echo($securityQuestion->getQuestion() . "</em></p>");
                            } else {
                                echo("</em></p>");
                            }
                        ?>
                        <div class='label30'>
                        <p><strong>NEW Security Question:</strong></p>
                        </div>
                        <div class='input70'>
                            <!-- HACK - wanted to print this out in dbQuestionsPrintSelect but options weren't populated before sent to the validation service -->
                            <select name="security-question">
                                <!-- A static option needed for the validation of the security question -->
                                <option><?php echo(SELECT_SECURITY_QUESTION); ?></option>
                                <?php
                                    $securityQuestions = lib_database::getSecurityQuestions();
                                    $randomizedSecurityQuestions = lib::randomizeArray($securityQuestions, 10);
                                    $selectedQuestion = "";
                                    if(isset($_POST['security-question'])) {
                                        $selectedQuestion = $_POST['security-question'];
                                    } else if ($gUser != NULL) {
                                        $selectedQuestion = $gUser->getSecurityQuestion();
                                    }
                                    lib::printSecurityQuestions($randomizedSecurityQuestions, $selectedQuestion);
                                ?>
                            </select>
                            <?php
                                if(isset($_POST['account-info-edit'])) {
                                    displayOutputSecurityQuestion();
                                }
                            ?>
                        </div>
                        <div class='clear'></div>

                        <div class='label30'>
                            <p><strong>Security Question Answer:</strong></p>
                        </div>
                        <div class='input70'>
                            <p><input type='text' name='answer' value="<?php if(isset($_POST['answer'])){ echo($_POST['answer']); } else if($gUser != null) { echo($gUser->getSecurityQuestionAnswer()); } ?>"/></p>
                            <?php
                                if (isset($_POST['account-info-edit'])) {
                                    displayOutputAnswer();
                                }
                            ?>
                        </div>
                        <div id="answer-confirm">
                            <div class='label30'>
                                <p><strong>Confirm Answer:</strong></p>
                            </div>
                            <div class='input70'>
                                <p><input type='text' name='answer-confirm' value="<?php if (isset($_POST['answer-confirm'])) { echo($_POST['answer-confirm']); } ?>"/></p>
                                <?php
                                    $answer = isset($_POST['answer']) ? $_POST['answer'] : "";
                                    if($gUser != NULL && strtolower($answer.trim(" ", "")) != strtolower($gUser->getSecurityQuestionAnswer().trim(" " , "")) && isset($_POST['account-info-edit'])) {
                                        displayOutputAnswerConfirm();
                                    }
                                ?>
                            </div>
                    </div>
                    <div class='clear'></div>
                    <hr/>

                    <p>
                        <em><strong>Part of Mailing List?: </strong>
                        <?php
                            if($gUser != NULL && $gUser->getEmailBlasts() == TRUE) {
                                echo("Yes");
                            } else {
                                echo("No");
                            }
                        ?>
                        </em>
                    </p>
                    <?php
                        displayOutputEmailBlasts();
                    ?>
                    <hr/>

                    <p>
                        <em><strong>Signed up for text blasts?: </strong>
                        <?php
                            if($gUser != NULL && $gUser->getTextBlasts() == TRUE) {
                                echo("Yes");
                            } else {
                                echo("No");
                            }
                            ?>
                        </em>
                    </p>
                    <?php
                        displayOutputTextBlasts();
                    ?>
                    <hr/>

                    <p><input type='submit' name="account-info-edit" value='Update Account Info' class="button"/></p>
                    <br/>
                </form>

                <div id='progress'>
                    <div class='progress-section3'>
                        <div class='finished-bar'>&nbsp;</div>
                        <p>Step 1: Account Info</p>
                    </div>
                    <div class='progress-section3'>
                        <div class='inprogress-bar'>&nbsp;</div>
                        <p>Step 2: Edit Account Info</p>
                    </div>
                    <div class='progress-section3'>
                        <div class='unfinished-bar'>&nbsp;</div>
                        <p>Step 3: Confirmation</p>
                    </div>
                </div>
                <div id='clear'></div>
                <?php
                    } else {
                        sendConfirmationEmail();
                        updateUserInDb();
                ?>
                    <div id='progress'>
                        <div class='progress-section3'>
                            <div class='finished-bar'>&nbsp;</div>
                            <p>Step 1: Account Info</p>
                        </div>
                        <div class='progress-section3'>
                            <div class='finished-bar'>&nbsp;</div>
                            <p>Step 2: Edit Account Info</p>
                        </div>
                        <div class='progress-section3'>
                            <div class='inprogress-bar'>&nbsp;</div>
                            <p>Step 3: Confirmation</p>
                        </div>
                    </div>
                    <div id='clear'></div>
        <?php
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