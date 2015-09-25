<?php 
Class UserRole
{
    
    protected $tableName;
    protected $stagingDBConnect;
	public function __construct()
    {
        $this->tableName = TABLE_ROLE; 
        $this->stagingDBConnect = new mysqli(DB_HOST,DB_USER_NAME,DB_PASSWORD,STAGING_DB);
    
    }
    /* isExistUserRole
     * @params int roleId
     * @return boolean value 
     * */
    public function isExistUserRole($roleId)
    {
        $sql = "select user_role_name from ".$this->tableName." where user_role_id = '".$roleId."'";
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
    
    public function addNewUserRole($role)
    {
    	$sql = "insert into ".$this->tableName." set
    			              user_role_id = '".$role['id']."',
    			              user_role_name = '".$role['name']."'";
    	$this->stagingDBConnect->query($sql);
    }
    
    public function updateExistingUserRole($role)
    {
    	$sql = "update ".$this->tableName." set 
    			               user_role_name = '".$role['name']."'where 
    			                user_role_id = '".$role['id']."'";
    	$this->stagingDBConnect->query($sql);
    }

    public function getAllUserRole()
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