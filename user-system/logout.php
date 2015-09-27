<?php
session_save_path('/tmp');

include("../php-main/lib.php");

$unsetCookieKeys = array(COOKIE_LOGIN_STATUS_KEY);
$loginStatusKey = isset($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) ? base64_decode($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) : NULL;

lib::encrypt(STATUS_LOGGED_OUT, $loginStatusKey);

foreach($unsetCookieKeys as $key) {
    log_util::log(LOG_LEVEL_DEBUG, "Un-setting cookie: " . $key);
    lib::cookieDestroy($key);
}

$referer = lib_get::referer();

if($referer != NULL) {
    log_util::log(LOG_LEVEL_DEBUG, "The referer WAS set");

    if(lib_check::endsWith("/user-system/login.php", $referer)) {
        log_util::log(LOG_LEVEL_DEBUG, "Redirecting login to index");
        lib::redirect(FALSE, NULL, FALSE, "/index.php");
    } else if(lib_check::endsWith("/user-system/deactivate-account-confirm.php", $referer)) {
        log_util::log(LOG_LEVEL_DEBUG, "Redirecting deactivate account confirm to deactivate account finished");
        lib::redirect(FALSE, NULL, FALSE, "/user-system/deactivate-account-finished.php");
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "Redirecting back to referer");
        lib::redirect(FALSE, NULL, TRUE, NULL);
    }
} else {
    log_util::log(LOG_LEVEL_DEBUG, "The referer WAS NOT set");
    lib::redirect(FALSE, NULL, FALSE, "/index.php");
}