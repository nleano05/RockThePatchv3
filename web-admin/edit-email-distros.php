<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$validForm = FALSE;

if(isset($_POST['delete-email-distro'])) {
    $validForm = checkInputDeleteEmailDistro();
    if($validForm) {
        $distroId = isset($_POST['delete-distro']) ? $_POST['delete-distro'] : "";
        lib_database::deleteEmailDistro($distroId);
        lib_database::deleteEmailDistroMembers($distroId);
    }
}

if(isset($_POST['edit-add-member'])) {
    $validForm = checkInputEditEmailDistroAddMember();
    if($validForm) {
        $distroId = isset($_POST['edit-email-distro-select']) ? $_POST['edit-email-distro-select'] : "";
        $email = isset($_POST['edit-add-member-email']) ? $_POST['edit-add-member-email'] : "";
        lib_database::writeEmailDistroMember($distroId, $email);
    }
}

if(isset($_POST['edit-email-distro-name'])) {
    $validForm = checkInputEditEmailDistroName();
    if($validForm) {
        $distroId = isset($_POST['edit-email-distro-select']) ? $_POST['edit-email-distro-select'] : "";
        $name = isset($_POST['edit-name']) ? $_POST['edit-name'] : "";
        lib_database::updateEmailDistro($distroId, $name);
    }
}

if(isset($_POST['edit-remove-member'])) {
    $validForm = checkInputEditEmailDistroRemoveMember();
    if($validForm) {
        $distroMemberId = isset($_POST['edit-remove-member-select']) ? $_POST['edit-remove-member-select'] : "";
        lib_database::deleteEmailDistroMember($distroMemberId);
    }
}

if(isset($_POST['add-email-distro'])) {
    $validForm = checkInputAddEmailDistro();
    if($validForm) {
        $name = isset($_POST['add-name']) ? $_POST['add-name'] : "";
        lib_database::writeEmailDistro($name);
    }
}

$emailDistros = lib_database::getEmailDistros();

function checkInputAddEmailDistro() {
    global $gNoAddName, $gBlackAddName, $gInUseAddEmailDistro;

    $gInUseAddEmailDistro = FALSE;
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

    $emailDistros = lib_database::getEmailDistros();
    foreach($emailDistros as $emailDistro) {
        if($emailDistro->getName() == $addName) {
            $validForm = FALSE;
            $gInUseAddEmailDistro = TRUE;
            break;
        }
    }

    return $validForm;
}

