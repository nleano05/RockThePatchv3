<?php

/**
 * Class EmailDistroMember
 * @author - Patches
 * @version - 1.0
 * @history - Created 12/06/2015
 */
class EmailDistroMember {
    private $id;
    private $distro;
    private $email;

    /**
     * @param int|NULL $id - The id of the email distro
     * @param int|NULL $distro - The id of the email distro the member is attached to
     * @param string|NULL $email -The email of the member
     */
    public function __construct($id = NULL, $distro = NULL, $email = NULL) {
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if (is_int($distro) || $distro == NULL) {
            $this->distro = $distro;
        } else {
            trigger_error('Expected an int or null for $name.', E_USER_WARNING);
        }
        if (is_string($email) || $email == NULL) {
            $this->email = $email;
        } else {
            trigger_error('Expected a string or null for $emails.', E_USER_WARNING);
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
     * @return int|NULL $distro
     */
    public function getDistro() {
        return $this->dustro;
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
     * @return string|NULL $email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string|NULL $email
     */
    public function setEmail($email) {
        if (is_string($email) || $email == NULL) {
            $this->email = $email;
        } else {
            trigger_error('Expected a string or null for $email.', E_USER_WARNING);
        }
    }
}