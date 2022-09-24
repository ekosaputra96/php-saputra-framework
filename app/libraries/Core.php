<?php
// App Core Class
// Create URL & loads core controllers
// URL format - /controller/method/params
class Core
{
  protected $currentController = "Pages";
  protected $currentMethod = "Index";
  protected $params = [];

  public function __construct()
  {
    // get url from getUrl method
    $url = $this->getUrl();
    // looking for controller
    if (!empty($url)) {
      if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
    }
    // require the controller
    require_once "../app/controllers/" . $this->currentController . ".php";
    // create instance of the class
    $this->currentController = new $this->currentController();
    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }
    $this->params = $url ? array_values($url) : [];
    // return callback that call method in a class
    call_user_func_array(
      [$this->currentController, $this->currentMethod],
      $this->params
    );
  }
  public function getUrl()
  {
    if (isset($_GET["url"])) {
      $url = rtrim($_GET["url"], "/");
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS);
      return explode("/", $url);
    }
  }
}
