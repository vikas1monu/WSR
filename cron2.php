<?php
/**
 * @file
 * Initiate Cron Job Call
 */
require_once 'vendor/autoload.php';
require_once 'config/config.php';
require_once 'includes/class/ProductionCron.php';

$cronJob = new ProductionCron();
$cronJob->initiateCronForProduction();
?>