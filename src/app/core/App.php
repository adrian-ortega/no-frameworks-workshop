<?php

namespace NoFrameworks\Core;

use NoFrameworks\Controllers\HomeController;

class App
{
  protected $controller = 'HomeController';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $this->parseRequest();
    $this->respond();
  }

  protected function respond()
  {
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  protected function parseRequestParam($str)
  {
    return preg_replace_callback('/[-_](.)/', function ($m) {
      return strtoupper($m[1]);
    }, $str);
  }

  protected function parseRequest()
  {
    if (!isset($_GET['uri'])) {
      $this->controller = new HomeController;
      return;
    };

    $request = explode('/', filter_var(trim($_GET['uri'], '/'), FILTER_SANITIZE_URL));

    // Check the controller exists
    if (isset($request[0])) {
      $maybeController = ucfirst($this->parseRequestParam($request[0])) . 'Controller';

      // The home controller is already included by the boostrap file, we need to include others
      $maybeControllerFile = ABS_PATH . '/app/controllers/' . $maybeController . '.php';
      if (file_exists($maybeControllerFile)) {
        require_once $maybeControllerFile;
        $this->controller = $maybeController;
        unset($request[0]);
      }
    }

    $controller = "\\NoFrameworks\\Controllers\\{$this->controller}";
    $this->controller = new $controller;

    if (isset($request[1])) {
      $this->method = 'notFound';
      $maybeMethod = $this->parseRequestParam($request[1]);
      if (method_exists($this->controller, $maybeMethod)) {
        $this->method = $maybeMethod;
        unset($request[1]);
      }
    }
    $this->params = !empty($request) ? array_values($request) : [];
  }
}
