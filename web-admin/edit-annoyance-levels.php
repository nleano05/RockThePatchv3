<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if(isset($_POST['add-annoyance-level'])) {
    $validForm = checkInputAddAnnoyanceLevel();
    if($validForm) {
        $addName = isset($_POST['add-name']) ? $_POST['add-name'] : "";
        $addLevel = isset($_POST['add-level']) ? $_POST['add-level'] : "";
        $addIsDefault = isset($_POST['add-is-default']) ? $_POST['add-is-default'] : "";
        lib_database::writeAnnoyanceLevel($addLevel, $addName, $addIsDefault);
    }
}

if(isset($_POST['delete-annoyance-level'])) {
    $validForm = checkInputDeleteAnnoyanceLevel();
    if($validForm) {
        $deleteLevel = isset($_POST['delete-level']) ? $_POST['delete-level'] : "";
        lib_database::deleteAnnoyanceLevel($deleteLevel);
    }
}

if(isset($_POST['edit-annoyance-level'])) {
    $validForm = checkInputEditAnnoyanceLevel();
    if($validForm) {
        $editAnnoyanceLevelSelect = isset($_POST['edit-annoyance-level-select']) ? $_POST['edit-annoyance-level-select'] : "";
        $editLevel = isset($_POST['edit-level']) ? $_POST['edit-level'] : "";
        $editName = isset($_POST['edit-name']) ? $_POST['edit-name'] : "";
        $editIsDefault = isset($_POST['edit-is-default']) ? $_POST['edit-is-default'] : "";

        lib_database::updateAnnoyanceLevel($editAnnoyanceLevelSelect, $editLevel, $editName, $editIsDefault);
    }
}

$annoyanceLevels = lib_database::getAnnoyanceLevels();

function checkInputAddAnnoyanceLevel() {
    global $gNoAddName, $gBlackAddName, $gInUseAddName;

    $validForm = TRUE;

    $addName = isset($_POST['add-name']) ? $_POST['add-name'] : "";

    $gNoAddName = lib_check::isEmpty($addName);
    if($gNoAddName) {
        $validForm = FALSE;
    }

    $gBlackAddName = lib_check::againstWhiteList($addName);
    if($gBlackAddName) {
        $validForm = FALSE;
    }

    $annoyanceLevels = lib_database::getAnnoyanceLevels();
    foreach($annoyanceLevels as $annoyanceLevel) {
        if($annoyanceLevel->getName() == $addName) {
            $validForm = FALSE;
            $gInUseAddName = TRUE;
            break;
        }
    }

    return $validForm;
}

