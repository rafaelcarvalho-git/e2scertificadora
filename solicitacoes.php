<?php include('modals/verificar_acesso.php'); ?>
<!doctype html>
<html lang="pt-br">
<head>
  <?php include('modals/head.php'); ?>
</head>
<body class="bg-light">
  <?php include('modals/navbar.php'); ?>
<header class="container py-4 text-center">
  <h3 class="text-center mx-auto pb-1">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h3>     
  <h2>Solicitações de Certificados Digitais</h2>
  <p class="lead">Lista com todas as solicitações em edição, processamento, emitidas ou concluídas feitas por contadores, AGRs ou administradores de sistema.</p>        
</header>
<main class="container">
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
  <div class="options d-flex mx-auto justify-content-evenly my-3">
    <button class="btn btn-info" onclick="ativas()">Solicitações Ativas</button>
    <button class="btn btn-info" onclick="concluidas()">Solicitações Concluidas</button>
    <style>
      @media (max-width:435px){.options, .filtros{display:flex;flex-direction:column;}
        #data-inicio, #data-fim, .options button{margin:auto auto 10px auto;width:85vw;}
      }@media(min-width:436px){#data-inicio{margin-right:10px;}#data-fim{margin-left:10px;margin-right:10px;}}
    </style>
    <script>
      function ativas() {
        document.getElementById("table-ativas").style.display = "table";
        document.getElementById("table-concluidas").style.display = "none";
      }
      function concluidas() {
        document.getElementById("table-ativas").style.display = "none";
        document.getElementById("table-concluidas").style.display = "table";
      }
    </script>
  </div>
  <div class="container">
  <?php include('modals/table-ativas.php');?>
  <?php include('modals/table-concluidas.php');?>
  </div>
</main>
</body>
</html>