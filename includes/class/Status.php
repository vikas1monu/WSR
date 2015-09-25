<?php 
Class Status
{
    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_STATUS; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    
    }
    /* isExistStatus
     * @params int statusId
     * @return boolean value 
     * */
    public function isExistStatus($statusId)
    {
        $sql = "select status_name from ".$this->tableName." where status_id = '".$statusId."'";
        $result = $this->stagingDBConnect->query($sql);
        if($result->num_rows)
        {
        	return true;
        }
        else 
        {
        	return false;
        }
    }
    
    public function addNewStatus($status)
    {
    	$sql = "insert into ".$this->tableName." set
    			              status_id = '".$status['id']."',
    			              status_name = '".$status['name']."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingStatus($status)
    {
    	$sql = "update ".$this->tableName." set 
    			               status_name = '".$status['name']."'where 
    			                status_id = '".$status['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllStatus()
    {
        $sql = "select * from ".$this->tableName;
        $result = $this->stagingDBConnect->query($sql);
        $resultSet = array();
        if($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                array_push($resultSet, $row);
            }
        }
        $this->stagingDBConnect->close();
        return $resultSet;
    }
}
?>