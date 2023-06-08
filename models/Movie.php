<?php

class Movie {

  public $id;
  public $title;
  public $description;
  public $image;
  public $trailer;
  public $category;
  public $length;
  public $userId;

  public function generateImageName() {
    return bin2hex(random_bytes(50)) . ".jpg";
  }
}

?>
