<?php

/**
 * Class FeatureRequestCategory
 * @author - Patches
 * @version - 1.0
 * @history - Created 10/04/2015
 */
class FeatureRequestCategory {
    private $id;
    private $name;
    private $distro;
    private $isDefault;

    /**
     * @param int|NULL $id - The id of the error report category
     * @param string|NULL $name - The name of the error report category
     * @param int|NULL $distro - The id of the email distro the error report category is attached to
     * @param bool|NULL $isDefault - If the error report category is selected by default in the UI
     */
    public function __construct($id = NULL, $name = NULL, $distro = NULL, $isDefault = NULL) {
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
        if (is_int($distro) || $distro == NULL) {
            $this->distro = $distro;
        } else {
            trigger_error('Expected an int or null for $distro.', E_USER_WARNING);
        }
        if (is_bool($isDefault) || $isDefault == NULL) {
            $this->isDefault = $isDefault;
        } else {
            trigger_error('Expected a bool or null for $isDefault.', E_USER_WARNING);
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
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string }NULL $name
     */
    public function setName($name) {
        if (is_string($name) || $name == NULL) {
            $this->name = $name;
        } else {
            trigger_error('Expected a string or null for $name.', E_USER_WARNING);
        }
    }


    /**
     * @return int|NULL $distro
     */
    public function getDistro() {
        return $this->distro;
    }

    /**
     * @param int|NULL $distro
     */
    public function setDistro($distro) {
        if (is_int($distro) || $distro == NULL) {
            $this->distro = $distro;
        } else {
            trigger_error('Expected an int or null for $distro.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL $isDefault
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