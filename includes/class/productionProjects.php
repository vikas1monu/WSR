<?php 
Class productionProjects
{
    
    protected $tableName;
    protected $productionDBConnect;
	
    public function __construct()
    {
        $this->tableName = TABLE_PRO_PROJECTS; 
        $this->productionDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,PRODUCTION_DB);
    }
    /* isExistProject
     * @params int projectId
     * @return boolean value 
     * */
    public function isExistProject($projectId)
    {
        $sql = "select r_project_name from ".$this->tableName." where r_project_id = '".$projectId."'";
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
    
    public function addNewProject($project)
    {

    	$sql = "insert into ".$this->tableName." set
    			              r_project_id = '".$project['project_id']."',
    			              r_project_name = '".$project['project_name']."',
    			              r_project_created_on = '".$project['project_created_on']."',
    			              r_project_description = '".$project['project_description']."'";
    	$this->productionDBConnect->query($sql);
    }
    
    public function updateExistingProject($project)
    {
    	$sql = "update ".$this->tableName." set 
    			              r_project_name = '".$project['project_name']."',
    			              r_project_created_on = '".$project['project_created_on']."',
    			              r_project_description = '".$project['project_description']."'
                               where 
    			              r_project_id = '".$project['project_id']."'";
    	$this->productionDBConnect->query($sql);
    }
}
?>