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

            if (empty($dbh)) {
                log_util::log(LOG_LEVEL_DEBUG, "PDO connection was empty.  dbh: ", $pdo);
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "PDO connection succeeded. dbh: ", $pdo);
            }
        } catch (PDOException $e) {
            $pdo = null;
            log_util::log(LOG_LEVEL_ERROR, "An error occurred while establishing PDO connection", $e);
        }

        log_util::logDivider();

        return $pdo;
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS null");
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
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS null");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "errorReportCategories", $errorReportCategories);
        log_util::logDivider();

        return $errorReportCategories;
    }


    /**
     *  This function gets a specific user
     *
     * @param $id (optional) The id of the user to search for
     * @param $email (optional) The email of the user to search for
     * @param $userName (optional) The user name of the user to search for
     *
     * @return User object
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @todo - Find a way to pass in a varying set of information and to make the search more flexible
     *
     * @example - To get user by id: $user = lib_database::getUser(1);
     * @example - To get user by email: $user = lib_database::getUser(NULL, "email@domain.com");
     * @example - To get user by userName: $user = lib_database::getUser(NULL, NULL, "userName");
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getUser($id = NULL, $email = NULL, $userName = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $user = new User();

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT null");

            if ($id !== NULL) {
                log_util::log(LOG_LEVEL_DEBUG, "Query using id");
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->bindParam(1, $id, PDO::PARAM_STR);
            } else if ($email !== NULL) {
                log_util::log(LOG_LEVEL_DEBUG, "Query using email");
                $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
                $stmt->bindParam(1, $email, PDO::PARAM_INT);
            } else if ($userName !== NULL) {
                log_util::log(LOG_LEVEL_DEBUG, "Query using userName");
                $stmt = $pdo->prepare("SELECT * FROM users WHERE userName = ?");
                $stmt->bindParam(1, $userName, PDO::PARAM_INT);
            }
            if (!empty($stmt)) {
                log_util::log(LOG_LEVEL_WARNING, "stmt WAS NOT empty");
                $stmt->execute();
                $row = $stmt->fetch();

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
                log_util::log(LOG_LEVEL_WARNING, "stmt WAS empty");
            }

            if (!empty($row)) {
                log_util::log(LOG_LEVEL_WARNING, "row WAS NOT empty");

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
}