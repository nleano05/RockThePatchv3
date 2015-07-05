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

class lib {

    /**
     *  This function decrypts data given an identifier
     *
     * @param string $identifier
     * @param bool|NULL $noDebugModeOutput
     *
     * @return string|NULL decrypted data
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

    /**
     *  This function decrypts data and writes it to the database with the corresponding identifiers
     *
     * @param string $data The data to be encrypted
     * @param string|array $identifiers The identifiers the encrypted data is to be connected to
     * @param bool|NULL $noDebugModeOutput Wether this displays output if debug mode is enabled
     *
     * @return string encrypted data
     * @throws - Nothing
     * @global - None
     * @notes
     *      - If identifiers is passed in as an array of strings, it will write out the same encryption data for each identifier
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