<?php
session_save_path('/tmp');
$referer = lib_get::referer();

$loginStatusKey = isset($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) ? base64_decode($_COOKIE[COOKIE_LOGIN_STATUS_KEY]) : NULL;
lib::encrypt(STATUS_LOGGED_OUT, $loginStatusKey, FALSE);

$_COOKIES[COOKIE_LOGIN_STATUS_KEY] = FALSE;
setcookie(COOKIE_LOGIN_STATUS_KEY, "", time()-3600, '/', '.rockthepatch.com', true);
setcookie(COOKIE_LOGIN_STATUS_KEY, "", time()+1, '/', '.rockthepatch.com', true);
if(strpos($referer, 'http://127.0.0.1') !== FALSE) {
    setcookie(COOKIE_LOGIN_STATUS_KEY, "", time()-3600, '/', '127.0.0.1', false);
    setcookie(COOKIE_LOGIN_STATUS_KEY, "", time()+1, '/', '127.0.0.1', false);
}

echo("<meta http-equiv='refresh' content='0;URL=/' />");