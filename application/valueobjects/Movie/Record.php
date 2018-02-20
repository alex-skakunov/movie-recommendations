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
}