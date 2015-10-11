<?php
require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\User.php');
require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\lib_const.php');

/** @noinspection PhpUndefinedClassInspection */
class UserTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $user = new User();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFirstName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getUserName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmail(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getPassword(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestion(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestionAnswer(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmailBlasts(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTextBlasts(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getCell(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getRole(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLocked(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLockedByAdmin(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTimeLocked(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getConsecutiveFailedLoginAttempts(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastLoginAttemptTime(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFriendStatus(), NULL);
    }

    public function testConstructorWithValues() {
        $user = new User(1, "first", "last", "userName", "email@domain.com", "password", 2, "answer", TRUE, FALSE, "317-555-1234", ROLE_ADMIN, FALSE, FALSE, "time locked", 3, "last login attempt time", 4);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFirstName(), "first");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastName(), "last");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getUserName(), "userName");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmail(), "email@domain.com");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getPassword(), "password");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestion(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestionAnswer(), "answer");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmailBlasts(), TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTextBlasts(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getCell(), "317-555-1234");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getRole(), ROLE_ADMIN);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLocked(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLockedByAdmin(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTimeLocked(), "time locked");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getConsecutiveFailedLoginAttempts(), 3);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastLoginAttemptTime(), "last login attempt time");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFriendStatus(), 4);
    }

    public function testGettersAndSetters() {
        $user = new User();

        $user->setId(1);
        $user->setFirstName("first");
        $user->setLastName("last");
        $user->setUserName("userName");
        $user->setEmail("email@domain.com");
        $user->setPassword("password");
        $user->setSecurityQuestion(2);
        $user->setSecurityQuestionAnswer("answer");
        $user->setEmailBlasts(TRUE);
        $user->setTextBlasts(FALSE);
        $user->setCell("317-555-1234");
        $user->setRole(ROLE_ADMIN);
        $user->setLocked(FALSE);
        $user->setLockedByAdmin(FALSE);
        $user->setTimeLocked("time locked");
        $user->setConsecutiveFailedLoginAttempts(3);
        $user->setLastLoginAttemptTime("last login attempt time");
        $user->setFriendStatus(4);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFirstName(), "first");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastName(), "last");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getUserName(), "userName");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmail(), "email@domain.com");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getPassword(), "password");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestion(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getSecurityQuestionAnswer(), "answer");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getEmailBlasts(), TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTextBlasts(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getCell(), "317-555-1234");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getRole(), ROLE_ADMIN);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLocked(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLockedByAdmin(), FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getTimeLocked(), "time locked");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getConsecutiveFailedLoginAttempts(), 3);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getLastLoginAttemptTime(), "last login attempt time");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($user->getFriendStatus(), 4);
    }
}
