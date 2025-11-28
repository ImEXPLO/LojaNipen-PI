    <main class="container my-5">
      <div class="container my-5">
        <div class="card shadow-sm">
          <div class="card-body p-4 p-md-5">
            <h2 class="mb-4">Cadastro de Usuários</h2>
            <form action="/usuarios/salvar" method="POST">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input
                  type="text"
                  class="form-control"
                  id="nome"
                  placeholder="Digite seu Nome"
                  name="nome"
                  required />
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
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
                  required />
              </div>

              <div class="mb-3">
                <label for="celular" class="form-label">Número Celular:</label>
                <input
                  type="tel"
                  class="form-control"
                  id="celular"
                  name="celular"
                  required />
              </div>

              <div class="mb-3">
                <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                <input
                  type="date"
                  class="form-control"
                  id="data_nascimento"
                  name="data_nascimento"
                  required />
              </div>

              <div class="mb-3">
                <label for="genero" class="form-label">Gênero:</label>
                <select class="form-select" id="genero" name="genero" required>
                  <option value="">Selecione</option>
                  <option value="masculino">Masculino</option>
                  <option value="feminino">Feminino</option>
                  <option value="outro">Outro</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="rua" class="form-label">Rua:</label>
                <input
                  type="text"
                  class="form-control"
                  id="rua"
                  name="rua"
                  required />
              </div>

              <div class="mb-3">
                <label for="cidade" class="form-label">Cidade:</label>
                <input
                  type="text"
                  class="form-control"
                  id="cidade"
                  name="cidade"
                  required />
              </div>

              <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-select" id="estado" required>
                  <option value="">Selecione seu estado</option>
                  <option value="AC">Acre (AC)</option>
                  <option value="AL">Alagoas (AL)</option>
                  <option value="AP">Amapá (AP)</option>
                  <option value="AM">Amazonas (AM)</option>
                  <option value="BA">Bahia (BA)</option>
                  <option value="CE">Ceará (CE)</option>
                  <option value="DF">Distrito Federal (DF)</option>
                  <option value="ES">Espírito Santo (ES)</option>
                  <option value="GO">Goiás (GO)</option>
                  <option value="MA">Maranhão (MA)</option>
                  <option value="MT">Mato Grosso (MT)</option>
                  <option value="MS">Mato Grosso do Sul (MS)</option>
                  <option value="MG">Minas Gerais (MG)</option>
                  <option value="PA">Pará (PA)</option>
                  <option value="PB">Paraíba (PB)</option>
                  <option value="PR">Paraná (PR)</option>
                  <option value="PE">Pernambuco (PE)</option>
                  <option value="PI">Piauí (PI)</option>
                  <option value="RJ">Rio de Janeiro (RJ)</option>
                  <option value="RN">Rio Grande do Norte (RN)</option>
                  <option value="RS">Rio Grande do Sul (RS)</option>
                  <option value="RO">Rondônia (RO)</option>
                  <option value="RR">Roraima (RR)</option>
                  <option value="SC">Santa Catarina (SC)</option>
                  <option value="SP">São Paulo (SP)</option>
                  <option value="SE">Sergipe (SE)</option>
                  <option value="TO">Tocantins (TO)</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="senha"
                  name="senha"
                  required />
              </div>

              <div class="mb-3">
                <label for="confirmarSenha" class="form-label">Confirmar Senha:</label>
                <input
                  type="password"
                  class="form-control"
                  id="confirmarSenha"
                  name="confirmarsenha"
                  required />
              </div>

              <div class="mb-3">
                <label for="nivel_acesso" class="form-label">Tipo de Usuário:</label>
                <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>
                  <option value="">Selecione</option>
                  <option value="admin">Administrador</option>
                  <option value="funcionario">Funcionário</option>
                  <option value="cliente">Cliente</option>
                </select>
              </div>



              <button type="submit" class="btn btn-success">Cadastrar</button>
              <button type="button" class="btn btn-warning">Voltar</button>
              <button type="reset" class="btn btn-danger">Limpar</button>
            </form>
          </div>
        </div>
      </div>
    </main>