<?php
session_save_path('/tmp');

include("../php-main/lib.php");

if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
    if (lib_check::userIsAdmin()) {
        $tables = array(TABLE_LOGIN_LOG, TABLE_LOGIN_STATISTICS);
        lib_database::deleteTables($tables);
    }
}

lib::redirect(FALSE, NULL, TRUE, NULL);