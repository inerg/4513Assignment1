<?php
/*
  Table Data Gateway for the Browser table.
 */
class ReferrerTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Referrer";
   } 
   protected function getTableName()
   {
      return "referrers";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
	
	public function getReferrer() {
		$sql = 'SELECT *
				FROM referrers
				LIMIT 100';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
    public function printReferrerDropdown()
    {
        $referrerList = $this->getReferrer();
        echo '<div class="input-field col s3">';
        echo '<select class="btn teal lighten-2 brand-button change dropdown-button-widths" id="referrer">';
        echo '<option class="placeholder white-text blue darken-1" selected disabled value="">Referrer</option>';
        foreach ($referrerList as $currentType) {
            echo '<option value="' . $currentType['id'] . '">' . $currentType['name'] . '</option>';
        }
        echo '</select>';
        echo '</div>';

    }
}

?>