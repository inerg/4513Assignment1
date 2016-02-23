<?php
/*
  Table Data Gateway for the Browser table.
 */
class OperatingSystemTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "OperatingSystem";
   } 
   protected function getTableName()
   {
      return "operating_systems";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "ID";
   }
	
	public function getOperatingSystems() {
		$sql = 'SELECT *
				FROM operating_systems
				LIMIT 100';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
    public function printOSDropdown()
    {
        $osList = $this->getOperatingSystems();
        echo '<div class="input-field col s3">';
        echo '<select class="btn teal lighten-2 brand-button change dropdown-button-widths" name="os">';
        echo '<option class="placeholder white-text blue darken-1" selected disabled value="">Operating System</option>';
        foreach ($osList as $currentType) {
            echo '<option value="' . $currentType['ID'] . '">' . $currentType['name'] . '</option>';
        }
        echo '</select>';
        echo '</div>';

    }
}

?>