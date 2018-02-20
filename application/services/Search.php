<?php

/**
 * a service to implement search
 * @author Alexander
 * @since 2018-02-20
 */
class Service_Search extends Service_Abstract {

    static protected $_instance;

    /**
     * @param ValueObject_Search_Spec $searchSpec
     * @return ValueObject_Search_Resultset
     */
    public function search(ValueObject_Search_Spec $searchSpec) {
        $data = Service_Database::getInstance()->getData();
        $resultset = new ValueObject_Search_Resultset;
        foreach($data as $dataRecord) {
            if(!in_array($searchSpec->getGenre(), $dataRecord->getGenres())) {
                continue;
            }

            $foundShowing = null;

            foreach ($dataRecord->getShowings() as $showingDateTime) {
                $interval = $searchSpec->getShowing()->diff($showingDateTime);
                $hours   = $interval->format('%h'); 
                $minutes = $interval->format('%i');
                $diffInMinutes = ($hours * 60 + $minutes);
                if ($diffInMinutes > 30) {
                    $foundShowing = $showingDateTime;
                    break;
                }
            }

            if(empty($foundShowing)) {
                continue;
            }

            $result = new ValueObject_Search_Result;
            $result
                ->setName($dataRecord->getName())
                ->setShowing($foundShowing)
            ;
            $resultset[] = $result;
        }
        return $resultset;
    }
}