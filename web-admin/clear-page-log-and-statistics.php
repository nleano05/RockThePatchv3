<?php
session_save_path('/tmp');

include("../php-main/lib.php");

$tables = array(TABLE_PAGE_LOG, TABLE_PAGE_STATISTICS);
lib_database::deleteTables($tables);

lib::redirect(FALSE, NULL, TRUE, NULL);