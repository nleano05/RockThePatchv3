<?php
	/**
	 *  This class houses functions related to getting, setting, and updating data in the database
	 */
	class lib_database {

		/**
		 *  This function connects to the database
		 *
		 *  @param	- None
		 *
		 *  @return NULL|PDO
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- Used internally by lib_database class to create and return a PDO connection
		 *  @example - $dbh = lib_database::dbConnect();
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		private static function connect() {
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
				log_util::log(LOG_LEVEL_ERROR, "An error occurred while establishing PDO connection", $e);
			}
			
			log_util::logDivider();
			
			return $dbh;
		}
		
		/**
		 *  This function clears the variable housing the database connection
		 *  
		 *  @param - None	 
		 *  
		 *  @return - NULL database connection
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- Used internally to return a NULL PDO connection
		 *  @example - $dbh = lib_database::dbDisconnect();
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		private static function disconnect() {
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
		 *  @param $name string (optional) The name of the email distro to pull from the database
		 *  @param $id int (optional) The id of the email distro to pull from the database	
		 *  
		 *  @return array of Email Distros
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- If no name or id is passed in, defaults to no WHERE clause and returning all distros
		 *  
		 *  @example - To get all distros: lib_database::getEmailDistros();
		 *  @example - To get distro by name: lib_database::getEmailDistros("Distro name");
		 *  @example - To get distro by id: lib_database::getEmailDistros(NULL, 1);
		 *  
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		public static function getEmailDistros($name = NULL, $id = NULL) {
			$reflector = new ReflectionClass(__CLASS__);
			$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
			$args = array();
			foreach($parameters as $parameter) {
				$args[$parameter->name] = ${$parameter->name};
			}
			log_util::logFunctionStart($args);
			
			$emailDistros = array();
			
			$dbh = lib_database::connect();
			
			if(!empty($dbh)) {
				log_util::log(LOG_LEVEL_DEBUG, "dbh IS NOT empty");
				
				if($name !== NULL) {
					log_util::log(LOG_LEVEL_DEBUG, "Query using name");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro WHERE name = ? ORDER BY name ASC");
					$stmt->bindParam(1, $name, PDO::PARAM_STR);
				} else if($id !==  NULL) {
					log_util::log(LOG_LEVEL_DEBUG, "Query using id");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro WHERE distro = ? ORDER BY name ASC");
					$stmt->bindParam(1, $id, PDO::PARAM_INT);
				} else {
					log_util::log(LOG_LEVEL_DEBUG, "Query for all");
					$stmt = $dbh->prepare("SELECT * FROM emailDistros LEFT JOIN emailDistroMembers ON emailDistros.id = emailDistroMembers.distro ORDER BY name ASC");
				}
				$stmt->execute();
				$row = $stmt->fetch();
				
				if(!empty($row)) {
					log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty. row: ", $row);
		
					$emailDistroMembers = array();
					$emailDistro = new EmailDistro();
				
					$currentDistro = $row['name'];	
					$emailDistro->setName($currentDistro);
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
							$emailDistro->setName($currentDistro);
							
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
					log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
				}
				
			} else {	
				log_util::log(LOG_LEVEL_ERROR, "dbh IS empty");
			}
			
			$dbh = lib_database::disconnect();
			
			log_util::log(LOG_LEVEL_DEBUG, "emailDistros: ", $emailDistros);
			log_util::logDivider();
			
			return $emailDistros;
		}
		
		public static function getUser($id = NULL, $email = NULL, $userName = NULL) {
				$reflector = new ReflectionClass(__CLASS__);
				$parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
				$args = array();
				foreach($parameters as $parameter) {
					$args[$parameter->name] = ${$parameter->name};
				}
				log_util::logFunctionStart($args);
				
				$user = new User();
				
				$dbh = lib_database::connect();
				
				if(!empty($dbh)) {
					log_util::log(LOG_LEVEL_DEBUG, "dbh IS NOT empty");
					
					if($id !== NULL) {
						log_util::log(LOG_LEVEL_DEBUG, "Query using id");
						$stmt = $dbh->prepare("SELECT * FROM users WHERE id = ?");
						$stmt->bindParam(1, $id, PDO::PARAM_STR);
					} else if($email !==  NULL) {
						log_util::log(LOG_LEVEL_DEBUG, "Query using email");
						$stmt = $dbh->prepare("SELECT * FROM users WHERE email = ?");
						$stmt->bindParam(1, $email, PDO::PARAM_INT);
					} else if($userName !== NULL) {
						log_util::log(LOG_LEVEL_DEBUG, "Query using userName");
						$stmt = $dbh->prepare("SELECT * FROM users WHERE userName = ?");
						$stmt->bindParam(1, $userName, PDO::PARAM_INT);
					}
                    if(!empty($stmt)) {
                        log_util::log(LOG_LEVEL_WARNING, "stmt WAS NOT empty");
                        $stmt->execute();
                        $row = $stmt->fetch();
                    } else {
                        log_util::log(LOG_LEVEL_WARNING, "stmt WAS empty");
                    }
					
					if(!empty($row)) {
						log_util::log(LOG_LEVEL_WARNING, "row WAS NOT empty");
						
					} else {
						log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
					}
				} else {	
					log_util::log(LOG_LEVEL_ERROR, "dbh IS empty");
				}
				
				$dbh = lib_database::disconnect();
				
				log_util::log(LOG_LEVEL_DEBUG, "user: ", $user);
				log_util::logDivider();
				
				return $user;
		}
	}