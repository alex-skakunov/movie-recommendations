<?php




class Application_Controller_Cli extends Zend_Controller_Action
{

	private $stdin;




	function preDispatch ()
	{
		$this->flush ();
	}


	function init ()
	{
		$this->_helper->ViewRenderer->setNoRender ();
		$this->adjustErrorHandler ();
	}


	protected function adjustErrorHandler ()
	{
		$error_handler = $this->getFrontController ()
			->getPlugin ('Zend_Controller_Plugin_ErrorHandler');

		if ($error_handler)
		{
			$error_handler->setErrorHandlerController ('error');
		}
	}

	function flush ()
	{
		while (ob_get_level())
		{
			ob_end_flush ();
		}
	}
}