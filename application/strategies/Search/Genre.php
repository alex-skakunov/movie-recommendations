<?php

class Strategy_Search_Genre extends Strategy_Search_Abstract {

    /**
	 * @param array $data
	 * @param ValueObject_Search_Spec $searchSpec 
	 * @return array 
	 */
    public function search(array $data, ValueObject_Search_Spec $searchSpec) {
        $resultset = array();

        foreach($data as $movieRecord) {
            if (!in_array($searchSpec->getGenre(), $movieRecord->getGenres())) {
                continue;
            }

            $resultset[] = $movieRecord;
        }
        return $resultset;
    }
}