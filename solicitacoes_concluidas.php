<?php //include('modals/verificar_acesso.php'); ?>
<?php
  include_once("conexao.php");      
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_dados = "SELECT * FROM solicitacoes_concluidas WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY MONTH(data_solicitacao) DESC";
  }
  else {
    $solicitar_dados = "SELECT * FROM solicitacoes_concluidas ORDER BY MONTH(data_solicitacao) DESC";
  }
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
  if($solicitacoes === FALSE) { 
    die(mysqli_error($connect));
  }
?>
<!doctype html>
<html lang="pt-br">
<head>
  <?php include('modals/head.php'); ?>
</head>
<body class="bg-light">
  <?php include('modals/navbar.php'); ?>
<header class="py-4 text-center">
  <div class="usuario bg-primary d-flex mx-auto align-items-center rounded mb-4" style="max-width: 460px;height: 52px;">
    <h4 class="text-center text-white mx-auto">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h4>
  </div>      
  <h2>Solicitações Concluídas</h2>
  <p class="lead">Lista com todas as solicitações que ja foram emitidas e concluídas.</p>        
</header>
<main class="container"> 
  <section class="d-flex flex-row text-center mx-auto mb-4">       
    <div class="d-flex mx-auto">          
      <select name="mes-consulta" class="form-select me-2" id="mes" style="width:150px;">
        <option value="">Período</option>
        <option value="01">Janeiro</option>
        <option value="02">Feveireiro</option>
        <option value="03">Março</option>
        <option value="04">Abril</option>
        <option value="05">Maio</option>
        <option value="06">Junho</option>
        <option value="07">Julho</option>
        <option value="08">Agosto</option>
        <option value="09">Setembro</option>
        <option value="10">Outubro</option>
        <option value="11">Novembro</option>
        <option value="12">Dezembro</option>            
      </select> 
      <button class="btn btn-primary" onclick="searchDataConcluidas()"><i class="bi bi-search"></i></button>
    </div><script src="js/script.js"></script>                 
  </section>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data da solicitação</th>
        <th scope="col">Usuário</th>
        <th scope="col">Data da conclusão</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['nome'];?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado'];?></td>        
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>                           
        <td><?php echo $rows_solicitacoes['contador'];?></td>
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>   
      </tr><?php } ?>
    </tbody>
  </table>
</main>
</body>
</html>