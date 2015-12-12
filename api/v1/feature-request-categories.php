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
            $featureRequestCategory = lib_database::getFeatureRequestCategoryById($_GET['id']);
            if($featureRequestCategory->isDefault() != NULL && $featureRequestCategory->isDefault() == TRUE) {
                $isDefault = 1;
            } else {
                $isDefault = 0;
            }
            $featureRequestCategoryJSON = "{";
            $featureRequestCategoryJSON .= "\"id\":" . $featureRequestCategory->getId() . ",";
            $featureRequestCategoryJSON .= "\"name\":\"" . $featureRequestCategory->getName() . "\",";
            $featureRequestCategoryJSON .= "\"distro\":" . $featureRequestCategory->getDistro() . ",";
            $featureRequestCategoryJSON .= "\"isDefault\":" . $isDefault;
            $featureRequestCategoryJSON .= "}";
        } else {
            $featureRequestCategoryJSON = "{error:'id field required'}";
        }

        echo($featureRequestCategoryJSON);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}