<?php

namespace NoFrameworks\Core;

class View
{
  protected $templates_path;

  public function __construct()
  {
    $this->templates_path = ABS_PATH . '/templates';
  }

  public function render($template, $data = [])
  {
    if (!file_exists($template = $this->templates_path . '/' . $template . '.php')) {
      return $this->render('not-found', $data);
    }

    extract($data);
    require_once $template;
  }
}
