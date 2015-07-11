<?php

require_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\php-main\models\EncryptionData.php');

/** @noinspection PhpUndefinedClassInspection */
class EncryptionDataTest extends PHPUnit_Framework_TestCase {

    public function testConstructorNULL() {
        $encryptionData = new EncryptionData();

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getId() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIdentifier() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getCipher() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIv() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getKey() == NULL);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getTime() == NULL);
    }

    public function testConstructorWithValues() {
        $encryptionData = new EncryptionData(1, "identifier", "cipher", "key", "iv", "time");

        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIdentifier() == "identifier");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getCipher() == "cipher");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIv() == "iv");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getKey() == "key");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getTime() == "time");
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
        $this->assertTrue($encryptionData->getId() == 1);
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIdentifier() == "identifier");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getCipher() == "cipher");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getIv() == "iv");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getKey() == "key");
        /** @noinspection PhpUndefinedMethodInspection */
        $this->assertTrue($encryptionData->getTime() == "time");
    }
}
