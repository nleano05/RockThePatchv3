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
            $errorReportCategory = lib_database::getErrorReportCategoryById($_GET['id']);
            if($errorReportCategory->isDefault() != NULL && $errorReportCategory->isDefault() == TRUE) {
                $isDefault = 1;
            } else {
                $isDefault = 0;
            }
            $errorReportCategoryJSON = "{";
            $errorReportCategoryJSON .= "\"id\":" . $errorReportCategory->getId() . ",";
            $errorReportCategoryJSON .= "\"name\":\"" . $errorReportCategory->getName() . "\",";
            $errorReportCategoryJSON .= "\"distro\":" . $errorReportCategory->getDistro() . ",";
            $errorReportCategoryJSON .= "\"isDefault\":" . $isDefault;
            $errorReportCategoryJSON .= "}";
        } else {
            $errorReportCategoryJSON = "{error:'id field required'}";
        }

        echo($errorReportCategoryJSON);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}