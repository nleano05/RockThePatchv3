<?php
session_save_path('/tmp');

include("../php-main/lib.php");

$tables = array(TABLE_ERROR_LOG, TABLE_ERROR_STATISTICS);
lib_database::deleteTables($tables);

lib::redirect(FALSE, NULL, TRUE, NULL);