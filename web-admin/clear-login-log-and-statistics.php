<?php
session_save_path('/tmp');

include("../php-main/lib.php");

$tables = array(TABLE_LOGIN_LOG, TABLE_LOGIN_STATISTICS);
lib_database::deleteTables($tables);

lib::redirect(FALSE, NULL, TRUE, NULL);