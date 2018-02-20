<?php

class Application_Services_DatabaseTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function testDataLoad() {
    	$this->assertGreaterThan(0, sizeof(Service_Database::getInstance()->getData()));
    }


}

