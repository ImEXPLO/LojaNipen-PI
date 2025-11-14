<main class="container my-5">
  <h2 class="mb-4">Lista de Usuários</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>CPF</th>
        <th>Celular</th>
        <th>Data de Nascimento</th>
        <th>Gênero</th>
        <th>Cidade</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($usuarios as $u): ?>
        <tr>
          <td><?= $u['nome'] ?></td>
          <td><?= $u['email'] ?></td>
          <td><?= $u['cpf'] ?></td>
          <td><?= $u['celular'] ?></td>
          <td><?= $u['data_nascimento'] ?></td>
          <td><?= $u['genero'] ?></td>
          <td><?= $u['cidade'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
    

  <br>

  <a href="/usuarios/inserir" class="btn btn-success">Criar Novo</a>

</main>