function checkInputDeleteEmailDistro() {
    global $gDefaultDeleteEmailDistro, $gInUseFeatureRequest, $gInUseErrorReport, $gMainEmailDistro;

    $validForm = TRUE;

    $deleteEmailDistro = isset($_POST['delete-distro']) ? $_POST['delete-distro'] : "";
    if($deleteEmailDistro == "-- SELECT EMAIL DISTRO TO DELETE --") {
        $gDefaultDeleteEmailDistro = TRUE;
        $validForm = FALSE;
    }

    $errorReportCategories = lib_database::getErrorReportCategories();
    foreach($errorReportCategories as $errorReportCategory) {
        if($errorReportCategory->getDistro() == $deleteEmailDistro) {
            $gInUseErrorReport = TRUE;
            $validForm = FALSE;
            break;
        }
    }

    $featureRequestCategories = lib_database::getFeatureRequestCategories();
    foreach($featureRequestCategories as $featureRequestCategory) {
        if($featureRequestCategory->getDistro() == $deleteEmailDistro) {
            $gInUseFeatureRequest = TRUE;
            $validForm = FALSE;
            break;
        }
    }

    if($deleteEmailDistro == "Patches") {
        $gMainEmailDistro = TRUE;
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputEditEmailDistroAddMember() {
    global $gNoEditAddMember, $gBlackEditAddMember, $gValidEditAddMember, $gDefaultEditEmailDistro, $gInUseEditAddMember;

    $validForm = TRUE;
    $gDefaultEditEmailDistro = FALSE;

    $editEmailDistroSelect = isset($_POST['edit-email-distro-select']) ? $_POST['edit-email-distro-select'] : "-- SELECT EMAIL DISTRO TO EDIT --";
    $editAddMemberEmail = isset($_POST['edit-add-member-email']) ? $_POST['edit-add-member-email'] : "";

    $gNoEditAddMember = lib_check::isEmpty($editAddMemberEmail);
    if($gNoEditAddMember) {
        $validForm = FALSE;
    }

    $gBlackEditAddMember = lib_check::againstWhiteList($editAddMemberEmail);
    if($gBlackEditAddMember) {
        $validForm = FALSE;
    }

    $gValidEditAddMember = lib_check::validEmail($editAddMemberEmail);
    if(!$gValidEditAddMember) {
        $validForm = FALSE;
    }

    if($editEmailDistroSelect == "-- SELECT EMAIL DISTRO TO EDIT --") {
        $gDefaultEditEmailDistro = TRUE;
        $validForm = FALSE;
    }

    $emailDistros = lib_database::getEmailDistroById($editEmailDistroSelect);
    foreach($emailDistros as $emailDistro) {
        $break = FALSE;

        $emailDistroMembers = $emailDistro->getDistroMembers();
        foreach($emailDistroMembers as $emailDistroMember) {
            if($emailDistroMember == $editAddMemberEmail) {
                $gInUseEditAddMember = TRUE;
                $validForm = FALSE;
                $break = TRUE;
                break;
            }
        }

        if($break) {
            break;
        }
    }

    return $validForm;
}

function checkInputEditEmailDistroName() {
    global $gNoEditName, $gBlackEditName;

    $validForm = TRUE;

    $editName = isset($_POST['edit-name']) ? $_POST['edit-name'] : "";

    $gNoEditName = lib_check::isEmpty($editName);
    if($gNoEditName) {
        $validForm = FALSE;
    }

    $gBlackEditName = lib_check::againstWhiteList($editName);
    if($gBlackEditName) {
        $validForm = FALSE;
    }

    return $validForm;
}

function checkInputEditEmailDistroRemoveMember() {
    global $gDefaultEditEmailDistro, $gDefaultEditRemoveMember;

    $validForm = FALSE;
    $gDefaultEditEmailDistro = TRUE;

    $editEmailDistroSelect = isset($_POST['edit-email-distro-select']) ? $_POST['edit-email-distro-select'] : "";
    $editRemoveMemberSelect = isset($_POST['edit-remove-member-select']) ? $_POST['edit-remove-member-select'] : "";

    if($editEmailDistroSelect != "-- SELECT EMAIL DISTRO TO EDIT --") {
        $validForm = TRUE;
        $gDefaultEditEmailDistro = FALSE;
    }

    if($editRemoveMemberSelect == "-- SELECT EMAIL DISTRO MEMBER TO REMOVE --") {
        $validForm = FALSE;
        $gDefaultEditRemoveMember = TRUE;
    }

    return $validForm;
}

function displayOutputAddEmailDistro() {
    global $gNoAddName, $gBlackAddName, $gInUseAddEmailDistro;

    if($gNoAddName) {
        echo("<p class='error'>Please enter in a name</p>");
    } else if($gBlackAddName) {
        echo("<p class='error'>Name contained characters that are not allowed</p>");
    } else if($gInUseAddEmailDistro) {
        echo("<p class='error'>The email distro you are trying to add already exists</p>");
    }
}

function displayOutputDeleteEmailDistro() {
    global $gDefaultDeleteEmailDistro, $gInUseErrorReport, $gInUseFeatureRequest, $gMainEmailDistro;

    if($gDefaultDeleteEmailDistro) {
        echo("<p class='error'>Please select an email distro to delete.</p>");
    } else if($gInUseErrorReport) {
        echo("<p class='error'>You can't delete the main email distro</p>");
    } else if($gInUseFeatureRequest) {
        echo("<p class='error'>The error report you are trying to delete is in use by an error report category</p>");
    } else if($gMainEmailDistro) {
        echo("<p class='error'>The error report you are trying to delete is in use by a feature request category</p>");
    }
}

function displayOutputEditEmailDistroAddMember() {
   global $gNoEditAddMember, $gBlackEditAddMember, $gValidEditAddMember, $gDefaultEditEmailDistro, $gInUseEditAddMember;

    if($gNoEditAddMember) {
        echo("<p class='error'>Please enter in an email address of a member to add</p>");
    } else if($gBlackEditAddMember) {
        echo("<p class='error'>The member's email address you are trying to add contained characters that are not allowed</p>");
    } else if(!$gValidEditAddMember) {
        echo("<p class='error'>Please enter in a valid email address to add</p>");
    } else if($gDefaultEditEmailDistro) {
        echo("<p class='error'>No email distro was selected to add a member</p>");
    } else if($gInUseEditAddMember) {
        echo("<p class='error'>The email you are trying to add to the distro is already a member</p>");
    }
}

function displayOutputEditEmailDistroName() {
    global $gNoEditName, $gBlackEditName;

    if($gNoEditName) {
        echo("<p class='error'>Please enter in a name</p>");
    } else if($gBlackEditName) {
        echo("<p class='error'>Name contained characters that are not allowed</p>");
    }
}

function displayOutputEditEmailDistroRemoveMember() {
    global $gDefaultEditEmailDistro, $gDefaultEditRemoveMember;

    if($gDefaultEditEmailDistro) {
        echo("<p class='error'>No email distro was selected to remove a member</p>");
    } else if($gDefaultEditRemoveMember) {
        echo("<p class='error'>No member was selected to remove</p>");
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
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <a href="/web-admin/main.php" title="Web Admin">Web Admin</a> / Edit Email Distros</div>
        <h1>Edit Email Distros</h1>

        <?php
            if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
                if(lib_check::userIsAdmin()) {
        ?>
                    <!-- START Form -->
                    <form method="post" name="manage-email-distros" action="/web-admin/edit-email-distros.php">
                        <!-- START Add, Edit, or Delete -->
                        <hr/>
                        <div class='radio-button-holder'>
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Add") {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" checked="checked" />Add Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Email Distro</p>
                            <?php
                                } else if($addEditOrDelete == "Edit") {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add" />Add Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" checked="checked" />Edit Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" />Delete Email Distro</p>
                            <?php
                                } else {
                            ?>
                                <p><input type="radio" name="add-edit-or-delete" value="Add"  />Add Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Edit" />Edit Email Distro</p>
                                <p><input type="radio" name="add-edit-or-delete" value="Delete" checked="checked" />Delete Email Distro</p>
                            <?php
                                }
                            ?>
                        </div>
                        <hr/>
                        <!-- END Add, Edit, or Delete -->

                        <!-- START Add portion of form-->
                        <?php
                            $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                            if($addEditOrDelete == "Add") {
                        ?>
                        <div id="add-email-distro-container">
                        <?php
                            } else{
                        ?>
                            <div id="add-email-distro-container" style="display:none;">
                        <?php
                            }
                        ?>
                                <h2>Add New Email Distro</h2>

                                <p><em><strong>*NOTE*</strong> This will only create the distro, to add members please go to the edit tab. </em></p>

                                <!-- START Name -->
                                <div class='label10'>
                                    <p><strong>Email Distro Name: </strong></p>
                                </div>
                                <div class='input90'>
                                    <p><input type='text' name='add-name' value="<?php if(isset($_POST['add-name'])){ echo($_POST['add-name']); } ?>"/></p>
                                    <?php
                                        if(!$validForm && isset($_POST['add-email-distro'])) {
                                            displayOutputAddEmailDistro();
                                        }
                                    ?>
                                </div>
                                <div class='clear'></div>
                                <!-- END Name -->

                                <p><input type="submit" name="add-email-distro" value="Create Email Distro" class="button" /></p>
                            </div>
                            <!-- END Add portion of form -->

                            <!-- START Edit portion of form -->
                            <?php
                                $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                if($addEditOrDelete == "Edit") {
                            ?>
                            <div id="edit-email-distro-container">
                                <?php
                                    } else {
                                ?>
                                <div id="edit-email-distro-container" style="display:none;">
                                <?php
                                    }
                                ?>
                                    <h2>Edit Existing Email Distro</h2>
                                <?php
                                    $editEmailDistroSelect = isset($_POST['edit-email-distro-select']) ? $_POST['edit-email-distro-select'] : "-- SELECT EMAIL DISTRO TO EDIT --";

                                    echo("<p class='email-distro'><select name='edit-email-distro-select' style='width:100%;'>");
                                    echo("<option value='-- SELECT EMAIL DISTRO TO EDIT --'>-- SELECT EMAIL DISTRO TO EDIT --</option>");
                                    foreach($emailDistros as $emailDistro) {
                                        if($editEmailDistroSelect == $emailDistro->getId()) {
                                            echo("<option value=" . $emailDistro->getId() . " selected='selected'>" . $emailDistro->getName() . "</option>");
                                        } else {
                                            echo("<option value=" . $emailDistro->getId() . ">" . $emailDistro->getName() . "</option>");
                                        }
                                    }
                                    echo("</select></p>");
                                ?>

                                    <!-- START Name -->
                                    <div class='label10'>
                                        <p><strong>Email Distro Name: </strong></p>
                                    </div>
                                    <div class='input90'>
                                        <p><input type='text' name='edit-name' value="<?php if(isset($_POST['edit-name'])){ echo($_POST['edit-name']); } ?>"/></p>
                                        <?php
                                            if(!$validForm && isset($_POST['edit-email-distro-name'])) {
                                                displayOutputEditEmailDistroName();
                                            }
                                        ?>
                                    </div>
                                    <div class='clear'></div>

                                    <p><input type="submit" name="edit-email-distro-name" value="Update Email Distro Name" class="button" /></p>
                                    <!-- END Name -->

                                    <!-- START Current Members -->
                                    <div class='label10'>
                                        <p><strong>Current Distro Members: </strong></p>
                                    </div>
                                    <div class='input90'>
                                        <p id="edit-email-distro-current-members" style="word-break:break-all;"></p>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Current Members -->

                                    <!-- START Add Member -->
                                    <div class='email-distro-add-remove-input'>
                                        <p><input type='text' name='edit-add-member-email' value="<?php if(isset($_POST['edit-add-member-email'])){ echo($_POST['edit-add-member-email']); } ?>"/></p>
                                        <?php
                                            if(!$validForm && isset($_POST['edit-add-member'])) {
                                                displayOutputEditEmailDistroAddMember();
                                            }
                                        ?>
                                    </div>
                                    <div class='email-distro-add-remove-input-button'>
                                        <p><input type="submit" name="edit-add-member" value="Add Member" class="button" /></p>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Add Member -->

                                    <!-- START Remove Member -->
                                    <div class="email-distro-add-remove-input">
                                    <?php
                                        $editRemoveMemberSelect = isset($_POST['edit-remove-member-select']) ? $_POST['edit-remove-member-select'] : "";

                                        echo("<p class='email-distro'><select name='edit-remove-member-select'>");
                                        echo("<option value='-- SELECT EMAIL DISTRO MEMBER TO REMOVE --'>-- SELECT EMAIL DISTRO MEMBER TO REMOVE --</option>");
                                        foreach($emailDistros as $emailDistro) {
                                            if($emailDistro->getName() == $editRemoveMemberSelect) {
                                                $emailDistroMembers = $emailDistro->emailMembers;
                                                foreach($emailDistroMembers as $emailDistroMember) {
                                                    if($emailDistroMember == $editRemoveMemberSelect) {
                                                        echo("<option selected='selected'>");
                                                        print_r($emailDistroMember);
                                                        echo("</option>");
                                                    } else {
                                                        echo("<option>");
                                                        print_r($emailDistroMember);
                                                        echo("</option>");
                                                    }
                                                }
                                            }
                                        }
                                        echo("</select></p>");

                                        if(!$validForm && isset($_POST['edit-remove-member'])) {
                                            displayOutputEditEmailDistroRemoveMember();
                                        }
                                    ?>
                                    </div>
                                    <div class="email-distro-add-remove-input-button">
                                        <p><input type="submit" name="edit-remove-member" value="Remove Member" class="button" /></p>
                                    </div>
                                    <div class='clear'></div>
                                    <!-- END Remove Member -->

                                </div>
                                <!-- END Edit portion of form -->

                                <!-- START Delete portion of form -->
                                <?php
                                    $addEditOrDelete = isset($_POST['add-edit-or-delete']) ? $_POST['add-edit-or-delete'] : "Add";
                                    if($addEditOrDelete == "Delete") {
                                ?>
                                <div id="delete-email-distro-container">
                                <?php
                                    } else {
                                ?>
                                    <div id="delete-email-distro-container" style="display:none;">
                                <?php
                                    }
                                ?>
                                        <h2>Delete Existing Email Distro</h2>

                                    <?php
                                        $deleteDistro = isset($_POST['delete-distro']) ? $_POST['delete-distro'] : "";

                                        echo("<p class='email-distro'>");
                                        echo("<select name='delete-distro' style='width:100%;'>");
                                        echo("<option value='-- SELECT EMAIL DISTRO TO DELETE --'>-- SELECT EMAIL DISTRO TO DELETE --</option>");
                                        foreach($emailDistros as $emailDistro) {
                                            if($emailDistro->getId() == $deleteDistro) {
                                                echo("<option value='" . $emailDistro->getId() . "' selected='selected'>" . $emailDistro->getName() . "</option>");
                                            } else {
                                                echo("<option value='" . $emailDistro->getId() . "'>" . $emailDistro->getName() . "</option>");
                                            }
                                        }
                                        echo("</select></p>");

                                        if(!$validForm && isset($_POST['delete-email-distro'])) {
                                            displayOutputDeleteEmailDistro();
                                        }
                                    ?>
                                        <p><input type="submit" name="delete-email-distro" value="Delete Email Distro" class="button" /></p>
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