<?php
session_save_path('/tmp');

include("../php-main/lib.php");

if($_POST['locked-users'] !== NO_LOCKED_USERS) {
    log_util::log(LOG_LEVEL_DEBUG, "Post IS NOT the the same as '--There are currently no locked out users--', going to unlock and redirect");

    if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
        if(lib_check::userIsAdmin()) {
            lib_database::toggleLock($_POST['locked-users'], FALSE);
        }
    }
} else {
    log_util::log(LOG_LEVEL_DEBUG, "Post IS NOT the the same as '--There are currently no locked out users--', just going to redirect");

    lib::redirect(FALSE, NULL, FALSE, "../web-admin/account-lock-administration.php");
}