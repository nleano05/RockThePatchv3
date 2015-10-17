<?php

/**
 *  This class houses functions related to getting, setting, and updating data in the database
 */
class lib_database {

    /**
     *  This function connects to the database
     *
     * @param - None
     *
     * @return NULL|PDO
     * @throws - Nothing
     * @global - None
     * @notes
     *    - Used internally by lib_database class to create and return a PDO connection
     * @example - $pdo = lib_database::connect();
     * @author  - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    private static function connect() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        try {
            $pdo = new PDO(DB_HOST, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            $pdo = null;
            log_util::log(LOG_LEVEL_ERROR, "An error occurred while establishing PDO connection", $e);
        }

        log_util::logDivider();

        return $pdo;
    }

    public static function deleteUpdate($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteUser($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function getAccessToken($token, $clientSecret) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if(isset($token)){
                log_util::log(LOG_LEVEL_DEBUG, "Getting token by token");

                $stmt = $pdo->prepare("SELECT * FROM oauth WHERE accessToken = ?");
                $stmt->bindParam(1, $token, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();
            } else if(isset($clientSecret)){
                log_util::log(LOG_LEVEL_DEBUG, "Getting token by client secret");

                $stmt = $pdo->prepare("SELECT * FROM oauth WHERE clientSecret = ?");
                $stmt->bindParam(1, $clientSecret, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();
            }

            if(!empty($row)){
                log_util::log(LOG_LEVEL_WARNING, "row WAS NOT empty");

                $accessToken = new AccessToken();

                $accessToken->setId((int)$row['id']);
                $accessToken->setClientId($row['clientId']);
                $accessToken->setClientSecret($row['clientSecret']);
                $accessToken->setAccessToken($row['accessToken']);
                $accessToken->setTimeStamp($row['timeStamp']);
                $accessToken->setScope($row['scope']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "accessToken: ", $accessToken);
        log_util::logDivider();

        if(isset($accessToken)) {
            return $accessToken;
        }
    }

    /**
     *  This function gets all of the annoyance levels
     *
     * @param    - None
     *
     * @return array of AnnoyanceLevel objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example  - $annoyanceLevels = lib_database::getAnnoyanceLevels();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getAnnoyanceLevels() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $annoyanceLevels = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection IS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM annoyance_levels ORDER BY level ASC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $annoyanceLevel = new AnnoyanceLevel();
                $annoyanceLevel->setId((int)$row['id']);
                $annoyanceLevel->setName($row['name']);
                $annoyanceLevel->setLevel((int)$row['level']);
                $annoyanceLevel->setIsDefault((bool)$row['isDefault']);

                array_push($annoyanceLevels, $annoyanceLevel);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "annoyanceLevels: ", $annoyanceLevels);
        log_util::logDivider();

        return $annoyanceLevels;
    }

    /**
     *  This gets all of the email distros
     *
     * @param None
     *
     * @return array of EmailDistro objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $emailDistros = lib_database::getEmailDistros();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getEmailDistros($name = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $emailDistros = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($name != NULL) {
                $stmt = $pdo->prepare("SELECT * FROM email_distros LEFT JOIN email_distro_members ON email_distros.id = email_distro_members.distro WHERE name = ? ORDER BY name ASC");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM email_distros LEFT JOIN email_distro_members ON email_distros.id = email_distro_members.distro ORDER BY name ASC");
            }
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty. row: ", $row);

                $emailDistroMembers = [];
                $emailDistro = new EmailDistro();

                $currentDistro = $row['name'];
                $emailDistro->setName($currentDistro);
                array_push($emailDistroMembers, $row['email']);

                log_util::log(LOG_LEVEL_DEBUG, "emailDistroMembers: ", $emailDistroMembers);

                /** @noinspection PhpAssignmentInConditionInspection */
                while ($row = $stmt->fetch()) {

                    log_util::log(LOG_LEVEL_DEBUG, "currentDistro: " . $currentDistro);
                    log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

                    if ($row['name'] != $currentDistro) {
                        log_util::log(LOG_LEVEL_DEBUG, "currentDistro DID vary from " . $row['name']);

                        $emailDistro->setEmails($emailDistroMembers);

                        array_push($emailDistros, $emailDistro);

                        $emailDistro = new EmailDistro();
                        $emailDistroMembers = [];
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
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "emailDistros: ", $emailDistros);
        log_util::logDivider();

        return $emailDistros;
    }

