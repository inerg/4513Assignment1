<?php
/*
  Table Data Gateway for the device-brand table.
 */
class DeviceTypeTableGateway extends TableDataGateway
{
    public function __construct($dbAdapter)
    {
        parent::__construct($dbAdapter);
    }

    protected function getDomainObjectClassName()
    {
        return "DeviceType";
    }

    protected function getTableName()
    {
        return "device_types";
    }

    protected function getOrderFields()
    {
        return 'name';
    }

    protected function getPrimaryKeyName()
    {
        return "ID";
    }


    public function getDeviceTypes()
    {
        $sql = 'SELECT name, id
				FROM device_types';

        $result = $this->dbAdapter->fetchAsArray($sql, null);

        return $result;
    }

    public function printDeviceTypeDropdown()
    {
        $deviceTypeList = $this->getDeviceTypes();
        echo '<div class="input-field col s3">';
        echo '<select class="btn teal lighten-2 brand-button change dropdown-button-widths" id="dt">';
        echo '<option class="placeholder white-text blue darken-1" selected disabled value="false">Device Type</option>';
        foreach ($deviceTypeList as $currentType) {
            echo '<option value="' . $currentType['id'] . '">' . $currentType['name'] . '</option>';
        }
        echo '</select>';
        echo '</div>';

    }
}

?>