<?php

class SearchController extends Application_Controller_Cli
{

	public function indexAction ()
	{
		$genre = $this->getParam('genre');
		$time = $this->getParam('time');

		$searchSpec = new ValueObject_Search_Spec;
		try {
			$searchSpec
				->setGenre($genre)
				->setShowing($time);
		}
		catch(Exception_Search_Spec_InitFailed $e) {
			echo 'Wrong data. Check your parameters', chr(10);
			return false;
		}

		$searchService = Zend_Registry::get('Search');
		$resultset = $searchService->search($searchSpec);

		$view = new ViewHelper_Search_Result;
		$view->render($resultset, $searchSpec, 30);
	}

}