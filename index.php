<?php 
/**
 * This is a initial point where application starts
 * For doing MVC framework properly we need a single point,
 * where all request have been submitted and filtered later
 * and provide a controller based on request.
 */

//  Saving Base Dir path
define("SC_DIR", dirname(__FILE__));

// Saving Base Url Path
define("SC_URL", "http://" . $_SERVER['SERVER_NAME'] . '/mca-mini-project/service-center/');

// Initialize our little framework
require_once 'app/init.php';
$app = new App();

