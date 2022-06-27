<?php
  include_once("conexao.php");  
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_dados = "SELECT * FROM solicitacoes WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY id DESC";
  }
  else {
    $solicitar_dados = "SELECT * FROM solicitacoes ORDER BY id DESC";
  }
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
  if($solicitacoes === FALSE) { 
    die(mysqli_error($connect));
  }
?>
<div class="modal fade" id="vencimentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vencimentos do Mês</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <table class="table table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Cliente</th>
                <th scope="col">Certificado</th>
                <th scope="col">Telefone</th>
                <th scope="col">Conclusao</th>
                <th scope="col">Usuário</th>
                <th scope="col">Vencimento</th>
                <th scope="col">Renovar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>THIAGO SAMPAIO DA SILVA</td>
                <td>R$ 135,00 E-CPF A3 sem mídia 1 ano</td>
                <td><a href="">88996444627</a></td>
                <td>2021-03-03 14:55:07</td>                  
                <td>GEONE</td>
                <td>2022-04-03 14:55:07</td>                  
                <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao"><i class="bi bi-check2-circle"></i></button></td>
              </tr>
          <!-- Janela Confirma Renovar Solicitação -->
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
                  <?php echo "<a href='concluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Concluir</button></a>";?>
                </div>
              </div>
            </div>
          </div>
          </tbody>
          </table>
    </div>
    </div>
</div>
</div>