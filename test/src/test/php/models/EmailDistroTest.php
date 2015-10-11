<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\EmailDistro.php');

/** @noinspection PhpUndefinedClassInspection */
class EmailDistroTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $emailDistro = new EmailDistro();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getEmails(), NULL);
    }

    public function testConstructorWithValues() {
        $emailDistro = new EmailDistro(1, "distro", ["email-one@domain.com", "email-two@domain.com"]);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getName(), "distro");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getEmails(),  ["email-one@domain.com", "email-two@domain.com"]);
    }

    public function testGettersAndSetters() {
        $emailDistro = new EmailDistro();

        $emailDistro->setId(1);
        $emailDistro->setName("distro");
        $emailDistro->setEmails(["email-one@domain.com", "email-two@domain.com"]);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getName(), "distro");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($emailDistro->getEmails(),  ["email-one@domain.com", "email-two@domain.com"]);
    }
}
