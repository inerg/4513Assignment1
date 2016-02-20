<?php

class Continent extends DomainObject
{  
   
   static function getFieldNames() {
      return array('continentCode','ContinentName','GeoNameId',);
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   

}

?>