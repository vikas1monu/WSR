<?php 
Class Issues
{
    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_ISSUES; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    }
    /* isExistIssue
     * @params int issueId
     * @return boolean value 
     * */
    public function isExistIssue($issueId)
    {
        $sql = "select 	issue_subject from ".$this->tableName." where issue_id = '".$issueId."'";
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
    
    public function addNewIssue($issue)
    { 
        foreach($issue['custom_fields'] as $key => $customValue)
        {
            if($customValue['id']==59)
                { 
                  $targetCompletion = $customValue['value'];
                 
                }
                
               if($customValue['id']==60)
                {
                $remainEffort = $customValue['value'];
                
                }
                if($customValue['id']==43)
                {
                $projectType = $customValue['value'];
                
                }
        }
    	$sql = "insert into ".$this->tableName." set
    			              issue_id = '".$issue['id']."',
                              issue_estimated_hours  = '".(!(empty($issue['estimated_hours']))?$issue['estimated_hours']:0)."',
    			              issue_subject = '".$issue['subject']."',
    			              issue_created_on = '".$issue['created_on']."',
    			              issue_start_date = '".(!empty($issue['start_date'])?$issue['start_date']: '0000-00-00')."',
    			              issue_updated_on = '".$issue['updated_on']."',
    			              issue_ratio_done = '".$issue['done_ratio']."',
    			              issue_due_date = '".(!empty($issue['due_date'])?$issue['due_date']: '0000-00-00')."',
    			              issue_description = '".$issue['description']."',
    			              tracker_id = '".$issue['tracker']['id']."',
    			              status_id = '".$issue['status']['id']."',
    			              project_id = '".$issue['project']['id']."',
    			              user_id = '".(!(empty($issue['assigned_to']['id']))?$issue['assigned_to']['id']:NULL)."',
    			              priority_id = '".$issue['priority']['id']."',
    			              parent_id = '".(!(empty($issue['parent']['id']))?$issue['parent']['id']:NULL)."',
    			              author_id = '".$issue['author']['id']."',
    			              author_name = '".$issue['author']['name']."',
    			              user_name = '".(!(empty($issue['assigned_to']['name']))?$issue['assigned_to']['name']:NULL)."',
                              remain_effort = '".(!(empty($remainEffort))?$remainEffort:0.0)."',
                              targeted_completion_date = '".(!(empty($targetCompletion))?$targetCompletion:NULL)."',
                              project_type = '".(!(empty($projectType))?$projectType:NULL)."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingIssue($issue)
    { 
        foreach($issue['custom_fields'] as $key => $customValue)
        {
            if($customValue['id']==59)
                { 
                  $targetCompletion = $customValue['value'];
                 
                }
                
               if($customValue['id']==60)
                {
                $remainEffort = $customValue['value'];
                
                }
              if($customValue['id']==43)
                {
                $projectType = $customValue['value'];
                
                }
        }
    	$sql = "update ".$this->tableName." set
                              issue_estimated_hours  = '".(!(empty($issue['estimated_hours']))?$issue['estimated_hours']:0)."',
                              issue_subject = '".$issue['subject']."',
    			              issue_created_on = '".$issue['created_on']."',
    			              issue_start_date = '".(!empty($issue['start_date'])?$issue['start_date']: '0000-00-00')."',
    			              issue_updated_on = '".$issue['updated_on']."',
    			              issue_ratio_done = '".$issue['done_ratio']."',
    			              issue_due_date = '".(!empty($issue['due_date'])?$issue['due_date']: '0000-00-00')."',
    			              issue_description = '".$issue['description']."',
    			              tracker_id = '".$issue['tracker']['id']."',
    			              status_id = '".$issue['status']['id']."',
    			              project_id = '".$issue['project']['id']."',
    			              user_id = '".(!(empty($issue['assigned_to']['id']))?$issue['assigned_to']['id']:NULL)."',
    			              priority_id = '".$issue['priority']['id']."',
    			              parent_id = '".(!(empty($issue['parent']['id']))?$issue['parent']['id']:NULL)."',
    			              author_id = '".$issue['author']['id']."',
    			              author_name = '".$issue['author']['name']."',
    			              user_name = '".(!(empty($issue['assigned_to']['name']))?$issue['assigned_to']['name']:NULL)."',
                              remain_effort = '".(!(empty($remainEffort))?$remainEffort:0.0)."',
                              targeted_completion_date = '".(!(empty($targetCompletion))?$targetCompletion:NULL)."',
                              project_type = '".(!(empty($projectType))?$projectType:NULL)."'
                              where 
    			              issue_id = '".$issue['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllIssues()
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