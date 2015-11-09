<?php
session_save_path('/tmp');

include("helper.php");
include(getRootPath() . "/php-main/lib.php");

$headers =  apache_request_headers();

log_util::log(LOG_LEVEL_DEBUG, "GET: ", $_GET);
log_util::log(LOG_LEVEL_DEBUG, "Headers: ", $headers);

if(isset($headers['Clientsecret'])) {
    $accessToken = lib_database::getAccessToken(NULL, $headers['Clientsecret']);
    if($accessToken != NULL) {
        $timeDifference = strtotime(gmdate('Y/m/d H:i:s')) - strtotime($accessToken->getTimeStamp());

        log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

        if ($timeDifference >= (30 * 60)) {
            log_util::log(LOG_LEVEL_DEBUG, "Token is expired");
            $accessToken = lib_database::updateAccessToken($headers['Clientsecret']);
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Token is not expired");
        }
        if (isset($accessToken)) {
            echo("{\"accessToken\":\"" . $accessToken->getAccessToken() . "\"}");
        }
    } else {
        header('HTTP/1.0 422 Unprocessable Entity');
    }
} else {
    header('HTTP/1.0 422 Unprocessable Entity');
}