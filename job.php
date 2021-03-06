<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
if (count($argv) < 2) {
    echo "Usage: {$argv[0]} {php_file}\n";
    exit(1);
}
define('APP_NAME', 'jobs');
define('APP_PATH', dirname(__FILE__) . '/app-'.APP_NAME."/");
define('SYS_PATH', APP_PATH . "../app-system/");
$G_LOAD_PATH = array(
    APP_PATH,
    APP_PATH."../app-spider/",
    APP_PATH."../app-common/",
    SYS_PATH
);
$G_CONF_PATH = array(
    APP_PATH."../app-common/config/",
    APP_PATH."../app-spider/config/"
);
require_once (SYS_PATH . "functions.php");
require_class("Dispatcher");
require (APP_PATH . "bin/{$argv[1]}");