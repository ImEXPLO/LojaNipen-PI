<main class="container my-5">
  
  <!-- Cabeçalho alinhado: Título na esquerda, Botão na direita -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Lista de Usuários</h2>
    <a href="/usuarios/inserir" class="btn btn-success">Criar Novo</a>
  </div>

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
        <!-- Nova Coluna -->
        <th class="text-center">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($usuarios as $u): ?>
        <tr>
          <td><?= $u['nome'] ?></td>
          <td><?= $u['email'] ?></td>
          <td><?= $u['cpf'] ?></td>
          <td><?= $u['celular'] ?></td>
          
          <!-- Pequena melhoria visual na data (opcional) -->
          <td><?= date('d/m/Y', strtotime($u['data_nascimento'])) ?></td>
          
          <td><?= $u['genero'] ?></td>
          <td><?= $u['cidade'] ?></td>
          
          <!-- Coluna dos Botões -->
          <td class="text-center">
            
            <!-- Botão EDITAR (Amarelo) -->
            <a href="/usuarios/editar?id=<?= $u['id_usuario'] ?>" class="btn btn-warning btn-sm" title="Editar">
                Editar
            </a>

            <!-- Botão EXCLUIR (Vermelho) -->
            <!-- Adicionei um alerta de confirmação em JavaScript para segurança -->
            <a href="/usuarios/excluir?id=<?= $u['id_usuario'] ?>" 
               class="btn btn-danger btn-sm" 
               onclick="return confirm('Tem certeza que deseja excluir <?= $u['nome'] ?>?');"
               title="Excluir">
                Excluir
            </a>

          </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>

</main>