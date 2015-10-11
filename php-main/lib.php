<?php

require_once("db_props.php");
require_once("token_props.php");

require_once("lib_check.php");
require_once("lib_const.php");
require_once("lib_database.php");
require_once("lib_get.php");
require_once("log_util.php");

require_once("models/AccountLock.php");
require_once("models/AnnoyanceLevel.php");
require_once("models/EmailDistro.php");
require_once("models/EncryptionData.php");
require_once("models/ErrorReportCategory.php");
require_once("models/FeatureRequestCategory.php");
require_once("models/SecurityQuestion.php");
require_once("models/Update.php");
require_once("models/User.php");

global $gDebugMode;
global $gDebugFunctionColor;
global $gDebugDivider;
global $gLoginStatus;
global $gMasterAdminEmail;
global $gMasterAdminName;

$gDebugFunctionColor = "blue";
$gDebugDivider = "-----------------------------------------------------------------------------------------";
$gMasterAdminEmail = MASTER_ADMIN_EMAIL;
$gMasterAdminName = MASTER_ADMIN_NAME;

if (!isset($_COOKIE[COOKIE_DEBUG_MODE])) {
    $gDebugMode = lib_check::debugMode();
} else {
    $gDebugMode = $_COOKIE[COOKIE_DEBUG_MODE];
}

/**
 * This class contains core function of the site that are not related to get, database, and other operations
 * @author - Patches
 * @version - 1.0
 * @history - Created 06/27/2015
 */
class lib {


    /**
     *  This function creates a new cookie
     *
     * @param string $key - The key to reference the cookie
     * @param string $value - The value to store in the cookie
     * @param bool $sendHeaders (optional) - Whether or not to send the headers
     * @param bool $noDebugModeOutput (optional) - Whether or not to display debug mode output (if enabled)
     *
     * @return void
     * @throws - nothing
     * @global - $gDebugMode
     * @notes  - none
     *
     * @example - To create a new cookie with debug mode output (if enabled) - lib::cookieCreate(COOKIE_KEY, $value);
     * @example - To create a new cookie with no debug mode output - lib::cookieCreate(COOKIE_KEY, $value, TRUE, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 09/26/2015
     */
    public static function cookieCreate($key, $value, $sendHeaders = TRUE, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }

        global $gDebugMode;

        if ($gDebugMode && !$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $_COOKIE[$key] = $value;
        if ($sendHeaders) {
            if ($gDebugMode && !$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "We ARE in debug mode, cannot send headers");
            } else {
                setcookie($key, $value, time() + 3600, '/', '.rockthepatch.com', TRUE);
                $referer = lib_get::referer();
                // Added for EasyPHP
                if (strpos($referer, 'http://127.0.0.1') !== FALSE) {
                    setcookie($key, $value, time() + 3600, '/', '127.0.0.1', FALSE);
                }
            }
        }

