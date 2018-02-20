<?php

class ValueObject_Movie_RecordTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function testGetClosestShowingWithinTimeframe() {
        $record = new ValueObject_Movie_Record(array(
	    'name' => 'Terminator',
	    'rating' => 95,
	    'genres' => array('Sci-fi', 'Fiction'),
	    'showings' => array('19:00+11:00', '23:50+11:00')
	));
	$closestShowing = $record->getClosestShowingWithinTimeframe(new DateTime('18:00'), 30);
    	$this->assertEquals('19:00', $closestShowing->format('H:i'));

	$closestShowing = $record->getClosestShowingWithinTimeframe(new DateTime('22:00'), 30);
    	$this->assertEquals('23:50', $closestShowing->format('H:i'));

	$closestShowing = $record->getClosestShowingWithinTimeframe(new DateTime('23:30'), 30);
    	$this->assertNull($closestShowing);
    }


}

