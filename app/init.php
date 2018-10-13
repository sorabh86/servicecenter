<?php 
/**
 * This file is initialise our project by including required files
 */

// start session object 
session_start();

// include core files & external functions
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'functions/functions.php';

// database details
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_DATA', 'service_center');
