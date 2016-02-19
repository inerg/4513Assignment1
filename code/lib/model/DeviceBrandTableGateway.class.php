<?php
/*
  Table Data Gateway for the device-brand table.
 */
class DeviceBrandTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "DeviceBrand";
   } 
   protected function getTableName()
   {
      return "device_brands";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }


   public function getDeviceBrands()
   {
		$sql = 'SELECT name
				FROM device_brands';
				
		$result = $this->dbAdapter->fetchAsArray($sql, null);
	   
	   return $result;
   }
   
   public function getBrandVisits($brand)
   {
		$sql = 'SELECT COUNT(visits.id) AS visitCount, name
				FROM device_brands INNER JOIN visits ON device_brands.ID = visits.device_brand_id
				WHERE name = "' .$brand. '"';
				
		$result = $this->dbAdapter->fetchAsArray($sql, null);
	   
		return $result;
   }
   
   
	public function displaySelect($brandsList) {
		echo '<select>';
		foreach ($brandsList as $currBrand) {
			echo '<option>' . $currBrand['name'] . '</option>';
		}
		echo '</select>'; 
   }
}

?>