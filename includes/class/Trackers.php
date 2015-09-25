<?php 
Class Trackers
{
    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_TRACKERS; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    
    }
    /* isExistTracker
     * @params int trackerId
     * @return boolean value 
     * */
    public function isExistTracker($trackerId)
    {
        $sql = "select tracker_name from ".$this->tableName." where tracker_id = '".$trackerId."'";
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
    
    public function addNewTracker($tracker)
    {
    	$sql = "insert into ".$this->tableName." set
    			              tracker_id = '".$tracker['id']."',
    			              tracker_name = '".$tracker['name']."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingTracker($tracker)
    {
    	$sql = "update ".$this->tableName." set 
    			               tracker_name = '".$tracker['name']."'where 
    			                tracker_id = '".$tracker['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllTrackers()
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