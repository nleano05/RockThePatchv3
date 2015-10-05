<?php

/**
 *  This class houses functions that check input and return true/false values
 */
class lib_check {

    /**
     *  This function uses preg_match to check if the given input matches a white list of characters
     *
     * @param string $input the string to check if it matches the white list
     *
     * @return bool
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $black = lib_check::againstWhiteList($input);
     * @author - Patches
     * @version - 1.0
     * @history - Created 09/12/2015
     */
    public static function againstWhiteList($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $black = FALSE;

        $whiteList = "/^[a-zA-Z0-9@-]/";

        $match = preg_match($whiteList, $input);

        if(!$match) {
            $black = TRUE;

            log_util::log(LOG_LEVEL_DEBUG, "input DOES NOT match the white list");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input DOES match the white list");
        }

        log_util::logDivider();

        return $black;
    }

    /**
     *  This function checks if debug mode should be disabled or enabled
     *
     * @param $enable boolean (optional) If debug mode is enabled or disabled
     * @param $careAboutAdmin boolean (optional) If we're only enabling debug mode for admin users
     *
     * @return boolean
     * @throws - Nothing
     * @global - None
     * @notes
     *    - To enable debug mode for all users $enable should be true and $careAboutAdmin false
     *    - To enable debug mode for ONLY admin users $enable should be set to true and $careAboutAdmin set to true
     *    - Defaults to debug mode being off
     *    - If enable if false, then debug mode remains off no matter what the value of $careAboutAdmin is
     * @example
     *    - $debugMode = lib_check::debugMode();
     *      if($debugMode) {
     *         // Do things
     *      }
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function debugMode($enable = FALSE, $careAboutAdmin = FALSE) {
        $debugEnable = FALSE;

        if ($careAboutAdmin) {
            $isAdmin = lib_check::userIsAdmin();
            if ($isAdmin) {
                $debugEnable = $enable;
            }
        } else {
            $debugEnable = $enable;
        }

        return $debugEnable;
    }

    /**
     *  This function checks if a string ends with another string
     *
     * @param string $needle The string to search for
     * @param string $haystack The string to search in
     *
     * @return bool
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $startsWith = lib_check::startsWith($needle, $haystack);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function endsWith($needle, $haystack) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        log_util::logDivider();

        return (substr($haystack, -$length) === $needle);
    }

    /**
     *  This function checks if the given input is empty
     *
     * @param string $input The string to check if empty
     *
     * @return bool
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $empty = lib_check::isEmpty($input);
     * @author - Patches
     * @version - 1.0
     * @history - Created 09/12/2015
     */
    public static function isEmpty($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $empty = FALSE;

        if(($input == "") || ($input == NULL) || !isset($input) || empty($input)) {
            $empty = TRUE;

            log_util::log(LOG_LEVEL_DEBUG, "input IS empty");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input IS NOT empty");
        }

        log_util::logDivider();

        return $empty;
    }

    public static function same($input1, $input2) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $same = FALSE;

        if($input1 == $input2) {
            $same = TRUE;

            log_util::log(LOG_LEVEL_DEBUG, "input1 IS the same as input2");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input1 IS NOT the same as input2");
        }

        log_util::log(LOG_LEVEL_DEBUG, "same: " . $same);
        log_util::logDivider();

