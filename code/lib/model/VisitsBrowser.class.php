<?php
/*
   Represents a single row for the Browsers table. 
   This a concrete implementation of the Domain Model pattern.
 */
class VisitsBrowser extends DomainObject implements JsonSerializable {
   static function getFieldNames() {
		return array('visit_date','visit_time','ip_address','CountryName','BrowserName','ReferrerName','OSName','DTName','BrandName');
   }
	public function __construct(array $data, $generateExc) {
		parent::__construct($data, $generateExc);
   }
   
	//This method is called by the json_encode() function that is part of PHP
	public function jsonSerialize() {
		 return [ 'visit' => [
					'visit_date' => $this->visit_date,
					'visit_time' => $this->visit_time,
					'ip_address' => $this->ip_address,
					'CountryName' => $this->CountryName,
					'BrowserName' => $this->BrowserName,
					'ReferrerName' => $this->ReferrerName,
					'OSName' => $this->OSName,
					'DTName' => $this->DTName,
					'BrandName' => $this->BrandName
					]
				];
	}
}

?>