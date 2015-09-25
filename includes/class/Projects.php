<?php 
Class Projects
{
    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_PROJECTS; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    
    }
    /* isExistProject
     * @params int projectId
     * @return boolean value 
     * */
    public function isExistProject($projectId)
    {
        $sql = "select project_identifier from ".$this->tableName." where project_id = '".$projectId."'";
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
    
    public function addNewProject($project)
    {
    	$sql = "insert into ".$this->tableName." set
    			              project_id = '".$project['id']."',
    			              project_identifier = '".$project['identifier']."',
    			              project_name = '".$project['name']."',
    			              project_created_on = '".$project['created_on']."',
    			              project_updated_on = '".$project['updated_on']."',
    			              project_description = '".$project['description']."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingProject($project)
    {
    	$sql = "update ".$this->tableName." set 
    			              project_identifier = '".$project['identifier']."',
    			              project_name = '".$project['name']."',
    			              project_created_on = '".$project['created_on']."',
    			              project_updated_on = '".$project['updated_on']."',
    			              project_description = '".$project['description']."' 
                              where 
    			              project_id = '".$project['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllProjects()
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