<?php

/**
 *  This class houses functions that check input and return true/false values
 */
class lib_check {

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
    function startsWith($needle, $haystack) {
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

        if ($user->getRole() === ROLE_ADMIN) {
            log_util::log(LOG_LEVEL_DEBUG, "user WAS was an admin");
            $isAdmin = TRUE;
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "user WAS NOT an admin");
        }

        log_util::logDivider();

        return $isAdmin;
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
    function wildCardSearch($needle, $haystack) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);
        $pattern = strtr($needle, array(
            '*' => '.*?', // 0 or more (lazy) - asterisk (*)
            '?' => '.', // 1 character - question mark (?)
        ));
        log_util::logDivider();
        return preg_match("/$pattern/", $haystack);
    }
}