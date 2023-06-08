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

  if($type === "register") {
    $name = filter_input(INPUT_POST, "name");
    $lastName = filter_input(INPUT_POST, "last-name");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmPassword = filter_input(INPUT_POST, "confirm-password");

    if($name && $lastName && $email && $password) {
      if($password == $confirmPassword) {
        if($userDAO->findByEmail($email) != false) {
          $message->setMessage("Endereço de email já cadastrado", $MSG_ERROR, "back");
        }
        else {
          $user = new User();
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($password);

          $user->name = $name;
          $user->lastName = $lastName;
          $user->email = $email;
          $user->token = $userToken;
          $user->password = $finalPassword;
          $auth = true;
          $userDAO->create($user, $auth);
        }
      }
      else {
        $message->setMessage("As senhas devem ser iguais", $MSG_ERROR, "back");
      }
    }
    else {
      $message->setMessage("Por favor, preencha todos os campos", $MSG_ERROR, "back");
    }
  }
  else if($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    if($userDAO->authenticateUser($email, $password)) {
      $message->setMessage("Seja bem-vindo!", "alert-success", "editprofile.php");
    }
    else {
      $message->setMessage("Usuário e/ou senha incorretos", "alert-danger", "back");
    }
  }

?>
