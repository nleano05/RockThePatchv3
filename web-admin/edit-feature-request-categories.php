<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if(isset($_POST['add-feature-request-category'])) {
    $validForm = checkInputAddFeatureRequestCategory();
    if($validForm) {
        $addCategory = isset($_POST['add-category']) ? $_POST['add-category'] : "";
        $addEmailDistro = isset($_POST['add-email-distro']) ? $_POST['add-email-distro'] : "";
        $addDefault = isset($_POST['add-default']) ? $_POST['add-default'] : "";
        lib_database::writeFeatureRequestCategory($addCategory, $addEmailDistro, $addDefault);
    }
}

if(isset($_POST['delete-feature-request-category'])) {
    $validForm = checkInputDeleteFeatureRequestCategory();
    if($validForm) {
        $deleteCategory = isset($_POST['delete-category']) ? $_POST['delete-category'] : "";
        lib_database::deleteFeatureRequestCategory($deleteCategory);
    }
}

if(isset($_POST['edit-feature-request-category']))
{
    $validForm = checkInputEditFeatureRequestCategory();
    if($validForm)
    {
        $categoryToUpdate = isset($_POST['edit-category-select']) ? $_POST['edit-category-select'] : "";
        $editCategory = isset($_POST['edit-category']) ? $_POST['edit-category'] : "";
        $editEmailDistro = isset($_POST['edit-email-distro']) ? $_POST['edit-email-distro'] : "";
        $editDefault = isset($_POST['edit-default']) ? $_POST['edit-default'] : "";
        lib_database::updateFeatureRequestCategory($categoryToUpdate, $editCategory, $editEmailDistro, $editDefault);
    }
}

$emailDistros = lib_database::getEmailDistros();
$featureRequestCategories = lib_database::getFeatureRequestCategories();

function checkInputAddFeatureRequestCategory() {
    global $gNoAddCategory, $gBlackAddCategory, $gInUseAddCategory, $gDefaultAddCategory;

    $validForm = TRUE;

    $addCategory = isset($_POST['add-category']) ? $_POST['add-category'] : "";
    $addEmailDistro = isset($_POST['add-email-distro']) ? $_POST['add-email-distro'] : "";

    $gNoAddCategory = lib_check::isEmpty($addCategory);
    if($gNoAddCategory) {
        $validForm = FALSE;
    }

    $gBlackAddCategory = lib_check::againstWhiteList($addCategory);
    if($gBlackAddCategory) {
        $validForm = FALSE;
    }

    if($addEmailDistro == SELECT_EMAIL_DISTRO) {
        $gDefaultAddCategory = TRUE;
        $validForm = FALSE;
    }

    $featureRequestCategories = lib_database::getFeatureRequestCategories();
    foreach($featureRequestCategories as $featureRequestCategory) {
        if(strtolower(str_replace(" ", "", $featureRequestCategory->getName())) == strtolower(str_replace(" ", "", $addCategory))) {
            $gInUseAddCategory = TRUE;
            $validForm = FALSE;
            break;
        }
    }

    return $validForm;
}

