<?php

class ContinentTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Continent";
   } 
   protected function getTableName()
   {
      return "visits";
   }
   protected function getOrderFields()
   {
      return "GeoNameId";
   }
   protected function getPrimaryKeyName() {
      return "ContinentCode";
   }
   
   
   public function getContinentNames()
   {
		//Retrieve # of visits for specified browser 
		$sql = 'SELECT ContinentName, ContinentCode FROM continents';

		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);
		return $result;

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
	public function printList($continent = null)
   {
	   if($continent == null) {
		   echo '<option class="placeholder" selected disabled value="">Pick a Brand!</option>';
	   } else {
		   echo '<option class="placeholder" disabled value="">Pick a Brand!</option>';
	   }
	   $continents = getContinentNames();
	   foreach($continents as $continent)
	   {
		   if($continent === $continent['ContinentCode']){
			   echo '<option value="' . $continent['ContinentCode'] . '" selected>' . $continent['ContinentName'] . '</option>';
		   } else {
			   echo '<option value="' . $continent['ContinentCode'] . '">' . $continent['ContinentName'] . '</option>';
		   }
	   }
			
   }

}

?>