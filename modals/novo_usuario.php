  <!-- Janela Cadastrar Usuário -->
  <div class="modal fade" id="cadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Usuário</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="modals/cadastrar_usuario.php">
            <div class="form-floating">
              <input type="text" class="form-control" name="usuario" required>
              <label>Nome Usuario</label>
            </div><br>
            <div class="form-floating">
              <input type="text" class="form-control" name="senha" required>
              <label>Senha</label>
            </div><br>
            <div id="isusuario">
              <section class="d-flex py-2">
                <div class="form-floating mx-auto">
                  <input type="number" class="form-control" name="comissao" min=0 max=100>
                  <label>Comissão</label>
                </div><br>
                <div class="form-floating mx-auto">
                  <input type="text" class="form-control" name="telefone-usuario">
                  <label>Telefone</label>
                </div><br>
              </section><br>
              <div class="form-floating">
                <input type="email" class="form-control" name="email-usuario">
                <label>E-mail</label>
              </div><br>
            </div>          
            <div class="form-floating">              
              <select id="privilegio" class="form-select" name="privilegio" required>
                <option value="Administrador">Administrador</option>
                <option value="Contador">Contador</option>
              </select>
              <label class="form-label">Privilégio de Sistema</label>
            </div><br>          
            <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>