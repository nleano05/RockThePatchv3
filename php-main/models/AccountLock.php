<?php

/**
 * Class AnnoyanceLevel
 */
class AccountLock {
    private $locked = "";
    private $type = "";
    private $timeLocked = "";
    private $timeDifference = "";

    /**
     * AccountLock constructor.
     * @param bool|NULL $locked
     * @param int|NULL $type
     * @param string|NULL $timeLocked
     * @param string|NULL $timeDifference
     */
    public function __construct($locked = NULL, $type = NULL, $timeLocked = NULL, $timeDifference = NULL) {
        if(is_bool($locked) || $locked == NULL) {
            $this->locked = $locked;
        } else {
            trigger_error('Expected an bool or null for $locked.', E_USER_WARNING);
        }
        if(is_int($type) || $type == NULL) {
            $this->type = $type;
        } else {
            trigger_error('Expected an int or null for $type.', E_USER_WARNING);
        }
        if(is_string($timeLocked) || $timeLocked == NULL) {
            $this->timeLocked = $timeLocked;
        } else {
            trigger_error('Expected a string or null for $timeLocked.', E_USER_WARNING);
        }
        if(is_string($timeDifference) || $timeDifference == NULL) {
            $this->timeDifference = $timeDifference;
        } else {
            trigger_error('Expected a string or null for $timeLocked.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL
     */
    public function getLocked() {
        return $this->locked;
    }

    /**
     * @param bool|NULL $locked
     */
    public function setLocked($locked) {
        if(is_bool($locked) || $locked == NULL) {
            $this->locked = $locked;
        } else {
            trigger_error('Expected an bool or null for $locked.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param int|NULL $type
     */
    public function setType($type) {
        if(is_int($type) || $type == NULL) {
            $this->type = $type;
        } else {
            trigger_error('Expected an int or null for $type.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getTimeLocked() {
        return $this->timeLocked;
    }

    /**
     * @param string|NULL $timeLocked
     */
    public function setTimeLocked($timeLocked) {
        if(is_string($timeLocked) || $timeLocked == NULL) {
            $this->timeLocked = $timeLocked;
        } else {
            trigger_error('Expected a string or null for $timeLocked.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getTimeDifference() {
        return $this->timeDifference;
    }

    /**
     * @param string|NULL $timeDifference
     */
    public function setTimeDifference($timeDifference) {
        if(is_string($timeDifference) || $timeDifference == NULL) {
            $this->timeDifference = $timeDifference;
        } else {
            trigger_error('Expected a string or null for $timeLocked.', E_USER_WARNING);
        }
    }
}