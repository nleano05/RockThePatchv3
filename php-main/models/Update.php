<?php

/**
 * Class Update
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/02/2015
 */
class Update {
    private $id;
    private $title;
    private $text;
    private $date;

    /**
     * @param int|NULL $id - The id of the update
     * @param string|NULL $title - The title of the update
     * @param string|NULL $text - The string/html body of the update
     * @param string|NULL $date - The date of publication for the update
     */
    public function __construct($id = NULL, $title = NULL, $text = NULL, $date = NULL) {
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
        if (is_string($title) || $title == NULL) {
            $this->title = $title;
        } else {
            trigger_error('Expected an string or null for $title.', E_USER_WARNING);
        }
        if (is_string($text) || $text == NULL) {
            $this->text = $text;
        } else {
            trigger_error('Expected an string or null for $text.', E_USER_WARNING);
        }
        if (is_string($date) || $date == NULL) {
            $this->date = $date;
        } else {
            trigger_error('Expected an string or null for $date.', E_USER_WARNING);
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
     * @return string|NULL $title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string|NULL $title
     */
    public function setTitle($title) {
        if (is_string($title) || $title == NULL) {
            $this->title = $title;
        } else {
            trigger_error('Expected an string or null for $title.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $text
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string|NULL $text
     */
    public function setText($text) {
        if (is_string($text) || $text == NULL) {
            $this->text = $text;
        } else {
            trigger_error('Expected an string or null for $text.', E_USER_WARNING);
        }
    }

    /**
     * @return string|NULL $date
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param string|NULL $date
     */
    public function setDate($date) {
        if (is_string($date) || $date == NULL) {
            $this->date = $date;
        } else {
            trigger_error('Expected an string or null for $date.', E_USER_WARNING);
        }
    }
}