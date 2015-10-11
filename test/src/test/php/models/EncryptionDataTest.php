<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\EncryptionData.php');

/** @noinspection PhpUndefinedClassInspection */
class EncryptionDataTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $encryptionData = new EncryptionData();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getId(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIdentifier(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getCipher(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIv(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getKey(), NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getTime(), NULL);
    }

    public function testConstructorWithValues() {
        $encryptionData = new EncryptionData(1, "identifier", "cipher", "key", "iv", "time");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIdentifier(), "identifier");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getCipher(), "cipher");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIv(), "iv");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getKey(), "key");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getTime(), "time");
    }

    public function testGettersAndSetters() {
        $encryptionData = new EncryptionData();

        $encryptionData->setId(1);
        $encryptionData->setIdentifier("identifier");
        $encryptionData->setCipher("cipher");
        $encryptionData->setIv("iv");
        $encryptionData->setKey("key");
        $encryptionData->setTime("time");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getId(), 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIdentifier(), "identifier");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getCipher(), "cipher");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getIv(), "iv");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getKey(), "key");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertEquals($encryptionData->getTime(), "time");
    }
}
