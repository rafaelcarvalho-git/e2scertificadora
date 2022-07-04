<?php include('verificar_acesso.php');?>
  <div class="modal fade" id="visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="visualizarSolicitacaoLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="visualizarSolicitacaoLabel">Informações do cliente</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4><strong>Nome</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo $rows_solicitacoes['nome']; ?></h3>
          <h4><strong>CPF</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo $rows_solicitacoes['cpf']; ?></h3>
          <h4><strong>Data de Nascimento</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo date("d/m/Y",strtotime($rows_solicitacoes['data_nascimento'])); ?></h3>
          <h4><strong>E-mail</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo $rows_solicitacoes['email']; ?></h3>
          <h4><strong>Telefone</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo $rows_solicitacoes['telefone']; ?> <a href="https://api.whatsapp.com/send/?phone=55<?php echo $rows_solicitacoes['telefone']; ?>&text&app_absent=0" target="_blank"><button type="button" class="btn btn-info text-white"><i class="bi bi-whatsapp"></i></button></a></h3>
          <hr>
          <h4><strong>CEP</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo $rows_solicitacoes['cep']; ?></h3>
          <h4><strong>Endereço</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo$rows_solicitacoes['endereco']; ?></h3>  
          <hr>
          <h4><strong>Observações</strong></h4>
          <h3 class="text-primary"><?php echo $rows_solicitacoes['observacoes']; ?></h3>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
    <!-- Janela Confirma Excluir Solicitação -->
    <div class="modal fade" id="excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Deseja excluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>? <br>
          Esta ação será irreversível.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <?php echo "<a href='modals/excluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
        </div>
      </div>
    </div>
  </div>
  <!-- Janela Confirma Concluir Solicitação -->
  <div class="modal fade" id="concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Concluir Solicitação</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Deseja concluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>? <br>          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <?php echo "<a href='modals/concluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Concluir</button></a>";?>
        </div>
      </div>
    </div>
  </div>