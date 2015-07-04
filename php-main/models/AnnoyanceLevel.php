<?php

/**
 * Class AnnoyanceLevel
 */
class AnnoyanceLevel {
    private $id;
    private $name;
    private $level;
    private $isDefault;

    /**
     * @param int|NULL $id The id of the annoyance level
     * @param string|NULL $name The name of the annoyance level
     * @param int|NULL $level The integer value of the severity/annoyance level
     * @param bool|NULL $isDefault If the annoyance level is the default one selected in the UI
     */
    public function __construct($id = NULL, $name = NULL, $level = NULL, $isDefault = NULL) {
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if (is_string($name) || $name == NULL) {
            $this->name = $name;
        } else {
            trigger_error('Expected a string or null for $name.', E_USER_WARNING);
        }
        if (is_int($level) || $level == NULL) {
            $this->level = $level;
        } else {
            trigger_error('Expected an int or null for $level', E_USER_WARNING);
        }
        if (is_bool($isDefault) || $isDefault == NULL) {
            $this->isDefault = $isDefault;
        } else {
            trigger_error('Expected a bool or null for $isDefault', E_USER_WARNING);
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
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string|NULL $name
     */
    public function setName($name) {
        if (is_string($name) || $name == NULL) {
            $this->name = $name;
        } else {
            trigger_error('Expected a string or null for $name.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL
     */
    public function getLevel() {
        return $this->level;
    }

    /**
     * @param int|NULL $level
     */
    public function setLevel($level) {
        if (is_int($level) || $level == NULL) {
            $this->level = $level;
        } else {
            trigger_error('Expected an int or null for $level.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL
     */
    public function isDefault() {
        return $this->isDefault;
    }

    /**
     * @param bool|NULL $isDefault
     */
    public function setIsDefault($isDefault) {
        if (is_bool($isDefault) || $isDefault == NULL) {
            $this->isDefault = $isDefault;
        } else {
            trigger_error('Expected a bool or null for $isDefault.', E_USER_WARNING);
        }
    }
}