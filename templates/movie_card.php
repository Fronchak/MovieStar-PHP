<?php

  $movieImg = "$BASE_URL/imgs/movies/" . ($movie->image ? $movie->image : 'movie-cover.jpg');

?>

<div class="card movie-card">
  <img class="card-img-top"
    style="background-image: url('<?php echo $movieImg; ?>'"
  />
  <div class="card-body">
    <p class="card-rating">
      <i class="bi bi-star-fill"></i>
      <span class="rating">9</span>
    </p>
    <h5 class="card-title">
      <a href="<?php echo $BASE_URL; ?>/movies.php?id=<?php echo $movie->id; ?>"><?php echo $movie->title ?></a>
    </h5>
    <a href="#" class="btn btn-primary rate-btn">Avaliar</a>
    <a href="#" class="btn btn-primary card-btn">Conhecer</a>
  </div>
</div>
