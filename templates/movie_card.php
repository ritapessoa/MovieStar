<?php

  if(empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
  }

?>
<div class="card movie-card">
  <div class="card-img-top" style="background-image: url('<?php echo $BASE_URL ?>img/movies/<?php echo $movie->image ?>')"></div>
  <div class="card-body">
    <p class="card-rating">
      <i class="fas fa-star"></i>
      <span class="rating"><?php echo $movie->rating ?></span>
    </p>
    <h5 class="card-title">
      <a href="<?php echo $BASE_URL ?>movie.php?id=<?php echo $movie->id ?>"><?php echo $movie->title ?></a>
    </h5>
    <a href="<?php echo $BASE_URL ?>movie.php?id=<?php echo $movie->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
    <a href="<?php echo $BASE_URL ?>movie.php?id=<?php echo $movie->id ?>" class="btn btn-primary card-btn">Conhecer</a>
  </div>
</div>