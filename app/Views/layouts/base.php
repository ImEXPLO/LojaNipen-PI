<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $title ?></title>
  <link rel="stylesheet" href="/css/style.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
    rel="stylesheet" />
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-info">
    <div class="container-fluid">
      <a class="navbar-brand" href="/home">LOJA NIPEN</a>
      <button class="navbar-toggler" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="/home">Principal</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/usuarios/inserir">Cadastro de Usuário</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/usuarios">Listar Usuários</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/produtos/inserir">Cadastro de Produtos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="/produtos">Listar Produtos</a>
          </li>
        </ul>

        <form class="d-flex" role="search">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Pesquisar" />
        </form>
        <a href="login.html" class="btn btn-danger">Sair</a>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <div class="dashboard-container">
      <?= $content ?>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <footer class="footer-site mt-auto">
    Projeto desenvolvido por: Caio Vinicius Alves e Victor Hugo P. Silva
  </footer>
</body>

</html>