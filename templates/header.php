<?php

    require_once("constants.php");
    require_once("db.php");
    require_once("./models/Message.php");
    require_once("./dao/users/UserDAO.php");

    $message = new Message($BASE_URL);
    $flashMessage = $message->getMessage();

    if(!empty($flashMessage["msg"])) {
      $message->clearMessage();
    }

    $userDAO = new UserDAO($conn, $BASE_URL);
    $userData = $userDAO->verifyToken();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="short icon" href="imgs/moviestar.ico" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Movie Star</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" id="navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-itens-center" href="<?php echo $BASE_URL; ?>" >
      <img src="<?php echo $BASE_URL; ?>/imgs/logo.svg" alt="Movie Star" id="logo" width="60" height="48"/>
      <span id="movie-star-title" class="ms-2">Movie Star</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex" role="search" id="seach-form">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php if($userData): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_URL; ?>/newmovie.php">Incluir Filme</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_URL; ?>/dashboard.php">Meus filmes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_URL; ?>/editprofile.php"><?php echo $userData->email; ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_URL; ?>/logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $BASE_URL; ?>/auth.php">Register/Login</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>
<?php if(!empty($flashMessage["msg"])): ?>
  <div id="flash-message-container">
    <div class="flash-message p-3">
      <div class="alert mb-0 <?php echo isset($flashMessage["type"]) ? $flashMessage["type"] : "alert-primary" ?>" role="alert">
        <?php echo $flashMessage["msg"]; ?>
      </div>
    </div>
  </div>
<?php endif; ?>
<div id="main-container" class="container-fluid py-4">