        if ($gDebugMode && !$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "Cookie: ", $_COOKIE);
            log_util::logDivider();
        }
    }

    /**
     *  This function destroys a cookie if it exists
     *
     * @param string $key - The key of the cookie to be destroyed
     *
     * @return void
     * @throws - nothing
     * @global - $gDebugMode
     * @notes  - none
     * @example - lib::cookieDestroy(COOKIE_KEY);
     * @author - Patches
     * @version - 1.0
     * @history - Created 09/26/2015
     */
    public static function cookieDestroy($key) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        global $gDebugMode;

        if (isset($_COOKIE[$key])) {
            unset($_COOKIE[$key]);
        }

        if ($gDebugMode) {
            log_util::log(LOG_LEVEL_DEBUG, "We ARE in debug mode, cannot send headers");
        } else {
            setcookie($key, "", time() - 3600, '/', '.rockthepatch.com', TRUE);
            setcookie($key, "", time() + 1, '/', '.rockthepatch.com', TRUE);
            $referer = lib_get::referer();

            if (strpos($referer, 'http://127.0.0.1') !== FALSE) {
                setcookie($key, "", time() - 3600, '/', '127.0.0.1', FALSE);
                setcookie($key, "", time() + 1, '/', '127.0.0.1', FALSE);
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "Cookie: ", $_COOKIE);
        log_util::logDivider();
    }

    /**
     *  This function makes a new issue GitHub issue using their API and tags it with an assignee, labels, and milestone
     *
     * @param string $title - The title of the issue to create
     * @param string $body - The text of the issue to create
     * @param string $assignee - The name of the user to assign the GitHub issue to
     * @param int $milestone - The number of the milestone to attach the GitHub issue to
     * @param array $labels - A string array of labels to attach to the GitHub issue to
     *
     * @return void
     * @throws - nothing
     * @global - none
     * @notes  - none
     * @example - lib::createGitHubIssue($titleOfIssue, $descriptionOfIssue, $assignee, $milestoneNumber, array("Bug", "Found By User"));
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/11/2015
     */
    public static function createGitHubIssue($title, $body, $assignee, $milestone, $labels){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);


        $curlSession = curl_init();
        $url = GITHUB_ISSUES_BASE_URL;

        log_util::log(LOG_LEVEL_DEBUG, "url: " . $url);

        $postData = array(
            'title' => $title,
            'body' => $body,
            'assignee' => $assignee,
            'milestone' => $milestone,
            'labels' => $labels
        );

        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlSession, CURLOPT_HEADER,0);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlSession, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            "Content-Type':'application/json",
            "Cache-Control: no-cache",
            "User-Agent: isuPatches-RockThePatchv3",
            "Authorization: token " . GITHUB_AUTH_TOKEN
        );
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curlSession, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($curlSession);
        if($response === false) {
            log_util::log(LOG_LEVEL_DEBUG, "Curl error: ", curl_error($curlSession));
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Operation completed without any errors");
        }

        curl_close($curlSession);

        log_util::logDivider();
    }

    /**
     *  This function decrypts data given an identifier
     *
     * @param string $identifier - The unique key to decrypt the data
     * @param bool $noDebugModeOutput (optional) - Whether or not to display debug mode output (if enabled)
     *
     * @return string|NULL $decryptedDataMCRYPT - The data after it's been decrypted
     * @throws - nothing
     * @global - none
     * @notes  - none
     *
     * @example - To decrypt data with debug mode output (if enabled): $decryptedData = lib::decrypt($identifier);
     * @example - To decrypt data with no debug mode output: $decryptedData = lib::decrypt($identifier, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function decrypt($identifier, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if (!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $decryptedDataMCRYPT = NULL;

        $encryptionData = lib_database::getEncryptionData($identifier, $noDebugModeOutput);
        if ($encryptionData != NULL) {
            $encoding = MCRYPT_RIJNDAEL_256;
            $mode = MCRYPT_MODE_ECB;

            $cipherBase64Dec = base64_decode($encryptionData->getCipher());

            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "cipherBase64Dec: " . $cipherBase64Dec);
            }

            $iv_size = "";
            $iv_dec = substr($cipherBase64Dec, 0, (int)$iv_size);

            $cipherBase64Dec = substr($cipherBase64Dec, (int)$iv_size);

            $decryptedDataMCRYPT = mcrypt_decrypt($encoding, $encryptionData->getKey(), $cipherBase64Dec, $mode, $iv_dec);
            $decryptedDataMCRYPT = rtrim(substr($decryptedDataMCRYPT, strlen($encryptionData->getIv()), strlen($decryptedDataMCRYPT)));
        } else {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_WARNING, "No encryption data returned");
            }
        }

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "decryptedDataMCYRPT: " . $decryptedDataMCRYPT);
            log_util::logDivider();
        }

        return $decryptedDataMCRYPT;
    }

    public static function displayRSS($entryCount, $rssLocation) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        global $gMaxLinkCount;
        $gMaxLinkCount = $entryCount * 2;

        log_util::log(LOG_LEVEL_DEBUG, "gMaxLinkCount: " . $gMaxLinkCount);

        $xmlParser = xml_parser_create();
        xml_set_element_handler($xmlParser, "lib::rssStartElement", "lib::rssEndElement");
        xml_set_character_data_handler($xmlParser, "lib::rssCharacterData");

        $fp = fopen($rssLocation, "r") or die("Error reading RSS data.");

        while ($data = fread($fp, 2048)) {
            xml_parse($xmlParser, $data, feof($fp));
        }

        fclose($fp);
        xml_parser_free($xmlParser);

        log_util::logDivider();
    }

    /**
     *  This function decrypts data and writes it to the database with the corresponding identifiers
     *
     * @param string $data - The data to be encrypted
     * @param string|array $identifiers - The identifiers that the encrypted data is to be connected to
     * @param bool $noDebugModeOutput (optional) - Whether or not to display debug mode output (if enabled)
     *
     * @return string $encryptedDataMCRYPT The string of encrypted data
     * @throws - nothing
     * @global - none
     * @notes
     *      - If identifiers is passed in as an array of strings, it will write out the same encryption data for each identifier
     *
     * @example - To encrypt data with debug mode output (if enabled): $encryptedString = lib::encrypt($data, $identifiers);
     * @example - To decrypt data with no debug mode output: $encryptedString = lib::encrypt($data, $identifiers, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function encrypt($data, $identifiers, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if (!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $encoding = MCRYPT_RIJNDAEL_256;
        $mode = MCRYPT_MODE_ECB;
        $salt = "!kQm*fF3pXe1Kbm%9";
        $key = hash('SHA256', $salt . $data, true);

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "salt: " . $salt);
            log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
        }

        $dataUTF8 = utf8_encode($data);
        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "dataUTF8: " . $dataUTF8);
        }

        $ivSize = mcrypt_get_iv_size($encoding, $mode);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "iv: " . $iv);
        }

        $cipher = mcrypt_encrypt($encoding, $key, $dataUTF8, $mode, $iv);

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "cipher: " . $cipher);
        }

        $cipher = $iv . $cipher;

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "cipher: " . $cipher);
        }

        $encryptedDataMCRYPT = base64_encode($cipher);
        $time = gmdate("F d, Y h:m:s");

        if (is_array($identifiers)) {
            foreach ($identifiers as $identifier) {
                $encryptionData = new EncryptionData();
                $encryptionData->setIdentifier($identifier);
                $encryptionData->setKey($key);
                $encryptionData->setCipher($encryptedDataMCRYPT);
                $encryptionData->setIv($iv);
                $encryptionData->setTime($time);
                lib_database::writeEncryptionData($encryptionData, $noDebugModeOutput);
            }

        } else {
            $encryptionData = new EncryptionData();
            $encryptionData->setIdentifier($identifiers);
            $encryptionData->setKey($key);
            $encryptionData->setCipher($encryptedDataMCRYPT);
            $encryptionData->setIv($iv);
            $encryptionData->setTime($time);
            lib_database::writeEncryptionData($encryptionData, $noDebugModeOutput);
        }

        if (!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "encryptedDataMCRYPT: ", $encryptedDataMCRYPT);
            log_util::logDivider();
        }

        return $encryptedDataMCRYPT;
    }

    /**
     *  This function generates a registration confirmation URL for the user to complete sign up
     *
     * @param string $email - The email used for registration
     * @param string $userName - The username used for registration
     * @param string $firstName - The first name used for registration
     * @param string $lastName - The last name used for registration
     *
     * @return string $registrationUrl - The url to send to the user fro them to complete the registration process
     * @throws - nothing
     * @global - none
     * @notes - none
     * @example - $registrationUrl= lib::generateRegistrationURL($email, $userName, $firstName, $lastName);
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
    public static function generateRegistrationUrl($email, $userName, $firstName, $lastName) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $registrationUrl = lib_get::baseUrl() . "user-system/registration-confirmation.php";

        $base64Temp = base64_encode($email);
        $base64Temp = str_replace("+", "-", $base64Temp); // Stripping +, /, and = for url friendly characters
        $base64Temp = str_replace("/", "_", $base64Temp);
        $email = str_replace("=", "*", $base64Temp);
        $registrationUrl .= "?email=" . $email;

        $base64Temp = base64_encode($userName);
        $base64Temp = str_replace("+", "-", $base64Temp); // Stripping +, /, and = for url friendly characters
        $base64Temp = str_replace("/", "_", $base64Temp);
        $userName = str_replace("=", "*", $base64Temp);
        $registrationUrl .= "&userName=" . $userName;

        $base64Temp = base64_encode($firstName);
        $base64Temp = str_replace("+", "-", $base64Temp); // Stripping +, /, and = for url friendly characters
        $base64Temp = str_replace("/", "_", $base64Temp);
        $firstName = str_replace("=", "*", $base64Temp);
        $registrationUrl .= "&firstName=" . $firstName;

        $base64Temp = base64_encode($lastName);
        $base64Temp = str_replace("+", "-", $base64Temp);  // Stripping +, /, and = for url friendly characters
        $base64Temp = str_replace("/", "_", $base64Temp);
        $lastName = str_replace("=", "*", $base64Temp);
        $registrationUrl .= "&lastName=" . $lastName;

        log_util::log(LOG_LEVEL_DEBUG, "registrationUrl: " . $registrationUrl);
        log_util::logDivider();

        return $registrationUrl;
    }

    /**
     *  This function generates a temporary password for a user so they can recover their account
     *
     * @param none
     * @return string $tempPassword - The temporary password a user can log in with to recover their account
     * @throws - nothing
     * @global - none
     * @notes - Generates a sequence of 10 random characters and numbers
     * @example - $tempPassword = lib::generateTempPassword();
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/10/2015
     */
    public static function generateTempPassword() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $tempPassword = '';
        $length = 10;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        for ($i=0;$i<$length;$i++) {
            $tempPassword .= $chars[mt_rand(0, (strlen($chars)-1))];
        }

        log_util::log(LOG_LEVEL_DEBUG, "tempPassword: " . $tempPassword);
        log_util::logDivider();

        return $tempPassword;
    }

    /**
     *  This function uses curl to time how long it takes a page to load
     *
     * @param string $url - The address of the page to ping
     *
     * @return string $timeMS - The time in MS of how long the curl took
     * @throws - Nothing
     * @global - None
     * @notes - None
     * @example - $timeMS = lib::ping($url);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/10/2015
     */
    public static function ping($url) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $curlSession = curl_init();

        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        curl_exec($curlSession);


        $info = curl_getinfo($curlSession);
        $time = $info['total_time'];
        $timeMS = $info['total_time'] * 1000;

        curl_close($curlSession);

        log_util::log(LOG_LEVEL_DEBUG, "time: " . $time);
        log_util::log(LOG_LEVEL_DEBUG, "timeMS: " . $timeMS);
        log_util::log(LOG_LEVEL_DEBUG, "round(timeMS): " . round($timeMS));

        return round($timeMS);
    }

    /**
     *  This function prints out security questions as options
     *
     * @param array $securityQuestions - An array of security questions from the database
     * @param int $selectedQuestion - The id of a selected security question
     *
     * @return void
     * @throws - nothing
     * @global - none
     * @notes  - none
     * @example - lib::printSecurityQuestions($randomizedSecurityQuestions, $selectedQuestion);
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
    public static function printSecurityQuestions($securityQuestions, $selectedQuestion) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        foreach($securityQuestions as $securityQuestion) {
            if($selectedQuestion == $securityQuestion->getId() || $selectedQuestion == $securityQuestion->getQuestion()) {
                echo("<option value='" . $securityQuestion->getId() . "' selected='selected'>". $securityQuestion->getQuestion() . "</option>");
            } else {
                echo("<option value='" . $securityQuestion->getId() . "'>". $securityQuestion->getQuestion() . "</option>");
            }
        }

       log_util::logDivider();
    }

    /**
     *  This function given an array will generate a randomized array with a specified entry count
     *
     * @param array $array - An array of security questions from the database
     * @param int $randomizedEntryCount - How many entries should be in the randomized array
     *
     * @return array $randomizedArray
     * @throws - nothing
     * @global - none
     * @notes  - none
     * @example - $randomizedSecurityQuestions = lib::randomizeArray($securityQuestions, 10);
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
    public static function randomizeArray($array, $randomizedEntryCount) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $randomizedArray = array();

        while (count($randomizedArray) < $randomizedEntryCount) {
            $randNum = rand(0, (count($array) - 1));

            log_util::log(LOG_LEVEL_DEBUG, "randNum: " . $randNum);
            log_util::log(LOG_LEVEL_DEBUG, "count(randomizedArray): " . count($randomizedArray));

            if (in_array($array[$randNum], $randomizedArray)) {
                log_util::log(LOG_LEVEL_DEBUG, "Item IS already in array: ", $array[$randNum]);
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Item IS NOT already in array, adding: ", $array[$randNum]);
                array_push($randomizedArray, $array[$randNum]);
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "randomizedArray: ", $randomizedArray);
        log_util::logDivider();

        return $randomizedArray;
    }

    /**
     *  This function redirects the user to another page
     *
     * @param bool $withDelay - A flag that determines if the redirect is going to use delay or not
     * @param int $delay - The number of seconds to delay before the redirect
     * @param bool $toReferer - If the user is going to be redirected to the referer
     * @param string $urlForRedirect - The url to redirect to if not going to referer
     *
     * @return void
     * @throws - nothing
     * @global - none
     * @notes
     *      - urlForRedirect is optional if you're going to the referer
     *      - Ignores delay unless with delay is true
     *
     * @example To redirect to referer with delay: lib::testConnection(true, 5, true);
     * @example To redirect to referer with no delay: lib::testConnection(false, null, true);
     * @example To redirect to another page with delay: lib::testConnection(true, 5, false, $url);
     * @example To redirect to another page with no delay: lib::testConnection(false, 5, true, $url);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/10/2015
     */
    public static function redirect($withDelay = FALSE, $delay = 5, $toReferer = TRUE, $urlForRedirect) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        if($toReferer) {
            $referer = lib_get::referer();
            if($referer != NULL)  {
                $url = $referer;
            } else {
                $url = "/index.php";
            }
        } else {
            if(isset($urlForRedirect)) {
                $url = $urlForRedirect;
            } else {
                $url = "/index.php";
            }
        }

        log_util::log(LOG_LEVEL_DEBUG, "url: " . $url);

        if($withDelay) {
            echo("<meta http-equiv='refresh' content='" . $delay . ";URL=" . $url . "' />");
        } else {
            echo("<meta http-equiv='refresh' content='0;URL=" . $url . "' />");
        }

        log_util::logDivider();
    }

    private static function rssStartElement($parser, $name) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        // *NOTE* Need to be global because they are not in a return
        global $gInsideItem, $gTag;

        log_util::log(LOG_LEVEL_DEBUG, "insideItem: " . $gInsideItem);
        log_util::log(LOG_LEVEL_DEBUG, "tag: " . $gTag);

        if($gInsideItem) {
            log_util::log(LOG_LEVEL_DEBUG, "Inside item is true, tag being set to name");
            $gTag = $name;
        } else if($name == "ITEM") {
            log_util::log(LOG_LEVEL_DEBUG, "name is 'ITEM', gInsideItem being set to true");
            $gInsideItem = true;
        }

        log_util::logDivider();
    }


    private static function rssEndElement($parser, $name) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        // *NOTE* Need to be global because they are not in a return
        global $gInsideItem, $gTitle, $gDescription, $gRssLink, $gLinkCount, $gPubDate, $gAuthor, $gMaxLinkCount, $gMasterAdminEmail, $gMasterAdminName;

        log_util::log(LOG_LEVEL_DEBUG, "gInsideItem: " . $gInsideItem);
        log_util::log(LOG_LEVEL_DEBUG, "gTitle: " . $gTitle);
        log_util::log(LOG_LEVEL_DEBUG, "gDescription: " . $gDescription);
        log_util::log(LOG_LEVEL_DEBUG, "gRssLink: " . $gRssLink);
        log_util::log(LOG_LEVEL_DEBUG, "gLinkCount: " . $gLinkCount);
        log_util::log(LOG_LEVEL_DEBUG, "gPubDate: " . $gPubDate);
        log_util::log(LOG_LEVEL_DEBUG, "gAuthor: " . $gAuthor);
        log_util::log(LOG_LEVEL_DEBUG, "$gMaxLinkCount: " . $gMaxLinkCount);

        if($name == "ITEM" && $gLinkCount <= $gMaxLinkCount) {
            log_util::log(LOG_LEVEL_DEBUG, "name IS 'ITEM' AND link count IS less than gMaxLinkCount.");

            if (strlen($gDescription) > RSS_MAX_DESC_CHARS) {
                log_util::log(LOG_LEVEL_DEBUG, "Length of description IS longer than allowed chars, truncating...");

                $gDescription = wordwrap($gDescription, RSS_MAX_DESC_CHARS, "-=CUT OFF HERE=-");
                $pos = strpos($gDescription, "-=CUT OFF HERE=-");
                $gDescription = trim(substr($gDescription, 0, $pos)) . "...";
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Length of description IS NOT longer than allowed chars, doing nothing");
            }
            $description = htmlspecialchars(trim($gDescription));
            $description = str_replace("&amp;quot;", "&quot;", $description);
            printf("<dl><dt><strong><a href='%s' title='$gTitle'>%s</a></strong></dt><dd></dd></dl>", trim($gRssLink),htmlspecialchars(trim($gTitle)));
            printf("<dl><dt>%s</dt><dd></dd></dl>",$description);
            printf("<dl><dt><a href='mailto:$gMasterAdminEmail' title='Email $gMasterAdminName'>%s</a></dt><dd></dd></dl>",$gAuthor);
            printf("<dl><dt><strong><em>%s</em></strong></dt><dd></dd></dl>",$gPubDate);
            $gTitle = "";
            $gDescription = "";
            $gRssLink = "";
            $gPubDate = "";
            $gAuthor = "";
            $gInsideItem = false;
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "name IS NOT 'ITEM' OR link count IS NOT less than gMaxLinkCount.");
        }

        log_util::logDivider();
    }

    private static function rssCharacterData ($parser, $data) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        // *NOTE* Need to be global because they are not in a return
        global $gInsideItem, $gTag, $gTitle, $gDescription, $gLink, $gLinkCount, $gPubDate, $gAuthor;

        log_util::log(LOG_LEVEL_DEBUG, "gInsideItem: " . $gInsideItem);
        log_util::log(LOG_LEVEL_DEBUG, "gTag: " . $gTag);
        log_util::log(LOG_LEVEL_DEBUG, "gTitle: " . $gTitle);
        log_util::log(LOG_LEVEL_DEBUG, "gDescription: " . $gDescription);
        log_util::log(LOG_LEVEL_DEBUG, "gLink: " . $gLink);
        log_util::log(LOG_LEVEL_DEBUG, "gLinkCount: " . $gLinkCount);
        log_util::log(LOG_LEVEL_DEBUG, "gPubDate: " . $gPubDate);
        log_util::log(LOG_LEVEL_DEBUG, "gAuthor: " . $gAuthor);

        if($gInsideItem) {
            log_util::log(LOG_LEVEL_DEBUG, "insideItem is true");

            switch ($gTag) {
                case "TITLE":
                    log_util::log(LOG_LEVEL_DEBUG, "title tag");
                    $gTitle .= $data;
                    break;
                case "DESCRIPTION":
                    log_util::log(LOG_LEVEL_DEBUG, "description tag");
                    $gDescription .= $data;
                    break;
                case "LINK":
                    log_util::log(LOG_LEVEL_DEBUG, "link tag");
                    $gLink .= $data;
                    $gLinkCount++;
                    break;
                case "AUTHOR":
                    log_util::log(LOG_LEVEL_DEBUG, "author tag");
                    $gAuthor .= $data;
                    break;
                case "PUBDATE":
                    log_util::log(LOG_LEVEL_DEBUG, "pubDate tag");
                    $gPubDate .= $data;
                    break;
                default:
                    log_util::log(LOG_LEVEL_WARNING, "Unhandled tag in RSSCharacterData");
                    break;
            }
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "inside item IS NOT true");
        }

        log_util::logDivider();
    }

    /**
     *  This function sends an email
     *
     * @param array|string $to - A comma delimited list or array of email addresses to send it to
     * @param string $subject - The subject of the email
     * @param string $body - The body of the email
     * @param bool $ccAdmin (optional) - Whether the master admin should be copied or not
     * @param object $attachment (optional) - An attachment to send with the email
     * @param string $attachmentType (optional) - The type of attachment being sent
     * @param string $encoding (optional) - The encoding to use for the email
     * @param string $fromName (optional) - The name the email is from
     * @param string $fromAddress (optional) - The address the email is from
     *
     * @return bool $success - Whether or not the email was sent successfully
     * @throws - nothing
     * @global - none
     * @notes  - none
     *
     * @example - To send a normal email: $success = lib::sendMail($email, $subject, $body);
     * @example - To send an email with attachment: $success = lib::sendMail($recipients, $subject, $body, TRUE, TRUE, $file, $fileType);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 10/04/2015
     */
    public static function sendMail($to, $subject, $body, $ccAdmin = FALSE, $html = TRUE, $attachment = NULL, $attachmentType = NULL, $encoding = "utf-8", $fromName = "Patches", $fromAddress = "patches@rockthepatch.com") {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $timestamp = time();
        $currentDate = getdate($timestamp);
        $currentDateMon = $currentDate['mon'];
        $currentDateMonth = $currentDate['month'];
        $currentDateYear = $currentDate['year'];
        $currentDateDay = $currentDate['mday'];

        if($currentDateMon < 10) {
            $currentDateMon = "0".$currentDateMon;
            $date = $currentDateMon."/".$currentDateDay."/".$currentDateYear;
        } else {
            $date = $currentDateMon."/".$currentDateDay."/".$currentDateYear;
        }
        $body .= "<strong><em>Date sent:</strong> $date</em>\r\n\r\n";

        $eol= "\n";
        $msg = "";

        $headers = "";
        $headers .= "From: " . $fromName . " <" . $fromAddress . ">" .$eol;
        if($ccAdmin){
            $headers .= "CC: " . $fromName . " <" . $fromAddress . ">" . $eol;
        }
        $headers .= "Return-Path: " . $fromName . " <" . $fromAddress . ">" . $eol;
        $headers .= "Reply-To: " . $fromName . " <" . $fromAddress . ">" . $eol;
        $headers .= "Message-ID: <" . time() . "TheSystem@" . $_SERVER['SERVER_NAME'] . ">" .$eol;  // This helps to avoid spam-filters*/
        $headers .= "X-Mailer: PHP v" . phpversion() . $eol; // This helps to avoid spam-filters
        $headers .= "MIME-Version: 1.0" . $eol;

        log_util::log(LOG_LEVEL_DEBUG, "headers: " . $headers);

        if(!empty($attachment)) {
            log_util::log(LOG_LEVEL_DEBUG, "Attachment IS NOT empty");

            $mimeBoundary = md5(time());

            log_util::log(LOG_LEVEL_DEBUG, "mimeBoundary: " . $mimeBoundary);

            $headers .= "Content-Type: multipart/mixed; boundary=\"" . $mimeBoundary . "\"" . $eol;

            log_util::log(LOG_LEVEL_DEBUG, "headers: " . $headers);

            $handle = fopen($attachment, 'rb');
            $fileContents = fread($handle, filesize($attachment));
            $fileContents = chunk_split(base64_encode($fileContents)); // Encoding the date for the transition by using base64_encode()
            $fileType = filetype($attachment);
            fclose($handle);

            $msg .= "--" . $mimeBoundary . $eol;
            $msg .= "Content-Type: " . $attachmentType . "; name=\"" . $attachment . "\"" . $eol;
            $msg .= "Content-Transfer-Encoding: base64" . $eol;
            $msg .= "Content-Disposition: attachment; filename=\"" . basename($attachment) . "\"" . $eol . $eol; // !! This line needs TWO end of lines !! IMPORTANT !!
            $msg .= $fileContents . $eol . $eol;
            $msg .= "Content-Type: multipart/mixed" . $eol;

            log_util::log(LOG_LEVEL_DEBUG, "attachment: " . $attachment);

            if(file_exists($attachment)) {
                log_util::log(LOG_LEVEL_DEBUG, "The file DOES exist");
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "The file DOES NOT exist");;
            }

            log_util::log(LOG_LEVEL_DEBUG, "basename(attachment): " . basename($attachment));
            log_util::log(LOG_LEVEL_DEBUG, "msg: " . $msg);

            if($html) {
                $contentType = "text/html";
            } else {
                $contentType = "text/plain";
            }

            $msg .= "--" . $mimeBoundary . $eol;

            log_util::log(LOG_LEVEL_DEBUG, "contentType: " . $contentType);
            log_util::log(LOG_LEVEL_DEBUG, "encoding: " . $encoding);

            $msg .= "Content-Type: " . $contentType . "; charset=\"" . $encoding . "\"" . $eol . $eol; // *NOTE* NEED TWO $EOLS HERE!
            $msg .= $body . $eol . $eol;

            $msg .= "--" . $mimeBoundary . "--" . $eol . $eol;  // finish with two eol's for better security. see Injection.
        } else {
            if($html) {
                $contentType = "text/html";
            } else {
                $contentType = "text/plain";
            }

            $headers .= "Content-Type: " . $contentType . "; charset=\"" . $encoding . "\"" . $eol . $eol;  // *NOTE* NEED TWO $EOLS HERE!
            $msg .= $body . $eol . $eol;
        }

        log_util::log(LOG_LEVEL_DEBUG, "headers: " . $headers);
        log_util::log(LOG_LEVEL_DEBUG, "msg: " . $msg);

        ini_set('sendmail_from', $fromAddress);

        if(is_array($to)) {
            $emailList = "";
            foreach($to as $value) {
                $emailList .= $value . ", ";
            }
            $emailList = rtrim($emailList, ", ");
            log_util::log(LOG_LEVEL_DEBUG, "emailList: " . $emailList);
            $success = mail($emailList, $subject, $msg, $headers);
        } else {
            $success = mail($to, $subject, $msg, $headers);
        }

        ini_restore('sendmail_from');

        if($success) {
            log_util::log(LOG_LEVEL_DEBUG, "Mail WAS sent successfully");
        } else {
            log_util::log(LOG_LEVEL_ERROR, "Mail WAS NOT sent successfully");
        }
        log_util::logDivider();

        return $success;
    }

    /**
     *  This function checks if the file calling it is connected to the library by writing a simple echo statement
     *
     * @param none
     *
     * @return void
     * @throws - nothing
     * @global - none
     * @notes  - none
     * @example - lib::testConnection();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function testConnection(){
        echo("<p>We're connected to the library now.</p>");
    }
}