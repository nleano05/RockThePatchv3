<?php
require_once("db_props.php");
require_once("lib_check.php");
require_once("lib_const.php");
require_once("lib_database.php");
require_once("lib_get.php");
require_once("log_util.php");

require_once("models/AnnoyanceLevel.php");
require_once("models/EmailDistro.php");
require_once("models/ErrorReportCategory.php");
require_once("models/FeatureRequestCategory.php");
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

if (!isset($_COOKIE['debugMode'])) {
    $gDebugMode = lib_check::debugMode();
} else {
    $gDebugMode = $_COOKIE['debugMode'];
}

/**
 * This class contains core function of the site that are not related to get, database, and other operations
 */
class lib {

    /**
     *  This function decrypts data given an identifier
     *
     * @param string $identifier
     * @param bool|NULL $noDebugModeOutput
     *
     * @return string|NULL $decryptedDataMCRYPT String of decrypted data
     * @throws - Nothing
     * @global - None
     * @notes  - None
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

        $fp = fopen($rssLocation,"r") or die("Error reading RSS data.");

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
     * @param string $data The data to be encrypted
     * @param string|array $identifiers The identifiers the encrypted data is to be connected to
     * @param bool|NULL $noDebugModeOutput Whether this displays output if debug mode is enabled
     *
     * @return string $encryptedDataMCRYPT The string of encrypted data
     * @throws - Nothing
     * @global - None
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
    public static function encrypt($data, $identifiers, $noDebugModeOutput = FALSE){
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
        $salt = "!kQm*fF3pXe1Kbm%9";
        $key = hash('SHA256', $salt . $data, true);

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "salt: " . $salt);
            log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
        }

        $dataUTF8 = utf8_encode($data);
        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "dataUTF8: " . $dataUTF8);
        }

        $mode = MCRYPT_MODE_ECB;
        $ivSize = mcrypt_get_iv_size($encoding, $mode);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "iv: " . $iv);
        }

        $cipher = mcrypt_encrypt($encoding, $key, $dataUTF8, $mode, $iv);

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "cipher: " . $cipher);
        }

        $cipher = $iv . $cipher;

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "cipher: " . $cipher);
        }

        $encryptedDataMCRYPT = base64_encode($cipher);
        $time = gmdate("F d, Y h:m:s");

        if(is_array($identifiers)) {
            foreach($identifiers as $identifier) {
                $encryptionData = new EncryptionData();
                $encryptionData->setIdentifier($identifier);
                $encryptionData->setKey($key);
                $encryptionData->setCipher($cipher);
                $encryptionData->setIv($iv);
                $encryptionData->setTime($time);
                lib_database::writeEncryptionData($encryptionData, $noDebugModeOutput);
            }

        } else {
            $encryptionData = new EncryptionData();
            $encryptionData->setIdentifier($identifiers);
            $encryptionData->setKey($key);
            $encryptionData->setCipher($cipher);
            $encryptionData->setIv($iv);
            $encryptionData->setTime($time);
            lib_database::writeEncryptionData($encryptionData, $noDebugModeOutput);
        }

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "encryptedDataMCRYPT: ", $encryptedDataMCRYPT);
            log_util::logDivider();
        }

        return $encryptedDataMCRYPT;
    }

    /**
     *  This function uses curl to time how long it takes a page to load
     *
     * @param string $url The address of the page to ping
     *
     * @return string $timeMS The time in MS of how long the curl took
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
     *  This function redirects the user to another page
     *
     * @param bool|NULL $withDelay A flag that determines if the redirect is going to use delay or not
     * @param int|NULL $delay The number of seconds to delay
     * @param bool|NULL $toReferer If the
     * @param string $urlForRedirect The url to redirect to
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes  -
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
    public static function redirect($withDelay = false, $delay = 5, $toReferer = true, $urlForRedirect) {
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
     *  This function checks if the file calling it is connected to the library by writing a simple echo statement
     *
     * @param None
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - lib::testConnection();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function testConnection(){
        echo("<p>We're connected to the library now.</p>");
    }
}