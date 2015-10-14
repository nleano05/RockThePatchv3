<?php

/**
 * This class houses functions that check input and return true/false values
 * @author - Patches
 * @version - 1.0
 * @history - Created 07/03/2015
 */
class lib_check {

    public static function accessToken($token) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $validToken = FALSE;

        $accessToken = lib_database::getAccessToken($token, null);
        if(isset($accessToken)) {
            log_util::log(LOG_LEVEL_DEBUG, "Access token DOES exist");

            $scope = explode(" ", $accessToken->getScope());

            log_util::log(LOG_LEVEL_DEBUG, "Scope: ", $scope);

            if(in_array("GET", $scope)) {
                log_util::log(LOG_LEVEL_DEBUG, "GET was in scope");

                $timeDifference = strtotime(gmdate('Y/m/d H:i:s')) - strtotime($accessToken->getTimeStamp());

                log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

                if($timeDifference >= (30 * 60)) {
                    log_util::log(LOG_LEVEL_DEBUG, "Token IS expired");
                } else {
                    log_util::log(LOG_LEVEL_DEBUG, "Token IS NOT expired");
                    $validToken = TRUE;
                }
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "GET was NOT in scope");
            }
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Access token DOES NOT exist");
        }

        log_util::logDivider();

        return $validToken;
    }

    /**
     *  This function uses preg_match to check if the given input matches a white list of characters
     *
     * @param string $input - The string to check if it matches the white list
     *
     * @return bool $black
     * @throws - nothing
     * @global - none
     * @notes  - none
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
     *  This function checks if a connecting agent is a known bot or spider
     *
     * @param string $agent - The agent to see if it matches a list of known bots and spiders
     *
     * @return bool $isBotOrSpider
     * @throws - nothing
     * @global - none
     * @notes  - none
     * @example - $botOrSpider = lib_check::botOrSpider($connectingAgent)
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/10/2015
     */
    public static function botOrSpider($agent) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $isBotOrSpider = FALSE;

        $knownBotsAndSpiders = array("bingbot" => "/bingbot(.*)/i",
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

        foreach($knownBotsAndSpiders as $key => $value) {
            log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
            log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

            if(preg_match($value, $agent)) {
                log_util::log(LOG_LEVEL_DEBUG, "Agent matched a known bot or spider");
                $isBotOrSpider = TRUE;
                break;
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "isBotOrSpider: " . $isBotOrSpider);
        log_util::logDivider();

        return $isBotOrSpider;
    }

    /**
     *  This function checks if debug mode should be disabled or enabled
     *
     * @param $enable boolean (optional) - If debug mode is enabled or disabled
     * @param $careAboutAdmin boolean (optional) - If we're only enabling debug mode for admin users
     *
     * @return bool $debugModeEnabled
     * @throws - nothing
     * @global - none
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
     * @param string $needle - The string to search for
     * @param string $haystack - The string to search in
     *
     * @return bool
     * @throws - nothing
     * @global - none
     * @notes  - none
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
     * @param string $input - The string to check if empty
     *
     * @return bool $empty
     * @throws - nothing
     * @global - none
     * @notes  - none
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

    public static function palindrome($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $inputStripped = str_replace(" ", "", $input);

        $intPointer1 = 0;
        $intPointer2 = strlen($inputStripped) - 1;

        log_util::log(LOG_LEVEL_DEBUG, "inputStripped: " . $inputStripped);
        log_util::log(LOG_LEVEL_DEBUG, "intPointer1: " . $intPointer1);
        log_util::log(LOG_LEVEL_DEBUG, "intPointer2: " . $intPointer2);

        $isPalindrome = TRUE;
        do {
            $temp1 = substr($inputStripped, $intPointer1, 1);
            $temp2 = substr($inputStripped, $intPointer2, 1);

            log_util::log(LOG_LEVEL_DEBUG, "temp1: " . $temp1);
            log_util::log(LOG_LEVEL_DEBUG, "temp2: " . $temp2);

            if($temp1 == $temp2) {
                $intPointer1++;
                $intPointer2--;

                log_util::log(LOG_LEVEL_DEBUG, "temp1: '" . $temp1 . "' DOES equal temp2: '" . $temp2 . "', incrementing intPointer1 and decrementing intPointer2");
                log_util::log(LOG_LEVEL_DEBUG, "intPointer1: " . $intPointer1);
                log_util::log(LOG_LEVEL_DEBUG, "intPointer2: " . $intPointer2);

            } else {
                log_util::log(LOG_LEVEL_DEBUG, "temp1: '" . $temp1 . "' DOES NOT equal temp2: '" . $temp2 . "', this is not a Palindrome");
                $isPalindrome = FALSE;
            }
        }while(($intPointer1 <= $intPointer2) && ($intPointer2 >= $intPointer1) && $isPalindrome);

        log_util::log(LOG_LEVEL_DEBUG, "isPalindrome: " . $isPalindrome);
        log_util::logDivider();

        return $isPalindrome;
    }

    /**
     *  This function checks if two inputs are the same
     *
     * @param string $input1
     * @param string $input2
     *
     * @return bool $same
     * @throws - nothing
     * @global - none
     * @notes
     *      - Primarily used for string comparisons
     *      - Does an == comparison
     * @example - $gPasswordsMatch = lib_check::same($newPassword, $newPasswordConfirm);
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
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

    /**
     *  This function does compares the string length using a given operator
     *
     * @param string $input - The string to compare the length of
     * @param string $length - The length to compare the inputs length to
     * @param string $operator - The operator to use when comparing
     *
     * @return bool $result
     * @throws - nothing
     * @global - none
     * @notes - none
     * @example - $gFirstNameTooLong = lib_check::stringLength($firstName, 40, ">");
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
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

    public static function upload($folder, $displayOutput = TRUE){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $invalidFile = FALSE;

        if($displayOutput) {
            echo("<p><strong>Upload Output</strong></p>");
        }

        $allowedExtensions = array("gif", "jpeg", "jpg", "png");

        if(isset($_FILES["file"]["name"])) {
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
        } else {
            $extension = "";
        }

        $type = isset($_FILES["file"]["type"]) ? $_FILES["file"]["type"] : "";
        $size = isset($_FILES["file"]["size"]) ? $_FILES["file"]["size"] : "";
        $error = isset($_FILES["file"]["error"]) ? $_FILES["file"]["error"] : "";
        $name = isset($_FILES["file"]["name"]) ? $_FILES["file"]["name"] : "";
        $tmpName = isset($_FILES["file"]["tmp_name"]) ? $_FILES["file"]["tmp_name"] : "";

        log_util::log(LOG_LEVEL_DEBUG, "type: " . $type);
        log_util::log(LOG_LEVEL_DEBUG, "size: " . $size);
        log_util::log(LOG_LEVEL_DEBUG, "error: " . $error);
        log_util::log(LOG_LEVEL_DEBUG, "name: " . $name);
        log_util::log(LOG_LEVEL_DEBUG, "tmpName: " . $tmpName);

        $allowedExtension = FALSE;
        foreach($allowedExtensions as $value) {
            log_util::log(LOG_LEVEL_DEBUG, "type: " . $type);
            log_util::log(LOG_LEVEL_DEBUG, "size: " . $size);

            if($extension == $value) {
                $allowedExtension = TRUE;
                break;
            }
        }

        if ((($type == "image/gif")
                || ($type == "image/jpeg")
                || ($type == "image/jpg")
                || ($type == "image/png"))
                && ($size / 1024 < 20000) // Set to 20MB or 20,000 KB for Yahoo Mail! who only allows attachments to be that size
                && $allowedExtension) {

            log_util::log(LOG_LEVEL_DEBUG, "The file WAS valid");

            if($displayOutput) {

                echo("<p>");
                if($error > 0) {
                    echo("Return Code: " . $error . "<br>");
                } else {
                    echo("Upload: " . $name . "<br>");
                    echo("Type: " . $type . "<br>");
                    echo("Size: " . ($size / 1024) . " kB<br>");
                    echo("Temp file: " . $tmpName . "<br>");

                    if(file_exists($folder . $name)) {
                        echo($_FILES["file"]["name"] . " already exists. ");
                        echo("Stored in: " . $folder . $name);
                    } else {
                        move_uploaded_file($tmpName, $folder . $name);
                        echo("Stored in: " . $folder . $name);
                    }
                }
                echo("</p>");
            }
        } else {
            log_util::log(LOG_LEVEL_WARNING, "The file WAS valid");

            $invalidFile = TRUE;

            if($displayOutput) {
                echo("<p style='color:red'>");

                if(!empty($_FILES["file"]["name"])) {
                    echo("Invalid file was uploaded.<br/>");
                    echo("Size: " . ($size / 1024) . " kB<br/>");
                    echo("File Type: " . ($type));
                } else {
                    echo("No file was uploaded.<br/>");
                }
                echo("</p>");
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "invalidFile: " . $invalidFile);
        log_util::logDivider();

        return $invalidFile;
    }

    public static function userInDb($id, $email, $userName = NULL, $password = NULL, $temp = FALSE, $noDebugModeOutput = FALSE) {
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

    public static function validIP($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $validIP = FALSE;

        if(filter_var($input, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $validIP = TRUE;
            log_util::log(LOG_LEVEL_DEBUG, "input IS a valid IP");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input IS NOT a valid IP");
        }

        log_util::log(LOG_LEVEL_DEBUG, "validIP: " . $validIP);
        log_util::logDivider();

        return $validIP;
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

    public static function validSubnet($input) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $validSubnet = FALSE;

        if(filter_var($input, FILTER_VALIDATE_IP)) {
            log_util::log(LOG_LEVEL_DEBUG, "input IS a valid ip");

            $subnetSplit = explode(".", $input);

            log_util::log(LOG_LEVEL_DEBUG, "subnetSplit: ", $subnetSplit);

            $binSubnet = "";
            foreach($subnetSplit as $value) {
                $binTemp = decbin($value);
                $binSubnet .= substr("00000000", 0, 8 - strlen($binTemp)) . $binTemp . ".";
            }
            $binSubnet = trim($binSubnet, ".");

            $temp = str_replace(".", "", $binSubnet);

            log_util::log(LOG_LEVEL_DEBUG, "binSubnet: " . $binSubnet);
            log_util::log(LOG_LEVEL_DEBUG, "temp: " . $temp);

            if(preg_match("/^(1+)(0*)$/", $temp)) {
                log_util::log(LOG_LEVEL_DEBUG, "Binary Subnet WAS consecutive 1's and zeros");
                $validSubnet = TRUE;
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Binary Subnet WAS NOT consecutive 1's and zeros");
            }
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "input IS NOT a valid IP");

            // If it's not a valid IP then we need to check to see if it's cidr notation
            //	*NOTE* the / is optional because I'm nice like that
            if(preg_match("/^([0-9]|[1-2][0-9]|[3][0-2])$/", str_replace("/", "", $input))) {
                $validSubnet = TRUE;
                log_util::log(LOG_LEVEL_DEBUG, "input IS valid cidr notation");
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "input IS NOT valid cidr notation");
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "validSubnet: " . $validSubnet);
        log_util::logDivider();

        return $validSubnet;
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