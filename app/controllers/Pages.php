<?php
// namespace Eko;
class Pages extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    if (isLoggedIn()) {
      return redirect("posts");
    }
    $data = [
      "title" => "SharePosts",
      "description" =>
        "Simple social network built on the EkoMVC PHP framework",
      "path" => "index",
    ];
    $this->view("pages/index", $data);
  }

  public function about()
  {
    $data = [
      "title" => "About us",
      "description" => "App to share posts with other users",
      "path" => "pages/about",
    ];
    $this->view("pages/about", $data);
  }
}
