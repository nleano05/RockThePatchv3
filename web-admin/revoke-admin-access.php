<?php
session_save_path('/tmp');

include("../php-main/lib.php");

$currentUser = lib_get::currentUser();

if(strtolower($currentUser->getId()) != strtolower($_POST['non-admin-users'])) {
    log_util::log(LOG_LEVEL_DEBUG, "user IS NOT the current user");
    if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
        if (lib_check::userIsAdmin()) {
            lib_database::toggleAdminAccess($_POST['non-admin-users'], FALSE);
        }
    }
} else {
    log_util::log(LOG_LEVEL_DEBUG, "user IS NOT the current user");
}

lib::redirect(FALSE, NULL, FALSE, "../web-admin/edit-admin-access.php");