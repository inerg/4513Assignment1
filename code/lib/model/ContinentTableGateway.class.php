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
	
	public function getVisitsByContinentCode($continentCode = null) {

        if($continentCode != null) {
            $sql = 'SELECT COUNT(id) as VisitCount,
                    CountryName
                    FROM visits v
                    INNER JOIN countries c ON c.ISO = v.country_code
                    WHERE country_code in (select ISO from countries where continent = \''.$continentCode.'\')
                    GROUP BY country_code';

            //convert records to array
            $result = $this->dbAdapter->fetchAsArray($sql, null);
            return $result;
        }
	}
	

	//Outputs a option list of continents.
	public function printContinentDropdown($selectedContinent = null)
   {
	   if($selectedContinent == null) {
		   echo '<option class="placeholder white-text pink darken-1" selected disabled>Select Continent</option>';
	   } else {
		   echo '<option class="placeholder white-text pink darken-1" disabled>Select Continent</option>';
	   }
	   $continents = $this->getContinentNames();
	   foreach($continents as $continent)
	   {
		   if($continent['ContinentCode'] == $selectedContinent){
			   echo '<option value="' . $continent['ContinentCode'] . '" selected>' . $continent['ContinentName'] . '</option>';
		   } else {
			   echo '<option value="' . $continent['ContinentCode'] . '">' . $continent['ContinentName'] . '</option>';
		   }
	   }
			
   }
	//Outputs a table of the visits by country based on the coninent.
	public function printVisitList($selectedContinent = null)
   {
	   if($selectedContinent != null) {
           $visitsCount = $this->getVisitsByContinentCode($selectedContinent);

           foreach($visitsCount as $visitCount)
           {
               echo '<tr><td>'.$visitCount['CountryName'].'</td><td class="pink-text text-darken-1 bold">'.$visitCount['VisitCount'].'</td></tr>';
           }

       }



   }

}

?>