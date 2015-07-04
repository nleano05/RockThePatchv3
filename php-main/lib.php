<?php
	require_once("db_props.php");
	require_once("lib_check.php");
	require_once("lib_const.php");
	require_once("lib_database.php");
	require_once("lib_get.php");
	require_once("log_util.php");
	
	require_once("models/User.php");
	require_once("models/EmailDistro.php");

	global $gDebugMode;
	global $gDebugFunctionColor;
	global $gDebugDivider; 
	global $gMasterAdminEmail;
	global $gMasterAdminName;

	$gDebugFunctionColor = "blue";
	$gDebugDivider = "-----------------------------------------------------------------------------------------";
	$gMasterAdminEmail = MASTER_ADMIN_EMAIL;
	$gMasterAdminName = MASTER_ADMIN_NAME;
	
	if(!isset($_COOKIE['debugMode'])) {
		$gDebugMode = lib_check::debugMode();
	} else {
		$gDebugMode = $_COOKIE['debugMode'];
	}
	
	lib_check::userIsAdmin();