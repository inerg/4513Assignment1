<?php

class Continent extends DomainObject implements JsonSerializable {  
   
   static function getFieldNames() {
      return array('continentCode','ContinentName','GeoNameId',);
   }

   public function __construct(array $data, $generateExc) {
      parent::__construct($data, $generateExc);
   }
   
	public function jsonSerialize() {
		return [ 'continent' => [ 
					'continentCode' => $this->continentCode,
					'continentName' => $this->continentName,
					'geoNameId' => $this->geoNameId
					]
				];
   }

}

?>