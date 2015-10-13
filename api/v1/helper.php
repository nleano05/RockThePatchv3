<?php

function getRootPath() {
    $rootPath = $_SERVER['DOCUMENT_ROOT'];

    if(strpos($_SERVER['SERVER_NAME'], 'staging') !== FALSE ) {
        $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/staging/";
    } else if (strpos($_SERVER['SERVER_NAME'], 'integration') !== FALSE) {
        $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/integration/";
    } else if (strpos($_SERVER['SERVER_NAME'], 'v3') !== FALSE) {
        $rootPath = $_SERVER['DOCUMENT_ROOT'] . "/v3/";
    }

    return $rootPath;
}