<?php

class Strategy_Order_Rating extends Strategy_Order_Abstract {

    /**
     * implemented in PHP5 style for backwards compatibility 
     * Can be changed to spaceship operator in PHP7 
     */
    static protected function _compare(ValueObject_Movie_Record $a, ValueObject_Movie_Record $b) {
        if ($a->getRating() == $b->getRating()) {
            return 0;
        }
        return ($a->getRating() < $b->getRating()) ? +1 : -1;
    }


    /**
	 * @param array $data 
	 * @return array
	 */
    public function order(array $data) {
        usort($data, array($this, '_compare'));
        return $data;
    }
}