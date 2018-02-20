<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


	protected function _initRouter ()
	{
		$this->bootstrap ('frontcontroller');

		$this->getResource ('frontcontroller')
			->setResponse(new Zend_Controller_Response_Cli())
			->setRouter (new Application_Router_Cli ())
			->setRequest (new Zend_Controller_Request_Simple ());
	}

    protected function _initAutoloader()
    {
        $resourceLoader = new Zend_Loader_Autoloader_Resource(
            array(
                'namespace' => '',
                'basePath' => APPLICATION_PATH,
            )
        );

        $resourceLoader
            ->addResourceType('exception', 'exceptions/', 'Exception')
            ->addResourceType('service', 'services/', 'Service')
            ->addResourceType('valueobject', 'valueobjects/', 'ValueObject')
            ->addResourceType('strategy', 'strategies/', 'Strategy')
            
     //       ->addResourceType('form', 'forms/', 'Form')
     //       ->addResourceType('validate', 'validators/', 'Validate')
     //       ->addResourceType('plugin', 'plugins/', 'Plugin')
            ;
        Zend_Loader_Autoloader::getInstance()->pushAutoloader($resourceLoader);
        Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(true);
        return $resourceLoader;
    }

    protected function _initConfig() {
        $this->_config = new Zend_Config($this->getApplication()->getOptions());
        $this->_config = $this->_config->toArray();
        Zend_Registry::set('config', $this->_config); 
    }

	protected function _initError ()
	{
		$frontcontroller = $this->getResource ('frontcontroller');

		$error = new Zend_Controller_Plugin_ErrorHandler ();
		$error->setErrorHandlerController ('error');

		$frontcontroller->registerPlugin ($error, 100);

		return $error;
	}


    protected function _initSearch()
    {
        Service_Search::getInstance()
            ->addSearchStrategy(new Strategy_Search_Genre)
            ->addSearchStrategy(new Strategy_Search_Showing)
            ->setOrderStrategy(new Strategy_Order_Rating);
        
        Zend_Registry::set('Search', Service_Search::getInstance());
        date_default_timezone_set($this->_config['timezone']['default']);
    }
    
}
