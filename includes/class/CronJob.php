<?php 
include_once './includes/class/Projects.php';
include_once './includes/class/Issues.php';
include_once './includes/class/TimeEntries.php';
include_once './includes/class/Trackers.php';
include_once './includes/class/UserRole.php';
include_once './includes/class/Status.php';
Class CronJob
{
    protected $client;
    protected $projectModel;
    protected $issueModel;
    protected $timeEntryModel;
    protected $trackerModel;
    protected $userRoleModel;
    protected $statusModel;

    
    
    public function __construct()
    {
        $this->client = new Redmine\Client(REDMINE_PORTAL_PATH,REDMINE_API_KEY);
        $this->projectModel = new Projects();
        $this->issueModel = new Issues();
        $this->timeEntryModel = new TimeEntries();
        $this->trackerModel = new Trackers();
        $this->userRoleModel = new UserRole();
        $this->statusModel = new Status();

    }
    /* initialteRedmineCronJob
     * It initiate cron Job to fetch all project on Redmine
     * */
    public function initialteRedmineCronJob()
     {   
            
        //GET All projects 
        $allProjects = $this->client->api('project')->all(array('limit' => 100,'offset' => 0));
        foreach ($allProjects['projects'] as $project)
        { 
        	$this->addProject($project);
        }
        //GET All issues 
            $allIssue=$this->client->api('issue')->all();
            if($allIssue['total_count'] >= 0)
            {
                for ($offset=0; $offset <=$allIssue['total_count'] ; $offset+=$allIssue['limit']) 
                { 
                    
                    $issueList=$this->client->api('issue')->all(array(
                        'limit' => $allIssue['limit'],
                        'offset' =>$offset));                
                    foreach ($issueList['issues'] as $singleIssue)
                    {
                     $this->addIssue($singleIssue);
                    }
                }
            }
           
                
        // //Get All Timelog Entries 
         $allTimeEntry=$this->client->api('time_entry')->all();
            if($allTimeEntry['total_count'] >= 0)
            {
                for ($offset=0; $offset <=$allTimeEntry['total_count'] ; $offset+=$allTimeEntry['limit']) 
                { 
                    
                    $timeEntryList=$this->client->api('time_entry')->all(array('limit' => $allTimeEntry['limit'],'offset' =>$offset));                
                    foreach ($timeEntryList['time_entries'] as $singleTimeLog)
                    {
                     $this->addTimeEntry($singleTimeLog);
                    }
                }
            }

                
    }
    
    /* masterRedmineCronJob
     * It  cron Job to fetch all master data on Redmine
     * */
    public function masterRedmineCronJob()
    {
    //GET All trackers   
    $allTracker = $this->client->api('tracker')->all(array('limit'=>1000));
    foreach ($allTracker['trackers'] as $key=>$tracker)
      {	
        $this->addTracker($tracker);
      }
    //GET All user roles 
    $allRole = $this->client->api('role')->all(array('limit' => 1000)); 
    foreach ($allRole['roles'] as $key=>$role)
       {
         $this->addUserRole($role);
       }
    //GET All issue status 
    $allStatus = $this->client->api('issue_status')->all(array('limit' => 1000));
    foreach($allStatus['issue_statuses'] as $key=>$status)
        {
         $this->addStatus($status);
        }
    }
    
    /* addProject
    This function check either project is exist or not 
    if exist then update database otherwise insert a new project 
    into database.
    */
    public function addProject($project)
    {
    	//IF project already exist into our DB then update record
    	if($this->projectModel->isExistProject($project['id']))
    	{
    		$this->projectModel->updateExistingProject($project);
    	}
    	else
    	{
    		//IF project not exist then add new project
    		$this->projectModel->addNewProject($project);
    	}
    }
    
    /* addIssue
    This function check either issue is exist or not 
    if exist then update database otherwise insert a new issue 
    into database.
    */
    public function addIssue($singleIssue)
    {
    	//IF Issue already exist into our DB then update record
    	if($this->issueModel->isExistIssue($singleIssue['id']))
    	{
    		$this->issueModel->updateExistingIssue($singleIssue);
    	}
    	else
    	{
    		//IF Issue not exist then add new Issue
    		$this->issueModel->addNewIssue($singleIssue);
    	}
    }
    /* addTimeEntry
    This function check either timeEntry is exist or not 
    if exist then update database otherwise insert a new time record 
    into database.
    */
     public function addTimeEntry($singleTimeLog)
    {
        //IF Time Entry already exist into our DB then update record
        if($this->timeEntryModel->isExistTimeEntry($singleTimeLog['id']))
        {
            $this->timeEntryModel->updateExistingTimeEntry($singleTimeLog);
        }
        else
        {
            //IF Time Entry not exist then add new timeEntry
            $this->timeEntryModel->addNewTimeEntry($singleTimeLog);
        }
    }

    public function addTracker($tracker)
    {
        //IF tracker already exist into our DB then update record
        if($this->trackerModel->isExistTracker($tracker['id']))
        {
            $this->trackerModel->updateExistingTracker($tracker);
        }
        else
        {
            //IF tracker not exist then add new tracker
            $this->trackerModel->addNewTracker($tracker);
        }
    }

    public function addUserRole($role)
    {
        //IF role already exist into our DB then update record
        if($this->userRoleModel->isExistUserRole($role['id']))
        {
            $this->userRoleModel->updateExistingUserRole($role);
        }
        else
        {
            //IF role not exist then add new role
            $this->userRoleModel->addNewUserRole($role);
        }
    }

    public function addStatus($status)
    {
        //IF status already exist into our DB then update record
        if($this->statusModel->isExistStatus($status['id']))
        {
            $this->statusModel->updateExistingStatus($status);
        }
        else
        {
            //IF status not exist then add new status
            $this->statusModel->addNewStatus($status);
        }
    }
}
?>