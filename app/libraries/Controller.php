<?php
// Base Controller
// Load the models and views
class Controller
{
  public function model($model)
  {
    $filePath = "../app/models/" . $model . ".php";
    if (file_exists($filePath)) {
      require_once $filePath;
      return new $model();
    } else {
      die("Model does not exits");
    }
  }

  public function view($view, $data = [])
  {
    $filePath = "../app/views/" . $view . ".php";
    if (file_exists($filePath)) {
      require_once $filePath;
    } else {
      die("View does not exits");
    }
  }
}
