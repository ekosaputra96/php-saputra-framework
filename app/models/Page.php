<?php
class Page
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getPosts()
  {
    $this->db->query("SELECT * FROM feedback");
    return $this->db->getResults();
  }
}
