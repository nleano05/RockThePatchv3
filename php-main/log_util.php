<?php
	define("LOG_LEVEL_ALL", 0);
	define("LOG_LEVEL_ERROR", 1);
	define("LOG_LEVEL_WARNING", 2);
	define("LOG_LEVEL_DEBUG", 3);
	define("LOG_LEVEL_INFO", 4);

	/**
	 *  This is a helper class that assists in outputting messages for debug mode
	 */
	class log_util {
		
		/**
		 *  This function outputs a log message
		 *  
		 *  @param $level int (required) The level the message is to be logged at
		 *  @param $message string (required) The message to log
		 *  @param $resource object (optional) A resource to be printed along with the message		 
		 *  
		 *  @return NULL
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Currently does not take into account log level
		 *  @todo Make this take into account log level
		 *  
		 *  @example - For just a message: log_util::log(LOG_LEVEL_DEBUG, "message");
		 *  @example - For a message with a resource: log_util::log(LOG_LEVEL_DEBUG, "message", $resource);
		 *  
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/02/2015
		 */
		public static function log($level, $message, $resource = NULL) {
			global $gDebugMode;
			
			if($gDebugMode) {
				if($resource !== NULL) {
					echo("<p>" . $message);
					print_r($resource);
					echo("</p>"); 
				} else {
					echo("<p>" . $message . "<p>");
				}
			}
		}
		
		/**
		 *  This function outputs the debug divider
		 *  
		 *  @param - None 
		 *  
		 *  @return NULL
		 *  @throws - Nothing
		 *  @global - $gDebugMode and $gDebugDivider
		 *  @notes 
		 *  	- Used at the end of methods
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Currently does not take into account log level
		 *  @todo - Make this take into account log level
		 *  @example - log_util::logDivider();
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		public static function logDivider(){
			global $gDebugMode, $gDebugDivider;
			
			if($gDebugMode) {
				echo($gDebugDivider);
			}
		}
		
		/**
		 *  This function outputs the function name and args
		 *  
		 *  @param $args array (required) The arguments for the function as a key/value pair
		 *  		 
		 *  @return NULL
		 *  @throws - Nothing
		 *  @global - $gDebugMode and $gDebugFunctionColor
		 *  @notes 
		 *  	- Used at the start of methods
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Currently does not take into account log level
		 *  @todo - Make this take into account log level
		 *  @example - log_util::logFunctionStart();
		 *  @author - Patches
		 *	@version - 1.0
		 *  @history - Created 07/03/2015
		 */
		public static function logFunctionStart($args) {
			global $gDebugMode, $gDebugFunctionColor;
			
			if($gDebugMode) {
				$callee = lib_get::callee();
				echo("<p style='color:" . $gDebugFunctionColor . ";' >" . $callee . ", args: ");
				print_r($args);
				echo("</p>");
			}
		}
	}