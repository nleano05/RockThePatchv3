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
		 *  @params
		 *  	- $level (int): The level the message is to be logged at
		 *  	- $message (string): The message to log
		 *  	- $resource (optional object): A resource to be printed along with the message		 
		 *  @return - callee
		 *  @notes
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Current doesn't take into account log level
		 *  @globals - None
		 *  @author - Patches
		 *  @TODO
		 *  	- Make this take into account log level
		 *  @history - Created 07/02/2015
		 */
		public static function log($level, $message, $resource = null){
			global $gDebugMode;
			
			if($gDebugMode) {
				if($resource !== null) {
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
		 *  @params - None 
		 *  @return - None
		 *  @notes 
		 *  	- Used at the end of methods
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Current doesn't take into account log level
		 *  @globals - $gDebugMode, $gDebugDivider
		 *  @author - Patches
		 *  @TODO
		 *  	- Make this take into account log level
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
		 *  @params 
		 *  	- $args (object): The arguments for the function as a key/value pair	 
		 *  @return - None
		 *  @notes 
		 *  	- Used at the start of methods
		 *  	- Currently only logs if gDebugMode is enabled
		 *  	- Current doesn't take into account log level
		 *  @globals - $gDebugMode, $gDebugFunctionColor
		 *  @author - Patches
		 *  @TODO
		 *  	- Make this take into account log level
		 *  @history - Created 07/03/2015
		 */
		public static function logFunctionStart($args) {
			global $gDebugMode, $gDebugFunctionColor;
			
			if($gDebugMode) {
				$callee = lib_get::getCallee();
				echo("<p style='color:" . $gDebugFunctionColor . ";' >" . $callee . ", args: ");
				print_r($args);
				echo("</p>");
			}
		}
	}
?>