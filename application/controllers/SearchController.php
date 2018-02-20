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
			$this->writeLine('Wrong data. Check your parameters');
			return false;
		}
		$searchService = Zend_Registry::get('Search');
		$resultset = $searchService->search($searchSpec);

		if(0 == sizeof($resultset)) {
			$this->writeLine('No movie recommendations.');
			return false;
		}

		foreach($resultset as $item) {
			$this->writeLine(sprintf('%s, showing at %s', $item->getName(), current($item->getShowings())->format('g a')));
		}
	}

}