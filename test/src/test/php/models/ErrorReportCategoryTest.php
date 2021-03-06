<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\ErrorReportCategory.php');

/** @noinspection PhpUndefinedClassInspection */
class ErrorReportCategoryTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $errorReportCategory = new ErrorReportCategory();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getDistro(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->isDefault(), NULL);
    }

    public function testConstructorWithValues() {
        $errorReportCategory = new ErrorReportCategory(1, "name", 2, TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getName(), "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getDistro(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->isDefault(), TRUE);
    }

    public function testGettersAndSetters() {
        $errorReportCategory = new ErrorReportCategory();

        $errorReportCategory->setId(1);
        $errorReportCategory->setName("name");
        $errorReportCategory->setDistro(2);
        $errorReportCategory->setIsDefault(TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getName(), "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->getDistro(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($errorReportCategory->isDefault(), TRUE);
    }
}