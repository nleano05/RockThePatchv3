<?php

/**
 *  This class houses functions related to getting data that's not database related
 */
class lib_get {

    public static function baseUrl() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $currentUrl = lib_get::currentUrl();
        if(strpos($currentUrl, "127.0.0.1") !== FALSE) {
            $baseUrl = "http://127.0.0.1/";
        } else if(strpos($currentUrl, "staging") !== FALSE) {
            $baseUrl = "https://staging.rockthepatch.com/";
        } else if(strpos($currentUrl, "integration") !== FALSE) {
            $baseUrl = "https://integration.rockthepatch.com/";
        } else if(strpos($currentUrl, "v3") !== FALSE) {
            $baseUrl = "https://v3.rockthepatch.com/";
        } else {
            $baseUrl = "https://rockthepatch.com/";
        }

        return $baseUrl;
    }
    
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
     *  This function returns the currently logged in user if any
     *
     * @param - None
     *
     * @return User|NULL
     * @throws - Nothing
     * @global - None
     * @notes - None
     * @example - lib_get::currentUser();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function currentUser(){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $loginStatusKey = isset($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) ? str_replace("_login", "", base64_decode($_COOKIE[COOKIE_LOGIN_STATUS_KEY])) : "";

        log_util::log(LOG_LEVEL_DEBUG, "loginStatusKey: " . $loginStatusKey);

        $currentUser = lib_database::getUser($loginStatusKey);

        log_util::log(LOG_LEVEL_DEBUG, "currentUser: ", $currentUser);
        log_util::logDivider();

        return $currentUser;
    }

    /**
     *  This function gets and returns the current URL
     *
     * @param - None
     *
     * @return string $currentUrl
     * @throws - Nothing
     * @global - None
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

    public static function gitHubIssues($state, $labels){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $curlSession = curl_init();
        $url = GITHUB_ISSUES_BASE_URL;
        if(!empty($state)){
            $url .=  "?state=" . $state;
            if(!empty($labels)){
                $url .= "&labels=" . $labels;
            }
        } else {
            if(!empty($lables)){
                $url .= "?labels" . $labels;
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "url: " . $url);

        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlSession, CURLOPT_HEADER,0);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            "Cache-Control: no-cache",
            "User-Agent: isuPatches-RockThePatch"
        );
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, $headers);
        $issues = curl_exec($curlSession);

        if($issues === false) {
            log_util::log(LOG_LEVEL_DEBUG, "Curl error: ", curl_error($curlSession));
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Operation completed without any errors");
        }

        curl_close($curlSession);

        log_util::log(LOG_LEVEL_DEBUG, "Issues: ", $issues);
        log_util::logDivider();

        return $issues;
    }

    public static function gitHubMilestones($state){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $curlSession = curl_init();
        $url = GITHUB_MILESTONES_BASE_URL;
        if(!empty($state)){
            $url .=  "?state=" . $state;
        }

        log_util::log(LOG_LEVEL_DEBUG, "url: " . $url);

        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlSession, CURLOPT_HEADER,0);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            "Cache-Control: no-cache",
            "User-Agent: isuPatches-RockThePatch"
        );
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, $headers);
        $milestones = curl_exec($curlSession);

        if($milestones === false) {
            log_util::log(LOG_LEVEL_DEBUG, "Curl error: ", curl_error($curlSession));
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Operation completed without any errors");
        }

        curl_close($curlSession);

        log_util::log(LOG_LEVEL_DEBUG, "Milestones: ", $milestones);
        log_util::logDivider();
        
        return $milestones;
    }

    /**
     *  This function returns the login status for the current user
     *
     * @param None
     *
     * @return string $loginStatus
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $loginStatus = lib_get::loginStatus();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function loginStatus(){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $loginStatusKey = isset($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) ? base64_decode($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) : NULL;

        $loginStatus = STATUS_LOGGED_OUT;
        if($loginStatusKey != NULL) {
            log_util::log(LOG_LEVEL_DEBUG, "id WAS NOT null");
            $loginStatus = lib::decrypt($loginStatusKey);
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "id WAS null");
        }

        log_util::log(LOG_LEVEL_DEBUG, "loginStatusKey: " . $loginStatusKey);
        log_util::log(LOG_LEVEL_DEBUG, "loginStatus: " . $loginStatus);

        log_util::logDivider();

        return $loginStatus;
    }

    /**
     *  This function returns the referer
     *
     * @param None
     *
     * @return string $referer
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $loginStatus = lib_get::referer();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/10/2015
     */
    public static function referer() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        if(isset($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        } else {
            $referer = null;
        }

        log_util::log(LOG_LEVEL_DEBUG, "referer: " . $referer);
        log_util::logDivider();

        return $referer;
    }
}