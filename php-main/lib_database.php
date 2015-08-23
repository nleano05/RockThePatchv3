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
     * @example - $dbh = lib_database::connect();
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

        $update = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("DELETE FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
        }

        $pdo = NULL;

        log_util::logDivider();
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
     * @example  - $dbh = lib_database::getAnnoyanceLevels();
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection IS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM annoyance_levels ORDER BY level ASC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $annoyanceLevel = new AnnoyanceLevel();
                $annoyanceLevel->setId($row['id']);
                $annoyanceLevel->setName($row['name']);
                $annoyanceLevel->setLevel($row['level']);
                $annoyanceLevel->setIsDefault($row['isDefault']);

                array_push($annoyanceLevels, $annoyanceLevel);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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
    public static function getEmailDistros() {
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM email_distros LEFT JOIN email_distro_members ON email_distros.id = email_distro_members.distro ORDER BY name ASC");
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
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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

        if(!empty($dbh)) {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT null");
            }

            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");

                $encryptionData = new EncryptionData();
                $encryptionData->setId($row['id']);
                $encryptionData->setIdentifier($row['identifier']);
                $encryptionData->setCipher($row['cipher']);
                $encryptionData->setKey($row['key']);
                $encryptionData->setIv($row['iv']);
                $encryptionData->setTime($row['time']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "$encryptionData: ", $encryptionData);
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
    public static function getErrorReportCategories() {
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM error_report_categories ORDER BY name ASC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $errorReportCategory = new ErrorReportCategory();
                $errorReportCategory->setId($row['id']);
                $errorReportCategory->setName($row['name']);
                $errorReportCategory->setDistro($row['distro']);
                $errorReportCategory->setIsDefault((bool)$row['isDefault']);

                array_push($errorReportCategories, $errorReportCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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
    public static function getFeatureRequestCategories() {
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM feature_request_categories ORDER BY name ASC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $featureRequestCategory = new FeatureRequestCategory();
                $featureRequestCategory->setId($row['id']);
                $featureRequestCategory->setName($row['name']);
                $featureRequestCategory->setDistro($row['distro']);
                $featureRequestCategory->setIsDefault((bool)$row['isDefault']);

                array_push($featureRequestCategories, $featureRequestCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId($row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "update: ", $update);
        log_util::logDivider();

        return $update;
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId($row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $update = new Update();
                $update->setId($row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);

                array_push($updates, $update);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
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
    public static function getUser($id = NULL, $userName = NULL, $email = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $user = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? OR email = ? OR userName = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $userName, PDO::PARAM_INT);
            $stmt->bindParam(3, $email, PDO::PARAM_INT);

            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");

                $user = new User();
                $user->setId($row['id']);
                $user->setFirstName($row['firstName']);
                $user->setLastName($row['lastName']);
                $user->setUserName($row['userName']);
                $user->setEmail($row['email']);
                $user->setPassword($row['password']);
                $user->setSecurityQuestion($row['securityQuestion']);
                $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                $user->setEmailBlasts((bool)$row['emailBlasts']);
                $user->setTextBlasts((bool)$row['textBlasts']);
                $user->setRole($row['role']);
                $user->setLastLoginAttempt($row['lastLoginAttempt']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "user: ", $user);
        log_util::logDivider();

        return $user;
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
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");
            }

            $stmt = $pdo->prepare("UPDATE encryption SET cipher=?, key=?, iv=?, time=? WHERE identifier = ?");
            $stmt->bindParam(1, $encryptionData->getCipher(), PDO::PARAM_STR);
            $stmt->bindParam(2, $encryptionData->getKey(), PDO::PARAM_STR);
            $stmt->bindParam(3, $encryptionData->getIv(), PDO::PARAM_STR);
            $stmt->bindParam(4, $encryptionData->getTime(), PDO::PARAM_STR);
            $stmt->bindParam(5, $encryptionData->getIdentifier(), PDO::PARAM_STR);
            $stmt->execute();

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
            }
        }

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("UPDATE recent_update SET title=?, text=?, date=? WHERE id = ?");
            $title = $update->getTitle();
            $text = $update->getText();
            $date = $update->getDate();
            $timestamp = date('Y-m-d H:i:s', strtotime($date));
            $id = $update->getId();
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $text, PDO::PARAM_STR);
            $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
            $stmt->bindParam(4, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
        }

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
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");
            }

            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $encryptionData->getIdentifier(), PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(empty($row)) {
                $stmt = $pdo->prepare("INSERT INTO encryption (identifier, cipher, key, iv, time) VALUE (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $encryptionData->getIdentifier(), PDO::PARAM_STR);
                $stmt->bindParam(2, $encryptionData->getCipher(), PDO::PARAM_STR);
                $stmt->bindParam(3, $encryptionData->getKey(), PDO::PARAM_STR);
                $stmt->bindParam(4, $encryptionData->getIv(), PDO::PARAM_STR);
                $stmt->bindParam(5, $encryptionData->getTime(), PDO::PARAM_STR);
                $stmt->execute();
            } else {
                lib_database::updateEncryptionData($encryptionData, $noDebugModeOutput);
            }

        } else {
            if(!$noDebugModeOutput) {
               log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $id = $update->getId();
            echo("<p>id: " . $id . "</p>");
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
           log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS null");
        }

        $pdo = NULL;

        log_util::logDivider();
    }
}