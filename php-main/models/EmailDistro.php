<?php

/**
 * Class EmailDistro
 * @author - Patches
 * @version - 1.0
 * @history - Created 07/03/2015
 */
class EmailDistro {
    private $id;
    private $name;
    private $distroMembers;

    /**
     * @param int|NULL $id - The id of the email distro
     * @param string|NULL $name - The name of the email distro
     * @param array|NULL $distroMembers - A string array of emails attached to the email distro
     */
    public function __construct($id = NULL, $name = NULL, $distroMembers = NULL) {
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
        if (is_array($distroMembers) || $distroMembers == NULL) {
            $this->distroMembers = $distroMembers;
        } else {
            trigger_error('Expected an array or null for $distroMembers.', E_USER_WARNING);
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
     * @return array|NULL $distroMembers
     */
    public function getDistroMembers() {
        return $this->distroMembers;
    }

    /**
     * @param array|NULL $distroMembers
     */
    public function setDistroMembers($distroMembers) {
        if (is_array($distroMembers) || $distroMembers == NULL) {
            $this->distroMembers = $distroMembers;
        } else {
            trigger_error('Expected an array or null for $distroMembers.', E_USER_WARNING);
        }
    }
}