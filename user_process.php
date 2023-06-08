<?php
  require_once("./models/User.php");
  require_once("./dao/users/UserDAO.php");
  require_once("constants.php");
  require_once("db.php");
  require_once("./models/Message.php");
  require_once("messagesType.php");

  $message = new Message($BASE_URL);
  $userDAO = new UserDAO($conn, $BASE_URL);

  $type = filter_input(INPUT_POST, "type");

  if($type === "update") {
    $userData = $userDAO->verifyToken();

    $name = filter_input(INPUT_POST, "name");
    $lastName = filter_input(INPUT_POST, "last-name");
    $bio = filter_input(INPUT_POST, "bio");

    $user = new User();
    $user->id = $userData->id;
    $user->name = $name;
    $user->lastName = $lastName;
    $user->token = $userData->token;
    $user->bio = $bio;

    if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

      $image = $_FILES["image"];
      $allowedTypes = ["image/jpeg", "image/png", "image/jpg"];
      $jpgArray = ["image/jpeg", "image/jpg"];
      if(in_array($image["type"], $allowedTypes)) {
        $imageFile;
        if(in_array($image["type"], $jpgArray)) {
          $imageFile = imagecreatefromjpeg($image["tmp_name"]);
        }
        else {
          $imageFile = imagecreatefrompng($image["tmp_name"]);
        }
        $imageName = $user->imageGenerateName();
        imagejpeg($imageFile, "./imgs/users/" . $imageName, 100);
        $user->image = $imageName;
      }
      else {
        $message->setMessage("Formato do arquivo inválido, favor inserir somente arquivos de image", "alert-danger", "back");
      }
    }



    $userDAO->update($user);
  }
  else if ($type === "change-password") {

    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirm-password");

    if($password == $confirmPassword) {

      $userData = $userDAO->verifyToken();

      $user = new User();
      $finalPassword = $user->generatePassword($password);
      $user->id = $userData->id;
      $user->password = $finalPassword;

      $userDAO->changePassword($user);
    }
    else {
      $message->setMessage("As senhas devem ser iguais", "alert-danger", "back");
    }

  }
  else {
    $message->setMessage('Informações inválidas!', "alert-danger", "index.php");
  }
?>
