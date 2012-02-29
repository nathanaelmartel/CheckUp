<?php


$application = 'frontend';

if (substr_count($_SERVER['REQUEST_URI'], '/api/')) {
	$application = 'api';
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration($application, 'dev', true);
sfContext::createInstance($configuration)->dispatch();
