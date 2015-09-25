<?php 
include_once '/config/config.php';

function __autoload($classname) {
    $classname = str_replace('\\', '/', $classname);
    
    $filename = CLASS_PATH. $classname .".php";
    if (file_exists($filename))
    {
        include_once($filename);
    }
    
    /* If  file not exits get it from Redmine Folder  */
    $filename = REDMINE_LIB_PATH. $classname .".php";
    if (file_exists($filename))
    {
        include_once($filename);
    }
}

?>