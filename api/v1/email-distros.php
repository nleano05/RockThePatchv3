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
            $emailDistros = $annoyanceLevel = lib_database::getEmailDistroById($_GET['id']);
            $emailDistrosJSON = json_encode($emailDistros);

            $temp = "{";
            $temp .= "\"id\":\"" . $emailDistros->getId() . "\",";
            $temp .= "\"name\":\"" . $emailDistros->getName() . "\",";
            $temp .= "\"distroMembers\":[";
            $tempEmailMembers = "";
            foreach($emailDistros->getDistroMembers() as $distroMember) {
                $tempEmailMembers .= "{";
                $tempEmailMembers .= "\"id\":\"" . $distroMember->getId() . "\",";
                $tempEmailMembers .= "\"email\":\"" . $distroMember->getEmail() . "\"";
                $tempEmailMembers .= "},";
            }
            $tempEmailMembers = rtrim($tempEmailMembers, ",");
            $temp .= $tempEmailMembers;
            $temp .= "]";
            $emailDistrosJSON = $temp . "}";
        } else {
            $emailDistrosJSON = "{error:'id field required'}";
        }

        echo($emailDistrosJSON);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}