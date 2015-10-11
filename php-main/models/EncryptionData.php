<?php

/**
 * Class EncryptionData
 * @author - Patches
 * @version - 1.0
 * @history - Created 07/05/2015
 */
class EncryptionData {
    private $id;
    private $identifier;
    private $cipher;
    private $key;
    private $iv;
    private $time;

    /**
     * @param int|NULL $id - The id of the encryption data
     * @param string|array|NULL $identifier - The unique identifier for encryption/decryption purposes
     * @param string|NULL $cipher - The algorithm used for encryption
     * @param string|NULL $key - The secret key used for encryption
     * @param string|NULL $iv - The initialization vector used for encryption
     * @param string|NULL $time - The time the data was encrypted in UTC
     */
    public function __construct($id = NULL, $identifier = NULL, $cipher = NULL, $key = NULL, $iv = NULL, $time = NULL) {
        if ((is_int($id)) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if ((is_string($identifier)) || $identifier == NULL) {
                $this->identifier = $identifier;
        } else {
            trigger_error('Expected a string or null for $identifier.', E_USER_WARNING);
        }
        if ((is_string($cipher)) || $cipher == NULL) {
            $this->cipher = $cipher;
        } else {
            trigger_error('Expected a string or null for $cipher.', E_USER_WARNING);
        }
        if ((is_string($key)) || $key == NULL) {
            $this->key = $key;
        } else {
            trigger_error('Expected a string or null for $key.', E_USER_WARNING);
        }
        if ((is_string($iv)) || $iv == NULL) {
            $this->iv = $iv;
        } else {
            trigger_error('Expected a string or null for $iv.', E_USER_WARNING);
        }
        if ((is_string($time)) || $time == NULL) {
            $this->time = $time;
        } else {
            trigger_error('Expected a string or null for $time.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int|NULL $id
     */
    public function setId($id) {
        if ((is_int($id)) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $identifier
     */
    public function getIdentifier() {
        return $this->identifier;
    }

    /**
     * @param string|NULL $identifier
     */
    public function setIdentifier($identifier) {
        if ((is_string($identifier)) || $identifier == NULL) {
            $this->identifier = $identifier;
        } else {
            trigger_error('Expected a string or null for $identifier.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $cipher
     */
    public function getCipher() {
        return $this->cipher;
    }

    /**
     * @param string|NULL $cipher
     */
    public function setCipher($cipher) {
        if ((is_string($cipher)) || $cipher == NULL) {
            $this->cipher = $cipher;
        } else {
            trigger_error('Expected a string or null for $cipher.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $key
     */
    public function getKey() {
        return $this->key;
    }

    /**
     * @param string||NULL $key
     */
    public function setKey($key) {
        if ((is_string($key)) || $key == NULL) {
            $this->key = $key;
        } else {
            trigger_error('Expected a string or null for $key.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $iv
     */
    public function getIv() {
        return $this->iv;
    }

    /**
     * @param string|NULL $iv
     */
    public function setIv($iv) {
        if ((is_string($iv)) || $iv == NULL) {
            $this->iv = $iv;
        } else {
            trigger_error('Expected a string or null for $iv.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $time
     */
    public function getTime() {
        return $this->time;
    }

    /**
     * @param string|NULL $time
     */
    public function setTime($time) {
        if ((is_string($time)) || $time == NULL) {
            $this->time = $time;
        } else {
            trigger_error('Expected a string or null for $time.', E_USER_WARNING);
        }
    }
}