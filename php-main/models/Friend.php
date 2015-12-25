<?php

/**
 * Class Friend
 * @author - Patches
 * @version - 1.0
 * @history - Created 12/25/2015
 */
class Friend {
    private $user;
    private $userId;
    private $friendId;
    private $status;


    /**
     * @param User|null $user
     * @param int|null $userId
     * @param int|null $friendId
     * @param int|null $status
     */
    public function __construct($user = NULL, $userId = NULL, $friendId = NULL, $status = NULL) {
        if ($user instanceof User || $user == NULL) {
            $this->user = $user;
        } else {
            trigger_error('Expected User or null for $user.', E_USER_WARNING);
        }
        if (is_int($userId) || $userId == NULL) {
            $this->userId = $userId;
        } else {
            trigger_error('Expected an int or null for $userId.', E_USER_WARNING);
        }
        if (is_int($friendId) || $friendId == NULL) {
            $this->friendId = $friendId;
        } else {
            trigger_error('Expected an int or null for $friendId.', E_USER_WARNING);
        }
        if (is_int($status) || $status == NULL) {
            $this->status = $status;
        } else {
            trigger_error('Expected a int or null for $status.', E_USER_WARNING);
        }
    }

    /**
     * @return User|null $user
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser($user) {
        if ($user instanceof User || $user == NULL) {
            $this->user = $user;
        } else {
            trigger_error('Expected User or null for $user.', E_USER_WARNING);
        }
    }

    /**
     * @return int|null $userId
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId($userId) {
        if (is_int($userId) || $userId == NULL) {
            $this->userId = $userId;
        } else {
            trigger_error('Expected an int or null for $userId.', E_USER_WARNING);
        }
    }

    /**
     * @return int|null $friendId
     */
    public function getFriendId() {
        return $this->friendId;
    }

    /**
     * @param int|null $friendId
     */
    public function setFriendId($friendId) {
        if (is_int($friendId) || $friendId == NULL) {
            $this->friendId = $friendId;
        } else {
            trigger_error('Expected an int or null for $friendId.', E_USER_WARNING);
        }
    }

    /**
     * @return int|null $status
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus($status) {
        if (is_int($status) || $status == NULL) {
            $this->status = $status;
        } else {
            trigger_error('Expected a int or null for $status.', E_USER_WARNING);
        }
    }
}