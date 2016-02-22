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
		echo '<select class="btn teal lighten-2 brand-button change dropdown-button-widths">';
		echo '<option class="placeholder white-text teal darken-1" selected disabled value="">Pick a Brand!</option>';
		foreach ($brandsList as $currBrand) {
			echo '<option>' . $currBrand['name'] . '</option>';
		}
		echo '</select>'; 
   
}
    //Outputs a option list of brands.
    public function printBrandDropdown($selectedBrand = null)
    {
        if($selectedBrand == null) {
            echo '<option class="placeholder white-text teal darken-1" selected disabled>Select Brand</option>';
        } else {
            echo '<option class="placeholder white-text teal darken-1" disabled value="">Select Brand</option>';
        }
        $brands = $this->getDeviceBrands();
        foreach($brands as $brand)
        {
            if($brand['name'] == $selectedBrand){
                echo '<option value="' . $brand['name'] . '" selected>' . $brand['name'] . '</option>';
            } else {
                echo '<option value="' . $brand['name'] . '">' . $brand['name'] . '</option>';
            }
        }

    }
    //Prints the vists for the brand selected.
    public function printBrandVists($selectedBrand = null)
    {
        if($selectedBrand != null) {
            echo '<p class="right">Visits for '.$selectedBrand.': <span class="teal-text text-darken-1 bold">'.$this->getBrandVisits($selectedBrand)[0]['visitCount'].'</span></p>';
        }

    }
	
	public function getDeviceBrandsInfo() {
		$sql = 'SELECT *
				FROM device_brands
				LIMIT 100';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
	public function getDeviceBrandsByQuery($whereClause, $searchVariable) {
		$sql = 'SELECT * ' . ' FROM device_brands ' .
				' WHERE ' . $whereClause . ' = "'. $searchVariable . '"';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
}

?>