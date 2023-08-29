<?php

date_default_timezone_set('America/Los_Angeles');
define('ABS_PATH', realpath(__DIR__ . '/..'));

error_reporting(E_ALL);
ini_set('log_errors', 1);

function dd()
{
  foreach (func_get_args() as $arg) {
    echo '<pre>';
    var_dump($arg);
    echo '</pre>';
  }
  die();
}

// Core
require_once ABS_PATH . '/app/core/View.php';
require_once ABS_PATH . '/app/core/Controller.php';
require_once ABS_PATH . '/app/controllers/HomeController.php';
require_once ABS_PATH . '/app/core/App.php';

$app = new \NoFrameworks\Core\App;