        return $same;
    }

    /**
     *  This function checks if a string begins with another string
     *
     * @param string $needle The string to search for
     * @param string $haystack The string to search in
     *
     * @return bool
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $startsWith = lib_check::startsWith($needle, $haystack);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function startsWith($needle, $haystack) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);
        $length = strlen($needle);
        log_util::logDivider();
        return (substr($haystack, 0, $length) === $needle);
    }

    public static function stringLength($input, $length, $operator) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $result = FALSE;

        switch($operator) {
            case "<":
                log_util::log(LOG_LEVEL_DEBUG, "Operator is less than");
                if(strlen($input) < $length) {
                    $result = TRUE;
                }
                break;
            case ">":
                log_util::log(LOG_LEVEL_DEBUG, "Operator is greater than");
                if(strlen($input) > $length) {
                    $result = TRUE;
                }
                break;
            case "=":
                log_util::log(LOG_LEVEL_DEBUG, "Operator is equal");
                if(strlen($input) == $length) {
                    $result = TRUE;
                }
                break;
            case "<=":
                log_util::log(LOG_LEVEL_DEBUG, "Operator is less than or equal to");
                if(strlen($input) <= $length) {
                    $result = TRUE;
                }
                break;
            case ">=":
                log_util::log(LOG_LEVEL_DEBUG, "Operator is greater than or equal to");
                if(strlen($input) >= $length) {
                    $result = TRUE;
                }
                break;
            default:
                log_util::log(LOG_LEVEL_ERROR, "Invalid operator");
                $result = FALSE;
                break;
        }

        if($result) {
            log_util::log(LOG_LEVEL_DEBUG, strlen($input) . " " . $operator . " " . $length . " DID evaluate to true");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, strlen($input) . " " . $operator . " " . $length . " DID NOT evaluate to true");
        }
        log_util::logDivider();

        return $result;
    }

    public static function userInDb($id, $email, $userName, $password, $temp, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $userInDB = FALSE;

        $db = $temp ? "users_temp" : "users";
        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "db:" . $db);
        }

        $user = lib_database::getUser($id, $email, $userName, $password, $temp, $noDebugModeOutput);

        if($user != NULL) {
            log_util::log(LOG_LEVEL_DEBUG, "user WAS was in database");
            $userInDB = TRUE;
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "user WAS NOT in database");
        }

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "userInDB:" . $userInDB);
            log_util::logDivider();
        }
		
        return $userInDB;
    }

    /**
     *  This function checks if the currently logged in user is an admin
     *
     * @param None
     *
     * @return boolean
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $isAdmin = lib_check::userIsAdmin();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function userIsAdmin() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $isAdmin = FALSE;

        $user = lib_get::currentUser();

        if(!empty($user)) {
            if ($user->getRole() === ROLE_ADMIN) {
                log_util::log(LOG_LEVEL_DEBUG, "user WAS was an admin");
                $isAdmin = TRUE;
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "user WAS NOT an admin");
            }
        }

        log_util::logDivider();

        return $isAdmin;
    }


    public static function userIsLocked($userName, $email, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $user = lib_database::getUser(NULL, $email, $userName, NULL, FALSE, $noDebugModeOutput);

        $accountLock = new AccountLock();
        $accountLock->setLocked(FALSE);
        $accountLock->setType(LOCK_TYPE_NORMAL);
        $accountLock->setTimeLocked($user->getTimeLocked());
        if($user->getLocked()) {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "User IS locked");
            }

            if($user->getTimeLocked() != "00:00:00"){
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_DEBUG, "User WAS NOT locked by admin");
                }

                $timeDifference = strtotime(gmdate('Y/m/d H:i:s')) - strtotime($user->getTimeLocked());
                $accountLock->setTimeDifference($timeDifference);
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);
                }

                if($timeDifference >= (30 * 60)) {
                    if(!$noDebugModeOutput) {
                        log_util::log(LOG_LEVEL_DEBUG, "Unlocking user due to time");
                    }
                    $accountLock->setLocked(FALSE);
                }
            } else {
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_DEBUG, "User WAS locked by admin");
                }
                $accountLock->setType(LOCK_TYPE_ADMIN);
            }
        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "User IS NOT locked");
            }
        }

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "accountLock: ", $accountLock);
            log_util::logDivider();
        }

        return $accountLock;
    }

    public static function validEmail($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $validEmail = FALSE;
        $email = str_replace(' ', '', $input);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validEmail = TRUE;
            log_util::log(LOG_LEVEL_DEBUG, "input IS a valid email");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input IS NOT a valid email");
        }

        log_util::log(LOG_LEVEL_DEBUG, "validEmail: " . $validEmail);
        log_util::logDivider();

        return $validEmail;
    }

    public static function validPassword($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        global $gPasswordNotCharNum, $gPasswordTooShort, $gPasswordTooLong, $gPasswordNoCapitalLetter, $gPasswordNoLowercaseLetter, $gPasswordNoNumber;

        $gPasswordNotCharNum = $gPasswordTooShort = $gPasswordTooLong = $gPasswordNoCapitalLetter = $gPasswordNoLowercaseLetter = $gPasswordNoNumber = FALSE;

        if(ctype_alnum($input) // Check to make sure input is numbers and digits only
            && strlen($input) >= 7 // Check to make sure the input is at least 7 chars
            && strlen($input) < 21 // Check to make sure the input isn't more than 20 chars
            && preg_match('`[A-Z]`', $input) // Check for at least one upper case
            && preg_match('`[a-z]`', $input) // Check for at least one lower case
            && preg_match('`[0-9]`', $input)) // Check for at least one digit
        {
            $validPassword = TRUE;
            log_util::log(LOG_LEVEL_DEBUG, "The password IS considered a good password");
        } else {
            $validPassword = FALSE;

            log_util::log(LOG_LEVEL_DEBUG, "The password IS NOT considered a good password");


            if(!ctype_alnum($input)) {
                $gPasswordNotCharNum = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordNotCharNum: " . $gPasswordNotCharNum . "</p>");

            if(strlen($input) < 7) {
                $gPasswordTooShort = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordTooShort: " . $gPasswordTooShort . "</p>");

            if(strlen($input) > 20) {
                $gPasswordTooLong = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordTooLong: " . $gPasswordTooLong . "</p>");

            if(!preg_match('`[A-Z]`', $input)) {
                $gPasswordNoCapitalLetter = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordNoCapitalLetter: " . $gPasswordNoCapitalLetter . "</p>");

            if(!preg_match('`[a-z]`', $input)) {
                $gPasswordNoLowercaseLetter = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordNoLowercaseLetter: " . $gPasswordNoLowercaseLetter . "</p>");

            if(!preg_match('`[0-9]`', $input)) {
                $gPasswordNoNumber = TRUE;
            }
            log_util::log(LOG_LEVEL_DEBUG, "gPasswordNoNumber: " . $gPasswordNoNumber . "</p>");
        }

        log_util::logDivider();

        return $validPassword;
    }

    public static function validPhone($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $validPhone = FALSE;

        $pattern = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
        $result = preg_match($pattern, $input);

        if($result) {
            $validPhone = TRUE;
            log_util::log(LOG_LEVEL_DEBUG, "input IS a valid phone");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input IS NOT a valid phone");
        }

        log_util::log(LOG_LEVEL_DEBUG, "validPhone: " . $validPhone);
        log_util::logDivider();

        return $validPhone;
    }

    /**
     *  This function uses preg_match to check if a string matches a wild card search for another string
     *
     * @param string $needle The string to search for
     * @param string $haystack The string to search in
     *
     * @return bool
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $match = lib_check::wildCardSearch($needle, $haystack);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function wildCardSearch($needle, $haystack) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);
        $pattern = strtr($needle, [
            '*' => '.*?', // 0 or more (lazy) - asterisk (*)
            '?' => '.', // 1 character - question mark (?)
        ]);
        log_util::logDivider();
        return preg_match("/$pattern/", $haystack);
    }
}