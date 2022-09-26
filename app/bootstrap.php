<?php
// load config
require_once "config/config.php";

// load helpers
require_once "helpers/url_helper.php";
require_once "helpers/session_helper.php";
require_once "helpers/error_helper.php";

// load all library
// require_once "libraries/Controller.php";
// require_once "libraries/Core.php";
// require_once "libraries/Database.php";

// autoload core library
spl_autoload_register(function ($className) {
  require_once "libraries/" . $className . ".php";
});
