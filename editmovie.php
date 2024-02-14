<?php
  require_once("templates/header.php");

  // Verifica se usuário está autenticado
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  $user = new User();
  $userDao = new UserDao($conn, $BASE_URL);

  $userData = $userDao->verifyToken(true);

  $movieDao = new MovieDAO($conn, $BASE_URL);

  $id = filter_input(INPUT_GET, "id");

  if(empty($id)) {

    $message->setMessage("O filme não foi encontrado!", "error", "index.php");

  } else {

    $movie = $movieDao->findById($id);

    // Verifica se o filme existe
    if(!$movie) {

      $message->setMessage("O filme não foi encontrado!", "error", "index.php");

    }

  }

  // Checar se o filme tem imagem
  if($movie->image == "") {
    $movie->image = "movie_cover.jpg";
  }

?>
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6 offset-md-1">
          <h1><?php echo $movie->title ?></h1>
          <p class="page-description">Altere os dados do filme no fomrulário abaixo:</p>
          <form id="edit-movie-form" action="<?php echo $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?php echo $movie->id ?>">
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu filme" value="<?php echo $movie->title ?>">
            </div>
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
              <label for="length">Duração:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do filme" value="<?php echo $movie->length ?>">
            </div>
            <div class="form-group">
              <label for="category">Category:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação" <?php echo $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                <option value="Drama" <?php echo $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                <option value="Comédia" <?php echo $movie->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                <option value="Fantasia / Ficção" <?php echo $movie->category === "Fantasia / Ficção" ? "selected" : "" ?>>Fantasia / Ficção</option>
                <option value="Romance" <?php echo $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
              </select>
            </div>
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?php echo $movie->trailer ?>">
            </div>
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme..."><?php echo $movie->description ?></textarea>
            </div>
            <input type="submit" class="btn card-btn" value="Editar filme">
          </form>
        </div>
        <div class="col-md-3">
          <div class="movie-image-container" style="background-image: url('<?php echo $BASE_URL ?>img/movies/<?php echo $movie->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>
<?php
  require_once("templates/footer.php");
?>