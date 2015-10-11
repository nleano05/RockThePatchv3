<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\FeatureRequestCategory.php');

/** @noinspection PhpUndefinedClassInspection */
class FeatureRequestCategoryTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $featureRequestCategory = new FeatureRequestCategory();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getName(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getDistro(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->isDefault(), NULL);
    }

    public function testConstructorWithValues() {
        $featureRequestCategory = new FeatureRequestCategory(1, "name", 2, TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getName(), "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getDistro(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->isDefault(), TRUE);
    }

    public function testGettersAndSetters() {
        $featureRequestCategory = new FeatureRequestCategory();

        $featureRequestCategory->setId(1);
        $featureRequestCategory->setName("name");
        $featureRequestCategory->setDistro(2);
        $featureRequestCategory->setIsDefault(TRUE);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getName(), "name");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->getDistro(), 2);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($featureRequestCategory->isDefault(), TRUE);
    }
}