    /**
     *  This
     *
     * @param string $identifier The identifier of the encryption object to get from the database
     * @param bool|null $noDebugModeOutput Whether or not to display output for debug mode if enabled
     *
     * @return EncryptionData|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - To get encryption data with output for debug mode if enabled: $encryptionData = lib_database::getEncryptionData($identifier);
     * @example - To get encryption data with no output even if debug mode is enabled: $encryptionData = lib_database::getEncryptionData($identifier, TRUE);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/10/2015
     */
    public static function getEncryptionData($identifier, $noDebugModeOutput = FALSE){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $encryptionData = NULL;

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");

                $encryptionData = new EncryptionData();
                $encryptionData->setId((int)$row['id']);
                $encryptionData->setIdentifier($row['identifier']);
                $encryptionData->setCipher($row['cipher']);
                $encryptionData->setKey($row['encryption_key']);
                $encryptionData->setIv($row['iv']);
                $encryptionData->setTime($row['encryption_time']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "encryptionData: ", $encryptionData);
        log_util::logDivider();

        return $encryptionData;
    }

    /**
     *  This function gets all of the error report categories
     *
     * @param None
     *
     * @return array of ErrorReportCategory objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $errorReportCategories = lib_database::getErrorReportCategories();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getErrorReportCategories($name = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $errorReportCategories = [];

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($name != NULL) {
                $stmt = $pdo->prepare("SELECT * FROM error_report_categories WHERE name = ? ORDER BY name ASC");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM error_report_categories ORDER BY name ASC");
            }
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $errorReportCategory = new ErrorReportCategory();
                $errorReportCategory->setId((int)$row['id']);
                $errorReportCategory->setName($row['name']);
                $errorReportCategory->setDistro((int)$row['distro']);
                $errorReportCategory->setIsDefault((bool)$row['isDefault']);

                array_push($errorReportCategories, $errorReportCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "errorReportCategories", $errorReportCategories);
        log_util::logDivider();

        return $errorReportCategories;
    }

    /**
     *  This function gets all of the feature request categories
     *
     * @param None
     *
     * @return array of FeatureRequestCategory objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $featureRequestCategories = lib_database::getFeatureRequestCategories();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function getFeatureRequestCategories($name = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $featureRequestCategories = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

			if($name != NULL) {
                $stmt = $pdo->prepare("SELECT * FROM feature_request_categories WHERE name = ? ORDER BY name ASC");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM feature_request_categories ORDER BY name ASC");
            }
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $featureRequestCategory = new FeatureRequestCategory();
                $featureRequestCategory->setId((int)$row['id']);
                $featureRequestCategory->setName($row['name']);
                $featureRequestCategory->setDistro((int)$row['distro']);
                $featureRequestCategory->setIsDefault((bool)$row['isDefault']);

                array_push($featureRequestCategories, $featureRequestCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "featureRequestCategories: ", $featureRequestCategories);
        log_util::logDivider();

        return $featureRequestCategories;
    }

    /**
     *  This function gets the most recent update from the database
     *
     * @param None
     *
     * @return Update|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $update = lib_database::getMostRecentUpdate();
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/22/2015
     */
    public static function getMostRecentUpdate() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $update = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "update: ", $update);
        log_util::logDivider();

        return $update;
    }

    public static function getSecurityQuestionById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM security_questions WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestion: ", $securityQuestion);
        log_util::logDivider();

        return $securityQuestion;
    }

    public static function getSecurityQuestions() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $securityQuestions = array();

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            $stmt = $pdo->prepare("SELECT * FROM security_questions");
            $stmt->execute();

            while($row = $stmt->fetch()) {
                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);

                array_push($securityQuestions, $securityQuestion);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestions: ", $securityQuestions);
        log_util::logDivider();

        return $securityQuestions;
    }

    /**
     *  This function gets an update based on unique id from the database
     *
     * @param None
     *
     * @return Update|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $update = lib_database::getUpdateById($id);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function getUpdateById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $update = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "update: ", $update);
        log_util::logDivider();

        return $update;
    }

    /**
     *  This function returns all of the updates from the database
     *
     * @param None
     *
     * @return array of Update objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $updates = lib_database::getUpdates();
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/02/2015
     */
    public static function getUpdates() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $updates = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);

                array_push($updates, $update);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "updates: ", $updates);
        log_util::logDivider();

        return $updates;
    }


    /**
     *  This function gets a specific user based off unique fields
     *
     * @param $id (optional) The id of the user to search for
     * @param $email (optional) The email of the user to search for
     * @param $userName (optional) The user name of the user to search for
     * @param $password (optional)
     * @param $temp (optional)
     * @param $temp (optional)
     *
     * @return User|NULL
     * @throws - Nothing
     * @global - None
     * @notes  - None
     *
     * @example - To get user by id: $user = lib_database::getUser(1);
     * @example - To get user by email: $user = lib_database::getUser(NULL, "email@domain.com");
     * @example - To get user by userName: $user = lib_database::getUser(NULL, NULL, "userName");
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getUser($id = NULL, $email = NULL, $userName = NULL, $password = NULL, $temp = FALSE, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $user = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
			
            $db = $temp ? "users_temp" : "users";
			
            $stmt = $pdo->prepare("SELECT * FROM " . $db . " WHERE id = ? OR email = ? OR userName = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $email, PDO::PARAM_INT);
            $stmt->bindParam(3, $userName, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                }

                if($password != NULL) {
                    $id = $row['id'];

                    $decryptedPassword = lib::decrypt($id . "_pass", $noDebugModeOutput);
                    if(!$noDebugModeOutput) {
                        log_util::log(LOG_LEVEL_DEBUG, "id: " . $id);
                        log_util::log(LOG_LEVEL_DEBUG, "decryptedPassword: " . $decryptedPassword);
                    }

                    if(($decryptedPassword === $password) || ($decryptedPassword === $password)){
                        if(!$noDebugModeOutput) {
                            if(!$noDebugModeOutput) {
                                log_util::log(LOG_LEVEL_DEBUG, "Password DID match one of the decrypted passwords");
                            }
                        }

                        $user = new User();
                        $user->setId((int)$row['id']);
                        $user->setFirstName($row['firstName']);
                        $user->setLastName($row['lastName']);
                        $user->setUserName($row['userName']);
                        $user->setEmail($row['email']);
                        $user->setPassword($row['password']);
                        $user->setSecurityQuestion((int)$row['securityQuestion']);
                        $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                        $user->setEmailBlasts((bool)$row['emailBlasts']);
                        $user->setTextBlasts((bool)$row['textBlasts']);
						$user->setCell($row['cell']);
                        $user->setRole((int)$row['role']);
                        $user->setLocked((bool)$row['locked']);
                        $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                        $user->setTimeLocked($row['timeLocked']);
                        $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                        $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);
                    } else {
                        if(!$noDebugModeOutput) {
                            if(!$noDebugModeOutput) {
                                log_util::log(LOG_LEVEL_DEBUG, "Password DID NOT match one of the decrypted passwords");
                            }
                        }
                    }
                } else {
                    $user = new User();
                    $user->setId((int)$row['id']);
                    $user->setFirstName($row['firstName']);
                    $user->setLastName($row['lastName']);
                    $user->setUserName($row['userName']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setSecurityQuestion((int)$row['securityQuestion']);
                    $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                    $user->setEmailBlasts((bool)$row['emailBlasts']);
                    $user->setTextBlasts((bool)$row['textBlasts']);
					$user->setCell($row['cell']);
                    $user->setRole((int)$row['role']);
                    $user->setLocked((bool)$row['locked']);
                    $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                    $user->setTimeLocked($row['timeLocked']);
                    $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                    $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);
                }
            } else {
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
                }
            }
        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "user: ", $user);
            log_util::logDivider();
        }
		
        return $user;
    }

    public static function getUsers($status, $sessionExpired = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $users = array();
        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM users");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                    log_util::log(LOG_LEVEL_DEBUG, "row IS NOT empty");
                    log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

                    $id = isset($row['id']) ? $row['id'] : "";
                    $loginStatusFromDatabase = lib::decrypt($id . "_login");

                    log_util::log(LOG_LEVEL_DEBUG, "id: " . $id);
                    log_util::log(LOG_LEVEL_DEBUG, "loginStatusFromDatabase: ". $loginStatusFromDatabase);

                    $user = new User();
                    $user->setId((int)$row['id']);
                    $user->setFirstName($row['firstName']);
                    $user->setLastName($row['lastName']);
                    $user->setUserName($row['userName']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setSecurityQuestion((int)$row['securityQuestion']);
                    $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                    $user->setEmailBlasts((bool)$row['emailBlasts']);
                    $user->setTextBlasts((bool)$row['textBlasts']);
                    $user->setCell($row['cell']);
                    $user->setRole((int)$row['role']);
                    $user->setLocked((bool)$row['locked']);
                    $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                    $user->setTimeLocked($row['timeLocked']);
                    $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                    $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);

                    $currentTime = gmdate('Y/m/d H:i:s');
                    log_util::log(LOG_LEVEL_DEBUG, "currentTime: " . $currentTime);

                    $timeDifference = strtotime($currentTime) - strtotime($user->getLastLoginAttemptTime());
                    log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

                    if($status == STATUS_LOGGED_IN && $loginStatusFromDatabase == STATUS_LOGGED_IN) {
                        if($timeDifference < (60 * 60)) {
                            log_util::log(LOG_LEVEL_DEBUG, "User WAS logged in AND session HAS NOT expired");

                            if(!$sessionExpired) {
                                array_push($users, $user);
                            }
                        } else {
                            log_util::log(LOG_LEVEL_DEBUG, "User WAS logged in BUT session HAS expired");

                            if($sessionExpired) {
                                array_push($users, $user);
                            }
                        }
                    }

                    if($status == STATUS_LOGGED_OUT && $loginStatusFromDatabase == STATUS_LOGGED_OUT) {
                        array_push($users, $user);
                    }
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "Users: ", $users);
        log_util::logDivider();

        return $users;
    }

    public static function getUsersSecurityQuestion($userNameOrEmail) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();
        $securityQuestion = NULL;

        if(!empty($pdo)) {
            $stmt = $pdo->prepare("SELECT * FROM users INNER JOIN security_questions ON users.securityQuestion = security_questions.id WHERE email = ? OR userName = ?");
            $stmt->bindParam(1, $userNameOrEmail, PDO::PARAM_STR);
            $stmt->bindParam(2, $userNameOrEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_ERROR, "row WAS NOT empty");

                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestion: ", $securityQuestion);
        log_util::logDivider();

        return $securityQuestion;
    }

    public static function migrateUser($email, $userName, $firstName, $lastName) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $user = lib_database::getUser(NULL, $email, $userName, NULL, TRUE);
			
            if($user != NULL) {
                log_util::log(LOG_LEVEL_ERROR, "row WAS NOT empty");

                $firstNameMigrate = $user->getFirstName();
                $lastNameMigrate = $user->getLastName();
                $userNameMigrate = $user->getUserName();
                $emailMigrate = $user->getEmail();
                $passwordMigrate = $user->getPassword();
                $securityQuestionMigrate = $user->getSecurityQuestion();
                $securityQuestionAnswerMigrate = $user->getSecurityQuestionAnswer();
                $emailBlastsMigrate = $user->getEmailBlasts();
                $textBlastsMigrate = $user->getTextBlasts();
                $cellMigrate = $user->getCell();
                $roleMigrate = $user->getRole();

                $stmt = $pdo->prepare("INSERT INTO users (firstName, lastName, userName, email, password, securityQuestion, securityQuestionAnswer, emailBlasts, textBlasts, cell, role) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $firstNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(3, $userNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(4, $emailMigrate, PDO::PARAM_STR);
                $stmt->bindParam(5, $passwordMigrate, PDO::PARAM_STR);
                $stmt->bindParam(6, $securityQuestionMigrate, PDO::PARAM_INT);
                $stmt->bindParam(7, $securityQuestionAnswerMigrate, PDO::PARAM_STR);
                $stmt->bindParam(8, $emailBlastsMigrate, PDO::PARAM_INT);
                $stmt->bindParam(9, $textBlastsMigrate, PDO::PARAM_INT);
                $stmt->bindParam(10, $cellMigrate, PDO::PARAM_STR);
                $stmt->bindParam(11, $roleMigrate, PDO::PARAM_INT);
                $stmt->execute();

				$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
                $stmt->execute();
				$row = $stmt->fetch();
			
				$decryptedPassword = lib::decrypt($emailMigrate . "_registration");
				$encryptedPassword = lib::encrypt($decryptedPassword, $row['id'] . "_pass");
				
				$stmt = $pdo->prepare("UPDATE users SET password=? WHERE id = ?");
				$stmt->bindParam(1, $encryptedPassword, PDO::PARAM_STR);
				$stmt->bindParam(2, $row['id'], PDO::PARAM_STR);
				$stmt->execute();

                $stmt = $pdo->prepare("DELETE FROM users_temp WHERE email = ? OR userName = ?");
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->bindParam(2, $userName, PDO::PARAM_STR);
                $stmt->execute();
            } else {
				
                log_util::log(LOG_LEVEL_ERROR, "user WAS null");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateAccessToken($clientSecret) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $token = lib::generateToken();

        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $timeStamp = gmdate("Y/m/d H:i:s");
        log_util::log(LOG_LEVEL_DEBUG, "timeStamp: " . $timeStamp);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE oauth SET accessToken=?, timeStamp=? WHERE clientSecret=?");
            $stmt->bindParam(1, $token, PDO::PARAM_INT);
            $stmt->bindParam(2, $timeStamp, PDO::PARAM_INT);
            $stmt->bindParam(3, $clientSecret, PDO::PARAM_INT);
            $stmt->execute();

            $accessToken = lib_database::getAccessToken($token, null);

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();

        if(isset($accessToken)) {
            return $accessToken;
        }
    }

    /**
     *  This function writes encryption data out to the database
     *
     * @param EncryptionData $encryptionData The encryption data to be updated
     * @param bool|NULL $noDebugModeOutput If debug mode output is echoed out or not
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes  - None
     *
     * @example - To update encryption data with debugMode output (if enabled) = lib_database::updateEncryptionData($encryptionData);
     * @example - To update encryption data with no debugMode output = lib_database::updateEncryptionData($encryptionData, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function updateEncryptionData(EncryptionData $encryptionData, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $identifier = $encryptionData->getIdentifier();
            $cipher = $encryptionData->getCipher();
            $key = $encryptionData->getKey();
            $iv = $encryptionData->getIv();
            $time = $encryptionData->getTime();

            $stmt = $pdo->prepare("UPDATE encryption SET cipher=?, encryption_key=?, iv=?, encryption_time=? WHERE identifier = ?");
            $stmt->bindParam(1, $cipher, PDO::PARAM_STR);
            $stmt->bindParam(2, $key, PDO::PARAM_STR);
            $stmt->bindParam(3, $iv, PDO::PARAM_STR);
            $stmt->bindParam(4, $time, PDO::PARAM_STR);
            $stmt->bindParam(5, $identifier, PDO::PARAM_STR);
            $stmt->execute();

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
    }

    public static function updateUserLockAttributes($id, $passed) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $lastLoginAttemptTime = gmdate("Y-m-d H:i:s");

        log_util::log(LOG_LEVEL_DEBUG, "lastLoginAttemptTime: " . $lastLoginAttemptTime);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if(!$passed) {
                $user = lib_database::getUser($id);

                $consecutiveFailedLoginAttemptsFromDB = $user->getConsecutiveFailedLoginAttempts();
                $timeLockedFromDB = $user->getTimeLocked();

                log_util::log(LOG_LEVEL_DEBUG, "consecutiveFailedLoginAttemptsFromDB: " . $consecutiveFailedLoginAttemptsFromDB);
                log_util::log(LOG_LEVEL_DEBUG, "timeLockedFromDB: " . $timeLockedFromDB);

                if(! $user->getLockedByAdmin()) {
                    log_util::log(LOG_LEVEL_DEBUG, "User WAS NOT locked by administrator");

                    if($consecutiveFailedLoginAttemptsFromDB < 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Below max consecutive number of failed login attempts");
                        $locked = FALSE;
                        $lockedByAdmin = FALSE;
                        $timeLocked = "";
                        $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                    } else if($consecutiveFailedLoginAttemptsFromDB == 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Reached max consecutive number of failed login attempts, locking user");
                        $locked = TRUE;
                        $lockedByAdmin = FALSE;
                        $timeLocked = gmdate('Y/m/d H:i:s');
                        $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                    }  else if($consecutiveFailedLoginAttemptsFromDB > 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Exceeded max consecutive number of failed login attempts");
                        $timeDifference = strtotime(gmdate('Y/m/d H:i:s')) - strtotime($timeLockedFromDB);
                        log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

                        if($timeDifference >= (30 * 60)) {
                            log_util::log(LOG_LEVEL_DEBUG, "timeDifference IS greater than 30 minutes...unlocking the user");
                            $locked = FALSE;
                            $lockedByAdmin = FALSE;
                            $consecutiveFailedLoginAttempts = 0;
                            $timeLocked = "";
                        } else {
                            log_util::log(LOG_LEVEL_DEBUG, "timeDifference IS NOT greater than 30 minutes...NOT unlocking the user");
                            $locked = TRUE;
                            $lockedByAdmin = FALSE;
                            $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                            $timeLocked = $timeLockedFromDB;
                        }
                    }
                } else {
                    log_util::log(LOG_LEVEL_DEBUG, "user WAS locked by administrator");
                    $locked = TRUE;
                    $lockedByAdmin = TRUE;
                    $timeLocked = "00:00:00";
                    $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                }
            } else {
                $locked = FALSE;
                $lockedByAdmin = FALSE;
                $timeLocked = "";
                $consecutiveFailedLoginAttempts = 0;
            }

            $locked = (int) $locked;
            $lockedByAdmin = (int) $lockedByAdmin;

            log_util::log(LOG_LEVEL_DEBUG, "locked: " . $locked);
            log_util::log(LOG_LEVEL_DEBUG, "timeLocked: " . $timeLocked);
            log_util::log(LOG_LEVEL_DEBUG, "consecutiveFailedLoginAttempts" . $consecutiveFailedLoginAttempts);

            $stmt = $pdo->prepare("UPDATE users SET locked=?, lockedByAdmin=?, timeLocked=?, consecutiveFailedLoginAttempts=?, lastLoginAttemptTime=? WHERE id = ?");
            $stmt->bindParam(1, $locked, PDO::PARAM_INT);
            $stmt->bindParam(2, $lockedByAdmin, PDO::PARAM_INT);
            $stmt->bindParam(3, $timeLocked, PDO::PARAM_STR);
            $stmt->bindParam(4, $consecutiveFailedLoginAttempts, PDO::PARAM_INT);
            $stmt->bindParam(5, $lastLoginAttemptTime, PDO::PARAM_STR);
            $stmt->bindParam(6, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;
        log_util::logDivider();
    }

    /**
     *  This function updates an update in the database
     *
     * @param Update $update The update to be updated
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes - None
     * @example - lib_database::update($update);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function updateUpdate(Update $update) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE recent_updates SET title=?, text=?, date=? WHERE id = ?");
            $title = $update->getTitle();
            $text = $update->getText();
            $date = $update->getDate();
            $id = $update->getId();
            $timestamp = date('Y-m-d H:i:s', strtotime($date));
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $text, PDO::PARAM_STR);
            $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
            $stmt->bindParam(4, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateUser($id, $firstName, $lastName, $userName, $email, $password, $securityQuestion, $securityQuestionAnswer, $emailBlasts, $textBlasts, $cellPhone) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE users SET firstName=?, lastName=?, userName=?, email=?, password=?, securityQuestion=?, securityQuestionAnswer=?, emailBlasts=?, textBlasts=?, cell=? WHERE id = ?");
            $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $password, PDO::PARAM_STR);
            $stmt->bindParam(6, $securityQuestion, PDO::PARAM_INT);
            $stmt->bindParam(7, $securityQuestionAnswer, PDO::PARAM_STR);
            $stmt->bindParam(8, $emailBlasts, PDO::PARAM_INT);
            $stmt->bindParam(9, $textBlasts, PDO::PARAM_INT);
            $stmt->bindParam(10, $cellPhone, PDO::PARAM_STR);
            $stmt->bindParam(11, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateUserPassword($id, $newPassword) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $encryptedPassword = lib::encrypt($newPassword, $id . "_pass");

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bindParam(1, $encryptedPassword, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    /**
     *  This function writes encryption data out to the database
     *
     * @param EncryptionData $encryptionData The encryption data to be written out
     * @param bool|NULL $noDebugModeOutput If debug mode output is echoed out or not
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes
     *      - Calls lib_database::updateEncryptionData() if there is already an entry for the identifier
     * @example - To write encryption data with debugMode output (if enabled) = lib_database::writeEncryptionData($encryptionData);
     * @example - To write encryption data with no debugMode output = lib_database::writeEncryptionData($encryptionData, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function writeEncryptionData(EncryptionData $encryptionData, $noDebugModeOutput = FALSE){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $identifier = $encryptionData->getIdentifier();
            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(empty($row)) {
                $cipher = $encryptionData->getCipher();
                $key = $encryptionData->getKey();
                $iv = $encryptionData->getIv();
                $time = $encryptionData->getTime();
                $stmt = $pdo->prepare("INSERT INTO encryption (identifier, cipher, encryption_key, iv, encryption_time) VALUE (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
                $stmt->bindParam(2, $cipher, PDO::PARAM_STR);
                $stmt->bindParam(3, $key, PDO::PARAM_STR);
                $stmt->bindParam(4, $iv, PDO::PARAM_STR);
                $stmt->bindParam(5, $time, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                lib_database::updateEncryptionData($encryptionData, $noDebugModeOutput);
            }

        } else {
            if(!$noDebugModeOutput) {
               log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
    }

    public static function writeLoginLogAndStatistics($id, $passed) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM login_statistics WHERE userId = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                $attempts = $row['attempts'] + 1;
                if($passed) {
                    $succeeded = $row['succeeded'] + 1;
                    $failed = $row['failed'];
                } else {
                    $succeeded = $row['succeeded'];
                    $failed = $row['failed'] + 1;
                }

                $stmt = $pdo->prepare("UPDATE login_statistics SET attempts=?, failed=?, succeeded=? WHERE userId = ?");
                $stmt->bindParam(1, $attempts, PDO::PARAM_INT);
                $stmt->bindParam(2, $failed, PDO::PARAM_INT);
                $stmt->bindParam(3, $succeeded, PDO::PARAM_INT);
                $stmt->bindParam(4, $id, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                $attempts = 1;
                if($passed) {
                    $succeeded = 1;
                    $failed = 0;
                } else {
                    $succeeded = 0;
                    $failed = 1;
                }

                $stmt = $pdo->prepare("INSERT INTO login_statistics (userId, attempts, failed, succeeded) VALUE (?, ?, ?, ?)");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $attempts, PDO::PARAM_INT);
                $stmt->bindParam(3, $failed, PDO::PARAM_INT);
                $stmt->bindParam(4, $succeeded, PDO::PARAM_INT);
                $stmt->execute();
            }

            $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
            $time = gmdate('Y/m/d H:i:s');

            $passed = (int) $passed;

            $stmt = $pdo->prepare("INSERT INTO login_log (userId, success, loginTime) VALUE (?, ?, ?)");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $passed, PDO::PARAM_INT);
            $stmt->bindParam(3, $time, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    /**
     *  This function writes update data out to the database
     *
     * @param Update $update The update data to be written
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes
     *  - Calls lib_database::updateUpdate() if there is already an entry for the update id
     * @example - lib_database::writeUpdate($update);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function writeUpdate(Update $update){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $id = $update->getId();
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(empty($row)) {
                $stmt = $pdo->prepare("INSERT INTO recent_updates (title, text, date) VALUE (?, ?, ?)");
                $title = $update->getTitle();
                $text = $update->getText();
                $date = $update->getDate();
                $timestamp = date('Y-m-d H:i:s', strtotime($date));
                $stmt->bindParam(1, $title, PDO::PARAM_STR);
                $stmt->bindParam(2, $text, PDO::PARAM_STR);
                $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                lib_database::updateUpdate($update);
            }

        } else {
           log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeUsersTemp($firstName, $lastName, $userName, $email, $password, $securityQuestion, $answer, $emailBlasts, $textBlasts, $cell, $role) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $dbh = lib_database::connect();

        if(!empty($dbh)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $exists = lib_check::userInDb(NULL, $email, $userName, NuLL, TRUE);

            if(!$exists) {
                log_util::log(LOG_LEVEL_ERROR, "user DOES NOT exist");

                $encryptedPassword = lib::encrypt($password, $email . "_registration");

                $stmt = $dbh->prepare("INSERT INTO users_temp (firstName, lastName, userName, email, password, securityQuestion, securityQuestionAnswer, emailBlasts, textBlasts, cell, role) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
                $stmt->bindParam(3, $userName, PDO::PARAM_STR);
                $stmt->bindParam(4, $email, PDO::PARAM_STR);
                $stmt->bindParam(5, $encryptedPassword, PDO::PARAM_STR);
                $stmt->bindParam(6, $securityQuestion, PDO::PARAM_INT);
                $stmt->bindParam(7, $answer, PDO::PARAM_STR);
                $stmt->bindParam(8, $emailBlasts, PDO::PARAM_INT);
                $stmt->bindParam(9, $textBlasts, PDO::PARAM_INT);
                $stmt->bindParam(10, $cell, PDO::PARAM_STR);
                $stmt->bindParam(11, $role, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                log_util::log(LOG_LEVEL_ERROR, "user DOES exist");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }
}