function checkInputDeleteFeatureRequestCategory() {
    global $gDefaultDeleteCategory;

    $validForm = TRUE;

    $deleteCategory = isset($_POST['delete-category']) ? $_POST['delete-category'] : "";

    if($deleteCategory == SELECT_A_FEATURE_REQUEST_CATEGORY_TO_DELETE) {
        $gDefaultDeleteCategory = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputEditFeatureRequestCategory() {
    global $gNoEditCategory, $gBlackEditCategory, $gDefaultEditEmailDistro;

    $validForm = TRUE;

    $editCategory = isset($_POST['edit-category']) ? $_POST['edit-category'] : "";
    $editEmailDistro = isset($_POST['edit-email-distro']) ? $_POST['edit-email-distro'] : "";

    $gNoEditCategory = lib_check::isEmpty($editCategory);
    if($gNoEditCategory) {
        $validForm = FALSE;
    }

    $gBlackEditCategory = lib_check::againstWhiteList($editCategory);
    if($gBlackEditCategory) {
        $validForm = FALSE;
    }

    if($editEmailDistro == SELECT_EMAIL_DISTRO) {
        $gDefaultEditEmailDistro = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputAddCategory() {
    global $gNoAddCategory, $gBlackAddCategory, $gInUseAddCategory;

    if($gNoAddCategory) {
        echo("<p class='error'>Please enter in a category.</p>");
    } else if($gBlackAddCategory) {
        echo("<p class='error'>Category entered contains characters that are not allowed.</p>");
    } else if($gInUseAddCategory) {
        echo("<p class='error'>Feature request category already exists.</p>");
    }
}

function displayOutputAddEmailDistro() {
    global $gDefaultAddEmailDistro;

    if($gDefaultAddEmailDistro) {
        echo("<p class='error'>Please select an email distro.</p>");
    }
}

function displayOutputDeleteCategory() {
    global $gDefaultDeleteCategory;

    if($gDefaultDeleteCategory) {
        echo("<p class='error'>Please select a category to delete.</p>");
    }
}

function displayOutputEditCategory() {
    global $gNoEditCategory, $gBlackEditCategory;

    if($gNoEditCategory) {
        echo("<p class='error'>Please enter in a category.</p>");
    } else if($gBlackEditCategory) {
        echo("<p class='error'>Category entered contains characters that are not allowed.</p>");
    }
}

function displayOutputEditEmailDistro() {
    global $gDefaultEditEmailDistro;

    if($gDefaultEditEmailDistro) {
        echo("<p class='error'>Please select an email distro.</p>");
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
    <title>Rock the Patch! v3 - Edit Feature Request Categories</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Edit Feature Request Categories</div>
        <h1>Edit Feature Request Categories</h1>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
        ?>
                    <!-- START Form -->
                    <form method="post" name="manage-feature-request-categories" action="edit-feature-request-categories.php">
                        <!-- START Add, Edit, or Delete -->
                        <hr/>
                        <div class='radio-button-holder'>
                        <?php
                            $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                            if($addEditOrDelete == "Add") {
                        ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" checked="checked" />Add Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Feature Request Category</p>
                        <?php
                            } else if($addEditOrDelete == "Edit") {
                        ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" />Add Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" checked="checked" />Edit Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Feature Request Category</p>
                        <?php
                            } else {
                        ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add"  />Add Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Feature Request Category</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" checked="checked" />Delete Feature Request Category</p>
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
                            <div id="add-feature-request-category-container">
                        <?php
                            } else {
                        ?>
                            <div id="add-feature-request-category-container" style="display:none;">
                        <?php
                            }
                        ?>
                            <h2>Add New Feature Request Category</h2>

                                <!-- START Category -->
                            <div class='feature-request-category-label'>
                                <p><strong>Category: </strong></p>
                            </div>
                            <div class='feature-request-category-input'>
                                <p><input type='text' name='add-category' value="<?php if(isset($_POST['add-category'])){ echo($_POST['add-category']); } ?>"/></p>
                                <?php
                                    if(!$validForm && isset($_POST['add-feature-request-category'])) {
                                        displayOutputAddCategory();
                                    }
                                ?>
                            </div>
                            <div class='clear'></div>
                            <!-- END Category -->

                            <!-- START Email Distro -->
                            <div class='feature-request-category-label'>
                                <p><strong>Email Distro: </strong></p>
                            </div>
                            <div class='feature-request-category-input'>
                            <?php
                                    $addEmailDistro = isset($_POST['add-email-distro']) ? $_POST['add-email-distro'] : "";

                                    echo("<select name='add-email-distro'>");
                                    if($addEmailDistro == "") {
                                        echo("<option value='" . SELECT_EMAIL_DISTRO . "' selected='selected'>" . SELECT_EMAIL_DISTRO . "</option>");
                                    } else {
                                        echo("<option value='" . SELECT_EMAIL_DISTRO . "'>" . SELECT_EMAIL_DISTRO . "</option>");
                                    }
                                    foreach($emailDistros as $emailDistro) {
                                        if($emailDistro->getId() == $addEmailDistro) {
                                            echo("<option value='" . $emailDistro->getId() . "' selected='selected'>" . $emailDistro->getName() . "</option>");
                                        } else {
                                            echo("<option value='" . $emailDistro->getId() . "'>" . $emailDistro->getName() . "</option>");
                                        }
                                    }
                                    echo("</select>");

                                    if(!$validForm && isset($_POST['add-feature-request-category'])) {
                                        displayOutputAddEmailDistro();
                                    }
                            ?>
                            </div>
                            <div class='clear'></div>
                            <!-- END Email Distro -->

                            <!-- START Default -->
                            <div class='feature-request-category-label-check'>
                                <p><strong>Make this the default feature request category? (all others will be set to false): </strong></p>
                            </div>
                            <div class='feature-request-category-input-check'>
                            <?php
                                $addDefault = isset($_POST['add-default']) ? $_POST['add-default'] : "no";
                                if($addDefault == "no") {
                            ?>
                                    <p>
                                        <input type="radio" name="add-default" value="yes" />Yes
                                        <input type="radio" name="add-default" value="no" checked="checked" />No
                                    </p>
                            <?php
                                } else {
                            ?>
                                    <p>
                                        <input type="radio" name="add-default" value="yes" checked="checked" />Yes
                                        <input type="radio" name="add-default" value="no" />No
                                    </p>
                            <?php
                                }
                            ?>
                                </div>
                            <div class='clear'></div>
                            <!-- END Default -->

                                <p><input type="submit" name="add-feature-request-category" value="Add Feature Request Category" class="button" /></p>
                            </div>
                            <!-- END Add portion of form -->

                            <!-- START Edit portion of form -->
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Edit"){
                            ?>
                                <div id="edit-feature-request-category-container">
                            <?php
                                } else {
                            ?>
                                <div id="edit-feature-request-category-container" style="display:none;">
                            <?php
                                }
                            ?>
                                    <h2>Edit Existing Feature Request Category</h2>

                            <?php
                                $editCategory = isset($_POST['edit-category-select']) ? $_POST['edit-category-select'] : "";
                                echo("<p class='feature-request-category'>");
                                echo("<select name='edit-category-select' style='width:100%;'>");
                                if($editCategory == "") {
                                    echo("<option value='" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_EDIT . "' selected='selected'>" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_EDIT . "</option>");
                                } else {
                                    echo("<option value='" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_EDIT . "'>" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_EDIT . "</option>");
                                }
                                foreach($featureRequestCategories as $featureRequestCategory) {
                                    if($featureRequestCategory->getId() == $editCategory) {
                                        echo("<option value='" . $featureRequestCategory->getId() . "' selected='selected'>" . $featureRequestCategory->getName() . "</option>");
                                    } else {
                                        echo("<option value='" . $featureRequestCategory->getId() . "'>" . $featureRequestCategory->getName() . "</option>");
                                    }
                                }
                                echo("</select>");
                                echo("</p>");
                            ?>


                            <!-- START Category -->
                            <div class='feature-request-category-label'>
                                <p><strong>Category: </strong></p>
                            </div>
                            <div class='feature-request-category-input'>
                            <p><input type='text' name='edit-category' value="<?php if(isset($_POST['edit-category'])){ echo($_POST['edit-category']); } ?>"/></p>
                            <?php
                                if(!$validForm && isset($_POST['edit-feature-request-category'])) {
                                    displayOutputEditCategory();
                                }
                            ?>
                            </div>
                            <div class='clear'></div>
                            <!-- END Category -->

                            <!-- START Email Distro -->
                            <div class='feature-request-category-label'>
                                <p><strong>Email Distro: </strong></p>
                            </div>
                            <div class='feature-request-category-input'>
                            <?php
                                $editEmailDistro = isset($_POST['edit-email-distro']) ? $_POST['edit-email-distro'] : "";

                                echo("<select name='edit-email-distro'>");
                                if($editEmailDistro == "") {
                                    echo("<option value='" . SELECT_EMAIL_DISTRO . "' selected='selected'>" . SELECT_EMAIL_DISTRO . "</option>");
                                } else {
                                    echo("<option value='" .SELECT_EMAIL_DISTRO . "'>" . SELECT_EMAIL_DISTRO . "</option>");
                                }
                                foreach($emailDistros as $emailDistro) {
                                    if($emailDistro->getId() == $editEmailDistro)
                                    {
                                        echo("<option value='" . $emailDistro->getId() . "' selected='selected'>" . $emailDistro->getName() . "</option>");
                                    } else {
                                        echo("<option value='" . $emailDistro->getId() . "'>" . $emailDistro->getName() . "</option>");
                                    }
                                }
                                echo("</select>");

                                if(!$validForm && isset($_POST['edit-feature-request-category'])) {
                                    displayOutputEditEmailDistro();
                                }
                            ?>
                            </div>
                            <div class='clear'></div>
                            <!-- END Email Distro -->

                            <!-- START Default -->
                            <div class='feature-request-category-label-check'>
                                <p><strong>Make this the default feature request category? (all others will be set to false): </strong></p>
                            </div>
                            <div class='feature-request-category-input-check'>
                                <?php
                                    $editDefault = isset($_POST['edit-default']) ? $_POST['edit-default'] : "no";
                                     if($editDefault == "no") {
                                ?>
                                        <p>
                                            <input type="radio" name="edit-default" value="yes" />Yes
                                            <input type="radio" name="edit-default" value="no" checked="checked" />No
                                        </p>
                                <?php
                                    } else {
                                ?>
                                        <p>
                                            <input type="radio" name="edit-default" value="yes" checked="checked" />Yes
                                            <input type="radio" name="edit-default" value="no" />No
                                        </p>
                                <?php
                                    }
                                ?>
                                </div>
                                <div class='clear'></div>
                                <!-- END Default -->

                                <p><input type="submit" name="edit-feature-request-category" value="Update Feature Request Category" class="button" /></p>
                            </div>
                            <!-- END Edit portion of form -->

                            <!-- START Delete portion of form -->
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Delete") {
                            ?>
                                <div id="delete-feature-request-category-container">
                            <?php
                                } else{
                            ?>
                                <div id="delete-feature-request-category-container" style="display:none;">
                            <?php
                                }
                            ?>
                                <h2>Delete Existing Feature Request Category</h2>

                            <?php
                                $deleteCategory = isset($_POST['delete-category']) ? $_POST['delete-category'] : "";
                                echo("<p class='feature-request-category'>");
                                echo("<select name='delete-category' style='width:100%;'>");
                                if($deleteCategory == "") {
                                    echo("<option value='" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_DELETE . "' selected='selected'>" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_DELETE . "</option>");
                                } else {
                                    echo("<option value='" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_DELETE . "'>" . SELECT_A_FEATURE_REQUEST_CATEGORY_TO_DELETE . "</option>");
                                }
                                foreach($featureRequestCategories as $featureRequestCategory) {
                                    if($featureRequestCategory->getId() == $deleteCategory) {
                                        echo("<option value='" . $featureRequestCategory->getId() . "' selected='selected'>" . $featureRequestCategory->getName() . "</option>");
                                    } else {
                                        echo("<option value='" . $featureRequestCategory->getId() . "'>" . $featureRequestCategory->getName() . "</option>");
                                    }
                                }
                                echo("</select>");
                                echo("</p>");

                                if(!$validForm && isset($_POST['delete-feature-request-category'])) {
                                    displayOutputDeleteCategory();
                                }
                            ?>

                            <p><input type="submit" name="delete-feature-request-category" value="Delete Feature Request Category" class="button" /></p>
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