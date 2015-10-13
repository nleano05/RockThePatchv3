<?php
session_save_path('/tmp');

include("helper.php");
include(getRootPath() . "/php-main/lib.php");

$headers =  apache_request_headers();

log_util::log(LOG_LEVEL_DEBUG, "GET: ", $_GET);
log_util::log(LOG_LEVEL_DEBUG, "Headers: ", $headers);

if(isset($headers['Authorizationtoken'])) {
    if(lib_check::accessToken($headers['Authorizationtoken'])) {
        if(isset($_GET['data'])) {
            $data = "{\"data\":\"";
            $data .= base64_decode($_GET['data']);
            $data .= "\"}";
        } else {
            $data = "{error:'Data field required'}";
        }

        echo($data);
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('HTTP/1.0 404 Not Found');
}