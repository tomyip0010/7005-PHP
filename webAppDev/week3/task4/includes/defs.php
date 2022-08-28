<?php
/* Functions for PM database example. */

/* Load sample data, an array of associative arrays. */
include "pms.php";

/* Search sample data for $name or $year or $state from form. */
function search($query) {
    global $pms; 

    // Filter $pms by $name
    if (!empty($query)) {
		$results = array();
		foreach ($pms as $pm) {
			if (stripos($pm['name'], $query) !== FALSE ||
				strpos($pm['from'], $query) !== FALSE || 
				strpos($pm['to'], $query) !== FALSE ||
				stripos($pm['state'], $query) !== FALSE) {
				$results[] = $pm;
			}
		}
		$pms = $results;
    }

    return $pms;
}
?>
