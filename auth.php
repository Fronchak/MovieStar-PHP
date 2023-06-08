<?php
  require_once('./templates/header.php');
?>
  <div class="row justify-content-md-evenly">
    <div class="col-12 col-md-4 mb-4 mb-md-0">
      <div class="auth-form-container" id="login-container">
        <h2>Entrar</h2>
        <form method="POST" action="auth_process.php">
          <input type="hidden" name="type" value="login" />
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control"
              placeholder="Digite o seu email"
            />
          </div>
          <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
              placeholder="Digite a sua senha"
            />
          </div>
          <div class=mb-3>
            <button type="submit" class="btn card-btn">Entrar <i class="bi bi-box-arrow-in-right"></i></button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="auth-form-container" id="register-container">
        <h2>Criar conta</h2>
        <form method="POST" action="<?php echo $BASE_URL; ?>/auth_process.php">
          <input type="hidden" name="type" value="register" />
          <div class="mb-3">
            <label class="form-label" for="name">Nome</label>
            <input
              type="text"
              name="name"
              id="name"
              class="form-control"
              placeholder="Digite o seu nome"
            />
          </div>
          <div class="mb-3">
            <label class="form-label" for="last-name">Sobrenome</label>
            <input
              type="text"
              name="last-name"
              id="last-name"
              class="form-control"
              placeholder="Digite o seu sobrenome"
            />
          </div>
          <div class="mb-3">
            <label for="register-email" class="form-label">Email</label>
            <input
              type="email"
              name="email"
              id="register-email"
              class="form-control"
              placeholder="Digite o seu email"
            />
          </div>
          <div class="mb-3">
          <label for="register-password" class="form-label">Senha</label>
            <input
              type="password"
              name="password"
              id="register-password"
              class="form-control"
              placeholder="Digite a sua senha"
            />
          </div>
          <div class="mb-3">
          <label for="confirm-password" class="form-label">Confirme a sua senha</label>
            <input
              type="password"
              name="confirm-password"
              id="confirm-password"
              class="form-control"
              placeholder="Confirme a sua senha"
            />
          </div>
          <div class=mb-3>
            <button type="submit" class="btn card-btn">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
  require_once('./templates/footer.php');
?>

