<main class="container my-5">
  
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Lista de Produtos</h2>
    <a href="/produtos/inserir" class="btn btn-success">Criar Novo</a>
  </div>

  <!-- A função/extra abaixo verifica se a lista de produtos está vazia -->
  <!-- Outra função pra estilização do site e também para debug pra ver se não tem nada -->
  <!-- de errado no BD ou em outro arquivo raiz do projeto. -->

  <?php if(empty($produtos)): ?>
      <div class="alert alert-warning text-center">
          Nenhum produto cadastrado até o momento.
      </div>
  <?php else: ?>

  <ul class="list-group">
    
    <?php foreach($produtos as $p): ?>
    <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center mb-3 shadow-sm border">
      
      <div class="col-12 col-md-9">
        <strong class="me-2">Nome:</strong>
        <span><?= $p['nome'] ?></span>
        <br />

        <strong class="me-2">Descrição do Produto:</strong>
        <span><?= $p['descricao'] ?></span>
        <br />

        <strong class="me-2">Quantidade em Estoque:</strong>
        <span><?= $p['quantidade'] ?></span>
        <br />

        <strong class="me-2">Valor Unitário:</strong>
        <span>R$ <?= number_format($p['valor_un'], 2, ',', '.') ?> / Unidade</span> <br />

        <!-- Outra função que o Gemini ajudou a criar e que ajuda a estilizar o site. -->

        <strong class="me-2">Categoria:</strong>
        <span><?= $p['categoria'] ?></span>
      </div>

      <div class="col-12 col-md-3 text-md-end mt-3 mt-md-0">
        <a href="/produtos/editar?id=<?= $p['id_produto'] ?>" class="btn btn-warning btn-sm me-2">Editar</a>

        <a href="/produtos/excluir?id=<?= $p['id_produto'] ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Tem certeza que deseja excluir o produto <?= $p['nome'] ?>?');">
           Excluir
        </a>
      </div>

    </li>
    <?php endforeach; ?>

  </ul>
  
  <?php endif; ?>

  <br>
  
</main>