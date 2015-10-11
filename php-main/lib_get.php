<?php

/**
 *  This class houses functions related to getting data that's not database related
 */
class lib_get {

    public static function agent($agentOverride = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $agents = array("Navigator" => "/Navigator(.*)/i",
            "SeaMonkey" => "/SeaMonkey(.*)/i",
            "rekonq" => "/rekonq(.*)/i",
            "SurveyBot" => "/SurveyBot(.*)/i",
            "Firefox" => "/Firefox(.*)/i",
            "W3C Validator" => "/W3C_Validator(.*)/i",
            "Internet Explorer" => array("/MSIE(.*)/i", "/rv(.*)/i"),
            "Epiphany" => "/Epiphany(.*)/i",
            "Midori" => "/Midori(.*)/i",
            "Opera" => array("/Opr(.*)/i", "/Opera(.*)/i"),
            "Chromium" => "/Chromium(.*)/i",
            "Google Chrome" => "/chrome(.*)/i",
            "MAXTHON" => "/MAXTHON(.*)/i",
            "Arora" => "/Arora(.*)/i",
            "Mobile Safari" => "/Mobile Safari(.*)/i",
            "Safari" => "/Safari(.*)/i",
            "w3m" => "/w3m(.*)/i",
            "Lynx" => "/Lynx(.*)/i",
            "ELinks" => "/ELinks(.*)/i",
            "Links" => "/Links(.*)/i",
            "Uzbl" => "/Uzbl(.*)/i",
            "NetSurf" => "/NetSurf(.*)/i",
            "Konqueror" => "/Konqueror(.*)/i",
            "Dillo" => "/Dillo(.*)/i",
            "bingbot" => "/bingbot(.*)/i",
            "YandexBot" => "/YandexBot(.*)/i",
            "PECL::HTTP" => "/PECL::HTTP(.*)/i",
            "Baiduspider" => "/Baiduspider(.*)/i",
            "Googlebot" => "/Googlebot(.*)/i",
            "PyCrawler" => "/PyCrawler(.*)/i",
            "Python-urllib" => "/Python-urllib(.*)/i",
            "ScreenerBot Crawler Beta" => "/ScreenerBot Crawler Beta(.*)/i",
            "AhrefsBot" => "/AhrefsBot(.*)/i",
            "MSNBot" => "/msnbot(.*)/i",
            "Facebook Externalhit" => "/facebookexternalhit(.*)/i",
            "Spbot" => "/spbot(.*)/i",
            "Linkdexbot" => "/linkdexbot(.*)/i",
            "Jigsaw" => "/Jigsaw(.*)/i",
            "MJ12bot" => "/MJ12bot(.*)/i",
            "Wget" => "/Wget(.*)/i",
            "Mail.RU_Bot" => "/Mail.RU_Bot(.*)/i",
            "SeznamBot" => "/SeznamBot(.*)/i",
            "Classbot" => "/classbot(.*)/i",
            "aiHitBot" => "/aiHitBot(.*)/i",
            "CATExplorador" => "/CATExplorador(.*)/i",
            "EasouSpider" => "/EasouSpider(.*)/i",
            "Twitterbot" => "/Twitterbot(.*)/i",
            "sees.co bot" => "/sees.co bot(.*)/i",
            "hrbot" => "/hrbot(.*)/i",
            "NerdyBot" => "/NerdyBot(.*)/i",
            "LSSRocketCrawler" => "/LSSRocketCrawler(.*)/i",
            "Comodo-Webinspector-Crawler" => "/Comodo-Webinspector-Crawler(.*)/i",
            "Xenu Link Sleuth" => "/Xenu Link Sleuth(.*)/i",
            "DBot" => "/DBot(.*)/i",
            "FeedValidator" => "/FeedValidator(.*)/i"
        );

        log_util::log(LOG_LEVEL_DEBUG, "agents: ", $agents);

        if(!$agentOverride) {
            if(isset($_SERVER['HTTP_USER_AGENT'])) {
                $fullAgent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $fullAgent = "";
            }
        } else {
            echo("<p>Overriding agent...<br/>");
            echo("Agent Override: " . $agentOverride . "</p>");

            $fullAgent = $agentOverride;
        }

        log_util::log(LOG_LEVEL_DEBUG, "fullAgent: " . $fullAgent);

        $agentInfo = array();

        if(lib_check::isEmpty($fullAgent)) {
            log_util::log(LOG_LEVEL_DEBUG, "Full agent WAS empty");
            $agentInfo = array_merge($agentInfo, array("Agent" => "Unknown Agent - Full agent not set"));
            $agentInfo = array_merge($agentInfo, array("Version" => "Unknown Agent Version - Full agent not set"));
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Full agent WAS NOT empty");
            foreach($agents as $key => $value) {
                log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
                log_util::log(LOG_LEVEL_DEBUG, "value: ", $value);

                $found = false;

                if(is_string($value)) {
                    $value = array($value);
                }

                foreach($value as $pattern) {
                    log_util::log(LOG_LEVEL_DEBUG, "pattern: " . $pattern);
                    if(preg_match($pattern, $fullAgent)) {
                        log_util::log(LOG_LEVEL_DEBUG, "Full agent DID match a known connecting agent");
                        $agentInfo = array_merge($agentInfo, array("Agent" => $key));
                        $agentInfo = array_merge($agentInfo, array("Version" => lib_get::agentVersion($key, $pattern, $fullAgent)));
                        $found = true;
                        break;
                    }
                }

                if($found) {
                    break;
                }
            }

            if(!$found) {
                log_util::log(LOG_LEVEL_DEBUG, "Full agent was set, but NOT a match");
                $agentInfo = array_merge($agentInfo, array("Agent" => "Unknown Agent"));
                $agentInfo = array_merge($agentInfo, array("Version" => "Unknown Agent Version"));
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "agentInfo: ", $agentInfo);
        log_util::logDivider();

        return $agentInfo;
    }

    private static function agentVersion($agent, $search, $string) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $agent = strtolower($agent);
        preg_match_all($search, $string, $match);

        switch($agent) {
            case "internet explorer":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersionTemp = explode(")", $agentVersionTemp[0]);
                $agentVersion = $agentVersionTemp[0];
                $agentVersion = str_replace(":", "", $agentVersionTemp[0]);
                break;
            case "opera":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(" ", $agentVersion);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "navigator":
                $agentVersion = substr($match[1][0],1,7);
                break;
            case "maxthon":
                $agentVersion = str_replace(")","",$match[1][0]);
                break;
            case "arora":
            case "epiphany":
            case "chromium":
            case "google chrome":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(" ", $agentVersion);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "dillo":
            case "seamonkey":
            case "w3m":
            case "twitterbot":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersion = $agentVersionTemp[1];
                break;
            case "konqueror":
            case "midori":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersionTemp = explode(",", $agentVersionTemp[1]);
                $agentVersion = $agentVersionTemp[0];
                break;
            case "netsurf":
            case "presto":
            case "rekonq":
            case "firefox":
            case "lynx":
            case "elinks":
            case "pecl::http":
            case "surveybot":
            case "msnbot":
            case "facebook externalhit":
            case "jigsaw":
            case "wget":
            case "seznambot":
            case "catexplorador":
            case "lssrocketcrawler":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersionTemp = explode(" ", $agentVersionTemp[1]);
                $agentVersion = $agentVersionTemp[0];
                break;
            case "links";
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersion = str_replace("(", "", $agentVersionTemp[0]);
                break;
            case "mobile safari":
            case "bingbot":
            case "yandexbot":
            case "python-urllib":
            case "ahrefsbot":
            case "linkdexbot":
            case "spbot":
            case "mj12bot":
            case "mail.ru_bot":
            case "aihitbot":
            case "dbot":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "uzbl":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(")", $agentVersion);
                $agentVersion = str_replace("(", "", $agentVersionTemp[0]);
                break;
            case "baiduspider":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "classbot":
            case "pycrawler":
            case "sees.co bot":
            case "hrbot":
            case "easouspider":
            case "nerdybot":
                $agentVersion = "No Version";
                break;
            case "safari":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersionTemp = explode(" ", $agentVersionTemp[0]);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "screenerbot crawler beta":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("(", $agentVersion);
                $agentVersion = $agentVersionTemp[0].trim(" ");
                break;
            case "googlebot":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode(";", $agentVersion);
                $agentVersionTemp = explode("(", $agentVersion);
                $agentVersion = str_replace("/", "", $agentVersionTemp[0]);
                break;
            case "w3c validator":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersionTemp = explode(" ", $agentVersionTemp[1]);
                $agentVersion = $agentVersionTemp[0];
                break;
            case "comodo-webinspector-crawler":
                $agentVersion = $match[1][0];
                break;
            case "xenu link sleuth":
            case "feedvalidator":
                $agentVersion = $match[1][0];
                $agentVersionTemp = explode("/", $agentVersion);
                $agentVersion = $agentVersionTemp[1];
                break;
            default:
                $agentVersion = "Unknown Agent Version";
                break;
        }

        log_util::log(LOG_LEVEL_DEBUG, "agentVersion: " . $agentVersion);
        log_util::logDivider();

        return $agentVersion;
    }

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

