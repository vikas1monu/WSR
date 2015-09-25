<?php 
Class TimeEntries
{

    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_TIMELOG; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    }

    /* isExistTimeEntry
     * @params int timeLogId
     * @return boolean value 
     * */
    public function isExistTimeEntry($timeLogId)
    {
        $sql = "select project_id from ".$this->tableName." where time_log_id = '".$timeLogId."'";
        
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
    
    public function addNewTimeEntry($timeEntry)
    {
      foreach($timeEntry['custom_fields'] as $key => $customValue)
        {
          $billingId = $customValue['id'];
          $billingValue = $customValue['value'];
        }
    	$sql = "insert into ".$this->tableName." set
    			              time_log_id = '".$timeEntry['id']."',
    			              project_id = '".$timeEntry['project']['id']."',
    			              time_log_comments = '".$timeEntry['comments']."',
    			              activity_id = '".$timeEntry['activity']['id']."',
    			              issue_id = '".$timeEntry['issue']['id']."',
    			              time_log_created_on = '".$timeEntry['created_on']."',
                        user_id = '".$timeEntry['user']['id']."',
                        time_log_hours = '".$timeEntry['hours']."',
                        time_log_spent_on = '".$timeEntry['spent_on']."',
                        time_log_updated_on = '".$timeEntry['updated_on']."',
                        billing_category_id = '".$billingId."',
                        billing_category_type = '".$billingValue."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingTimeEntry($timeEntry)
    {
      foreach($timeEntry['custom_fields'] as $key => $customValue)
        {
          $billingId = $customValue['id'];
          $billingValue = $customValue['value'];
        }
    	$sql = "update ".$this->tableName." set 
                              project_id = '".$timeEntry['project']['id']."',
                              time_log_comments = '".$timeEntry['comments']."',
                              activity_id = '".$timeEntry['activity']['id']."',
                              issue_id = '".$timeEntry['issue']['id']."',
                              time_log_created_on = '".$timeEntry['created_on']."',
                              user_id = '".$timeEntry['user']['id']."',
                              time_log_hours = '".$timeEntry['hours']."',
                              time_log_spent_on = '".$timeEntry['spent_on']."',
                              time_log_updated_on = '".$timeEntry['updated_on']."',
                              billing_category_id = '".$billingId."',
                              billing_category_type = '".$billingValue."' 
                              where 
                              time_log_id = '".$timeEntry['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllTimeEntry()
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