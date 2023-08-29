<?php

namespace NoFrameworks\Core;

abstract class Controller
{
  protected $view;

  public function __construct()
  {
    $this->view = new View();
  }

  public function notFound()
  {
    return $this->view->render('not-found');
  }

  public function index()
  {
    echo 'not found';
  }
}
