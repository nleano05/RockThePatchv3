<?php

/**
 * Class BlockedIPGroup
 * @author - Patches
 * @version - 1.0
 * @history - Created 11/1/2015
 */
class BlockedIPGroup {

    private $id;
    private $ip;
    private $subnet;

    /**
     * @param int|NULL $id
     * @param string|NULL $ip
     * @param string|NULL $subnet
     */
    public function __construct($id = NULL, $ip = NULL, $subnet = NULL) {
        if(is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if(is_string($ip) || $ip == NULL) {
            $this->ip = $ip;
        } else {
            trigger_error('Expected a string or null for $ip.', E_USER_WARNING);
        }
        if(is_string($subnet) || $subnet == NULL) {
            $this->subnet = $subnet;
        } else {
            trigger_error('Expected a string or null for $subnet.', E_USER_WARNING);
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
        if(is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $ip
     */
    public function getIp() {
        return $this->ip;
    }

    /**
     * @param string|NULL $ip
     */
    public function setIp($ip) {
        if(is_string($ip) || $ip == NULL) {
            $this->ip = $ip;
        } else {
            trigger_error('Expected a string or null for $ip.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $subnet
     */
    public function getSubnet() {
        return $this->subnet;
    }

    /**
     * @param string|NULL $subnet
     */
    public function setSubnet($subnet) {
        if(is_string($subnet) || $subnet == NULL) {
            $this->subnet = $subnet;
        } else {
            trigger_error('Expected a string or null for $subnet.', E_USER_WARNING);
        }
    }
}