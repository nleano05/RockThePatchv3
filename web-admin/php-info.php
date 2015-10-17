<?php
session_save_path('/tmp');

include("../php-main/lib.php");
include("../php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$isAdmin = lib_check::userIsAdmin();

if($gLoginStatus == STATUS_LOGGED_IN) {
    if($isAdmin) {
        phpinfo();
    } else {
        echo("<p><em>" . NOTICE_MUST_BE_ADMIN . "</em></p>");
    }
} else {
    echo("<p><em>" . NOTICE_MUST_BE_LOGGED_IN . "</em></p>");
}