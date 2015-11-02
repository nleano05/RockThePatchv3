<?php

/**
 * Class IPOverlapDetector
 * @author - Patches
 * @version - 1.0
 * @history - Created 11/1/2015
 */
class IPOverlapDetector {

    private $overlapDetected;
    private $overlapsWithUsersIP;
    private $ipOfOverlap;
    private $subnetOfOverlap;

    /**
     * @param bool|NULL $overlapDetected
     * @param bool|NULL $overlapsWithUsersIP
     * @param string|NULL $ipOfOverlap
     * @param string|NULL $subnetOfOverlap
     */
    public function __construct($overlapDetected = NULL, $overlapsWithUsersIP = NULL, $ipOfOverlap = NULL, $subnetOfOverlap = NULL) {
        if(is_bool($overlapDetected) || $overlapDetected == NULL) {
            $this->overlapDetected = $overlapDetected;
        } else {
            trigger_error('Expected a bool or null for $overlapDetected.', E_USER_WARNING);
        }
        if(is_bool($overlapsWithUsersIP) || $overlapsWithUsersIP == NULL) {
            $this->overlapsWithUsersIP = $overlapsWithUsersIP;
        } else {
            trigger_error('Expected a bool or null for $overlapsWithUsersIP.', E_USER_WARNING);
        }
        if(is_string($ipOfOverlap) || $ipOfOverlap == NULL) {
            $this->ipOfOverlap = $ipOfOverlap;
        } else {
            trigger_error('Expected a string or null for $ipOfOverlap.', E_USER_WARNING);
        }
        if(is_string($subnetOfOverlap) || $subnetOfOverlap == NULL) {
            $this->subnetOfOverlap = $subnetOfOverlap;
        } else {
            trigger_error('Expected a string or null for $subnetOfOverlap.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL $overlapDetected
     */
    public function overlapDetected() {
        return $this->overlapDetected;
    }

    /**
     * @param bool|NULL $overlapDetected
     */
    public function setOverlapDetected($overlapDetected) {
        if(is_bool($overlapDetected) || $overlapDetected == NULL) {
            $this->overlapDetected = $overlapDetected;
        } else {
            trigger_error('Expected a bool or null for $overlapDetected.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL $overlapWithUsersIP
     */
    public function overlapsWithUsersIP() {
        return $this->overlapsWithUsersIP;
    }

    /**
     * @param bool|NULL $overlapsWithUsersIP
     */
    public function setOverlapsWithUsersIP($overlapsWithUsersIP) {
        if(is_bool($overlapsWithUsersIP) || $overlapsWithUsersIP == NULL) {
            $this->overlapsWithUsersIP = $overlapsWithUsersIP;
        } else {
            trigger_error('Expected a bool or null for $overlapsWithUsersIP.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $ipOfOverlap
     */
    public function getIpOfOverlap() {
        return $this->ipOfOverlap;
    }

    /**
     * @param string|NULL $ipOfOverlap
     */
    public function setIpOfOverlap($ipOfOverlap) {
        if(is_string($ipOfOverlap) || $ipOfOverlap == NULL) {
            $this->ipOfOverlap = $ipOfOverlap;
        } else {
            trigger_error('Expected a string or null for $ipOfOverlap.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $subnetOfOverlap
     */
    public function getSubnetOfOverlap() {
        return $this->subnetOfOverlap;
    }

    /**
     * @param string|NULL $subnetOfOverlap
     */
    public function setSubnetOfOverlap($subnetOfOverlap) {
        if(is_string($subnetOfOverlap) || $subnetOfOverlap == NULL) {
            $this->subnetOfOverlap = $subnetOfOverlap;
        } else {
            trigger_error('Expected a string or null for $subnetOfOverlap.', E_USER_WARNING);
        }
    }
}