<?php

/**
 * Class User
 * @author - Patches
 * @version - 1.0
 * @history - Created 07/03/2015
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
    private $locked;
    private $timeLocked;
    private $consecutiveFailedLoginAttempts;
    private $lastLoginAttemptTime;
    private $friendStatus;

    /**
     * @param int|NULL $id - The id of the user
     * @param string|NULL $firstName - The first name of the user
     * @param string|NULL $lastName - The last name of the user
     * @param string|NULL $userName - The username for the user
     * @param string|NULL $email - The email for the user
     * @param string|NULL $password - An encrypted version of the users password
     * @param int|NULL $securityQuestion - The id of the security question for the user
     * @param string|NULL $securityQuestionAnswer - The answer to the security question the user chose
     * @param bool|NULL $emailBlasts - If the user is signed up to receive email blasts
     * @param bool|NULL $textBlasts - If the user is signed up to receive text blasts
     * @param string|NULL $cell - The user's cell phone number
     * @param int|NULL $role - If the user is a regular user, admin, etc
     * @param bool|NULL $locked - If the user's account is locked or not
     * @param bool|NULL $lockedByAdmin = If the account was locked by an administrator
     * @param int|NULL $timeLocked - The time the account was locked
     * @param int|NULL $consecutiveFailedLoginAttempts - The number of failed login attempts in a row
     * @param string|NULL $lastLoginAttemptTime - The last time in UTC of when the user logged in
     * @param int|NULL $friendStatus - How the current user is connected to another user
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
        $locked = NULL,
        $lockedByAdmin = NULL,
        $timeLocked = NULL,
        $consecutiveFailedLoginAttempts = NULL,
        $lastLoginAttemptTime = NULL,
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
        if (is_bool($locked) || $locked == NULL) {
            $this->locked = $locked;
        } else {
            trigger_error('Expected an bool or null for $locked.', E_USER_WARNING);
        }
        if (is_bool($lockedByAdmin) || $lockedByAdmin == NULL) {
            $this->lockedByAdmin = $lockedByAdmin;
        } else {
            trigger_error('Expected a bool or null for $lockedByAdmin.', E_USER_WARNING);
        }
        if (is_string($timeLocked) || $timeLocked == NULL) {
            $this->timeLocked = $timeLocked;
        } else {
            trigger_error('Expected an string or null for $timeLocked.', E_USER_WARNING);
        }
        if (is_int($consecutiveFailedLoginAttempts) || $consecutiveFailedLoginAttempts == NULL) {
            $this->consecutiveFailedLoginAttempts = $consecutiveFailedLoginAttempts;
        } else {
            trigger_error('Expected an int or null for $consecutiveFailedLoginAttempts.', E_USER_WARNING);
        }
        if (is_string($lastLoginAttemptTime) || $lastLoginAttemptTime == NULL) {
            $this->lastLoginAttemptTime = $lastLoginAttemptTime;
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
     * @return string|NULL $firstName
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
     * @return string|NULL $lastName
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
     * @return string|NULL $userName
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

    /**
     * @return string|NULL $password
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
     * @return int|NULL $securityQuestion
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
     * @return string|NULL $securityQuestionAnswer
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
     * @return bool|NULL $emailBlasts
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
     * @return bool|NULL $textBlasts
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
     * @return string|NULL $cell
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
     * @return string|NULL $role
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
     * @return bool|NULL $locked
     */
    public function getLocked() {
        return $this->locked;
    }

    /**
     * @param bool|NULL $locked
     */
    public function setLocked($locked) {
        if (is_bool($locked) || $locked == NULL) {
            $this->locked = $locked;
        } else {
            trigger_error('Expected an bool or null for $locked.', E_USER_WARNING);
        }
    }

    /**
     * @return bool|NULL $lockedByAdmin
     */
    public function getLockedByAdmin() {
        return $this->lockedByAdmin;
    }

    /**
     * @param bool|NULL $lockedByAdmin
     */
    public function setLockedByAdmin($lockedByAdmin) {
        if (is_bool($lockedByAdmin) || $lockedByAdmin == NULL) {
            $this->lockedByAdmin = $lockedByAdmin;
        } else {
            trigger_error('Expected an bool or null for $lockedByAdmin.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $timeLocked
     */
    public function getTimeLocked() {
        return $this->timeLocked;
    }

    /**
     * @param string|NULL $timeLocked
     */
    public function setTimeLocked($timeLocked) {
        if (is_string($timeLocked) || $timeLocked == NULL) {
            $this->timeLocked = $timeLocked;
        } else {
            trigger_error('Expected an string or null for $timeLocked.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $consecutiveFailedLoginAttempts
     */
    public function getConsecutiveFailedLoginAttempts() {
        return $this->consecutiveFailedLoginAttempts;
    }

    /**
     * @param int|NULL $consecutiveFailedLoginAttempts
     */
    public function setConsecutiveFailedLoginAttempts($consecutiveFailedLoginAttempts) {
        if (is_int($consecutiveFailedLoginAttempts) || $consecutiveFailedLoginAttempts == NULL) {
            $this->consecutiveFailedLoginAttempts = $consecutiveFailedLoginAttempts;
        } else {
            trigger_error('Expected an int or null for $consecutiveFailedLoginAttempts.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $lastLoginAttemptTime
     */
    public function getLastLoginAttemptTime() {
        return $this->lastLoginAttemptTime;
    }

    /**
     * @param string|NULL $lastLoginAttemptTime
     */
    public function setLastLoginAttemptTime($lastLoginAttemptTime) {
        if (is_string($lastLoginAttemptTime) || $lastLoginAttemptTime == NULL) {
            $this->lastLoginAttemptTime = $lastLoginAttemptTime;
        } else {
            trigger_error('Expected a string or null for $role.', E_USER_WARNING);
        }
    }

    /**
     * @return int|NULL $friendStatus
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