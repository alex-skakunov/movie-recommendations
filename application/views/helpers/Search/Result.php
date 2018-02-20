<?php

/**
 * an view helper to show result set
 * @author Alexander
 * @since 2018-02-20
 */
class ViewHelper_Search_Result {

    public function render($resultset, $searchSpec, $offset) {
		if (0 == sizeof($resultset)) {
			echo 'No movie recommendations.', PHP_EOL;
			return false;
		}

		foreach ($resultset as $movieRecord) {
			$closestShowing = $movieRecord->getClosestShowingWithinTimeframe($searchSpec->getShowing(), $offset);
			echo sprintf('%s, showing at %s', $movieRecord->getName(), $closestShowing->format('g a')), PHP_EOL;
		}
    }

}