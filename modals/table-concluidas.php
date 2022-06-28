<?php
  include_once("modals/conexao.php");      
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitacoes_concluidas = "SELECT * FROM solicitacoes_concluidas WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY MONTH(data_solicitacao) DESC";
  }
  else {
    $solicitacoes_concluidas = "SELECT * FROM solicitacoes_concluidas ORDER BY MONTH(data_solicitacao) DESC";
  }
  $concluidas= mysqli_query($connect, $solicitacoes_concluidas);
  if($concluidas=== FALSE) { 
    die(mysqli_error($connect));
  }
?>
<table id="table-concluidas" class="table table-hover" style="display: none;">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data da solicitação</th>
        <th scope="col">Usuário</th>
        <th scope="col">Data da conclusão</th>
        <th scope="col">Validade</th>
        <th scope="col">Data do vencimento</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($concluidas)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['nome'];?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado'];?></td>        
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>                           
        <td><?php echo $rows_solicitacoes['usuario'];?></td>
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>   
        <td><?php echo $rows_solicitacoes['validade'];?> Anos</td>
        <td><?php echo $rows_solicitacoes['data_vencimento'];?></td>  
      </tr><?php } ?>
    </tbody>
</table>
