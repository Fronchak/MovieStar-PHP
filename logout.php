<?php

  require_once("templates/header.php");
  if($userData) {
    $userDAO->destroyToken();
  }
?>
