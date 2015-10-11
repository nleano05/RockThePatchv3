<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\Update.php');

/** @noinspection PhpUndefinedClassInspection */
class UpdateTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $update = new Update();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getId() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getTitle() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getText() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getDate() == NULL);
    }

    public function testConstructorWithValues() {
        $update = new Update(1, "title", "update text", "date");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getTitle() == "title");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getText() == "update text");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getDate() == "date");
    }

    public function testGettersAndSetters() {
        $update = new Update();

        $update->setId(1);
        $update->setTitle("title");
        $update->setText("update text");
        $update->setDate("date");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getTitle() == "title");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getText() == "update text");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($update->getDate() == "date");
    }
}