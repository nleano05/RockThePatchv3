<?php
session_save_path('/tmp');

include("helper.php");
include(getRootPath() . "/php-main/lib.php");
include(getRootPath() . "/php-main/cookie.php");

$headers =  apache_request_headers();

log_util::log(LOG_LEVEL_DEBUG, "GET: ", $_GET);
log_util::log(LOG_LEVEL_DEBUG, "Headers: ", $headers);

if(isset($headers['Authorizationtoken'])) {
    if(lib_check::accessToken($headers['Authorizationtoken'])) {
        if(isset($_GET['id'])) {
            $securityQuestion = lib_database::getSecurityQuestionById($_GET['id']);

            $securityQuestionJSON = "{";
            $securityQuestionJSON .= "\"id\":" . $securityQuestion->getId() . ",";
            $securityQuestionJSON .= "\"question\":\"" . $securityQuestion->getQuestion() . "\"";
            $securityQuestionJSON .= "}";
        } else {
            $securityQuestionJSON = "{error:'id field required'}";
        }

        echo($securityQuestionJSON);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}