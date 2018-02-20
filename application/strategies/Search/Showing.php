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
            foreach ($movieRecord->getShowings() as $showingDateTime) {
                $interval = $searchSpec->getShowing()->diff($showingDateTime, false);
                $hours   = (int)$interval->format('%r%h'); 
                $minutes = (int)$interval->format('%i');
                $diffInMinutes = ($hours * 60 + $minutes);
                if ($diffInMinutes >= 30) {
                    $resultset[] = $movieRecord;
                    continue(2);
                }
            }
        }
        return $resultset;
    }
}