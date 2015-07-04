<?php
	/**
	 *  This class houses functions that check input and return true/false values
	 */
	class lib_check {
		
		/**
		 *  This function checks if debug mode should be disabled or enabled
		 *  
		 *  @param $enable boolean (optional) If debug mode is enabled or disabled
		 *  @param $careAboutAdmin boolean (optional) If we're only enabling debug mode for admin users		 
		 *  		 
		 *  @return boolean
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- To enable debug mode for all users $enable should be true and $careAboutAdmin false
		 *  	- To enable debug mode for ONLY admin users $enable should be set to true and $careAboutAdmin set to true
		 *  	- Defaults to debug mode being off
		 *  	- If enable if false, then debug mode remains off no matter what the value of $careAboutAdmin is
		 *  @example 
		 *  	- $debugMode = lib_check::debugMode();
		 *  	  if($debugMode) {
		 *  	  	 // Do things	
		 *  	  }	
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		public static function debugMode($enable = FALSE, $careAboutAdmin = FALSE) {
			$debugEnable = FALSE;
			
			if($careAboutAdmin) {
				$isAdmin = lib_check::userIsAdmin();
				if($isAdmin) {
					$debugEnable = $enable;
				}
			} else {
				$debugEnable = $enable;
			}
			
			return $debugEnable;
		}
		
		public static function userIsAdmin() {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
			
			$isAdmin = FALSE;
			
			$email = "isupatches@yahoo.com"; //isset($_COOKIE['email']) ? base64_decode($_COOKIE['email']) : "";
			$emailTemp = isset($_COOKIE['emailTemp']) ? base64_decode($_COOKIE['emailTemp']) : "";
			
			log_util::log(LOG_LEVEL_DEBUG, "email: " . $email);
			log_util::log(LOG_LEVEL_DEBUG, "emailTemp: " . $emailTemp);
			
			$user = lib_database::getUser(NULL, $email);
			$userTemp = lib_database::getUser(NULL, $emailTemp);
			
			log_util::logDivider();
			
			return $isAdmin;
		}
	}