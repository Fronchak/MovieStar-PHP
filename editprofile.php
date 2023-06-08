<?php
  require_once('./templates/header.php');
  require_once("./dao/users/UserDAO.php");
  $userDAO = new UserDAO($conn, $BASE_URL);
  $userData = $userDAO->verifyToken(true);
  $name = $userData->getFullName();
  if(is_null($userData->image)) {
    $userData->image = "user.png";
  }
?>
  <form
    method="post"
    action="<?php echo $BASE_URL; ?>/user_process.php"
    enctype="multipart/form-data"
  >
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-4 mb-4 mb-md-0">
        <div class="auth-form-container">
          <input
            type="hidden"
            name="type"
            value="update"
          />
          <h1><?php echo $name; ?></h1>
          <p>Altere seus dados no formulário abaixo:</p>
          <div class="mb-3">
            <label class="form-label" for="name">Nome</label>
            <input
              type="text"
              name="name"
              id="name"
              class="form-control"
              placeholder="Escreva o seu nome"
              value="<?php echo $userData->name; ?>"
            />
          </div>
          <div class="mb-3">
            <label class="form-label" for="last-name">Sobrenome</label>
            <input
              type="text"
              name="last-name"
              id="last-name"
              class="form-control"
              placeholder="Escreva o seu sobrenome"
              value="<?php echo $userData->lastName; ?>"
            />
          </div>
          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control disabled"
              value="<?php echo $userData->email; ?>"
              readonly
            />
          </div>
          <div class="mb-3">
            <button class="btn card-btn">Alterar <i class="bi bi-pencil-fill"></i></button>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 mb-4">
        <div class="auth-form-container">
          <div
            id="profile-image-container"
            style="background-image: url('<?php echo $BASE_URL; ?>/imgs/users/<?php echo $userData->image ?>') ">

          </div>
          <div class="mb-3">
            <label class="form-label" for="image">Imagem de perfil</label>
            <input
              type="file"
              name="image"
              id="image"
              class="form-control"
            />
          </div>
          <div class="mb-3">
            <label class="form-label" for="bio">Escreva uma descrição sobre você</label>
            <textarea
              name="bio"
              id="bio"
              placeholder="Escreva sobre você"
              class="form-control"
              rows="4"
            ><?php echo $userData->bio; ?></textarea>
          </div>
        </div>
      </div>
    </div>

  </form>
  <div class="row justify-content-center mt-3" id="change-password-container">
    <div class="col-12 col-md-4 ">
      <div class="auth-form-container">
        <h2>Alterar senha</h2>
        <p class="page-description">Preencha o formulário abaixo para alterar a sua senha</p>
        <form method="post" action="<?php echo $BASE_URL; ?>/user_process.php">
          <input
            type="hidden"
            name="type"
            value="change-password"
          />
          <div class="mb-3">
            <label class="form-label" for="password">Senha</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Digite a sua nova senha"
              class="form-control"
            />
          </div>
          <div class="mb-3">
            <label class="form-label" for="confirm-password">Confirmação de senha</label>
            <input
              type="password"
              name="confirm-password"
              id="confirm-password"
              placeholder="Confirme a sua nova senha"
              class="form-control"
            />
          </div>
          <div class="mb-3">
            <button class="btn card-btn">Mudar senha <i class="bi bi-pencil-square"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
  require_once('./templates/footer.php');
?>

