<?php
    session_start();
    include_once('conexao.php');
    if(isset($_SESSION['privilegio']) != 'Contador'){
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 400px;'>Acesso somente para Contadores! <br> Realize o login para entrar no sistema.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header("Location: index.php");
    }
    if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
      unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);        
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 400px;'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header('Location: index.php');        
    }else {
      if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Contador'){
        $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 400px;'>Acesso somente para Contadores!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
        header("Location: index.php");
      }else {
        $logado = $_SESSION['usuario'];
      }      
    }    
?>
<?php
  include_once("conexao.php");  
  if(!empty($_GET['search'])) {
    $mes = $_GET['search'];
    $ano = date("Y");
    $solicitar_dados = "SELECT * FROM solicitacoes_contadores WHERE contador = '$logado' AND MONTH(data_solicitacao) = '$mes' AND YEAR(data_solicitacao) = '$ano' ORDER BY id DESC";
  }
  else {
    $solicitar_dados = "SELECT * FROM solicitacoes_contadores WHERE contador = '$logado' ORDER BY id DESC";
  }
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
  if($solicitacoes === FALSE) { 
    die(mysqli_error($connect));
  }
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>    
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mx-auto" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav mx-auto">
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</button></a>         
      </li>    
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</button></a>  
      </li>      
    </ul>   
  </div>
</nav>
<header class="py-4 text-center">
  <div class="usuario bg-primary d-flex mx-auto align-items-center rounded mb-4" style="max-width: 460px;height: 52px;">
    <h4 class="text-center text-white mx-auto">Olá, <strong><?php echo strtoupper($logado); ?></strong>. Seja bem vindo(a).</h4>
  </div>     
  <h2>Solicitar Certificado Digital</h2>
  <p class="lead">Faça a solicitação do certificado digital para seus clientes e acompanhe todas as solicitações feitas por você.</p>        
</header>
<main class="container">
<?php
  if (isset($_SESSION['solicitacaoSucesso'])) {
      echo $_SESSION['solicitacaoSucesso'];
      unset($_SESSION['solicitacaoSucesso']);
  }
?>
  <div class="componentes-contadores d-flex flex-row align-items-center mx-auto">
    <button type="button" class="btn btn-primary mx-auto mb-4" data-bs-toggle="modal" data-bs-target="#orientacoes">Orientações Importantes</button>      
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
        <button class="btn btn-primary" onclick="searchDataContador()"><i class="bi bi-search"></i></button>
      </div>               
    </section>
  </div>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data da solicitação</th>
      </tr>
    </thead>
    <tbody><?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
      <tr>
        <td><?php echo base64_decode($rows_solicitacoes['nome']); ?></td>
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
</body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>