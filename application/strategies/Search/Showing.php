<?php

class Strategy_Search_Showing extends Strategy_Search_Abstract {

    /**
     * @param array $data
     * @param ValueObject_Search_Spec $searchSpec 
     * @return array 
     */
    public function search(array $data, ValueObject_Search_Spec $searchSpec) {
        $resultset = array();
        foreach($data as $movieRecord) {
            $closestShowing = $movieRecord->getClosestShowingWithinTimeframe($searchSpec->getShowing(), 30);
            if (empty($closestShowing)) {
                continue;
            }
            $resultset[] = $movieRecord;
        }
        return $resultset;
    }
}