<?php

class Application_Services_DatabaseTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
    	$this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
    }

    public function testCreation() {
    	$this->assertClassHasStaticAttribute('_instance', Service_Database::getInstance());
    }


}

