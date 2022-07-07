<?php
    session_start();
    include_once('modals/conexao.php');
    if(isset($_SESSION['privilegio']) != 'Contador'){
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 360px;'>Acesso somente para Parceiros! <br> Realize o login para entrar no sistema.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header("Location: login.php");
    }
    if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
      unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);        
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 360px;'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header('Location: login.php');        
    }else {
      if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Contador'){
        $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 360px;'>Acesso somente para Parceiros!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
        header("Location: login.php");
      }else {
        $logado = $_SESSION['usuario'];
      }      
    }    
?>
<?php
  include_once("modals/conexao.php");
  if(!empty($_GET['start'])) {
    $start = $_GET['start'];
    $end = $_GET['end'];
    //$ano = date("Y")
    $solicitacoes_usuarios = "SELECT * FROM solicitacoes_usuarios WHERE usuario= '$logado' AND data_solicitacao BETWEEN '{$start} 00:00:00' AND '{$end} 23:59:59' ORDER BY data_solicitacao DESC";
  }
  else {
    $solicitacoes_usuarios = "SELECT * FROM solicitacoes_usuarios WHERE usuario= '$logado' ORDER BY data_solicitacao DESC";
  }
  $sol_usuarios= mysqli_query($connect, $solicitacoes_usuarios);
  if($sol_usuarios=== FALSE) { 
    die(mysqli_error($connect));
  }
?>
<!doctype html>
<html lang="pt-br">
<head>
<?php include('modals/head.php'); ?>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary" aria-label="Fourth navbar example">
  <div class="container-fluid">
    <img src="css/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top ms-5"><a class="navbar-brand mx-auto ms-2" href="http://e2scertificadoradigital.com.br/" target="_blank"> AR E2S CORRETORA DE SEGUROS LTDA-ME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button><style>@media(max-width:585px){.navbar-brand{display:none;}}</style>
    <div class="collapse navbar-collapse" id="navbarsExample04">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</a>  
        </li>  
      </ul>
    </div>
  </div>
</nav>
<header class="py-4 text-center">
  <h3 class="text-center mx-auto pb-1">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h3>     
  <h2>Solicitar Certificado Digital</h2>
  <p class="lead">Faça a solicitação do certificado digital para seus clientes e acompanhe todas as solicitações feitas por você.</p>        
</header>
<main class="container overflow-auto">
<?php
  if (isset($_SESSION['solicitacaoSucesso'])) {
      echo $_SESSION['solicitacaoSucesso'];
      unset($_SESSION['solicitacaoSucesso']);
  }
?>
  <div class="componentes-contadores d-flex flex-row align-items-center mx-auto">
    <button type="button" class="btn btn-primary mx-auto mb-4" data-bs-toggle="modal" data-bs-target="#orientacoes">Orientações Importantes</button>      
    <?php include('modals/filtro_consulta.php');?>
  </div>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data da solicitação</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($sol_usuarios)){ ?>
      <tr>
        <td><?php echo $rows_solicitacoes['nome']; ?></td>
        <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>        
        <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                        
      </tr><?php } ?>
    </tbody>
  </table>
</main>
<!-- Janela Orientacoes -->
<div class="modal fade" id="orientacoes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Orientações para solicitar o Certificado Digital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="documentos">
          <h6>Documentos</h6>
          <ul>
            <li>Preencha todos os campos obrigatórios.</li>
            <li>Confira se os dados estão corretos.</li>
            <li>Envie todos os documentos requisitados.</li>
            <li>Documentos apenas ORIGINAIS, em bom estado e foto de boa qualidade.</li>
            <li>Não pode haver dedos ou qualquer outro objeto cobrindo as informações do documento.</li>
            <li>Só faça a solicitação do certificado quando houver todos os dados e documentos em mãos.</li>
            <li>Insira sempre os dados do CLIENTE, caso insira qualquer informação do contador o certificado poderá ser revogado.</li>
          </ul>
        </div>
        <div class="certificados">
          <h6>Certificados</h6>
          <ul>
            <li><b>Certificado A1</b> - Mídia Digital, instala em várias máquinas.</li>
            <li><b>Certificado A3</b> - Mídia Física (Token ou Cartão).</li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>
<?php include('modals/nova_solicitacao.php'); ?>
<?php include('modals/sair_do_sistema.php'); ?>
</div>
<footer class="container overflow-auto text-center py-4">
  <h6>Contatos</h6>
  <h7><i class="bi bi-whatsapp"></i> Edval Silvino: <a href="https://api.whatsapp.com/send/?phone=5588996444627&text&app_absent=0" target="_blank">(88) 99644-4627</a></h7><br>  
  <h7><i class="bi bi-whatsapp"></i> E2S Certificadora Digital <a href="https://api.whatsapp.com/send/?phone=5588999628489&text&app_absent=0" target="_blank">(88) 99962-8489</a></h7>        
</footer>
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>