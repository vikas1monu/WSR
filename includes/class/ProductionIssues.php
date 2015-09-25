<?php 
Class ProductionIssues
{
    
    protected $tableName;
    protected $productionDBConnect;
	
    public function __construct()
    {
        $this->tableName = TABLE_PRO_ISSUES; 
        $this->productionDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,PRODUCTION_DB);
    }
    /* isExistIssue
     * @params int issueId
     * @return boolean value 
     * */
    public function isExistIssue($issueId)
    {
        $sql = "select 	r_issue_id from ".$this->tableName." where r_issue_id = '".$issueId."'";
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
    
    public function addNewIssue($issue)
    { 

    	$sql = "insert into ".$this->tableName." set
    			              r_issue_id = '".$issue['issue_id']."',
                        r_issue_subject = '".$issue['issue_subject']."',
                        r_issue_estimated_hours  = '".(!(empty($issue['issue_estimated_hours']))?$issue['issue_estimated_hours']:0)."',
    			              r_issue_created_on = '".$issue['issue_created_on']."',
    			              r_issue_start_date = '".(!empty($issue['issue_start_date'])?$issue['issue_start_date']: '0000-00-00')."',
    			              r_issue_updated_on = '".$issue['issue_updated_on']."',
    			              r_issue_completion_ratio = '".$issue['issue_ratio_done']."',
    			              r_issue_due_date = '".(!empty($issue['issue_due_date'])?$issue['issue_due_date']: '0000-00-00')."',
    			              r_issue_description = '".$issue['issue_description']."',
    			              r_issue_tracker_code = '".$issue['tracker_id']."',
    			              r_ticket_status_code = '".$issue['status_id']."',
    			              r_project_id = '".$issue['project_id']."',
    			              r_assignee_id = '".(!(empty($issue['user_id']))?$issue['user_id']:NULL)."',
    			              r_issue_priority_code = '".$issue['priority_id']."',
    			              r_issue_parent_issue_id = '".(!(empty($issue['parent_id']))?$issue['parent_id']:NULL)."',
    			              r_issue_created_by = '".$issue['author_id']."',
    			              r_author_name = '".$issue['author_name']."',
    			              r_user_name = '".(!(empty($issue['user_name']))?$issue['user_name']:NULL)."',
                        r_issue_remain_effort = '".(!(empty($issue['remain_effort']))?$issue['remain_effort']:0)."',
                        r_issue_target_completion_date = '".(!(empty($issue['targeted_completion_date']))?$issue['targeted_completion_date']:'0000-00-00')."',
                        r_project_type = '".(!(empty($issue['project_type']))?$issue['project_type']:NULL)."'";
    	$this->productionDBConnect->query($sql);
    }
    
    public function updateExistingIssue($issue)
    { 
    	$sql = "update ".$this->tableName." set
                              r_issue_subject = '".$issue['issue_subject']."',
                              r_issue_estimated_hours  = '".(!(empty($issue['issue_estimated_hours']))?$issue['issue_estimated_hours']:0)."',
                              r_issue_created_on = '".$issue['issue_created_on']."',
                              r_issue_start_date = '".(!empty($issue['issue_start_date'])?$issue['issue_start_date']: '0000-00-00')."',
                              r_issue_updated_on = '".$issue['issue_updated_on']."',
                              r_issue_completion_ratio = '".$issue['issue_ratio_done']."',
                              r_issue_due_date = '".(!empty($issue['issue_due_date'])?$issue['issue_due_date']: '0000-00-00')."',
                              r_issue_description = '".$issue['issue_description']."',
                              r_issue_tracker_code = '".$issue['tracker_id']."',
                              r_ticket_status_code = '".$issue['status_id']."',
                              r_project_id = '".$issue['project_id']."',
                              r_assignee_id = '".(!(empty($issue['user_id']))?$issue['user_id']:NULL)."',
                              r_issue_priority_code = '".$issue['priority_id']."',
                              r_issue_parent_issue_id = '".(!(empty($issue['parent_id']))?$issue['parent_id']:NULL)."',
                              r_issue_created_by = '".$issue['author_id']."',
                              r_author_name = '".$issue['author_name']."',
                              r_user_name = '".(!(empty($issue['user_name']))?$issue['user_name']:NULL)."',
                              r_issue_remain_effort = '".(!(empty($issue['remain_effort']))?$issue['remain_effort']:0)."',
                              r_issue_target_completion_date = '".(!(empty($issue['targeted_completion_date']))?$issue['targeted_completion_date']:'0000-00-00')."', 
                              r_project_type = '".(!(empty($issue['project_type']))?$issue['project_type']:NULL)."'
                              where 
    			               r_issue_id = '".$issue['issue_id']."'";

    	        $this->productionDBConnect->query($sql);
    }
}
?>