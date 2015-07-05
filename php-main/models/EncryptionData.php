<?php

/**
 * Class EncryptionData
 */
class EncryptionData {
    private $id;
    private $identifier;
    private $cipher;
    private $key;
    private $iv;
    private $time;

    /**
     * EncryptionData constructor.
     * @param int|NULL $id
     * @param string|array|NULL $identifier
     * @param string|NULL $cipher
     * @param string|NULL $key
     * @param string|NULL $iv
     * @param string|NULL $time
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
     * @return int|NULL
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
     * @return string|NULL
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
     * @return string|NULL
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
     * @return string|NULL
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
     * @return string|NULL
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
     * @return string|NULL
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