<?php
  require_once('./templates/header.php');
  require_once("./dao/users/UserDAO.php");
  require_once('./dao/movies/MovieDAO.php');
  $userDAO = new UserDAO($conn, $BASE_URL);
  $movieDAO = new MovieDAO($conn, $BASE_URL);
  $userData = $userDAO->verifyToken(true);

  $movies = $movieDAO->getMoviesByUserId($userData->id);
?>
<div class="container">
  <h2 class="section-title">Dashboard</h2>
  <p class="section-description">Adicione ou atualize as informações dos filmes que você registrou</p>
  <div id="add-movie-container" class="mb-3">
    <a href="<?php echo $BASE_URL; ?>/newmovie.php" class="btn card-btn">
      <i class="bi bi-plus-circle-fill"></i> Adicionar Filme
    </a>
  </div>
  <div class="row">
    <?php foreach($movies as $movie): ?>
      <div class="col">
        <?php require("templates/movie_dashboard_card.php"); ?>
      </div>
    <?php endforeach; ?>
    <?php if(count($movies) == 0): ?>
      <p class="empty-list">Você ainda não possui nenhum filme cadastrado,
        <a href="<?php echo $BASE_URL; ?>/newmovie.php">cliqui aqui</a> para cadastrar o seu primeiro filme
      </p>
    <?php endif; ?>
  </div>
</div>
<?php
  require_once('./templates/footer.php');
?>
