<?php
/**
 * @file
 * Initiate Cron Job Call
 */
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'includes/class/CronJob.php';

$cronJob = new CronJob();
$cronJob->initialteRedmineCronJob();
//$cronJob->masterRedmineCronJob();
?>