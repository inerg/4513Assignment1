<?php
/*
  Table Data Gateway for the Browser table.
 */
class BrowserTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Browser";
   } 
   protected function getTableName()
   {
      return "browsers";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
	
	public function getBrowsers() {
		$sql = 'SELECT *
				FROM browsers
				LIMIT 100';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
	
	public function getBrowsersByQuery($whereClause, $searchVariable) {
		$sql = 'SELECT * ' . ' FROM browsers ' .
				' WHERE ' . $whereClause . ' = "'. $searchVariable . '"';
		
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}

    public function printBrowserDropdown()
    {
        $browserList = $this->getBrowsers();
        echo '<div class="input-field col s3">';
        echo '<select class="btn teal lighten-2 brand-button change dropdown-button-widths" id="browser">';
        echo '<option class="placeholder white-text blue darken-1" selected value="false">Browser</option>';
        foreach ($browserList as $currentType) {
            echo '<option value="' . $currentType['id'] . '">' . $currentType['name'] . '</option>';
        }
        echo '</select>';
        echo '</div>';

    }
}

?>