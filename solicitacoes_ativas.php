<?php include('modals/verificar_acesso.php'); ?>
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
  <h2>Solicitações de Certificados Digitais Ativas</h2>
  <p class="lead">Lista com todas as solicitações em edição ou processamento feitas por contadores, AGRs ou administradores de sistema.</p>        
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
      <button class="btn btn-primary" onclick="searchDataAtivas()"><i class="bi bi-search"></i></button>
    </div>               
  </section>
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Certificado</th>
        <th scope="col">Data</th>
        <th scope="col">Contador</th>
        <th scope="col">Ação</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>RAFAEL CANDIDO LACERDA CARVALHO</td>
        <td>E-CNPJ A1 MIDIA DIGITAL R$ 210,00</td>
        <td>02/02/2022 15:44:55</td>                  
        <td>GEONE</td>
        <td>
        <div class="nav-item dropdown">
          <button type="button" class="btn btn-info dropdown-toggle text-white" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Ação</button>
          <ul class="dropdown-menu" aria-labelledby="dropdown04">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Informações</a></li>
            <li><a class="dropdown-item" href="documentos/<?php echo base64_decode($rows_solicitacoes['documentos']); ?>">Documentos</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Concluir</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Excluir</a></li>
          </ul>
        </div>
        </td>
      </tr>
  <!-- Janela Visualizar Informações Cliente -->
  <div class="modal fade" id="visualizarSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="visualizarSolicitacaoLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="visualizarSolicitacaoLabel">Informações do cliente</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4><strong>Nome</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['nome']); ?></h3>
          <h4><strong>CPF</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['cpf']); ?></h3>
          <h4><strong>Data de Nascimento</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo date("d/m/Y",strtotime($rows_solicitacoes['data_nascimento'])); ?></h3>
          <h4><strong>E-mail</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['email']); ?></h3>
          <h4><strong>Telefone</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['telefone']); ?> <a href="https://api.whatsapp.com/send/?phone=55<?php echo base64_decode($rows_solicitacoes['telefone']); ?>&text&app_absent=0" target="_blank"><button type="button" class="btn btn-info text-white"><i class="bi bi-whatsapp"></i></button></a></h3>
          <hr>
          <h4><strong>CEP</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['cep']); ?></h3>
          <h4><strong>Endereço</strong></h4>
          <h3 class="text-primary user-select-all"><?php echo base64_decode($rows_solicitacoes['endereco']); ?></h3>  
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
          Deseja excluir a solicitação de <?php echo base64_decode($rows_solicitacoes['nome']); ?>? <br>
          Esta ação será irreversível.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <?php echo "<a href='excluir_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
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
          Deseja concluir a solicitação de <?php echo base64_decode($rows_solicitacoes['nome']); ?>? <br>
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
<?php include('modals/nova_solicitacao.php'); ?>
<?php include('modals/vencimentos.php'); ?>
</main>
</body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>