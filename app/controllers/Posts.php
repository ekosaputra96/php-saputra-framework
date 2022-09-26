<?php
class Posts extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      return redirect("users/login");
    }

    $this->postModel = $this->model("Post");
  }

  public function index()
  {
    try {
      $posts = $this->postModel->getPosts();
    } catch (PDOException $th) {
      die("ERR: " . $th->getMessage());
    }
    $data = [
      "path" => "posts/index",
      "posts" => $posts,
    ];
    $this->view($data["path"], $data);
  }

  public function add()
  {
    $data = [
      "path" => "posts/add",
      "title" => "",
      "body" => "",
    ];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data["title"] = $_POST["title"];
      $data["body"] = $_POST["body"];
      $data["user_id"] = $_SESSION["user_id"];

      // validate data
      if (empty($data["title"])) {
        $data["title_err"] = "Please enter title";
      }

      if (empty($data["body"])) {
        $data["body_err"] = "Please enter body text";
      }

      // make sure there is no errors
      if (empty($data["title_err"]) && empty($data["body_err"])) {
        try {
          if ($this->postModel->addPost($data)) {
            flash("post_message", "Post has been added");
            redirect("posts");
          }
        } catch (PDOException $th) {
          die("Err: " . $th->getMessage());
        }
      }
    }
    $this->view($data["path"], $data);
  }

  public function edit($id)
  {
    $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
    $data = [
      "path" => "posts/edit",
      "id" => "",
      "title" => "",
      "body" => "",
    ];

    // check if empty data
    if (empty($data["id"])) {
      try {
        $post = $this->postModel->getPostById($id);
      } catch (PDOException $th) {
        PDOError($th);
      }
      $data["id"] = $post->id;
      $data["title"] = $post->title;
      $data["body"] = $post->body;
    }

    // redirect if user_id doesn't match with the post
    if ($post->user_id !== $_SESSION["user_id"]) {
      redirect("posts");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // sanitize POST array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $data["title"] = trim($_POST["title"]);
      $data["body"] = trim($_POST["body"]);
      $data["id"] = trim($id);

      // validate data
      if (empty($data["title"])) {
        $data["title_err"] = "Please enter title";
      }

      if (empty($data["body"])) {
        $data["body_err"] = "Please enter body text";
      }

      // make sure there is no errors
      if (empty($data["title_err"]) && empty($data["body_err"])) {
        try {
          if ($this->postModel->updatePost($data)) {
            flash("post_message", $data["title"] . " has been edited");
            redirect("posts");
          }
        } catch (PDOException $th) {
          PDOError($th);
        }
      }
    }

    $this->view($data["path"], $data);
  }

  public function show($id)
  {
    $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
    try {
      $post = $this->postModel->getPostWithUser($id);
    } catch (PDOException $th) {
      PDOError($th);
    }
    $data = [
      "path" => "posts/show",
      "post" => $post,
    ];

    $this->view($data["path"], $data);
  }

  public function delete($id)
  {
    $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
    try {
      $post = $this->postModel->getPostById($id);
    } catch (PDOException $th) {
      PDOError($th);
    }
    // die();

    if (!$post) {
      flash("post_message", "Post not found !", "alert alert-warning");
    }

    if ($post->user_id !== $_SESSION["user_id"]) {
      flash("post_message", "Not Authorized", "alert alert-warning");
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      try {
        if ($this->postModel->deletePost($id)) {
          flash(
            "post_message",
            $post->title . " has been deleted",
            "alert alert-danger"
          );
        }
      } catch (PDOException $th) {
        PDOError($th);
      }
    }

    return redirect("posts");
  }
}
