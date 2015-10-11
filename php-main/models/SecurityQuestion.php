<?php

/**
 * Class SecurityQuestion
 * @author - Patches
 * @version - 1.0
 * @history - Created 07/13/2015
 */
class SecurityQuestion {
    private $id;
    private $question;

    /**
     * @param string|NULL $id - The id of the security question
     * @param string|NULL $question - The security question
     */
    public function __construct($id = NULL, $question = NULL) {
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if (is_string($question) || $question == NULL) {
            $this->question = $question;
        } else {
            trigger_error('Expected an string or null for $question.', E_USER_WARNING);
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
     * @return string|NULL $question
     */
    public function getQuestion() {
        return $this->question;
    }

    /**
     * @param string|NULL $question
     */
    public function setQuestion($question) {
        if (is_string($question) || $question == NULL) {
            $this->question = $question;
        } else {
            trigger_error('Expected an string or null for $question.', E_USER_WARNING);
        }
    }
}