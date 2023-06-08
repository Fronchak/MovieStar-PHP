<?php

require_once("./models/Movie.php");
require_once("./dao/movies/MovieDAO.php");
require_once('./dao/users/UserDAO.php');
require_once("constants.php");
require_once("db.php");
require_once("./models/Message.php");
require_once("messagesType.php");

$message = new Message($BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if($type == "create") {
    $userData = $userDAO->verifyToken();
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');
    $trailer = filter_input(INPUT_POST, 'trailer');
    $category = filter_input(INPUT_POST, 'category');
    $length = filter_input(INPUT_POST, 'length');

    $movie = new Movie();

    if(!empty($title) && !empty($description) && !empty($category)) {
      $movie->title = $title;
      $movie->description = $description;
      $movie->trailer = $trailer;
      $movie->category = $category;
      $movie->length = $length;
      $movie->userId = $userData->id;

      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        $image = $_FILES["image"];
        $imageType = $image["type"];
        $allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
        $jpgArray = ["image/jpeg", "image/jpg"];
        if(in_array($imageType, $allowedTypes)) {
          if(in_array($imageType, $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
          }
          else {
            $imageFile = imagecreatefrompng($image["tmp_name"]);
          }
          $imageName = $movie->generateImageName();
          imagejpeg($imageFile, "./imgs/movies/" . $imageName, 100);
          $movie->image = $imageName;
        }
        else {
          $message->setMessage("Formato do arquivo inválido, favor inserir somente arquivos de image", "alert-danger", "back");
        }
      }
      $movieDAO->create($movie);
    }
    else {
      $message->setMessage('Favor preencher todos os campos obrigatórios', 'alert-danger', 'back');
    }
}
else {
  $message->setMessage("Informações inválidas", 'alert-danger');
}

?>
