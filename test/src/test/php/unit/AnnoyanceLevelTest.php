<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\AnnoyanceLevel.php');

/** @noinspection PhpUndefinedClassInspection */
class AnnoyanceLevelTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL(){
        $annoyanceLevel = new AnnoyanceLevel();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getId() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getName() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getLevel() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->isDefault() == NULL);
    }

    public function testConstructorWithValues(){
        $annoyanceLevel = new AnnoyanceLevel(1, "name", 5, TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getName() == "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getLevel() == 5);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->isDefault() == TRUE);
    }

    public function testGettersAndSetters(){
        $annoyanceLevel = new AnnoyanceLevel();

        $annoyanceLevel->setId(1);
        $annoyanceLevel->setName("name");
        $annoyanceLevel->setLevel(5);
        $annoyanceLevel->setIsDefault(TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getName() == "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->getLevel() == 5);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($annoyanceLevel->isDefault() == TRUE);
    }
}