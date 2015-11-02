<?php
session_save_path('/tmp');

include("../php-main/lib.php");

if(lib_get::loginStatus() == STATUS_LOGGED_IN) {
    if (lib_check::userIsAdmin()) {
        if (isset($_POST['enable'])) {
            $debugMode = TRUE;
            $_COOKIES[COOKIE_DEBUG_MODE] = TRUE;
            lib::cookieCreate(COOKIE_DEBUG_MODE, TRUE, TRUE);
        }

        if (isset($_POST['disable']) || isset($_POST['disable-cookie'])) {
            global $debugMode;

            $debugMode = FALSE;
            $_COOKIES[COOKIE_DEBUG_MODE] = FALSE;

            setcookie(COOKIE_DEBUG_MODE, "", time() - 3600, '/', '.rockthepatch.com', TRUE);
            setcookie(COOKIE_DEBUG_MODE, "", time() + 1, '/', '.rockthepatch.com', TRUE);

            if (strpos(lib_get::referer(), '127.0.0.1') !== FALSE) {
                setcookie(COOKIE_DEBUG_MODE, "", time() - 3600, '/', '127.0.0.1', FALSE);
                setcookie(COOKIE_DEBUG_MODE, "", time() + 1, '/', '127.0.0.1', FALSE);
            }
        }
    }
}

echo("<meta http-equiv='refresh' content='0;URL=../web-admin/modify-debug-mode-finished.php' />");