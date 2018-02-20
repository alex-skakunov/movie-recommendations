<?php

/**
 * a service to provide an access to data
 * @author Alexander
 * @since 2018-02-20
 */
class Service_Database extends Service_Abstract {

    static protected $_instance;

    /**
     * ValueObject_Database_Record[]
     */
    protected $_data = array();

    /**
     * internally preloads the data
     */
    public function getData() {
        if (empty($this->_data)) {
            $this->_load();
        }
        return $this->_data;
    }

    /**
     * internally preloads the data
     */
    protected function _load() {
        $config = Zend_Registry::get('config');
        if (empty($config)) {
            throw new Exception_Config_Missing;
        }

        $filePath = $config['database']['file'];
        try {
            $json = file_get_contents(APPLICATION_PATH . '/../' . $filePath);
        }
        catch(Exception $e) {
            throw new Exception_Config_FileLoadFailed;
        }

        $array = json_decode($json, 1);
        foreach ($array as $item) {
            $this->_data[] = new ValueObject_Database_Record($item);
        }
    }
}