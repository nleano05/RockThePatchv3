<?php
session_save_path('/tmp');

include("helper.php");
include(getRootPath() . "/php-main/lib.php");
include(getRootPath() . "/php-main/cookie.php");

$headers =  apache_request_headers();

if(isset($headers['Authorizationtoken'])) {
    if(lib_check::accessToken($headers['Authorizationtoken'])) {
        if(isset($_GET['id'])) {
            $annoyanceLevel = lib_database::getAnnoyanceLevelById($_GET['id']);
            $annoyanceLevelJSON = "{";
            $annoyanceLevelJSON .= "\"id\":" . $annoyanceLevel->getId() . ",";
            $annoyanceLevelJSON .= "\"level\":" . $annoyanceLevel->getLevel() . ",";
            $annoyanceLevelJSON .= "\"name\":\"" . $annoyanceLevel->getName() . "\"";
            $annoyanceLevelJSON .= "}";
        } else {
            $annoyanceLevelJSON = "{error:'id field required'}";
        }
        echo($annoyanceLevelJSON);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}