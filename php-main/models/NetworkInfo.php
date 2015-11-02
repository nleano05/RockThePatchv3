<?php

/**
 * Class FeatureRequestCategory
 * @author - Patches
 * @version - 1.0
 * @history - Created 10/14/2015
 */
Class NetworkInfo {
    private $networkClass;
    private $cidr;
    private $networkPortion;
    private $hostPortion;
    private $numberOfSubnets;
    private $numberOfUsableSubnets;
    private $numberOfHosts;
    private $numberOfUsableHosts;
    private $wildcard;
    private $networkID;
    private $broadcastID;
    private $firstHostIP;
    private $lastHostIP;

    /**
     * @param string|NULL $networkClass
     * @param float|NULL $cidr
     * @param float|NULL $networkPortion
     * @param float|NULL $hostPortion
     * @param int|NULL $numberOfSubnets
     * @param int|NULL $numberOfUsableSubnets
     * @param int|NULL $numberOfHosts
     * @param int|NULL $numberOfUsableHosts
     * @param string|NULL $wildcard
     * @param string|NULL $networkID
     * @param string|NULL $broadcastID
     * @param string|NULL $firstHostIP
     * @param string|NULL $lastHostIP
     */
    public function __construct($networkClass = NULL, $cidr = NULL, $networkPortion = NULL, $hostPortion = NULL, $numberOfSubnets = NULL, $numberOfUsableSubnets = NULL, $numberOfHosts = NULL, $numberOfUsableHosts = NULL, $wildcard = NULL, $networkID = NULL, $broadcastID = NULL, $firstHostIP= NULL, $lastHostIP = NULL) {
        if (is_string($networkClass) || $networkClass == NULL) {
            $this->networkClass = $networkClass;
        } else {
            trigger_error('Expected a string or null for $networkClass.', E_USER_WARNING);
        }
        if (is_float($cidr) || $cidr == NULL) {
            $this->cidr = $cidr;
        } else {
            trigger_error('Expected a float or null for $cidr.', E_USER_WARNING);
        }
        if (is_float($networkPortion) || $networkPortion == NULL) {
            $this->networkPortion = $networkPortion;
        } else {
            trigger_error('Expected a float or null for $networkPotion.', E_USER_WARNING);
        }
        if (is_float($hostPortion) || $hostPortion == NULL) {
            $this->hostPortion = $hostPortion;
        } else {
            trigger_error('Expected a float or null for $hostPortion.', E_USER_WARNING);
        }
        if (is_int($numberOfSubnets) || $numberOfSubnets == NULL) {
            $this->numberOfSubnets = $numberOfSubnets;
        } else {
            trigger_error('Expected a float or null for $numberOfSubnets.', E_USER_WARNING);
        }
        if (is_int($numberOfUsableSubnets) || $numberOfUsableSubnets == NULL) {
            $this->numberOfUsableSubnets = $numberOfUsableSubnets;
        } else {
            trigger_error('Expected a float or null for $numberOfUsableSubnets.', E_USER_WARNING);
        }
        if (is_int($numberOfHosts) || $numberOfHosts == NULL) {
            $this->numberOfHosts = $numberOfHosts;
        } else {
            trigger_error('Expected a float or null for $numberOfHosts.', E_USER_WARNING);
        }
        if (is_int($numberOfUsableHosts) || $numberOfUsableHosts == NULL) {
            $this->numberOfUsableHosts = $numberOfUsableHosts;
        } else {
            trigger_error('Expected a float or null for $numberOfUsableHosts.', E_USER_WARNING);
        }
        if (is_string($wildcard) || $wildcard == NULL) {
            $this->wildcard = $wildcard;
        } else {
            trigger_error('Expected a string or null for $wildcard.', E_USER_WARNING);
        }
        if (is_string($networkID) || $networkID == NULL) {
            $this->networkID = $networkID;
        } else {
            trigger_error('Expected a string or null for $networkID.', E_USER_WARNING);
        }
        if (is_string($broadcastID) || $broadcastID == NULL) {
            $this->broadcastID = $broadcastID;
        } else {
            trigger_error('Expected a string or null for $broadcastID.', E_USER_WARNING);
        }
        if (is_string($firstHostIP) || $firstHostIP == NULL) {
            $this->firstHostIP = $firstHostIP;
        } else {
            trigger_error('Expected a string or null for $firstHostIP.', E_USER_WARNING);
        }
        if (is_string($lastHostIP) || $lastHostIP == NULL) {
            $this->lastHostIP = $lastHostIP;
        } else {
            trigger_error('Expected a string or null for $lastHostIP.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $networkClass
     */
    public function getNetworkClass() {
        return $this->networkClass;
    }

    /**
     * @param string|NULL $networkClass
     */
    public function setNetworkClass($networkClass) {
        if (is_string($networkClass) || $networkClass == NULL) {
            $this->networkClass = $networkClass;
        } else {
            trigger_error('Expected a string or null for $networkClass.', E_USER_WARNING);
        }
    }

    /**
     * @return float|string|NULL $cidr
     */
    public function getCidr() {
        return $this->cidr;
    }

    /**
     * @param float|string|NULL $cidr
     */
    public function setCidr($cidr) {
        if (is_float($cidr) || is_string($cidr) || $cidr == NULL) {
            $this->cidr = $cidr;
        } else {
            trigger_error('Expected a float or null for $cidr.', E_USER_WARNING);
        }
    }

    /**
     * @return float|string|NULL $networkPortion
     */
    public function getNetworkPortion() {
        return $this->networkPortion;
    }

    /**
     * @param float|string|NULL $networkPortion
     */
    public function setNetworkPortion($networkPortion) {
        if (is_float($networkPortion) || is_string($networkPortion) || $networkPortion == NULL) {
            $this->networkPortion = $networkPortion;
        } else {
            trigger_error('Expected a float or null for $networkPotion.', E_USER_WARNING);
        }
    }

    /**
     * @return float|NULL $hostPortion
     */
    public function getHostPortion() {
        return $this->hostPortion;
    }

    /**
     * @param float|NULL $hostPortion
     */
    public function setHostPortion($hostPortion) {
        if (is_float($hostPortion) || is_int($hostPortion) || $hostPortion == NULL) {
            $this->hostPortion = $hostPortion;
        } else {
            trigger_error('Expected a float, int, or null for $hostPortion.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $numberOfSubnets
     */
    public function getNumberOfSubnets() {
        return $this->numberOfSubnets;
    }

    /**
     * @param int|NULL $numberOfSubnets
     */
    public function setNumberOfSubnets($numberOfSubnets) {
        if (is_int($numberOfSubnets) || $numberOfSubnets == NULL) {
            $this->numberOfSubnets = $numberOfSubnets;
        } else {
            trigger_error('Expected a float or null for $numberOfSubnets.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $numberOfUsableSubnets
     */
    public function getNumberOfUsableSubnets() {
        return $this->numberOfUsableSubnets;
    }

    /**
     * @param int|NULL $numberOfUsableSubnets
     */
    public function setNumberOfUsableSubnets($numberOfUsableSubnets) {
        if (is_int($numberOfUsableSubnets) || $numberOfUsableSubnets == NULL) {
            $this->numberOfUsableSubnets = $numberOfUsableSubnets;
        } else {
            trigger_error('Expected a float or null for $numberOfUsableSubnets.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $numberOfHosts
     */
    public function getNumberOfHosts() {
        return $this->numberOfHosts;
    }

    /**
     * @param int|NULL $numberOfHosts
     */
    public function setNumberOfHosts($numberOfHosts) {
        if (is_int($numberOfHosts) || $numberOfHosts == NULL) {
            $this->numberOfHosts = $numberOfHosts;
        } else {
            trigger_error('Expected a float or null for $numberOfHosts.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $numberOfUsableHosta
     */
    public function getNumberOfUsableHosts() {
        return $this->numberOfUsableHosts;
    }

    /**
     * @param int|NULL $numberOfUsableHosts
     */
    public function setNumberOfUsableHosts($numberOfUsableHosts) {
        if (is_int($numberOfUsableHosts) || $numberOfUsableHosts == NULL) {
            $this->numberOfUsableHosts = $numberOfUsableHosts;
        } else {
            trigger_error('Expected a float or null for $numberOfUsableHosts.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $wildcard
     */
    public function getWildcard() {
        return $this->wildcard;
    }

    /**
     * @param string|NULL $wildcard
     */
    public function setWildcard($wildcard) {
        if (is_string($wildcard) || $wildcard == NULL) {
            $this->wildcard = $wildcard;
        } else {
            trigger_error('Expected a string or null for $wildcard.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $networkID
     */
    public function getNetworkID() {
        return $this->networkID;
    }

    /**
     * @param string}NULL $networkID
     */
    public function setNetworkID($networkID) {
        if (is_string($networkID) || $networkID == NULL) {
            $this->networkID = $networkID;
        } else {
            trigger_error('Expected a string or null for $networkID.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $broadcastID
     */
    public function getBroadcastID() {
        return $this->broadcastID;
    }

    /**
     * @param string|NULL $broadcastID
     */
    public function setBroadcastID($broadcastID) {
        if (is_string($broadcastID) || $broadcastID == NULL) {
            $this->broadcastID = $broadcastID;
        } else {
            trigger_error('Expected a string or null for $broadcastID.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $firstHostIP
     */
    public function getFirstHostIP() {
        return $this->firstHostIP;
    }

    /**
     * @param string|NULL $firstHostIP
     */
    public function setFirstHostIP($firstHostIP) {
        if (is_string($firstHostIP) || $firstHostIP == NULL) {
            $this->firstHostIP = $firstHostIP;
        } else {
            trigger_error('Expected a string or null for $firstHostIP.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $lastHostIP
     */
    public function getLastHostIP() {
        return $this->lastHostIP;
    }

    /**
     * @param string|NULL $lastHostIP
     */
    public function setLastHostIP($lastHostIP) {
        if (is_string($lastHostIP) || $lastHostIP == NULL) {
            $this->lastHostIP = $lastHostIP;
        } else {
            trigger_error('Expected a string or null for $lastHostIP.', E_USER_WARNING);
        }
    }
}