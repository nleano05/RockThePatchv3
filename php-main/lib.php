<?php
	require_once("db_props.php");
	require_once("lib_get.php");
	require_once("lib_database.php");
	require_once("log_util.php");
	
	require_once("/models/EmailDistro.php");

	global $gDebugMode;
	global $gDebugFunctionColor;
	global $gDebugDivider; 
	global $gMasterAdminEmail;
	global $gMasterAdminName;
	
	$gDebugMode;
	$gDebugFunctionColor = "blue";
	$gDebugDivider = "-----------------------------------------------------------------------------------------";
		
	$mainDistro = lib_database::dbGetEmailDistros("Patches");
	if(isset($mainDistro) && isset($mainDistro[0])) {
		if(isset($mainDistro[0]->emailMembers) && $mainDistro[0]->emailMembers[0]){
			$gMasterAdminEmail = $mainDistro[0]->emailMembers[0];
		} else {
			$gMasterAdminEmail = "patches@rockthepatch.com";
		}
		
		if(isset($mainDistro[0]->name) && $mainDistro[0]->name[0]){
			$gMasterAdminName = $mainDistro[0]->name[0];
		} else {
			$gMasterAdminName = "Patches";
		}
	} else {
		$gMasterAdminEmail = "patches@rockthepatch.com";
		$gMasterAdminName = "Patches";
	}
?>