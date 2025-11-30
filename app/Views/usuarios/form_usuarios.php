<main class="container my-5">
  <div class="container my-5">
    <div class="card shadow-sm">
      <div class="card-body p-4 p-md-5">
        
        <!-- Título Dinâmico: Muda se for Edição ou Cadastro -->
        <h2 class="mb-4"><?= isset($dados['id_usuario']) ? 'Editar Usuário' : 'Cadastro de Usuários' ?></h2>
        
        <form action="/usuarios/salvar" method="POST">
          
          <!-- CAMPO OCULTO ID (Essencial para a Edição funcionar) -->
          <input type="hidden" name="id" value="<?= $dados['id_usuario'] ?? '' ?>">

          <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input
              type="text"
              class="form-control"
              id="nome"
              placeholder="Digite seu Nome"
              name="nome"
              value="<?= $dados['nome'] ?? '' ?>"
              required />
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?= $dados['email'] ?? '' ?>"
              required />
            <div id="emailHelp" class="form-text">
              Seu e-mail não será compartilhado.
            </div>
          </div>

          <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input
              type="text"
              class="form-control"
              id="cpf"
              name="cpf"
              value="<?= $dados['cpf'] ?? '' ?>"
              required />
          </div>

          <div class="mb-3">
            <label for="celular" class="form-label">Número Celular:</label>
            <input
              type="tel"
              class="form-control"
              id="celular"
              name="celular"
              value="<?= $dados['celular'] ?? '' ?>"
              required />
          </div>

          <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            <input
              type="date"
              class="form-control"
              id="data_nascimento"
              name="data_nascimento"
              value="<?= $dados['data_nascimento'] ?? '' ?>"
              required />
          </div>

          <!-- GÊNERO CORRIGIDO: Values M, F, O (Para bater com CHAR(1) do banco) -->
          <div class="mb-3">
            <label for="genero" class="form-label">Gênero:</label>
            <select class="form-select" id="genero" name="genero" required>
              <option value="">Selecione</option>
              <option value="M" <?= ($dados['genero'] ?? '') == 'M' ? 'selected' : '' ?>>Masculino</option>
              <option value="F" <?= ($dados['genero'] ?? '') == 'F' ? 'selected' : '' ?>>Feminino</option>
              <option value="O" <?= ($dados['genero'] ?? '') == 'O' ? 'selected' : '' ?>>Outro</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="rua" class="form-label">Rua:</label>
            <input
              type="text"
              class="form-control"
              id="rua"
              name="rua"
              value="<?= $dados['rua'] ?? '' ?>"
              required />
          </div>
          
          <!-- Adicionei Numero e Complemento (existem no banco) -->
          <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="numero" class="form-label">Número:</label>
                    <input type="text" class="form-control" name="numero" value="<?= $dados['numero'] ?? '' ?>">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="complemento" class="form-label">Complemento:</label>
                   <input type="text" class="form-control" name="complemento" value="<?= $dados['complemento'] ?? '' ?>">
               </div>
          </div>
          
           <!-- Adicionei Bairro e CEP (existem no banco) -->
           <div class="row">
               <div class="col-md-6 mb-3">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input type="text" class="form-control" name="bairro" value="<?= $dados['bairro'] ?? '' ?>">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="cep" class="form-label">CEP:</label>
                   <input type="text" class="form-control" name="cep" value="<?= $dados['cep'] ?? '' ?>">
               </div>
           </div>

          <div class="mb-3">
            <label for="cidade" class="form-label">Cidade:</label>
            <input
              type="text"
              class="form-control"
              id="cidade"
              name="cidade"
              value="<?= $dados['cidade'] ?? '' ?>"
              required />
          </div>

          <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-select" id="estado" name="estado" required>
              <option value="">Selecione seu estado</option>
              <?php
                $estados = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
                foreach($estados as $uf): 
              ?>
                <!-- Marca o estado correto se estiver editando -->
                <option value="<?= $uf ?>" <?= ($dados['estado'] ?? '') == $uf ? 'selected' : '' ?>><?= $uf ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- SENHA: Não é required na edição (só no cadastro novo) -->
          <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input
              type="password"
              class="form-control"
              id="senha"
              name="senha"
              <?= isset($dados['id_usuario']) ? '' : 'required' ?> 
            />
            <?php if(isset($dados['id_usuario'])): ?>
                <div class="form-text">Deixe em branco se não quiser alterar a senha atual.</div>
            <?php endif; ?>
          </div>

          <!-- NÍVEL ACESSO: Values iguais ao ENUM do banco -->
          <div class="mb-3">
            <label for="nivel_acesso" class="form-label">Tipo de Usuário:</label>
            <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>
              <option value="">Selecione</option>
              <option value="Administrador" <?= ($dados['nivel_acesso'] ?? '') == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
              <option value="Funcionário" <?= ($dados['nivel_acesso'] ?? '') == 'Funcionário' ? 'selected' : '' ?>>Funcionário</option>
              <option value="Cliente" <?= ($dados['nivel_acesso'] ?? '') == 'Cliente' ? 'selected' : '' ?>>Cliente</option>
            </select>
          </div>

          <button type="submit" class="btn btn-success">Salvar</button>
          
          <!-- Botão Voltar agora é um link que funciona -->
          <a href="/usuarios" class="btn btn-warning">Voltar</a>
          
          <button type="reset" class="btn btn-danger">Limpar</button>
        </form>
      </div>
    </div>
  </div>
</main>