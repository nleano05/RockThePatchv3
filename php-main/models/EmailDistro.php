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
    private $emails;

    /**
     * @param int|NULL $id - The id of the email distro
     * @param string|NULL $name - The name of the email distro
     * @param array|NULL $emails - A string array of emails attached to the email distro
     */
    public function __construct($id = NULL, $name = NULL, $emails = NULL) {
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
        if (is_array($emails) || $emails == NULL) {
            $this->emails = $emails;
        } else {
            trigger_error('Expected an array or null for $emails.', E_USER_WARNING);
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
     * @return array|NULL $emails
     */
    public function getEmails() {
        return $this->emails;
    }

    /**
     * @param array|NULL $emails
     */
    public function setEmails($emails) {
        if (is_array($emails) || $emails == NULL) {
            $this->emails = $emails;
        } else {
            trigger_error('Expected an array or null for $emails.', E_USER_WARNING);
        }
    }
}