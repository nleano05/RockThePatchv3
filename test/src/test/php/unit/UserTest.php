<?php
require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\User.php');
require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\lib_const.php');

/** @noinspection PhpUndefinedClassInspection */
class UserTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $user = new User();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getId() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFirstName() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastName() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getUserName() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmail() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getPassword() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestion() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestionAnswer() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmailBlasts() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getTextBlasts() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getCell() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getRole() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastLoginAttempt() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFriendStatus() == NULL);
    }

    public function testConstructorWithValues() {
        $user = new User(1, "first", "last", "userName", "email@domain.com", "password", 2, "answer", TRUE, FALSE, "317-555-1234", ROLE_ADMIN, "some date", 3);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFirstName() == "first");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastName() == "last");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getUserName() == "userName");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmail() == "email@domain.com");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getPassword() == "password");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestion() == 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestionAnswer() == "answer");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmailBlasts() == TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getTextBlasts() == FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getCell() == "317-555-1234");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getRole() == ROLE_ADMIN);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastLoginAttempt() == "some date");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFriendStatus() == 3);
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
        $user->setLastLoginAttempt("some date");
        $user->setFriendStatus(3);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFirstName() == "first");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastName() == "last");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getUserName() == "userName");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmail() == "email@domain.com");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getPassword() == "password");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestion() == 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getSecurityQuestionAnswer() == "answer");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getEmailBlasts() == TRUE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getTextBlasts() == FALSE);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getCell() == "317-555-1234");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getRole() == ROLE_ADMIN);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getLastLoginAttempt() == "some date");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($user->getFriendStatus() == 3);
    }
}
