<?php
function PDOError($th)
{
  die("ERR : " . $th->getMessage());
}
