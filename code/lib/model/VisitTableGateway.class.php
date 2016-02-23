<?php

class VisitTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Visit";
   } 
   protected function getTableName()
   {
      return "visits";
   }
   protected function getOrderFields() 
   {
      return "visit_date";
   }
   protected function getPrimaryKeyName() {
      return "id";
   }
   
   
   public function getVisitsByBrowser($browser)
   {
		//Retrieve # of visits for specified browser 
		$sql1 = 'SELECT COUNT(browser_id) AS visitCount
				FROM browsers INNER JOIN visits 
				ON browsers.ID = visits.browser_id 
				WHERE name = "' . $browser['name'] . '"';	

		//convert records to array
		$result1 = $this->dbAdapter->fetchAsArray($sql1, null);

		$numResult = (int)$result1[0]['visitCount'];

		return $numResult;

	}
	
	public function getListOfBrowsers() {
		
		$sql = 'SELECT name 
				FROM browsers';
				
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);
		
		return $result;
	}
	
	public function getTotalVisits() {
		$sql = 'SELECT COUNT(id) AS numVisits 
				FROM visits';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);
		
		foreach($result as $a) {
			foreach($a as $b) {
				$c = (int)$b;
			}
		}
		return $c;
	}
	
	//Outputs a <table> to screen with browser visit statistics
	public function displayBrowserStatisticsTable() {
	   $totalVisits = $this->getTotalVisits();
	   $list = $this->getListOfBrowsers();
	   $totalVisits = $this->getTotalVisits();
	   $statArray = [];
	   foreach($list as $curr_browser) {
		   $result2 = $this->getVisitsByBrowser($curr_browser);
		   array_push($statArray, $result2);
	   }  
	   
	
		echo '<table class="striped highlight responsive-table table-hover-browsers">
						<thead>
							<tr>
								<th data-field="id">Browsers</th>
								<th data-field="name">%</th>
							</tr>
						</thead>
						<tbody>';
		
		
		for($i = 0; $i < count($statArray); $i++)
		{
			echo '<tr>';
			echo '<td>' . $list[$i]['name'] . '</td>';
		
			$visitsForSelectedBrowser = $statArray[$i];
			$percent = ($visitsForSelectedBrowser / $totalVisits) * 100;
			echo '<td class="orange-text text-darken-4 bold">' . round($percent, 2) . '%</td>';
	
			echo '</tr>';
		}
		echo '</tbody></table>';
			
   }
   
	public function getVisits() {
		$sql = 'SELECT *
				FROM visits
				LIMIT 100';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
	public function getVisitsByQuery($whereClause, $searchVariable) {
		$sql = 'SELECT * ' . ' FROM visits ' .
				' WHERE ' . $whereClause . ' = "'. $searchVariable . '"';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
	
	public function getCustomSearch($selectVal, $searchField, $and, $searchVariable, $groupBy, $having, $join) {
		
	if($join == NULL) {	//no joins used
		if($groupBy == NULL) //groupBy not used
		{
			if($having == NULL) //and not using having
			{//echo "hit a";
				$sql = 'SELECT '.$selectVal. '
					FROM visits 
					WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and;
			}
			else { //and using having
			//echo "hit b";
				$sql = 'SELECT '.$selectVal. '
					FROM visits 
					WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and.'
					HAVING '.$having;
				
			}
		}
		else { //groupBy used
			if($having != NULL) {//and having used
			//echo "hit c";
				$sql = 'SELECT '.$selectVal. ' 
						FROM visits 
						WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and.'
						GROUP BY '.$groupBy.' 
						HAVING '.$having;
			}
			if($having == NULL) {//and having not used
			//echo "hit d";
				$sql = 'SELECT '.$selectVal. ' 
						FROM visits 
						WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and.'
						GROUP BY '.$groupBy;
			}
		}
	}
	else { //joins used
		if($groupBy == NULL) //not using groupBy
		{
			if($having == NULL) //and not using having
			{//echo "hit e";
				$sql = 'SELECT '.$selectVal. '
					FROM visits INNER JOIN '.$join.' 
					WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and;
			}
			else {//and using having
			//echo "hit f";
				$sql = 'SELECT '.$selectVal. '
					FROM visits  INNER JOIN '.$join.'
					WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"
					HAVING '.$having;
				
			}
		}
		else { //groupBy used
			if($having != NULL) {//and having used
			//echo "hit g";
				$sql = 'SELECT '.$selectVal. ' 
						FROM visits INNER JOIN '.$join.'
						WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and.'
						GROUP BY '.$groupBy.'
						HAVING '.$having;
			}
			if($having == NULL) {//and having not used
			//echo "hit h";
				$sql = 'SELECT '.$selectVal. ' 
						FROM visits INNER JOIN '.$join.'
						WHERE '.$searchField.' LIKE "%'.$searchVariable.'%"'.$and.'
						GROUP BY '.$groupBy;
			}
		}
		
	}
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}

}

?>