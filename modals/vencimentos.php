<?php
  include_once("conexao.php");  
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_vencimentos = "SELECT * FROM solicitacoes_concluidas WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY id DESC";
  }
  else {
    $mes = date("m");
    $ano = date("Y");
    $solicitar_vencimentos = "SELECT * FROM solicitacoes_concluidas where validade = 1 and year(data_vencimento) = '$ano' and month(data_vencimento) = '$mes' ORDER BY id DESC";
  }
  $vencimentos = mysqli_query($connect, $solicitar_vencimentos);
  if($vencimentos === FALSE) { 
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
                <th scope="col">Renovado</th>
              </tr>
            </thead>
            <tbody><?php while($rows_vencimentos = mysqli_fetch_assoc($vencimentos)){ ?>
              <tr>
                <td><?php echo $rows_vencimentos['nome']; ?></td>
                <td><?php echo $rows_vencimentos['tipo_certificado'];?></td>
                <td><a href=""><?php echo $rows_vencimentos['telefone'];?></a></td>
                <td><?php echo $rows_vencimentos['data_conclusao'];?></td>                  
                <td><?php echo $rows_vencimentos['usuario']; ?></td>
                <td><?php echo $rows_vencimentos['data_vencimento'];?></td>                  
                <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao"><i class="bi bi-check2-circle"></i></button></td>
              </tr>
          <!-- Janela Confirma Renovar Solicitação -->
          <div class="modal fade" id="concluirSolicitacao<?php echo $rows_vencimentos['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Concluir Solicitação</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Deseja concluir a solicitação de <?php echo $rows_vencimentos['nome']; ?>? <br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <?php echo "<a href='concluir_solicitacao.php?id=" . $rows_vencimentos['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Concluir</button></a>";?>
                </div>
              </div>
            </div>
          </div><?php } ?>
          </tbody>
      </table>
    </div>
  </div>
</div>
</div>