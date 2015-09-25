<?php 
include_once './includes/class/Projects.php';
include_once './includes/class/Issues.php';
include_once './includes/class/TimeEntries.php';
include_once './includes/class/productionProjects.php';
include_once './includes/class/ProductionIssues.php';
include_once './includes/class/ProductionTimeEntries.php';
Class ProductionCron
{
    protected $projectModel;
    protected $productionProjectModel;

    protected $issueModel;
    protected $productionIssueModel;

    protected $timeEntryModel;
    protected $productionTimeEntryModel;
    
    public function __construct()
    {
        
        $this->projectModel = new Projects();
        $this->productionProjectModel = new productionProjects();

        $this->issueModel = new Issues();
        $this->productionIssueModel = new ProductionIssues();

        $this->timeEntryModel = new TimeEntries();
        $this->productionTimeEntryModel = new ProductionTimeEntries();
    }

    public function initiateCronForProduction()
    {
        $stagingProjects = $this->projectModel->getAllProjects();
        $this->addProjectToProduction($stagingProjects);
       
        $stagingIssues = $this->issueModel->getAllIssues();
        $this->addIssueToProduction($stagingIssues);
         
        $stagingTimeEntry = $this->timeEntryModel->getAllTimeEntry();
        $this->addTimeEntryToProduction($stagingTimeEntry);
    }

    public function addProjectToProduction($stagingProjects)
    {    
        foreach ($stagingProjects as $singleProject) {
           
          //IF project already exist into our DB then update record
        if($this->productionProjectModel->isExistProject($singleProject['project_id']))
        {
            $this->productionProjectModel->updateExistingProject($singleProject);
        }
        else
        {
        $this->productionProjectModel->addNewProject($singleProject);
        }
     }
    }
    
      public function addIssueToProduction($stagingIssues)
    {    

        foreach ($stagingIssues as $singleIssue) {
           
          //IF issue already exist into our DB then update record
        if($this->productionIssueModel->isExistIssue($singleIssue['issue_id']))
        {
            $this->productionIssueModel->updateExistingIssue($singleIssue);
        }
        else
        {
        $this->productionIssueModel->addNewIssue($singleIssue);
        }
     }
    }


     public function addTimeEntryToProduction($stagingTimeEntry)
    {    

        foreach ($stagingTimeEntry as $singleTimeEntry) {
           
          //IF TimeEntry already exist into our DB then update record
        if($this->productionTimeEntryModel->isExistTimeEntry($singleTimeEntry['time_log_id']))
        {
            $this->productionTimeEntryModel->updateExistingTimeEntry($singleTimeEntry);
        }
        else
        {
        $this->productionTimeEntryModel->addNewTimeEntry($singleTimeEntry);
        }
    }
    }
}
