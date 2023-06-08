<?php
  require_once('./templates/header.php');
  require_once("dao/movies/MovieDAO.php");

  $movieDAO = new MovieDAO($conn, $BASE_URL);

  $latestMovies = $movieDAO->getLatestMovies();

  $actionMovies = $movieDAO->getMoviesByCategory('Ação');
  $fantasyMoves = $movieDAO->getMoviesByCategory('Fantasia');
?>
  <div class="container">
    <h2 class="section-title">Filmes novos</h2>
    <p class="section-description">Veja as críticas dos últimos filmes adicionados no MovieStar</p>
    <div class="movies-container row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
      <?php foreach($latestMovies as $movie): ?>
        <div class="col">
          <?php require("templates/movie_card.php"); ?>
        </div>
      <?php endforeach; ?>
      <?php if(count($latestMovies) == 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrados</p>
      <?php endif; ?>
    </div>
    <h2 class="section-title">Ação</h2>
    <p class="section-description">Veja os melhores filmes de ação</p>
    <div class="movies-container row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
      <?php foreach($actionMovies as $movie): ?>
        <div class="col">
          <?php require("templates/movie_card.php"); ?>
        </div>
      <?php endforeach; ?>
      <?php if(count($actionMovies) == 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrados</p>
      <?php endif; ?>
    </div>
    <h2 class="section-title">Fantasia</h2>
    <p class="section-description">Veja os melhores filmes de fantasia</p>
    <div class="movies-container row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
      <?php foreach($fantasyMoves as $movie): ?>
        <div class="col">
          <?php require("templates/movie_card.php"); ?>
        </div>
      <?php endforeach; ?>
      <?php if(count($fantasyMoves) == 0): ?>
        <p class="empty-list">Ainda não há filmes cadastrados</p>
      <?php endif; ?>
    </div>
  </div>

<?php
  require_once('./templates/footer.php');
?>

