<?php
class Users extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model("User");
  }

  public function index()
  {
    header("location: " . URLROOT);
  }

  // register
  public function register()
  {
    $data = [
      "path" => "users/register",
      "name" => "",
      "email" => "",
      "password" => "",
      "confirm_password" => "",
      "name_err" => "",
      "email_err" => "",
      "password_err" => "",
      "confirm_password_err" => "",
    ];

    // check if post is summited
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // process form
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data["name"] = trim($_POST["name"]);
      $data["email"] = trim($_POST["email"]);
      $data["password"] = trim($_POST["password"]);
      $data["confirm_password"] = trim($_POST["confirm_password"]);

      // validate name
      if (empty($data["name"])) {
        $data["name_err"] = "Please enter name";
      }

      // validate email
      if (empty($data["email"])) {
        $data["email_err"] = "Please enter email";
      } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $data["email_err"] = "Please enter valid email";
      } elseif ($this->userModel->findUserByEmail($data["email"])) {
        $data["email_err"] = "Email is already taken";
      }

      // validate password
      if (empty($data["password"])) {
        $data["password_err"] = "Please enter password";
      } elseif (strlen($data["password"]) < 6) {
        $data["password_err"] = "Password must be at least 6 characters";
      }

      // validate confirm password
      if (empty($data["confirm_password"])) {
        $data["confirm_password_err"] = "Please enter confirm password";
      } elseif ($data["password"] !== $data["confirm_password"]) {
        $data["confirm_password_err"] = "Passwords do not match";
      }

      // make sure there is no error
      if (
        empty($data["name_err"]) &&
        empty($data["email_err"]) &&
        empty($data["password_err"]) &&
        empty($data["confirm_password_err"])
      ) {
        // pass the filter
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

        // insert the dato to database
        try {
          $this->userModel->register($data);
          flash("login_message", "You're now registered and can login");
          redirect("users/login");
        } catch (PDOException $th) {
          die("ERR !!! : " . $th->getMessage());
        }
      }
    }
    // load register form
    $this->view("users/register", $data);
  }

  // login
  public function login()
  {
    $data = [
      "path" => "users/login",
      "email" => "",
      "password" => "",
      "email_err" => "",
      "password_err" => "",
    ];
    // check if post is summited
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // process form

      // sanitize post data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data["email"] = trim($_POST["email"]);
      $data["password"] = trim($_POST["password"]);

      // validate email
      if (empty($data["email"])) {
        $data["email_err"] = "Please enter email";
      } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $data["email_err"] = "Please enter valid email";
      } elseif (!$this->userModel->findUserByEmail($data["email"])) {
        $data["email_err"] = "No user with that email";
      }

      // validate password
      if (empty($data["password"])) {
        $data["password_err"] = "Please enter password";
      } elseif (strlen($data["password"]) < 6) {
        $data["password_err"] = "Password must be at least 6 characters";
      }

      if (empty($data["email_err"]) && empty($data["password_err"])) {
        // validated
        // check and set logged in user
        $loggedInUser = $this->userModel->login(
          $data["email"],
          $data["password"]
        );
        if ($loggedInUser) {
          // create session
          $this->createUserSession($loggedInUser);
        } else {
          $data["password_err"] = "Password Incorrect";
        }
      }
    }
    $this->view("users/login", $data);
  }

  public function createUserSession($user)
  {
    $_SESSION["user_id"] = $user->id;
    $_SESSION["user_email"] = $user->email;
    $_SESSION["user_name"] = $user->name;
    redirect("posts");
  }

  public function logout()
  {
    unset($_SESSION["user_id"]);
    unset($_SESSION["user_email"]);
    unset($_SESSION["user_name"]);
    session_destroy();
    redirect("users/login");
  }
}
