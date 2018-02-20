<?php

abstract class Strategy_Search_Abstract {

    abstract public function search(array $data, ValueObject_Search_Spec $searchSpec);
}