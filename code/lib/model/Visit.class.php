<?php

class Visit extends DomainObject implements JsonSerializable {  
   
   static function getFieldNames() {
      return array('id','ip_address','country_code','visit_date','visit_time','device_type_id','device_brand_id','browser_id','referrer_id','os_id',);
   }

   public function __construct(array $data, $generateExc) {
      parent::__construct($data, $generateExc);
   }
   
	public function jsonSerialize() {
		return [ 'visit' => [
					'id' => $this->id, 
					'ip_address' => $this->ip_address,
					'country_code' => $this->country_code,
					'visit_date' => $this->visit_date,
					'visit_time' => $this->visit_time,
					'device_type_id' => $this->device_type_id,
					'device_brand_id' => $this->device_brand_id,
					'browser_id' => $this->browser_id,
					'referrer_id' => $this->referrer_id,
					'os_id' => $this->os_id
					]
				];
   }	
}

?>