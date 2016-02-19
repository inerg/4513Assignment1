<?php

class Visit extends DomainObject
{  
   
   static function getFieldNames() {
      return array('id','ip_address','country_code','visit_date','visit_time','device_type_id','device_brand_id','browser_id','referrer_id','os_id',);
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   

}

?>