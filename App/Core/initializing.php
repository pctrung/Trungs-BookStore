<?php

// Define App Directories
defined('ROOT') ?:  define('ROOT', dirname(dirname(__DIR__)));

defined('DS') ?:  define('DS', DIRECTORY_SEPARATOR);
defined('APP') ?:  define('APP', ROOT . DS . 'App');
defined('CORE') ?:  define('CORE', APP . DS . 'Core');
defined('CONT') ?:  define('CONT', APP . DS . 'Controllers');
defined('MODEL') ?:  define('MODEL', APP . DS . 'Models');
defined('VIEW') ?:  define('VIEW', APP . DS . 'Views');
defined('CONF') ?:  define('CONF', APP . DS . 'Configs');
defined('PUBLIC') ?:  define('PUBLIC', ROOT . DS . 'public');

// database constant
$database = require(CONF . DS . 'database.php');

defined('DB_HOSTNAME') ?:  define('DB_HOSTNAME', $database['db_hostname']);
defined('DB_NAME') ?:  define('DB_NAME', $database['db_name']);
defined('DB_USERNAME') ?:  define('DB_USERNAME', $database['db_username']);
defined('DB_PASSWORD') ?:  define('DB_PASSWORD', $database['db_password']);

// route constant
$routes = require(CONF . DS . 'routes.php');

defined('DEFAULT_CONTROLLER') ?: define('DEFAULT_CONTROLLER', $routes['default_controller']);
defined('DEFAULT_ACTION') ?: define('DEFAULT_ACTION', $routes['default_action']);

// load require file
require_once(CORE . DS . "App.php");
require_once(CORE . DS . "Controller.php");
require_once(CORE . DS . "Database.php");
