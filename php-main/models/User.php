<?php

/**
 * Class User
 */
class User {
    private $id;
    private $firstName;
    private $lastName;
    private $userName;
    private $email;
    private $password;
    private $securityQuestion;
    private $securityQuestionAnswer;
    private $emailBlasts;
    private $textBlasts;
    private $cell;
    private $role;
    private $lastLoginAttempt;
    private $friendStatus;

    /**
     * @param int|NULL $id
     * @param string|NULL $firstName
     * @param string|NULL $lastName
     * @param string|NULL $userName
     * @param string|NULL $email
     * @param string|NULL $password
     * @param int|NULL $securityQuestion
     * @param string|NULL $securityQuestionAnswer
     * @param bool|NULL $emailBlasts
     * @param bool|NULL $textBlasts
     * @param string|NULL $cell
     * @param int|NULL $role
     * @param string|NULL $lastLoginAttempt
     * @param int|NULL $friendStatus
     */
    public function __construct(
        $id = NULL,
        $firstName = NULL,
        $lastName = NULL,
        $userName = NULL,
        $email = NULL,
        $password = NULL,
        $securityQuestion = NULL,
        $securityQuestionAnswer = NULL,
        $emailBlasts = NULL,
        $textBlasts = NULL,
        $cell = NULL,
        $role = NULL,
        $lastLoginAttempt = NULL,
        $friendStatus = NULL) {

        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if (is_string($firstName) || $firstName == NULL) {
            $this->firstName = $firstName;
        } else {
            trigger_error('Expected a string or null for $firstName.', E_USER_WARNING);
        }
        if (is_string($lastName) || $lastName == NULL) {
            $this->lastName = $lastName;
        } else {
            trigger_error('Expected a string or null for $lastName.', E_USER_WARNING);
        }
        if (is_string($userName) || $userName == NULL) {
            $this->userName = $userName;
        } else {
            trigger_error('Expected a string or null for $userName.', E_USER_WARNING);
        }
        if (is_string($email) || $email == NULL) {
            $this->email = $email;
        } else {
            trigger_error('Expected a string or null for $email.', E_USER_WARNING);
        }
        if (is_string($password) || $password == NULL) {
            $this->password = $password;
        } else {
            trigger_error('Expected a string or null for $password.', E_USER_WARNING);
        }
        if (is_int($securityQuestion) || $securityQuestion == NULL) {
            $this->securityQuestion = $securityQuestion;
        } else {
            trigger_error('Expected an int or null for $securityQuestion.', E_USER_WARNING);
        }
        if (is_string($securityQuestionAnswer) || $securityQuestionAnswer == NULL) {
            $this->securityQuestionAnswer = $securityQuestionAnswer;
        } else {
            trigger_error('Expected a string or null for $securityQuestion.', E_USER_WARNING);
        }
        if (is_bool($emailBlasts) || $emailBlasts == NULL) {
            $this->emailBlasts = $emailBlasts;
        } else {
            trigger_error('Expected a bool or null for $emailBlasts.', E_USER_WARNING);
        }
        if (is_bool($textBlasts) || $textBlasts == NULL) {
            $this->textBlasts = $textBlasts;
        } else {
            trigger_error('Expected a bool or null for $textBlast.', E_USER_WARNING);
        }
        if (is_string($cell) || $cell == NULL) {
            $this->cell = $cell;
        } else {
            trigger_error('Expected a string or null for $cell.', E_USER_WARNING);
        }
        if (is_int($role) || $role == NULL) {
            $this->role = $role;
        } else {
            trigger_error('Expected an int or null for $role.', E_USER_WARNING);
        }
        if (is_string($lastLoginAttempt) || $lastLoginAttempt == NULL) {
            $this->lastLoginAttempt = $lastLoginAttempt;
        } else {
            trigger_error('Expected a string or null for $role.', E_USER_WARNING);
        }
        if (is_int($friendStatus) || $friendStatus == NULL) {
            $this->friendStatus = $friendStatus;
        } else {
            trigger_error('Expected an int or null for $friendStatus.', E_USER_WARNING);
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
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * @param string|NULL $firstName
     */
    public function setFirstName($firstName) {
        if (is_string($firstName) || $firstName == NULL) {
            $this->firstName = $firstName;
        } else {
            trigger_error('Expected a string or null for $firstName.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param string|NULL $lastName
     */
    public function setLastName($lastName) {
        if (is_string($lastName) || $lastName == NULL) {
            $this->lastName = $lastName;
        } else {
            trigger_error('Expected a string or null for $lastName.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getUserName() {
        return $this->userName;
    }

    /**
     * @param string|NULL $userName
     */
    public function setUserName($userName) {
        if (is_string($userName) || $userName == NULL) {
            $this->userName = $userName;
        } else {
            trigger_error('Expected a string or null for $userName.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
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

    /**
     * @return string|NULL
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string|NULL $password
     */
    public function setPassword($password) {
        if (is_string($password) || $password == NULL) {
            $this->password = $password;
        } else {
            trigger_error('Expected a string or null for $password.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL
     */
    public function getSecurityQuestion() {
        return $this->securityQuestion;
    }

    /**
     * @param int|NULL $securityQuestion
     */
    public function setSecurityQuestion($securityQuestion) {
        if (is_int($securityQuestion) || $securityQuestion == NULL) {
            $this->securityQuestion = $securityQuestion;
        } else {
            trigger_error('Expected an int or null for $securityQuestion.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getSecurityQuestionAnswer() {
        return $this->securityQuestionAnswer;
    }

    /**
     * @param string|NULL $securityQuestionAnswer
     */
    public function setSecurityQuestionAnswer($securityQuestionAnswer) {
        if (is_string($securityQuestionAnswer) || $securityQuestionAnswer == NULL) {
            $this->securityQuestionAnswer = $securityQuestionAnswer;
        } else {
            trigger_error('Expected a string or null for $securityQuestion.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL
     */
    public function getEmailBlasts() {
        return $this->emailBlasts;
    }

    /**
     * @param bool|NULL $emailBlasts
     */
    public function setEmailBlasts($emailBlasts) {
        if (is_bool($emailBlasts) || $emailBlasts == NULL) {
            $this->emailBlasts = $emailBlasts;
        } else {
            trigger_error('Expected a bool or null for $emailBlasts.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL
     */
    public function getTextBlasts() {
        return $this->textBlasts;
    }

    /**
     * @param bool|NULL $textBlasts
     */
    public function setTextBlasts($textBlasts) {
        if (is_bool($textBlasts) || $textBlasts == NULL) {
            $this->textBlasts = $textBlasts;
        } else {
            trigger_error('Expected a bool or null for $textBlast.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getCell() {
        return $this->cell;
    }

    /**
     * @param string|NULL $cell
     */
    public function setCell($cell) {
        if (is_string($cell) || $cell == NULL) {
            $this->cell = $cell;
        } else {
            trigger_error('Expected a string or null for $cell.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @param string|NULL $role
     */
    public function setRole($role) {
        if (is_int($role) || $role == NULL) {
            $this->role = $role;
        } else {
            trigger_error('Expected an int or null for $role.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL
     */
    public function getLastLoginAttempt() {
        return $this->lastLoginAttempt;
    }

    /**
     * @param string|NULL $lastLoginAttempt
     */
    public function setLastLoginAttempt($lastLoginAttempt) {
        if (is_string($lastLoginAttempt) || $lastLoginAttempt == NULL) {
            $this->lastLoginAttempt = $lastLoginAttempt;
        } else {
            trigger_error('Expected a string or null for $role.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL
     */
    public function getFriendStatus() {
        return $this->friendStatus;
    }

    /**
     * @param int|NULL $friendStatus
     */
    public function setFriendStatus($friendStatus) {
        if (is_int($friendStatus) || $friendStatus == NULL) {
            $this->friendStatus = $friendStatus;
        } else {
            trigger_error('Expected an int or null for $friendStatus.', E_USER_WARNING);
        }
    }
}