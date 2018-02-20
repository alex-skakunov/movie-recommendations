<?php


class ValueObject_Search_Spec {

    protected $_genre = '';
    protected $_showing = null;

    public function getGenre() {
        return $this->_genre;
    }

    public function getShowing() {
        return $this->_showing;
    }

    public function setGenre($genre) {
        $this->_genre = strtolower($genre);
        return $this;
    }

    public function setShowing($showing) {
    	if (!is_object($showing)) {
			$showing = new DateTime($showing);
    		if (empty($showing)) {
    			throw new Exception("Could not create a datetime object");
    			
    		}
    	}
        $this->_showing = $showing;
        return $this;
    }
}