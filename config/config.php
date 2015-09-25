<?php 
include_once 'tables.php';

define('SITE_ROOT','http://wsr.cron');
define('SEPARATOR', '/');
define('ADMIN_EMAIL', 'avinash.singh@optimusinfo.com');
define('CLASS_PATH','./includes/class/');
define('REDMINE_LIB_PATH','./includes/Redmine/');
define('REDMINE_API_PATH',REDMINE_LIB_PATH.'Api/');

define('REDMINE_PORTAL_PATH','https://portal.optimusinfo.com/redmine');
define('REDMINE_API_KEY', 'abde3ae06a4eb5c46e51ff13f33953726b9e24c8');


if($_SERVER['HTTP_HOST'] == 'wsr.cron')
{
    define('STAGING_DB','wsr_staging_db');
    define('PRODUCTION_DB','wsr_production_db');
    define('DB_HOST','localhost');
    define('DB_USER_NAME','root');
    define('DB_PASSWORD','optimus@123');
}
else 
{
    define('STAGING_DB','wsr_staging_db');
    define('PRODUCTION_DB','wsr_production_db');
    define('DB_HOST','localhost');
    define('DB_USER_NAME','root');
    define('DB_PASSWORD','optimus@123');
}
?>