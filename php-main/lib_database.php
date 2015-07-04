<?php
	/**
	 *  This class houses functions related to getting, setting, and updating data in the database
	 */
	class lib_database {

		/**
		 *  This function connects to the database
		 *
		 *  @param - None
		 *
		 *  @return NULL|PDO
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes
		 *  	- Used internally by lib_database class to create and return a PDO connection
		 *  @example - $dbh = lib_database::connect();
		 *  @author  - Patches
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
         *  This function gets all of the annoyance levels
         *
         *  @param	- None
         *
         *  @return array of AnnoyanceLevel objects
         *  @throws - Nothing
         *  @global - None
         *  @notes  - None
         *  @example  - $dbh = lib_database::getAnnoyanceLevels();
         *  @author - Patches
         *  @version - 1.0
         *  @history - Created 07/03/2015
         */
		public static function getAnnoyanceLevels(){
            $reflector = new ReflectionClass(__CLASS__);
            $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
            $args = array();
            foreach($parameters as $parameter) {
                $args[$parameter->name] = ${$parameter->name};
            }
            log_util::logFunctionStart($args);

			$annoyanceLevels = array();

			$dbh = lib_database::connect();

			if(!empty($dbh))
			{
				log_util::log(LOG_LEVEL_DEBUG, "dnh IS NOT null");

				$stmt = $dbh->prepare("SELECT * FROM annoyance_levels ORDER BY level ASC");
				$stmt->execute();

                while($row = $stmt->fetch()) {
                    $annoyanceLevel = new AnnoyanceLevel();
                    $annoyanceLevel->setId($row['id']);
                    $annoyanceLevel->setName($row['name']);
                    $annoyanceLevel->setLevel($row['level']);
                    $annoyanceLevel->setIsDefault($row['isDefault']);

                    array_push($annoyanceLevels, $annoyanceLevel);
                }
			} else {
				log_util::log(LOG_LEVEL_DEBUG, "dbh WAS null");
			}

			$dbh = NULL;

			log_util::log(LOG_LEVEL_DEBUG, "annoyanceLevels: ", $annoyanceLevels);
			log_util::logDivider();

			return $annoyanceLevels;
		}

		/**
		 *  This gets all of the email distros
		 *  
		 *  @param None
		 *  
		 *  @return array of EmailDistro objects
		 *  @throws - Nothing
		 *  @global - None
		 *  @notes  - None
		 *  @example - $emailDistros = lib_database::getEmailDistros();
		 *  @author - Patches
		 *  @version - 1.0
		 *  @history - Created 07/03/2015
		 */
		public static function getEmailDistros() {
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
				
				$stmt = $dbh->prepare("SELECT * FROM email_distros LEFT JOIN email_distro_members ON email_distros.id = email_distro_members.distro ORDER BY name ASC");
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
			
			$dbh = NULL;
			
			log_util::log(LOG_LEVEL_DEBUG, "emailDistros: ", $emailDistros);
			log_util::logDivider();
			
			return $emailDistros;
		}

        /**
         *  This function gets all of the error report categories
         *
         *  @param None
         *
         *  @return array of ErrorReportCategory objects
         *  @throws - Nothing
         *  @global - None
         *  @notes  - None
         *  @example - $errorReportCategories = lib_database::getErrorReportCategories();
         *  @author - Patches
         *  @version - 1.0
         *  @history - Created 07/03/2015
         */
        public static function getErrorReportCategories() {
            $reflector = new ReflectionClass(__CLASS__);
            $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
            $args = array();
            foreach($parameters as $parameter) {
                $args[$parameter->name] = ${$parameter->name};
            }
            log_util::logFunctionStart($args);

            $dbh = lib_database::connect();

            $errorReportCategories = array();

            if(!empty($dbh)) {
                log_util::log(LOG_LEVEL_DEBUG, "dbh WAS NOT null");

                $stmt = $dbh->prepare("SELECT * FROM error_report_categories ORDER BY name ASC");
                $stmt->execute();

                while($row = $stmt->fetch()) {
                    $errorReportCategory = new ErrorReportCategory();
                    $errorReportCategory->setId($row['id']);
                    $errorReportCategory->setName($row['name']);
                    $errorReportCategory->setDistro($row['distro']);
                    $errorReportCategory->setIsDefault($row['isDefault']);

                    array_push($errorReportCategories, $errorReportCategory);
                }
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "dbh WAS null");
            }

            $dbh = NULL;

            log_util::log(LOG_LEVEL_DEBUG, "errorReportCategories", $errorReportCategories);
            log_util::logDivider();

            return $errorReportCategories;
        }


        /**
         *  This function gets a specific user
         *
         *  @param $id (optional) The id of the user to search for
         *  @param $email (optional) The email of the user to search for
         *  @param $userName (optional) The user name of the user to search for
         *
         *  @return User object
         *  @throws - Nothing
         *  @global - None
         *  @notes  - None
         *  @todo - Find a way to pass in a varying set of information and to make the search more flexible
         *
         *  @example - To get user by id: $user = lib_database::getUser(1);
         *  @example - To get user by email: $user = lib_database::getUser(NULL, "email@domain.com");
         *  @example - To get user by userName: $user = lib_database::getUser(NULL, NULL, "userName");
         *
         *  @author - Patches
         *  @version - 1.0
         *  @history - Created 07/03/2015
         */
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
				
				$dbh = NULL;
				
				log_util::log(LOG_LEVEL_DEBUG, "user: ", $user);
				log_util::logDivider();
				
				return $user;
		}
	}