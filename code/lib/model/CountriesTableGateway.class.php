<?php

class CountriesTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Countries";
   } 
   protected function getTableName()
   {
      return "countries";
   }
   protected function getOrderFields()
   {
      return "CountryName";
   }
   protected function getPrimaryKeyName() {
      return "ISO";
   }
   
   
   public function getCountryNames()
   {
		//Retrieve # of visits for specified browser 
		$sql = 'SELECT CountryName FROM countries';

		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);
		return $result;

	}
	

	//Outputs a option list of continents.
	public function printCountryOptions()
   {

       echo '<datalist id="countryList">';
	   $countries = $this->getCountryNames();
	   foreach($countries as $country)
	   {
			   echo '<option>' . $country['CountryName'] . '</option>';
	   }
       echo '</datalist>';
   }
}

?>