<?php

/**
 *  This class houses functions related to getting data that's not database related
 */
class lib_get {

    /**
     *  This function gets the callee of another function
     *
     * @param - None
     *
     * @return - Callee
     * @throws - Nothing
     * @global - None
     * @notes    - None
     * @example - lib_get::callee();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/02/2015
     */
    public static function callee() {
        $backtrace = debug_backtrace();
        return $backtrace[2]['function'];
    }

    /**
     *    This function gets and returns the current URL
     *
     * @param - None
     *
     * @return string $currentUrl
     * @throws - Nothing
     * @global - $gDebugMode, $gDebugFunctionColor, and $gDebugDivider
     * @notes - None
     * @example - lib_get::currentUrl();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/02/2015
     */
    public static function currentUrl() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $currentURL = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

        log_util::log(LOG_LEVEL_DEBUG, "currentURL: " . $currentURL);
        log_util::logDivider();

        return $currentURL;
    }
}