<?php

class Update {
    private $id;
    private $title;
    private $text;
    private $date;

    /**
     * @param int|NULL $id
     * @param string|NULL $title
     * @param string|NULL $text
     * @param string|NULL $date
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
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        if (is_int($id) || $id == NULL) {
            $this->id = $id;
        } else {
            trigger_error('Expected an int or null for $id.', E_USER_WARNING);
        }
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        if (is_string($title) || $title == NULL) {
            $this->title = $title;
        } else {
            trigger_error('Expected an string or null for $title.', E_USER_WARNING);
        }
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text) {
        if (is_string($text) || $text == NULL) {
            $this->text = $text;
        } else {
            trigger_error('Expected an string or null for $text.', E_USER_WARNING);
        }
    }

    /**
     * @return NULL|string
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * @param NULL|string $date
     */
    public function setDate($date) {
        $this->date = $date;
    }
}