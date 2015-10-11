<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\SecurityQuestion.php');

/** @noinspection PhpUndefinedClassInspection */
class SecurityQuestionTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $securityQuestion = new SecurityQuestion();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getQuestion(), NULL);
    }

    public function testConstructorWithValues() {
        $securityQuestion = new SecurityQuestion(1, "security question");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getQuestion(), "security question");
    }

    public function testGettersAndSetters() {
        $securityQuestion = new SecurityQuestion();

        $securityQuestion->setId(1);
        $securityQuestion->setQuestion("security question");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($securityQuestion->getQuestion(), "security question");
    }
}