<?php

/**
 * a service to implement search
 * @author Alexander
 * @since 2018-02-20
 */
class ValueObject_Search_Result {

    protected $_name = '';
    protected $_showing = null;

    public function getName() {
        return $this->_name;
    }

    public function getShowing() {
        return $this->_showing;
    }

    public function setName($name) {
        $this->_name = $name;
        return $this;
    }

    public function setShowing(DateTime $showing) {
        $this->_showing = $showing;
        return $this;
    }
}