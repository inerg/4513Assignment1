<?php
/*
   Represents a single row for the Browsers table. 
   This a concrete implementation of the Domain Model pattern.
 */
class OperatingSystem extends DomainObject implements JsonSerializable {
   static function getFieldNames() {
		return array('id','name');
   }

	public function __construct(array $data, $generateExc) {
		parent::__construct($data, $generateExc);
   }
   
	//This method is called by the json_encode() function that is part of PHP
	public function jsonSerialize() {
		 return [ 'os' => [
					'id' => $this->id, 
					'name' => $this->name
					]
				];
	}
}

?>