<?php

class Application_Router_Cli extends Zend_Controller_Router_Abstract
{

	public function route (Zend_Controller_Request_Abstract $dispatcher)
	{
		$getopt = new Zend_Console_Getopt (array ());
		$arguments = $getopt->getRemainingArgs ();
		
		$controller = 'search';
		$action = 'index';
		
		if ($arguments)
		{
			$controller = array_shift ($arguments);
			
			if ($arguments)
			{
				foreach ($arguments as $arg)
				{
					$parameter = explode ('=', $arg, 2);
					if (false == isset ($parameter [1]))
					{
						$parameter [1] = true;
					}
					
					$dispatcher->setParam ($parameter [0], $parameter [1]);
					unset ($parameter);
				}
			}
		}
		
		$dispatcher->setControllerName ($controller)
			->setActionName ($action);
		
		return $dispatcher;
	}


	public function assemble ($userParams, $name = null, $reset = false, $encode = true)
	{
		echo "Not implemented\n", exit ();
	}
}