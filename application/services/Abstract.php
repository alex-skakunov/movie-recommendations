<?php

class Service_Abstract {

    static public function getInstance() {
        if (!static::$_instance) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public function save($object) {
        $em = Zend_Registry::get('entitymanager');
        $em->persist($object);
        $em->flush();
        return $object;
    }
}