<?php

/**
 * Class AccessToken
 * @author - Patches
 * @version - 1.0
 * @history - Created 10/12/2015
 */
class AccessToken {

    private $id;
    private $clientId;
    private $clientSecret;
    private $accessToken;
    private $timeStamp;
    private $scope;

    /**
     * @param int|NULL $id
     * @param string|NULL $clientId
     * @param string|NULL $clientSecret
     * @param string|NULL $accessToken
     * @param string|NULL $timeStamp
     * @param string|NULL $scope
     */
    public function __construct($id = NULL, $clientId = NULL, $clientSecret = NULL, $accessToken = NULL, $timeStamp = NULL, $scope = NULL) {
        if(is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if(is_string($clientId) || $clientId == NULL) {
            $this->clientId = $clientId;
        } else {
            trigger_error('Expected a string or null for $clientId.', E_USER_WARNING);
        }
        if(is_string($clientSecret) || $clientSecret == NULL) {
            $this->clientSecret = $clientSecret;
        } else {
            trigger_error('Expected a string or null for $clientSecret.', E_USER_WARNING);
        }
        if(is_string($accessToken) || $accessToken == NULL) {
            $this->accessToken = $accessToken;
        } else {
            trigger_error('Expected a string or null for $accessToken.', E_USER_WARNING);
        }
        if(is_string($timeStamp) || $timeStamp == NULL) {
            $this->timeStamp = $timeStamp;
        } else {
            trigger_error('Expected a string or null for $timeStamp.', E_USER_WARNING);
        }
        if(is_string($scope) || $scope == NULL) {
            $this->scope = $scope;
        } else {
            trigger_error('Expected a string or null for $scope.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int|NULL $id
     */
    public function setId($id) {
        if(is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getClientId() {
        return $this->clientId;
    }

    /**
     * @param string|NULL $clientId
     */
    public function setClientId($clientId) {
        if(is_string($clientId) || $clientId == NULL) {
            $this->clientId = $clientId;
        } else {
            trigger_error('Expected a string or null for $clientId.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getClientSecret() {
        return $this->clientSecret;
    }

    /**
     * @param string|NULL $clientSecret
     */
    public function setClientSecret($clientSecret) {
        if(is_string($clientSecret) || $clientSecret == NULL) {
            $this->clientSecret = $clientSecret;
        } else {
            trigger_error('Expected a string or null for $clientSecret.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getAccessToken() {
        return $this->accessToken;
    }

    /**
     * @param string|NULL $accessToken
     */
    public function setAccessToken($accessToken) {
        if(is_string($accessToken) || $accessToken == NULL) {
            $this->accessToken = $accessToken;
        } else {
            trigger_error('Expected a string or null for $accessToken.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getTimeStamp() {
        return $this->timeStamp;
    }

    /**
     * @param string|NULL $timeStamp
     */
    public function setTimeStamp($timeStamp) {
        if(is_string($timeStamp) || $timeStamp == NULL) {
            $this->timeStamp = $timeStamp;
        } else {
            trigger_error('Expected a string or null for $timeStamp.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getScope() {
        return $this->scope;
    }

    /**
     * @param string|NULL $scope
     */
    public function setScope($scope) {
        if(is_string($scope) || $scope == NULL) {
            $this->scope = $scope;
        } else {
            trigger_error('Expected a string or null for $scope.', E_USER_WARNING);
        }
    }
}