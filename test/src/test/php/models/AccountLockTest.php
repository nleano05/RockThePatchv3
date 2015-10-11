<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\AccountLock.php');

/** @noinspection PhpUndefinedClassInspection */
class AccountLockTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $accountLock = new AccountLock();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getLocked() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getType() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeLocked() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeDifference() == NULL);
    }

    public function testConstructorWithValues() {
        $accountLock = new AccountLock(TRUE, 2, "time locked", "time difference");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getLocked() == TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getType() == 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeLocked() == "time locked");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeDifference() == "time difference");
    }

    public function testGettersAndSetters() {
        $accountLock = new AccountLock();

        $accountLock->setLocked(TRUE);
        $accountLock->setType(2);
        $accountLock->setTimeLocked("time locked");
        $accountLock->setTimeDifference("time difference");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getLocked() == TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getType() == 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeLocked() == "time locked");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($accountLock->getTimeDifference() == "time difference");
    }
}