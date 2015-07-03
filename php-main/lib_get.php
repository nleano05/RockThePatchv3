<?php

	/**
	 *  This class houses functions related to getting data that's not database related
	 */
	class lib_get {
		
		/**
		 *  This function gets the callee of another function
		 *  
		 *  @params - None
		 *  @return - Callee
		 *  @notes	- None
		 *  @globals - None
		 *  @author - Patches
		 *  @history - Created 07/02/2015
		 */
		public static function getCallee() {
			$backtrace = debug_backtrace();
			return $backtrace[2]['function'];
		}
		
		/**
		 *	This function gets and returns the current URL  
		 *  
		 *  @params - None
		 *  @return - None
		 *  @notes - None
		 *  @globals - $gDebugMode, $gDebugFunctionColor, $gDebugDivider
		 *  @author - Patches
		 *  @histor - Created 07/02/2015
		 */
		public static function getCurrentUrl() {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
		
			$currentURL = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
			
			log_util::log(LOG_LEVEL_DEBUG, "currentURL: " . $currentURL);
			log_util::logDivider();
			
			return $currentURL;
		}
	}
?>