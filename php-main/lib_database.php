<?php
	/**
	 *  This class houses functions related to getting, setting, and updating data in the database
	 */
	class lib_database {
	
		/**
		 *  This function connects to the database
		 *  
		 *  @params - None	 
		 *  @return - PDO() object or NULL
		 *  @notes - None
		 *  @globals - None
		 *  @author - Patches
		 *  @history - Created 07/03/2015
		 */
		private static function dbConnect() {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
			
			try {			
				$dbh = new PDO(DB_HOST, DB_USER, DB_PASS);

				if(empty($dbh)) {
					log_util::log(LOG_LEVEL_DEBUG, "PDO connection was empty.  dbh: ", $dbh);
				} else {
					log_util::log(LOG_LEVEL_DEBUG, "PDO connection succeeded. dbh: ", $dbh);
				}
			} catch(PDOException $e) {
				$dbh = null;
				log_util::log(LOG_LEVEL_ERROR, "An error occured while establishing PDO connection", $e);
			}
			
			log_util::logDivider();
			
			return $dbh;
		}
		
		/**
		 *  This function clears the variable housing the database connection
		 *  
		 *  @params - None	 
		 *  @return - NULL database connection
		 *  @notes - None
		 *  @globals - None
		 *  @author - Patches
		 *  @history - Created 07/03/2015
		 */
		private static function dbDisconnect() {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
			
			$dbh = null;
			
			log_util::logDivider();
			
			return $dbh;
		}
		
		/**
		 *  This function clears the variable housing the database connection
		 *  
		 *  @params
		 *  	- $name (optional string): The name of the email distro to pull from the database
		 *  	- $id (optional int): The id of the email distro to pull from the database	
		 *  @return - An array of EmailDistro objects
		 *  @notes
		 *  	- If no name or id is passed in, defaults to no WHERE clause and returning all distros
		 *  @globals - None
		 *  @author - Patches
		 *  @history - Created 07/03/2015
		 */
		public static function dbGetEmailDistros($name = NULL, $id = NULL) {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
			
			$emailDistros = array();
			
			$dbh = lib_database::dbConnect();
			
			if(!empty($dbh)) {
				log_util::log(LOG_LEVEL_DEBUG, "dbh IS NOT empty");
				
				if($name !== NULL) {
					log_util::log(LOG_LEVEL_DEBUG, "Querying using name");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro WHERE name = ? ORDER BY name ASC");
					$stmt->bindParam(1, $name, PDO::PARAM_STR);
				} else if($id !==  NULL) {
					log_util::log(LOG_LEVEL_DEBUG, "Querying using id");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro WHERE id = ? ORDER BY name ASC");
					$stmt->bindParam(1, $id, PDO::PARAM_STR);
				} else {
					log_util::log(LOG_LEVEL_DEBUG, "Querying for all");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro ORDER BY name ASC");
				}
				$stmt->execute();
				$row = $stmt->fetch();
				
				if(!empty($row)) {
					log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty. row: ", $row);
		
					$emailDistroMembers = array();
					$emailDistro = new EmailDistro();
				
					$currentDistro = $row['name'];	
					$emailDistro->setName($row['name']);
					array_push($emailDistroMembers, $row['email']);
					
					log_util::log(LOG_LEVEL_DEBUG, "emailDistroMembers: ", $emailDistroMembers);
	
					while($row = $stmt->fetch()) {		
						
						log_util::log(LOG_LEVEL_DEBUG, "currentDistro: " . $currentDistro);
						log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);
					
						if($row['name'] != $currentDistro) {
							log_util::log(LOG_LEVEL_DEBUG, "currentDistro DID vary from " . $row['name']);
		
							$emailDistro->setEmails($emailDistroMembers);
							
							array_push($emailDistros, $emailDistro);
							
							$emailDistro = new EmailDistro();
							$emailDistroMembers = array();
							$currentDistro = $row['name'];
							$emailDistro->setName($row['name']);
							
							array_push($emailDistroMembers, $row['email']);
						} else {
							log_util::log(LOG_LEVEL_DEBUG, "currentDistro DID NOT  vary from " . $row['name']);
							array_push($emailDistroMembers, $row['email']);
						}
					
						$currentDistro = $row['name'];
						log_util::log(LOG_LEVEL_DEBUG, "currentDistro: " . $currentDistro);
						log_util::log(LOG_LEVEL_DEBUG, "emailDistroMembers: ", $emailDistroMembers);
					}
					
					$emailDistro->setEmails($emailDistroMembers);
					array_push($emailDistros, $emailDistro);
					
				} else {
					log_util::log(LOG_LEVEL_DEBUG, "row WAS empty");
				}
				
			} else {	
				log_util::log(LOG_LEVEL_DEBUG, "dbh IS empty");
			}
			
			$dbh = lib_database::dbDisconnect();
			
			log_util::log(LOG_LEVEL_DEBUG, "emailDistros: ", $emailDistros);
			log_util::logDivider();
			
			return $emailDistros;
		}
	}
?>