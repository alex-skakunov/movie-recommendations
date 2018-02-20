<?php

/**
 * a service to implement search
 * @author Alexander
 * @since 2018-02-20
 */
class Service_Search extends Service_Abstract {

    static protected $_instance;

    protected $_searchStrategiesList = array();
    protected $_resultsOrderStrategy = null;

    public function eraseSearchStrategies() {
        $this->_searchStrategiesList = array();
        return $this;
    }

    public function addSearchStrategy(Strategy_Search_Abstract $strategy) {
        $this->_searchStrategiesList[] = $strategy;
        return $this;
    }

    public function setOrderStrategy(Strategy_Order_Abstract $strategy) {
        $this->_resultsOrderStrategy = $strategy;
        return $this;
    }

    /**
     * @param ValueObject_Search_Spec $searchSpec
     * @return ValueObject_Search_Resultset
     */
    public function search(ValueObject_Search_Spec $searchSpec) {
        if (empty($this->_searchStrategiesList)) {
            throw new Exception_Search_StrategyNotSpecified;
        }

        $data = Service_Database::getInstance()->getData();
        foreach ($this->_searchStrategiesList as $strategy) {
            $data = $strategy->search($data, $searchSpec);
        }

        if (!empty($this->_resultsOrderStrategy)) {
            $data = $this->_resultsOrderStrategy->order($data);    
        }

        return $data;
    }
}