function checkInputDeleteAnnoyanceLevel() {
    global $gDefaultDeleteAnnoyanceLevel;

    $validForm = TRUE;

    $deleteLevel = isset($_POST['delete-level']) ? $_POST['delete-level'] : "";

    if($deleteLevel == SELECT_ANNOYANCE_LEVEL_TO_DELETE) {
        $gDefaultDeleteAnnoyanceLevel = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputEditAnnoyanceLevel() {
    global $gNoEditName, $gBlackEditName, $gInUseEditName, $gInUseEditLevel, $gDefaultEditAnnoyanceLevel;

    $validForm = TRUE;

    $editName = isset($_POST['edit-name']) ? $_POST['edit-name'] : "";
    $editLevel = isset($_POST['edit-level']) ? $_POST['edit-level'] : "";
    $editAnnoyanceLevelSelect = isset($_POST['edit-annoyance-level-select']) ? $_POST['edit-annoyance-level-select'] : "";

    $gNoEditName = lib_check::isEmpty($editName);
    if($gNoEditName) {
        $validForm = FALSE;
    }

    $gBlackEditName = lib_check::againstWhiteList($editName);
    if($gBlackEditName) {
        $validForm = FALSE;
    }

    $annoyanceLevels = lib_database::getAnnoyanceLevels();

    foreach($annoyanceLevels as $annoyanceLevel) {
        if($annoyanceLevel->getName() == $editName) {
            $gInUseEditName = TRUE;
            break;
        }
    }

    foreach($annoyanceLevels as $annoyanceLevel) {
        if($annoyanceLevel->getLevel() == $editLevel) {
            $validForm = FALSE;
            $gInUseEditLevel = TRUE;
            break;
        }
    }

    if($editAnnoyanceLevelSelect == SELECT_ANNOYANCE_LEVEL_TO_EDIT) {
        $gDefaultEditAnnoyanceLevel = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function displayOutputAddName() {
    global $gNoAddName, $gBlackAddName, $gInUseAddName;

    if($gNoAddName) {
        echo("<p class='error'>Please enter in an annoyance level name.</p>");
    } else if($gBlackAddName) {
        echo("<p class='error'>The annoyance level name entered contains characters that are not allowed.</p>");
    } else if($gInUseAddName) {
        echo("<p class='error'>There is already an annoyance level with that name.</p>");
    }
}

function displayOutputEditAnnoyanceLevel() {
    global $gDefaultEditAnnoyanceLevel;

    if($gDefaultEditAnnoyanceLevel) {
        echo("<p class='error'>Please select an annoyance level to edit.</p>");
    }
}

function displayOutputEditLevel() {
    global $gInUseEditLevel;

    if($gInUseEditLevel) {
        echo("<p class='error'>The annoyance level is already in use.</p>");
    }
}

function displayOutputEditName() {
    global $gNoEditName, $gBlackEditName, $gInUseEditNAme;

    if($gNoEditName) {
        echo("<p class='error'>Please enter in an annoyance level name.</p>");
    }else if($gBlackEditName) {
        echo("<p class='error'>The annoyance level name entered contains characters that are not allowed.</p>");
    } else if($gInUseEditNAme) {
        echo("<p class='error'>There is already an annoyance level with that name.</p>");
    }
}

function displayOutputDeleteAnnoyanceLevel() {
    global $gDefaultDeleteAnnoyanceLevel;

    if($gDefaultDeleteAnnoyanceLevel) {
        echo("<p class='error'>Please select an annoyance level to delete.</p>");
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
    <title>Rock the Patch! v3 - Edit Admin Access</title>
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Edit Admin Access</div>
        <h1>Edit Admin Access</h1>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
        ?>
                    <!-- START Form -->
                    <form method="post" name="manage-annoyance-levels" action="edit-annoyance-levels.php">
                        <!-- START Add, Edit, or Delete -->
                        <hr/>
                        <div class='radio-button-holder'>
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Add") {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" checked="checked" />Add Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Annoyance Level</p>
                            <?php
                                } else if($addEditOrDelete == "Edit") {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" />Add Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" checked="checked" />Edit Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Annoyance Level</p>
                            <?php
                                } else {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add"  />Add Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Annoyance Level</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" checked="checked" />Delete Annoyance Level</p>
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
                        <div id="add-annoyance-level-container">
                            <?php
                                } else {
                            ?>
                                <div id="add-annoyance-level-container" style="display:none;">
                            <?php
                                }
                            ?>
                                <h2>Add New Annoyance Level</h2>

                                <!-- START Level -->
                                <div class='label10'>
                                    <p><strong>Level: </strong></p>
                                </div>
                                <div class='input90'>
                                    <?php
                                        $addLevel = isset($_POST['add-level']) ? $_POST['add-level'] : "";
                                        echo("<p>");
                                        echo("<select  name='add-level'>");
                                        for($x = 1; $x < 10; $x++) {
                                            $levelInUse = FALSE;
                                            foreach($annoyanceLevels as $annoyanceLevel) {
                                                if($annoyanceLevel->getLevel() == $x) {
                                                    $levelInUse = TRUE;
                                                    break;
                                                }
                                            }

                                            if(!$levelInUse) {
                                                if($x == $addLevel) {
                                                    echo("<option value='" . $x . "' selected='selected'>" . $x . "</option>");
                                                } else {
                                                    echo("<option value='" . $x . "'>" . $x . "</option>");
                                                }
                                            }
                                        }
                                        echo("</select>");
                                        echo("</p>");
                                    ?>
                                </div>
                                <div class='clear'></div>
                                <!-- END Level -->

                                <!-- START Name -->
                                <div class='label10'>
                                    <p><strong>Name: </strong></p>
                                </div>
                                <div class='input90'>
                                    <p><input type='text' name='add-name' value="<?php if(isset($_POST['add-name'])){ echo($_POST['add-name']); } ?>"/></p>
                                    <?php
                                        if(!$validForm && isset($_POST['add-annoyance-level'])) {
                                            displayOutputAddName();
                                        }
                                    ?>
                                </div>
                                <div class='clear'></div>
                                <!-- END Name -->

                                <!-- START Default -->
                                <div>
                                    <p><strong>Make this the default annoyance level? (all others will be set to false): </strong></p>
                                </div>
                                <div>
                                <?php
                                    $addIsDefault = isset($_POST['add-is-default']) ? $_POST['add-is-default'] : "no";
                                    if($addIsDefault == "no") {
                                ?>
                                        <p><input type="radio" name="add-is-default" value="yes" />Yes
                                        <input type="radio" name="add-is-default" value="no" checked="checked" />No</p>
                                <?php
                                    } else {
                                ?>
                                        <p><input type="radio" name="add-is-default" value="yes" checked="checked" />Yes
                                        <input type="radio" name="add-is-default" value="no" />No</p>
                                <?php
                                    }
                                ?>
                                </div>
                                <div class='clear'></div>
                                <!-- END Default -->

                                <p><input type="submit" name="add-annoyance-level" value="Add Annoyance Level" class="button" /></p>
                            </div>
                            <!-- END Add portion of form -->

                            <!-- START Edit portion of form -->
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Edit") {
                            ?>
                                <div id="edit-annoyance-level-container">
                            <?php
                                } else {
                            ?>
                                <div id="edit-annoyance-level-container" style="display:none;">
                            <?php
                                }
                            ?>
                                    <h2>Edit Existing Annoyance Level</h2>

                                    <?php
                                        $editAnnoyanceLevelSelect = isset($_POST['edit-annoyance-level-select']) ? $_POST['edit-annoyance-level-select'] : "";
                                        echo("<p class='annoyance-level-category'>");
                                        echo("<select name='edit-annoyance-level-select' style='width:100%;'>");
                                        if($editAnnoyanceLevelSelect == "") {
                                            echo("<option value='-- SELECT ANNOYANCE LEVEL TO EDIT --' selected='selected'>-- SELECT ANNOYANCE LEVEL TO EDIT --</option>");
                                        } else {
                                            echo("<option value='-- SELECT ANNOYANCE LEVEL TO EDIT --'>-- SELECT ANNOYANCE LEVEL TO EDIT --</option>");
                                        }
                                        foreach($annoyanceLevels as $annoyanceLevel) {
                                            if($annoyanceLevel->getId() == $editAnnoyanceLevelSelect) {
                                                echo("<option value='" . $annoyanceLevel->getId() . "' selected='selected'>" . $annoyanceLevel->getLevel() . " - ". $annoyanceLevel->getName() . "</option>");
                                            } else {
                                                echo("<option value='" . $annoyanceLevel->getId() . "'>" . $annoyanceLevel->getLevel() . " - ". $annoyanceLevel->getName() . "</option>");
                                            }
                                        }
                                        echo("</select>");
                                        echo("</p>");

                                        if(!$validForm && isset($_POST['edit-annoyance-level'])) {
                                            displayOutputEditAnnoyanceLevel();
                                        }
                                    ?>

                                    <!-- START Level -->
                                    <div class='label10'>
                                        <p><strong>Level: </strong></p>
                                    </div>
                                    <div class='input90'>
                                        <?php
                                            $editLevel = isset($_POST['edit-level']) ? $_POST['edit-level'] : "";
                                            echo("<p>");
                                            echo("<select  name='edit-level'>");
                                            for($x = 1; $x < 10; $x++) {
                                                if($x == $editLevel) {
                                                    echo("<option value='" . $x . "' selected='selected'>" . $x . "</option>");
                                                } else {
                                                    echo("<option value='" . $x . "'>" . $x . "</option>");
                                                }
                                            }
                                            echo("</select>");
                                            echo("</p>");

                                            if(!$validForm && isset($_POST['edit-annoyance-level'])) {
                                                displayOutputEditLevel();
                                            }
                                        ?>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Level -->

                                    <!-- START Name -->
                                    <div class='label10'>
                                        <p><strong>Name: </strong></p>
                                    </div>
                                    <div class='input90'>
                                        <p><input type='text' name='edit-name' value="<?php if(isset($_POST['edit-name'])){ echo($_POST['edit-name']); } ?>"/></p>
                                        <?php
                                            if(!$validForm && isset($_POST['edit-annoyance-level'])) {
                                                displayOutputEditName();
                                            }
                                        ?>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Name -->

                                    <!-- START Default -->
                                    <div>
                                        <p><strong>Make this the default annoyance level? (all others will be set to false): </strong></p>
                                    </div>
                                    <div>
                                        <?php
                                        $editIsDefault = isset($_POST['edit-is-default']) ? $_POST['edit-is-default'] : "no";
                                        if($editIsDefault == "no") {
                                            ?>
                                            <p><input type="radio" name="edit-is-default" value="yes" />Yes
                                                <input type="radio" name="edit-is-default" value="no" checked="checked" />No</p>
                                            <?php
                                        } else {
                                            ?>
                                            <p><input type="radio" name="edit-is-default" value="yes" checked="checked" />Yes
                                                <input type="radio" name="edit-is-default" value="no" />No</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Default -->

                                    <p><input type="submit" name="edit-annoyance-level" value="Update Annoyance Level" class="button" /></p>
                                </div>
                                <!-- END Edit portion of form -->

                                <!-- START Delete portion of form -->
                                <?php
                                    $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                    if($addEditOrDelete == "Delete") {
                                ?>
                                <div id="delete-annoyance-level-container">
                                    <?php
                                        } else {
                                    ?>
                                        <div id="delete-annoyance-level-container" style="display:none;">
                                    <?php
                                        }
                                    ?>
                                        <h2>Delete Existing Annoyance Level</h2>

                                        <?php
                                            $deleteAnnoyanceLevel = isset($_POST['delete-level']) ? $_POST['delete-level'] : "";
                                            echo("<p>");
                                            echo("<select name='delete-level' style='width:100%;'>");
                                            if($deleteAnnoyanceLevel == "") {
                                                echo("<option value='-- SELECT ANNOYANCE LEVEL TO DELETE --' selected='selected'>-- SELECT ANNOYANCE LEVEL TO DELETE --</option>");
                                            } else {
                                                echo("<option value='-- SELECT ANNOYANCE LEVEL TO DELETE --'>-- SELECT ANNOYANCE LEVEL TO DELETE --</option>");
                                            }
                                            foreach($annoyanceLevels as $annoyanceLevel) {
                                                if(($annoyanceLevel->getId()) == $deleteAnnoyanceLevel) {
                                                    echo("<option value='" . $annoyanceLevel->getId() . "' selected='selected'>" . $annoyanceLevel->getLevel() . " - ". $annoyanceLevel->getName() . "</option>");
                                                } else {
                                                    echo("<option value='" . $annoyanceLevel->getId() . "'>" . $annoyanceLevel->getLevel() . " - ". $annoyanceLevel->getName() . "</option>");
                                                }
                                            }
                                            echo("</select>");
                                            echo("</p>");

                                            if(!$validForm && isset($_POST['delete-annoyance-level'])){
                                                displayOutputDeleteAnnoyanceLevel();
                                            }
                                        ?>

                                        <p><input type="submit" name="delete-annoyance-level" value="Delete Annoyance Level" class="button" /></p>
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