<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

global $gValidForm;
$gValidForm = FALSE;

if(isset($_POST['register'])) {
    $gValidForm = checkInput();
}

function checkInput() {
    global $gNoFirstName, $gNoLastName, $gNoUserName, $gNoEmail, $gNoEmailConfirm, $gNoPassword, $gNoPasswordConfirm, $gNoCellPhone, $gNoSecurityQuestion, $gNoAnswer;
    global $gBlackFirstName, $gBlackLastName, $gBlackUserName, $gBlackEmail, $gBlackEmailConfirm, $gBlackPassword, $gBlackPasswordConfirm, $gBlackCellPhone, $gBlackAnswer;
    global $gFirstNameTooLong, $gLastNameTooLong, $gUserNameTooLong;
    global $gEmailInUse, $gUserNameInUse;
    global $gEmailInRegistration, $gUserNameInRegistration;
    global $gValidEmail, $gValidPassword, $gValidCellPhone;
    global $gEmailsMatch, $gPasswordsMatch;

    $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : "";
    $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : "";
    $userName = isset($_POST['user-name']) ? $_POST['user-name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $emailConfirm = isset($_POST['email-confirm']) ? $_POST['email-confirm'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $passwordConfirm = isset($_POST['password-confirm']) ? $_POST['password-confirm'] : "";
    $cellPhone = isset($_POST['cell-phone']) ? $_POST['cell-phone'] : "";
    $securityQuestion = isset($_POST['security-question']) ? $_POST['security-question'] : "";
    $answer = isset($_POST['answer']) ? $_POST['answer'] : "";

    log_util::log(LOG_LEVEL_DEBUG, "firstName: " . $firstName);
    log_util::log(LOG_LEVEL_DEBUG, "lastName: " . $lastName);
    log_util::log(LOG_LEVEL_DEBUG, "userName: " . $userName);
    log_util::log(LOG_LEVEL_DEBUG, "email: " . $email);
    log_util::log(LOG_LEVEL_DEBUG, "emailConfirm: " . $emailConfirm);
    log_util::log(LOG_LEVEL_DEBUG, "password: " . $password);
    log_util::log(LOG_LEVEL_DEBUG, "passwordConfirm: " . $passwordConfirm);
    log_util::log(LOG_LEVEL_DEBUG, "cellPhone: " . $cellPhone);
    log_util::log(LOG_LEVEL_DEBUG, "securityQuestion: " . $securityQuestion);
    log_util::log(LOG_LEVEL_DEBUG, "answer: " . $answer);

    $validForm = TRUE;

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

    $gNoEmailConfirm = lib_check::isEmpty($emailConfirm);
    if($gNoEmailConfirm) {
        $validForm = FALSE;
    }

    $gNoPassword = lib_check::isEmpty($password);
    if($gNoPassword) {
        $validForm = FALSE;
    }

    $gNoPasswordConfirm = lib_check::isEmpty($passwordConfirm);
    if($gNoPasswordConfirm) {
        $validForm = FALSE;
    }

    $gNoAnswer = lib_check::isEmpty($answer);
    if($gNoAnswer) {
        $validForm = FALSE;
    }

    $gNoCellPhone  = lib_check::isEmpty($cellPhone);
    if($gNoCellPhone) {
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

    $gBlackEmailConfirm  = lib_check::againstWhiteList($emailConfirm);
    if($gBlackEmailConfirm) {
        $validForm = FALSE;
    }

    $gBlackPassword  = lib_check::againstWhiteList($password);
    if($gBlackPassword) {
        $validForm = FALSE;
    }

    $gBlackPasswordConfirm  = lib_check::againstWhiteList($passwordConfirm);
    if($gBlackPasswordConfirm) {
        $validForm = FALSE;
    }

    $gBlackAnswer  = lib_check::againstWhiteList($answer);
    if($gBlackAnswer) {
        $validForm = FALSE;
    }

    $gBlackCellPhone  = lib_check::againstWhiteList($cellPhone);
    if($gBlackCellPhone) {
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

    $gEmailInUse = lib_check::userInDb(NULL, $email, NULL, NULL, FALSE);
    if($gEmailInUse) {
        $validForm = FALSE;
    }

    $gUserNameInUse = lib_check::userInDb(NULL, NULL, $userName, NULL, FALSE);
    if($gUserNameInUse) {
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

    $gEmailsMatch = lib_check::same($email, $emailConfirm);
    if(!$gEmailsMatch ) {
        $validForm = FALSE;
    }

    $gPasswordsMatch = lib_check::same($password, $passwordConfirm);
    if(!$gPasswordsMatch) {
        $validForm = FALSE;
    }

    $gValidCellPhone = lib_check::validPhone($cellPhone);
    if(!$gValidCellPhone) {
        $validForm = FALSE;
    }

    $gValidPassword = lib_check::validPassword($password);
    if(!$gValidPassword) {
        $validForm = FALSE;
    }

    if($securityQuestion == SELECT_SECURITY_QUESTION) {
        $gNoSecurityQuestion = TRUE;
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

    if($gNoLastName) {
        echo("<p class='error'>Please enter in a last name to continue.</p>");
    } else if($gBlackLastName) {
        echo("<p class='error'>Last name contained characters that are not allowed.</p>");
    } else if($gLastNameTooLong) {
        echo("<p class='error'>Your last name may not have more than 40 chars.</p>");
    }
}

function displayOutputUserName() {
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

function displayOutputEmailConfirm(){
    global $gNoEmailConfirm, $gBlackEmailConfirm;

    if($gNoEmailConfirm) {
        echo("<p class='error'>Please confrim your email to continue.</p>");
    } else if($gBlackEmailConfirm) {
        echo("<p class='error'>User Email confirmation contained characters that are not allowed.</p>");
    }
}

function displayOutputPassword() {
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

function displayOutputPasswordConfirm() {
    global $gNoPasswordConfirm, $gBlackPasswordConfirm;

    if($gNoPasswordConfirm) {
        echo("<p class='error'>Please confirm your password to continue.</p>");
    } else if($gBlackPasswordConfirm) {
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

function displayOutputSecurityQuestion(){
    global $gNoSecurityQuestion;

    if($gNoSecurityQuestion) {
        echo("<p class='error'>Please choose a security question.</p>");
    }
}

function displayOutputAnswer() {
    global $gNoAnswer, $gBlackAnswer;

    if($gNoAnswer) {
        echo("<p class='error'>Please enter in an answer to the security question to continue.</p>");
    } else if($gBlackAnswer) {
        echo("<p class='error'>Answer to security question contained characters that are not allowed.</p>");
    }
}

function displayOutputEmailBlast() {
    if(!empty($_POST['email-blasts'])) {
        echo("<p><input type='checkbox' name ='email-blasts' checked='checked' />Be part of the electronic mailing list<em> (You'll receive emails whenever the site is updated or there is a special event.</em>)</p>");
    } else {
        echo("<p><input type='checkbox' name ='email-blasts' />Be part of the electronic mailing list<em> (You'll receive emails whenever the site is updated or there is a special event.</em>)</p>");
    }
}

function displayOutputTextBlast() {
    if(!empty($_POST['text-blasts'])) {
        echo("<p><input type='checkbox' name ='text-blasts' checked='checked' />Sign up for text blasts<em> (You'll recieve text messages whenever the site is updated or there is a special event.  The text rates of your carrier will apply.</em>)</p>");
    } else {
        echo("<p><input type='checkbox' name ='text-blasts' />Sign up for text blasts<em> (You'll recieve text messages whenever the site is updated or there is a special event.  The text rates of your carrier will apply.</em>)</p>");
    }
}

function register() {
    $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : "";
    $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : "";
    $userName = isset($_POST['user-name']) ? $_POST['user-name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $cellPhone = isset($_POST['cell-phone']) ? $_POST['cell-phone'] : "";
    $securityQuestion = isset($_POST['security-question']) ? $_POST['security-question'] : "";
    $answer = isset($_POST['answer']) ? $_POST['answer'] : "";

    if(!empty($_POST['email-blasts'])) {
        $emailBlasts = 1;
    } else {
        $emailBlasts = 0;
    }

    if(!empty($_POST['text-blasts'])) {
        $textBlasts = 1;
    } else {
        $textBlasts = 0;
    }

    $role = ROLE_USER;

    lib_database::writeUsersTemp($firstName, $lastName, $userName, $email, $password, $securityQuestion, $answer, $emailBlasts, $textBlasts, $cellPhone, $role);
}

function sendRegistrationEmail() {
    global $gMasterAdminEmail, $gMasterAdminName;

    $firstName = isset($_POST['first-name']) ? $_POST['first-name'] : "";
    $lastName = isset($_POST['last-name']) ? $_POST['last-name'] : "";
    $userName = isset($_POST['user-name']) ? $_POST['user-name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $cellPhone = isset($_POST['cell-phone']) ? $_POST['cell-phone'] : "";

    if(!empty($_POST['email-blasts'])) {
        $emailBlasts = "Yes";
    } else {
        $emailBlasts = "No";
    }

    if(!empty($_POST['text-blasts'])) {
        $textBlasts = "Yes";
    } else {
        $textBlasts = "No";
    }

    $registrationUrl= lib::generateRegistrationURL($email, $userName, $firstName, $lastName);

    $subject = "Rock the Patch! - New User Registration";
    $body = "<h2 style='color:#e44d26;'>Rock the Patch! - New User Registration</h2>\r\n\r\n"
        ."\r\n"
        ."This email has been used to register a Rock the Patch! user account with exclusive access to downloads, special news, videos, and more."
        ." Below is the information sent during registration:<br/><br/>\r\n"
        ."\r\n"
        ."<strong>First Name:</strong> $firstName<br/><br/>\r\n\r\n"
        ."<strong>Last Name:</strong> $lastName<br/><br/>\r\n\r\n"
        ."<strong>User Name:</strong> $userName<br/><br/>\r\n\r\n"
        ."<strong>Email:</strong> $email<br/><br/>\r\n\r\n"
        //."<strong>Answer to Security Question:</strong> $answerOut<br/><br/>\r\n\r\n"
        ."<strong>Cell #:</strong> $cellPhone <br/><br/>\r\n\r\n"
        ."<strong>Signed up for email blasts:</strong> $emailBlasts <br/><br/>\r\n\r\n"
        ."<strong>Signed up for text blasts:</strong> $textBlasts <br/><br/>\r\n\r\n"
        ." Before the account can be used to log in, this email needs to be confirmed.  Please click on the link below to do this: \r\n\r\n"
        ."<br/>\r\n\r\n"
        .$registrationUrl
        ."<br/><br/>\r\n\r\n";

    $success = lib::sendMail($email, $subject, $body);

    if($success) {
        echo("<p><strong><em>EMAIL SUCCESS -- Yay! A registration link was sent to the provided email.</em></strong></p>");
    } else {
        echo("<p><strong><em>EMAIL FAILURE -- Bummer, registration link <font class='error'>was not</font> sent although the provided information was valid.  Please try again later or contact $gMasterAdminName at: <a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>$gMasterAdminEmail</a>.</em></strong></p>");
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
    <title>Rock the Patch! v3 - Register</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / Register</div>

        <h1>Register</h1>

        <?php
            if(!$gValidForm) {
        ?>
                <p>Great!  You want to register to be a 'Rock the Patch!' user!  This will give you access to
                some pages that other people won't get to see and exclusive bonus content.  I just need a little
                information from you.  Please fill out the form below.</p>

            <!-- ### Start Register Form ### -->
            <form action="register.php" method="post" name="registration-form">

                <div class="label30">
                    <p><strong>First Name:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="first-name" value="<?php if(isset($_POST['first-name'])){ echo($_POST['first-name']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputFirstName();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Last Name:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="last-name" value="<?php if(isset($_POST['last-name'])){ echo($_POST['last-name']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputLastName();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Requested User Name:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="user-name" value="<?php if(isset($_POST['user-name'])){ echo($_POST['user-name']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputUserName();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>User Email:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="email" value="<?php if(isset($_POST['email'])){ echo($_POST['email']); } ?>"/></p>

                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputEmail();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Confirm User Email:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="email-confirm" value="<?php if(isset($_POST['email-confirm'])){ echo($_POST['email-confirm']); }?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputEmailConfirm();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Password:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="password" name="password" value="<?php if(isset($_POST['password'])){ echo($_POST['password']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputPassword();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Confirm Password:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="password" name="password-confirm" value="<?php if(isset($_POST['password-confirm'])){ echo($_POST['password-confirm']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputPasswordConfirm();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Cell Phone Number:</strong><br/> (<em>format: xxx-xxx-xxxx</em>)</p>
                </div>
                <div class="input70">
                    <p><input type="text" id="cell-phone" name="cell-phone" value="<?php if(isset($_POST['cell-phone'])){ echo($_POST['cell-phone']); } ?>" maxlength='12'/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputCellPhone();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Security Question:</strong></p>
                </div>
                <div class="input70">
                    <!-- HACK - wanted to print this out in dbQuestionsPrintSelect but options weren't populated before sent to the validation service -->
                    <select name="security-question">
                         <!-- A static option needed for the validation of the security question -->
                        <option><?php echo(SELECT_SECURITY_QUESTION); ?></option>
                        <?php
                            $securityQuestions = lib_database::getSecurityQuestions();
                            $randomizedSecurityQuestions = lib::randomizeArray($securityQuestions, 10);
                            $selectedQuestion = isset($_POST['security-question']) ? $_POST['security-question'] : "";
                            lib::printSecurityQuestions($randomizedSecurityQuestions, $selectedQuestion);
                        ?>
                    </select>
                    <?php
                        displayOutputSecurityQuestion();
                    ?>
                </div>
                <div class="clear"></div>

                <div class="label30">
                    <p><strong>Security Question Answer:</strong></p>
                </div>
                <div class="input70">
                    <p><input type="text" name="answer" value="<?php if(isset($_POST['answer'])){ echo($_POST['answer']); } ?>"/></p>
                    <?php
                        if(isset($_POST['register'])) {
                            displayOutputAnswer();
                        }
                    ?>
                </div>
                <div class="clear"></div>

                <?php
                    displayOutputEmailBlast();
                ?>

                <?php
                    displayOutputTextBlast();
                ?>

                <p><input type="submit" name="register" value="Register" class="button" /></p>
            </form>
            <br/>
            <!-- ### End Register Form ### -->

            <div id="progress">
                <div class="progress-section2">
                    <div class="inprogress-bar">&nbsp;</div>
                    <p>Step 1: Account Info</p>
                </div>
                <div class="progress-section2">
                    <div class="unfinished-bar">&nbsp;</div>
                    <p>Step 2: Confirmation</p>
                </div>
            </div>
            <div id="clear"></div>
        <?php
            } else{
        ?>
            <h2>Congratulations on becoming a 'Rock The Patch!' User</h2>
            <p>The form you have submitted was valid. Before you can log in as a 'Rock the Patch!' user
                though, you will need to verify the email address provided. An email has been sent to that
                address with a link to confirm and register the provided email. Once you click the
                confirmation link, you will be able to log in and have access to exclusive content
                including downloads, music videos, and special news updates.</p>
            <?php
                register();
                sendRegistrationEmail();
            ?>
            <br/>

            <div id="progress">
                <div class="progress-section2">
                    <div class="finished-bar">&nbsp;</div>
                    <p>Step 1: Account Info</p>
                </div>
                <div class="progress-section2">
                    <div class="inprogress-bar">&nbsp;</div>
                    <p>Step 2: Confirmation</p>
                </div>
            </div>
            <div id="clear"></div>
        <?php
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