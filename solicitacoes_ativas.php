<?php// include('verificar_acesso.php'); ?>
<?php
  include_once("modals/conexao.php");  
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitacoes_ativas = "SELECT * FROM solicitacoes WHERE MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY id DESC";
  }
  else {
    $solicitacoes_ativas = "SELECT * FROM solicitacoes ORDER BY MONTH(data_solicitacao) DESC";
  }
  $ativas= mysqli_query($connect, $solicitacoes_ativas);
  if($ativas=== FALSE) { 
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
<header class="container py-4 text-center">
  <h3 class="text-center mx-auto pb-1">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h3>     
  <h2>Solicitações de Certificados Digitais Ativas</h2>
  <p class="lead">Lista com todas as solicitações em edição ou processamento feitas por contadores, AGRs ou administradores de sistema.</p>        
</header>
<main class="container overflow-auto">
  <?php
    if(isset($_SESSION['excluirSolicitacao'])){
      echo $_SESSION['excluirSolicitacao'];
      unset($_SESSION['excluirSolicitacao']);
    }
    if(isset($_SESSION['concluirSolicitacao'])){
      echo $_SESSION['concluirSolicitacao'];
      unset($_SESSION['concluirSolicitacao']);
    }
  ?>
  <?php include('modals/filtro_consulta.php');?>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data</th>
        <th scope="col">Usuário</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($ativas)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['nome']; ?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>
        <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                  
        <td><?php echo $rows_solicitacoes['usuario']; ?></td>
        <td>
          <div class="dropdown navbar py-0">
            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-card-list"></i></button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Informações</a></li>
              <li><a class="dropdown-item" href="documentos/<?php echo $rows_solicitacoes['documentos']; ?>">Documentos</a></li>
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Concluir</a></li>
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Excluir</a></li>
            </ul>
          </div>
        </td>
      </tr>
  <?php include('modals/acoes_solicitacao.php');?><?php } ?>
  </tbody>
  </table>
</main>
</body>
</html>