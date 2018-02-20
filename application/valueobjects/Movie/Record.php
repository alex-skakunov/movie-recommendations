<?php

/**
 * an object to represent a movie
 * @author Alexander
 * @since 2018-02-20
 */
class ValueObject_Movie_Record {

    protected $_name = '';
    protected $_rating = 0;
    protected $_genres = array();
    protected $_showings = array();

    public function __construct(array $record) {
        $this->_name = trim($record['name']);
        $this->_rating = (int)$record['rating'];
        foreach($record['genres'] as $genre) {
            $this->_genres[] = strtolower($genre); 
        } 
        foreach($record['showings'] as $showing) {
            $_showing = new DateTime($showing);
            $this->_showings[] = $_showing;         
        }
    }

    public function getName() {
        return $this->_name;
    }

    public function getRating() {
        return $this->_rating;
    }

    public function getGenres() {
        return $this->_genres;
    }

    public function getShowings() {
        return $this->_showings;
    }

    public function getClosestShowingWithinTimeframe(DateTime $start, $offset) {
        $showing = null;
        $minDifference = 10000;
        foreach ($this->_showings as $showingDateTime) {
            $interval = $start->diff($showingDateTime, false);
            $hours   = (int)$interval->format('%r%h'); 
            $minutes = (int)$interval->format('%i');
            $diffInMinutes = ($hours * 60 + $minutes);
            if ($diffInMinutes < $offset) {
                continue;
            }

            if ($diffInMinutes < $minDifference) {
                $minDifference = $diffInMinutes;
                $showing = $showingDateTime;
            }
        }
        return $showing;
    }

}