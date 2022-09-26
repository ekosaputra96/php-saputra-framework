<?php
session_start();

// flash message helper
function flash($name = "", $message = "", $class = "alert alert-success")
{
  if (!empty($name)) {
    if (!empty($message) && empty($_SESSION[$name])) {
      if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if (!empty($_SESSION[$name . "_class"])) {
        unset($_SESSION[$name . "_class"]);
      }

      $_SESSION[$name] = $message;
      $_SESSION[$name . "_class"] = $class;
    } elseif (empty($message) && !empty($_SESSION[$name])) {
      $data = [
        "message" => $_SESSION[$name],
        "class" => $_SESSION[$name . "_class"],
      ];
      unset($_SESSION[$name]);
      unset($_SESSION[$name . "_class"]);
      return $data;
    }
  }
  return false;
}

function isLoggedIn()
{
  if (isset($_SESSION["user_id"])) {
    return true;
  }
  return false;
}
