<?php

class Application_Services_SearchTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function setUp() {
	Service_Search::getInstance()->eraseSearchStrategies();
    }

    /**
     * @expectedException Exception_Search_StrategyNotSpecified
     */
    public function testSearchFailsWithoutSearchStrategies() {
        Service_Search::getInstance()->search(new ValueObject_Search_Spec);
    }

    public function testAddingSearchStrategy() {
        $service = Service_Search::getInstance()->addSearchStrategy(new Strategy_Search_Genre);
    	$this->assertEquals(get_class($service), 'Service_Search');
    }

    public function testSetingOrderStrategy() {
        $service = Service_Search::getInstance()->setOrderStrategy(new Strategy_Order_Rating);
    	$this->assertEquals(get_class($service), 'Service_Search');
    }

    public function testSearchDoesNotFailWithSearchStrategies() {
        Service_Search::getInstance()
	    ->addSearchStrategy(new Strategy_Search_Genre)
	    ->search(new ValueObject_Search_Spec);
    }


}

