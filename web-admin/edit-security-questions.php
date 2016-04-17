<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if(isset($_POST['add-security-question'])) {
    $validForm = checkInputAddSecurityQuestion();
    if($validForm) {
        $addQuestion = isset($_POST['add-question']) ? $_POST['add-question'] : "";
        lib_database::writeSecurityQuestion($addQuestion);
    }
}

if(isset($_POST['delete-security-question'])) {
    $validForm = checkInputDeleteSecurityQuestion();
    if($validForm) {
        $deleteQuestion = isset($_POST['delete-question']) ? $_POST['delete-question'] : "";
        lib_database::deleteSecurityQuestion($deleteQuestion);
    }
}

if(isset($_POST['edit-security-question'])) {
    $validForm = checkInputEditSecurityQuestion();
    if($validForm) {
        $questionToUpdate = isset($_POST['edit-question-select']) ? $_POST['edit-question-select'] : "";
        $editQuestion = isset($_POST['edit-question']) ? $_POST['edit-question'] : "";
        lib_database::updateSecurityQuestion($questionToUpdate, $editQuestion);
    }
}

$securityQuestions = lib_database::getSecurityQuestions();

function checkInputAddSecurityQuestion() {
    global $gNoAddQuestion, $gBlackAddQuestion, $gInUseAddQuestion;

    $validForm = TRUE;

    $addQuestion = isset($_POST['add-question']) ? $_POST['add-question'] : "";

    $gNoAddQuestion = lib_check::isEmpty($addQuestion);
    if($gNoAddQuestion) {
        $validForm = FALSE;
    }

    $gBlackAddQuestion = lib_check::againstWhiteList($addQuestion);
    if($gBlackAddQuestion) {
        $validForm = FALSE;
    }

    $securityQuestions = lib_database::getSecurityQuestions();
    foreach($securityQuestions as $securityQuestion) {
        if(strtolower(str_replace(" ", "", $securityQuestion->getQuestion())) == strtolower(str_replace(" ", "", $addQuestion))) {
            $gInUseAddQuestion = TRUE;
            $validForm = FALSE;
            break;
        }
    }

    return $validForm;
}

