<?php
/*
   Represents a single row for the device-brand table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class DeviceType extends DomainObject implements JsonSerializable {
   
   static function getFieldNames() {
      return array('ID','name');
   }

   public function __construct(array $data, $generateExc) {
      parent::__construct($data, $generateExc);
   }
   
	public function jsonSerialize() {
	   return [ 'deviceType' => [
					'ID' => $this->id,
					'name' => $this->name
					]
				];
   }
}

?>