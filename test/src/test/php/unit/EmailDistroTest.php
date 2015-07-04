<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\EmailDistro.php');

/** @noinspection PhpUndefinedClassInspection */
class EmailDistroTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL(){
        $emailDistro = new EmailDistro();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getId() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getName() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getEmails() == NULL);
    }

    public function testConstructorWithValues() {
        $emailDistro = new EmailDistro(1, "distro", array("email-one@domain.com", "email-two@domain.com"));

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getName() == "distro");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getEmails() ==  array("email-one@domain.com", "email-two@domain.com"));
    }

    public function testGettersAndSetters() {
        $emailDistro = new EmailDistro();

        $emailDistro->setId(1);
        $emailDistro->setName("distro");
        $emailDistro->setEmails(array("email-one@domain.com", "email-two@domain.com"));

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getName() == "distro");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($emailDistro->getEmails() ==  array("email-one@domain.com", "email-two@domain.com"));
    }
}
