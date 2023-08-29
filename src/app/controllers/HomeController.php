<?php

namespace NoFrameworks\Controllers;

use NoFrameworks\Core\Controller;

class HomeController extends Controller
{
  public function index()
  {
    return $this->view->render('home', [
      'welcome' => 'hello world'
    ]);
  }
}