function checkInputDeleteSecurityQuestion() {
    global $gDefaultDeleteQuestion, $gSecurityQuestionInUse;

    $validForm = TRUE;

    $deleteQuestion = isset($_POST['delete-question']) ? $_POST['delete-question'] : "";

    if($deleteQuestion == SELECT_SECURITY_QUESTION_TO_DELETE) {
        $gDefaultDeleteQuestion = TRUE;
        $validForm = FALSE;
    }

    $gSecurityQuestionInUse = lib_check::securityQuestionInUse($deleteQuestion);
    if($gSecurityQuestionInUse) {
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputEditSecurityQuestion() {
    global $gNoEditQuestion, $gBlackEditQuestion, $gDefaultEditQuestion;

    $validForm = TRUE;

    $editQuestion = isset($_POST['edit-question']) ? $_POST['edit-question'] : "";
    $editQuestionSelect = isset($_POST['edit-question-select']) ? $_POST['edit-question-select'] : "";

    $gNoEditQuestion = lib_check::isEmpty($editQuestion);
    if($gNoEditQuestion) {
        $validForm = FALSE;
    }

    $gBlackEditQuestion = lib_check::againstWhiteList($editQuestion);
    if($gBlackEditQuestion) {
        $validForm = FALSE;
    }

    if($editQuestionSelect == SELECT_SECURITY_QUESTION_TO_EDIT) {
        $gDefaultEditQuestion = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputAddQuestion() {
    global $gNoAddQuestion, $gBlackAddQuestion, $gInUseAddQuestion;

    if($gNoAddQuestion) {
        echo("<p class='error'>Please enter in a question.</p>");
    } else if($gBlackAddQuestion) {
        echo("<p class='error'>Question entered contains characters that are not allowed.</p>");
    } else if($gInUseAddQuestion) {
        echo("<p class='error'>Security question already exists.</p>");
    }
}

function displayOutputEditQuestion() {
    global $gNoEditQuestion, $gBlackEditQuestion;

    if($gNoEditQuestion) {
        echo("<p class='error'>Please enter in a question.</p>");
    } else if($gBlackEditQuestion) {
        echo("<p class='error'>Security question entered contains characters that are not allowed.</p>");
    }
}

function displayOutputEditQuestionSelect() {
    global $gDefaultEditQuestion;

    if($gDefaultEditQuestion) {
        echo("<p class='error'>Please select a security question to edit.</p>");
    }
}

function displayOutputDeleteQuestion() {
    global $gDefaultDeleteQuestion, $gSecurityQuestionInUse;

    if($gDefaultDeleteQuestion) {
        echo("<p class='error'>Please select a security question to delete.</p>");
    } else if ($gSecurityQuestionInUse) {
        echo("<p class='error'>You may not delete a security question that is in use.</p>");
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
    <title>Rock the Patch! v3 - Edit Security Questions</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Edit Security Questions</div>
        <h1>Edit Security Questions</h1>

        <?php
        if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
            if(lib_check::userIsAdmin()) {
                ?>
                <!-- START Form -->
                <form method="post" name="manage-security-questions" action="edit-security-questions.php">
                    <!-- START Add, Edit, or Delete -->
                    <hr/>
                    <div class='radio-button-holder'>
                        <?php
                            $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                            if($addEditOrDelete == "Add") {
                                ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" checked="checked" />Add Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Security Question</p>
                                <?php
                            } else if($addEditOrDelete == "Edit") {
                                ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" />Add Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" checked="checked" />Edit Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Security Question</p>
                                <?php
                            } else {
                                ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add"  />Add Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Security Question</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" checked="checked" />Delete Security Question</p>
                                <?php
                            }
                        ?>
                    </div>
                    <hr/>
                    <!-- END Add, Edit, or Delete -->

                    <!-- START Add portion of form -->
                    <?php
                        $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                        if($addEditOrDelete == "Add") {
                    ?>
                        <div id="add-security-question-container">
                    <?php
                        } else {
                    ?>
                        <div id="add-security-question-container" style="display:none;">
                    <?php
                        }
                    ?>
                        <h2>Add New Security Question</h2>

                        <!-- START Question -->
                        <div class='feature-request-category-label'>
                            <p><strong>Question: </strong></p>
                        </div>
                        <div class='feature-request-category-input'>
                            <p><input type='text' name='add-question' value="<?php if(isset($_POST['add-question'])){ echo($_POST['add-question']); } ?>"/></p>
                            <?php
                                if(!$validForm && isset($_POST['add-security-question'])) {
                                    displayOutputAddQuestion();
                                }
                            ?>
                        </div>
                        <div class='clear'></div>
                        <!-- END Question -->


                        <p><input type="submit" name="add-security-question" value="Add Security Question" class="button" /></p>
                    </div>
                    <!-- END Add portion of form -->

                    <!-- START Edit portion of form -->
                    <?php
                        $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                        if($addEditOrDelete == "Edit"){
                    ?>
                        <div id="edit-security-question-container">
                    <?php
                        } else {
                    ?>
                        <div id="edit-security-question-container" style="display:none;">
                    <?php
                        }
                    ?>
                        <h2>Edit Existing Security Question</h2>

                    <?php
                        $editSecurityQuestion = isset($_POST['edit-question-select']) ? $_POST['edit-question-select'] : "";
                        echo("<p class='security-question-category'>");
                        echo("<select name='edit-question-select' style='width:100%;'>");
                            if($editCategory == "") {
                                echo("<option value='" . SELECT_SECURITY_QUESTION_TO_EDIT . "' selected='selected'>" . SELECT_SECURITY_QUESTION_TO_EDIT . "</option>");
                            } else {
                                echo("<option value='" . SELECT_SECURITY_QUESTION_TO_EDIT . "'>" . SELECT_SECURITY_QUESTION_TO_EDIT . "</option>");
                            }
                            foreach($securityQuestions as $securityQuestion) {
                                if($securityQuestion->getId() == $editSecurityQuestion) {
                                    echo("<option value='" . $securityQuestion->getId() . "' selected='selected'>" . $securityQuestion->getQuestion() . "</option>");
                                } else {
                                    echo("<option value='" . $securityQuestion->getId() . "'>" . $securityQuestion->getQuestion() . "</option>");
                                }
                            }
                            echo("</select>");
                            echo("</p>");

                            if(!$validForm && isset($_POST['edit-security-question'])) {
                                displayOutputEditQuestionSelect();
                            }
                        ?>


                        <!-- START Category -->
                        <div class='feature-request-category-label'>
                            <p><strong>Question: </strong></p>
                            </div>
                            <div class='feature-request-category-input'>
                                <p><input type='text' name='edit-question' value="<?php if(isset($_POST['edit-question'])){ echo($_POST['edit-question']); } ?>"/></p>
                                <?php
                                    if(!$validForm && isset($_POST['edit-security-question'])) {
                                        displayOutputEditQuestion();
                                    }
                                ?>
                            </div>
                            <div class='clear'></div>
                            <!-- END Category -->

                            <p><input type="submit" name="edit-security-question" value="Update Security Question" class="button" /></p>
                        </div>
                        <!-- END Edit portion of form -->

                        <!-- START Delete portion of form -->
                        <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Delete") {
                        ?>
                            <div id="delete-security-question-container">
                        <?php
                            } else{
                        ?>
                            <div id="delete-security-question-container" style="display:none;">
                        <?php
                            }
                        ?>
                            <h2>Delete Existing Security Question</h2>

                        <?php
                            $deleteQuestion = isset($_POST['delete-question']) ? $_POST['delete-question'] : "";
                            echo("<p class='feature-request-category'>");
                            echo("<select name='delete-question' style='width:100%;'>");
                            if($deleteQuestion == "") {
                                echo("<option value='" . SELECT_SECURITY_QUESTION_TO_DELETE . "' selected='selected'>" . SELECT_SECURITY_QUESTION_TO_DELETE . "</option>");
                            } else {
                                echo("<option value='" . SELECT_SECURITY_QUESTION_TO_DELETE . "'>" . SELECT_SECURITY_QUESTION_TO_DELETE . "</option>");
                            }
                            foreach($securityQuestions as $securityQuestion) {
                                if($securityQuestion->getId() == $deleteQuestion) {
                                    echo("<option value='" . $securityQuestion->getId() . "' selected='selected'>" . $securityQuestion->getQuestion() . "</option>");
                                } else {
                                    echo("<option value='" . $securityQuestion->getId() . "'>" . $securityQuestion->getQuestion() . "</option>");
                                }
                            }
                            echo("</select>");
                            echo("</p>");

                            if(!$validForm && isset($_POST['delete-security-question'])) {
                                displayOutputDeleteQuestion();
                            }
                        ?>

                        <p><input type="submit" name="delete-security-question" value="Delete Security Question" class="button" /></p>
                    </div>
                    <!-- END Delete portion of form -->
                </form>
                <!-- END Form -->
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