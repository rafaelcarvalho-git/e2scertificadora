<?php //include('modals/verificar_acesso.php'); ?>
<?php
  include_once("conexao.php");      
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
<!doctype html>
<html lang="pt-br">
<head>
  <?php include('modals/head.php'); ?>
</head>
<body class="bg-light">
  <?php include('modals/navbar.php'); ?>
<header class="py-4 text-center">
  <h3 class="text-center mx-auto pb-1">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h3>        
  <h2>Solicitações Concluídas</h2>
  <p class="lead">Lista com todas as solicitações que ja foram emitidas e concluídas.</p>        
</header>
<main class="container"> 
  <?php include('modals/filtro_consulta.php');?>
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
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($concluidas)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['nome'];?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado'];?></td>        
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>                           
        <td><?php echo $rows_solicitacoes['usuario'];?></td>
        <td><?php echo $rows_solicitacoes['data_solicitacao'];?></td>   
      </tr><?php } ?>
    </tbody>
  </table>
</main>
</body>
</html>