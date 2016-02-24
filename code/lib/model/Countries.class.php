<?php

class Countries extends DomainObject implements JsonSerializable {
   
   static function getFieldNames() {
      return array('ISO','flipsCountryCode','ISO3','ISONumeric','CountryName','Capital','GeoNameID','Area','Population','Continent','TopLevelDomain','CurrencyCode','CurrencyName','PhoneCountryCode',);
   }

   public function __construct(array $data, $generateExc) {
      parent::__construct($data, $generateExc);
   }
   
	public function jsonSerialize() {
		return [ 'country' => [
					'ISO' => $this->ISO,
					'flipsCountryCode' => $this->flipsCountryCode,
					'ISO3' => $this->ISO3,
					'ISONumeric' => $this->ISONumeric,
					'CountryName' => $this->CountryName,
					'Capital' => $this->Capital,
					'GeoNameID' => $this->GeoNameID,
					'Area' => $this->Area,
					'Population' => $this->Population,
					'Continent' => $this->Continent,
					'TopLevelDomain' => $this->TopLevelDomain,
					'CurrencyCode' => $this->CurrencyCode,
					'CurrencyName' => $this->CurrencyName,
					'PhoneCountryCode' => $this->PhoneCountryCode
					]
				];
   }

}

?>