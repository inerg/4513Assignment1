<?php
/*
   Represents a single row for the device-brand table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class DeviceBrand extends DomainObject implements JsonSerializable {  
   
   static function getFieldNames() {
      return array('id','name');
   }

   public function __construct(array $data, $generateExc) {
      parent::__construct($data, $generateExc);
   }
   
	public function jsonSerialize() {
	   return [ 'deviceBrand' => [
					'id' => $this->id,
					'name' => $this->name
					]
				];
   }
}

?>