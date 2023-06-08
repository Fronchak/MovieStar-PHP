<?php
  require_once('./templates/header.php');
  require_once("./dao/users/UserDAO.php");
  $userDAO = new UserDAO($conn, $BASE_URL);
  $userData = $userDAO->verifyToken(true);
?>
  <div class="container" id="new-movie-container">
    <h1 class="page-title text-center">Adicionar filme</h1>
    <p class="page-description text-center">Adicione sua crítica e compartilhe com o mundo!</p>
    <form action="<?php echo $BASE_URL; ?>/movie_process.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create"/>
      <div class="mb-3">
        <label class="form-label" for="title">Título</label>
        <input
          type="text"
          name="title"
          id="title"
          class="form-control"
          placeholder="Escreva o título do filme"
        />
      </div>
      <div class="mb-3">
        <label class="form-label" for="image">Imagem</label>
        <input
          type="file"
          name="image"
          id="image"
          class="form-control"
        />
      </div>
      <div class="mb-3">
        <label class="form-label" for="length">Duração do filme</label>
        <input
          type="text"
          name="length"
          id="length"
          class="form-control"
          placeholder="Digite a duração do filme"
        />
      </div>
      <div class="mb-3">
        <label class="form-label" for="category">Categoria</label>
        <input
          type="text"
          name="category"
          id="category"
          class="form-control"
          placeholder="Digite a categoria do filme"
        />
      </div>
      <div class="mb-3">
        <label class="form-label" for="trailer">Trailer</label>
        <input
          type="text"
          name="trailer"
          id="trailer"
          class="form-control"
          placeholder="Insira a url do trailer do filme"
        />
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Descrição</label>
        <textarea
          id="description"
          name="description"
          class="form-control"
          placeholder="Descrição do filme"
          rows="4"
        ></textarea>
      </div>
      <div class="mb-3">
        <button class="btn card-btn">Cadastrar filme</button>
      </div>
    </form>
  </div>
<?php
  require_once('./templates/footer.php');
?>

