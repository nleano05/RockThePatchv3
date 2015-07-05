<?php
require_once("db_props.php");
require_once("lib_check.php");
require_once("lib_const.php");
require_once("lib_database.php");
require_once("lib_get.php");
require_once("log_util.php");

require_once("models/AnnoyanceLevel.php");
require_once("models/EmailDistro.php");
require_once("models/ErrorReportCategory.php");
require_once("models/FeatureRequestCategory.php");
require_once("models/User.php");

global $gDebugMode;
global $gDebugFunctionColor;
global $gDebugDivider;
global $gLoginStatus;
global $gMasterAdminEmail;
global $gMasterAdminName;

$gDebugFunctionColor = "blue";
$gDebugDivider = "-----------------------------------------------------------------------------------------";
$gMasterAdminEmail = MASTER_ADMIN_EMAIL;
$gMasterAdminName = MASTER_ADMIN_NAME;

if (!isset($_COOKIE['debugMode'])) {
    $gDebugMode = lib_check::debugMode();
} else {
    $gDebugMode = $_COOKIE['debugMode'];
}

class lib {

    /**
     *  This function checks if the file calling it is connected to the library by writing a simple echo statement
     *
     * @param None
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - lib::testConnection();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function testConnection(){
        echo("<p>We're connected to the library now.</p>");
    }
}