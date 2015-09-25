<?php 
Class ProductionTimeEntries
{

    
    protected $tableName;
    protected $productionDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_PRO_TIME_LOG; 
        $this->productionDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,PRODUCTION_DB);
    }

    /* isExistTimeEntry
     * @params int timeLogId
     * @return boolean value 
     * */
    public function isExistTimeEntry($timeLogId)
    {
        $sql = "select r_project_id from ".$this->tableName." where r_issue_timelog_id = '".$timeLogId."'";
        
        $result = $this->productionDBConnect->query($sql);

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
    	$sql = "insert into ".$this->tableName." set
    			        r_issue_timelog_id = '".$timeEntry['time_log_id']."',
    			        r_project_id = '".$timeEntry['project_id']."',
    			        r_issue_timelog_comments = '".$timeEntry['time_log_comments']."',
    			        r_time_log_activity_code = '".$timeEntry['activity_id']."',
    			        r_issue_id = '".$timeEntry['issue_id']."',
                        r_user_id = '".$timeEntry['user_id']."',
                        r_issue_timelog_logged_hours = '".$timeEntry['time_log_hours']."',
                        r_issue_timelog_date = '".$timeEntry['time_log_spent_on']."',
                        r_issue_timelog_updated_on = '".$timeEntry['time_log_updated_on']."',
                        r_time_log_billing_category_code = '".(!(empty($issue['billing_category_type']))?$issue['billing_category_type']:0)."'";
    	$this->productionDBConnect->query($sql);
    }
    
    public function updateExistingTimeEntry($timeEntry)
    {
    	$sql = "update ".$this->tableName." set 
                        r_project_id = '".$timeEntry['project_id']."',
                        r_issue_timelog_comments = '".$timeEntry['time_log_comments']."',
                        r_time_log_activity_code = '".$timeEntry['activity_id']."',
                        r_issue_id = '".$timeEntry['issue_id']."',
                        r_user_id = '".$timeEntry['user_id']."',
                        r_issue_timelog_logged_hours = '".$timeEntry['time_log_hours']."',
                        r_issue_timelog_date = '".$timeEntry['time_log_spent_on']."',
                        r_issue_timelog_updated_on = '".$timeEntry['time_log_updated_on']."',
                        r_time_log_billing_category_code = '".(!(empty($issue['billing_category_type']))?$issue['billing_category_type']:0)."'
                         where 
                        r_issue_timelog_id = '".$timeEntry['time_log_id']."'";
    	$this->productionDBConnect->query($sql);
    }
}
?>