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
	
	public function displayBrowserStatisticsTable()
   {
	   $totalVisits = $this->getTotalVisits();
	   $list = $this->getListOfBrowsers();
	   $totalVisits = $this->getTotalVisits();
	   $statArray = [];
	   foreach($list as $curr_browser) {
		   $result2 = $this->getVisitsByBrowser($curr_browser);
		   array_push($statArray, $result2);
	   }  
	   
	echo '<table border="1">';
	echo '<caption>Percentage of Visits by Browser</caption>';
	echo '<tr>';
	
	for($i = 0; $i < count($statArray); $i++)
	{
		echo '<th>' . $list[$i]['name'] . '</th>';
	}
	echo '</tr>';

	for($k = 0; $k < count($statArray); $k++)
	{
		$visitsForSelectedBrowser = $statArray[$k];
		$percent = ($visitsForSelectedBrowser / $totalVisits) * 100;
		echo '<td>' . round($percent, 2) . '%</td>';
	}
	echo '</tr></table>';				
   }

}

?>