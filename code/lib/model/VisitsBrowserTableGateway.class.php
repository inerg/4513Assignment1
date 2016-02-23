<?php
/*
  Table Data Gateway for the Browser table.
 */
class VisitsBrowserTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "VisitsBrowser";
   } 
   protected function getTableName()
   {
      return "visits";
   }
   protected function getOrderFields() 
   {
      return 'name';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
	
	public function getVisitInfo($searchParameters) {
        error_log($searchParameters);
		$sql = 'SELECT	visit_date
                        ,visit_time
                        ,ip_address
                        ,CountryName
                        ,b.name AS BrowserName
                        ,r.name AS ReferrerName
                        ,os.name AS OSName
                        ,dt.name AS DTName
                        ,db.name AS BrandName
                        FROM visits v
                        INNER JOIN countries c ON c.ISO = v.country_code
                        INNER JOIN browsers b ON b.ID = v.browser_id
                        INNER JOIN referrers r ON r.id = v.referrer_id
                        INNER JOIN operating_systems os ON os.ID = v.os_id
                        INNER JOIN device_types dt ON dt.ID = v.device_type_id
                        INNER JOIN device_brands db ON v.device_brand_id
                         '. $searchParameters. '
                          ORDER BY visit_date, visit_time  LIMIT 100';


        error_log($sql);
		//convert records to array
		$result = $this->dbAdapter->fetchAsArray($sql, null);

		return $result;
	}
}

?>