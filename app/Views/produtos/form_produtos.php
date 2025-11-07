<main class="container my-5">
  <div class="container my-5">
    <div class="card shadow-sm">
      <div class="card-body p-4 p-md-5">
        <h2 class="mb-4">Cadastro de Produtos</h2>
        <form action="list_produtos.html" method="POST">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto:</label>
            <input
              type="text"
              class="form-control"
              id="nome"
              placeholder="Digite o Nome do Produto"
              name="nome"
              required />
          </div>

          <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Produto:</label>
            <input
              type="type"
              class="form-control"
              id="descricao"
              name="descricao"
              required />
          </div>

          <div class="mb-3">
            <label for="qtd" class="form-label">Quantidade:</label>
            <input
              type="number"
              class="form-control"
              id="qtd"
              name="qtd"
              required />
          </div>

          <div class="mb-3">
            <label for="preco-un" class="form-label">Valor Unitário:</label>
            <input
              type="number"
              class="form-control"
              id="preco-un"
              name="preco-un"
              required />
          </div>

          <div class="mb-3">
            <label for="categoria" class="form-label">Categoria:</label>
            <input
              type="text"
              class="form-control"
              id="categoria"
              name="categoria"
              required />
          </div>

          <button type="submit" class="btn btn-success">Cadastrar</button>
          <button type="button" class="btn btn-warning">Voltar</button>
          <button type="reset" class="btn btn-danger">Limpar</button>
        </form>
      </div>
    </div>
  </div>

  <br>

  <a href="/produtos/inserir" class="btn btn-success">Criar Novo</a>

</main>