    public static function os($agentOverride = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $OS = array("Windows NT" => "/Windows NT(.*)/i",
            "Android" => "/Android(.*)/i",
            "Linux" =>   "/Linux(.*)/i",
            "Unix" => "/Unix(.*)/i",
            "iPod" => "/iPod(.*)/i",
            "iPad" => "/iPad(.*)/i",
            "iPhone OS" => "/iPhone OS(.*)/i",
            "Mac OS X" => "/Mac OS X(.*)/i",
            "Mac" => "/Mac(.*)/i",
            "BlackBerry9000" => "/BlackBerry9000(.*)/i"
        );

        if(!$agentOverride) {
            if(isset($_SERVER['HTTP_USER_AGENT'])) {
                $fullAgent = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $fullAgent = "";
            }
        } else {
            echo("<p>Overriding agent...<br/>");
            echo("Agent Override: " . $agentOverride . "</p>");
            $fullAgent = $agentOverride;
        }

        log_util::log(LOG_LEVEL_DEBUG, "fullAgent: " . $fullAgent);

        $osInfo = array();

        foreach($OS as $key => $value) {
            if(lib_check::isEmpty($fullAgent)) {
                log_util::log(LOG_LEVEL_DEBUG, "Full agent WAS NOT set");
                $osInfo = array_merge($osInfo, array("OS" => "Unknown OS - Full agent not set"));
                $osInfo = array_merge($osInfo, array("Version" => "Unknown OS Version - Full agent not set"));
            } else if(preg_match($value, $fullAgent)) {
                log_util::log(LOG_LEVEL_DEBUG, "Full agent matched a known OS");
                $osInfo = array_merge($osInfo, array("OS" => $key));
                $osInfo = array_merge($osInfo, array("Version" => lib_get::osVersion($key, $value, $fullAgent)));
                break;
            } else if(lib_check::botOrSpider($fullAgent)) {
                log_util::log(LOG_LEVEL_DEBUG, "Full agent was detected to be a bot or spider");
                $osInfo = array_merge($osInfo, array("OS" => "Unknown OS - Bot or spider"));
                $osInfo = array_merge($osInfo, array("Version" => "Unknown OS Version - Bot or spider"));
                break;
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Full agent was set, but we couldn't detect OS it was using");
                $osInfo = array_merge($osInfo, array("OS" => "Unknown OS"));
                $osInfo = array_merge($osInfo, array("Version" => "Unknown OS Version"));
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "osInfo: ", $osInfo);
        log_util::logDivider();

        return $osInfo;
    }

    private static function osVersion($os, $search, $string) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $os = strtolower($os);
        preg_match_all($search, $string, $match);

        switch($os) {
            case "windows nt":
                $osVersionTemp = substr($match[1][0],0,4);
                $osVersion = str_replace(")", "", $osVersionTemp);
                if($osVersion.trim(" ") == "") {
                    $osVersion = "Unknown Windows OS Version";
                }
                break;
            case "android":
                $osVersionTemp = explode(" ", $match[1][0]);
                $osVersionTemp = explode(";", $osVersionTemp[0]);
                $osVersion = str_replace(";", "", $osVersionTemp[0]);
                if($osVersion.trim(" ") == "") {
                    $osVersion = "Unknown Android OS Version";
                }
                break;
            case "linux":
                //$osVersionTemp = explode(" ", $match[1][0]);
                //$osVersion = str_replace(")", "", $osVersionTemp[1]);
                $osVersion = "Unknown OS Version - Linux";
                break;
            case "iphone os":
                $osVersionTemp = explode(" ", $match[1][0]);
                $osVersion = $osVersionTemp[1];
                break;
            case "ipad":
            case "ipod":
                $osVersionTemp = explode(")", $match[1][0]);
                $osVersion = str_replace(";", "", $osVersionTemp[0]);
                $osVersion = $osVersion.trim(" ");
                break;
            case "mac os x":
                $osVersionTemp = explode(" ", $match[1][0]);
                $osVersion = str_replace(";", "", $osVersionTemp[1]);
                $osVersion = str_replace(")", "", $osVersion);
                break;
            case "blackberry9000":
                $osVersionTemp = explode("/", $match[1][0]);
                $osVersionTemp = explode(" ", $match[1][0]);
                $osVersion = str_replace("/", "", $osVersionTemp[0]);
                break;
            default:
                $osVersion = "Unknown OS Version";
                break;
        }

        log_util::log(LOG_LEVEL_DEBUG, "osVersion: " . $osVersion);
        log_util::logDivider();

        return $osVersion;
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