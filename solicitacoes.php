<?php
  session_start();
  include_once("conexao.php");
  $solicitar_dados = "SELECT * FROM SOLICITACOES";
  $solicitacoes = mysqli_query($connect, $solicitar_dados);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="color: white;" ><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">          
          <div class="nav-link">          
            <div class="dropdown">
              <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Solicitações
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="solicitacoes.php">Ativas</a></li>
                <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Concluidas</a></li>
              </ul>
            </div>
          </div> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="usuarios.php"><button type="button" class="btn btn-success">Usuários</button></a>          
        </li>        
      </ul>
    </div>
  </div>
</nav>
<main class="container">
    <div class="py-5 text-center">
      <h2>Solicitações de Certificados Digitais Ativas</h2>
      <p class="lead">Lista com todas as solicitações feitas por contadores ou administradores de sistema.</p>
    </div>  
<?php
  if(isset($_SESSION['solicitacaoExcluida'])){
    echo $_SESSION['solicitacaoExcluida'];
    unset($_SESSION['solicitacaoExcluida']);
  }
?>
    <table class="table table-hover">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Cliente</th>
          <th scope="col">Certificado</th>
          <th scope="col">Informações</th>
          <th scope="col">Data da solicitação</th>
          <th scope="col">Contador</th>
          <th scope="col">Documentos</th>
          <th scope="col">Situação</th>
        </tr>
      </thead>
      <tbody>
      <?php while($rows_solicitacoes = mysqli_fetch_assoc($solicitacoes)){ ?>
        <tr>
          <td><?php echo $rows_solicitacoes['id']; ?></td>
          <td><?php echo $rows_solicitacoes['nome']; ?></td>
          <td><?php echo $rows_solicitacoes['tipo_certificado']; ?></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $rows_solicitacoes['id']; ?>">Visualizar</button></td>
          <td><?php echo $rows_solicitacoes['data_solicitacao']; ?></td>                  
          <td><?php echo $rows_solicitacoes['contador']; ?></td>
          <td><button type="button" class="btn btn-primary">Baixar</button></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Concluir</button></td>
          <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>">Excluir</button></td>
        </tr>
<!-- Janela Visualizar Informações Cliente -->
<div class="modal fade" id="myModal<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Informações do cliente</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h4>Nome</h4>
          <h3><?php echo $rows_solicitacoes['nome']; ?></h3>
          <h4>CPF</h4>
          <h3><?php echo $rows_solicitacoes['cpf']; ?></h3>
          <h4>Data de Nascimento</h4>
          <h3><?php echo date("d/m/Y",strtotime($rows_solicitacoes['data_nascimento'])); ?></h3>
          <h4>E-mail</h4>
          <h3><?php echo $rows_solicitacoes['email']; ?></h3>
          <h4>Telefone</h4>
          <h3><?php echo $rows_solicitacoes['telefone']; ?></h3>
          <hr>
          <h4>CEP</h4>
          <h3><?php echo $rows_solicitacoes['cep']; ?></h3>
          <h4>Endereço</h4>
          <h3><?php echo $rows_solicitacoes['endereco']; ?></h3>  
          <hr>
          <h4>Observações</h4>
          <h3><?php echo $rows_solicitacoes['observacoes']; ?></h3>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>
<!------------------------------>
<!-- Janela Confirma Apagar Solicitação -->
<div class="modal fade" id="excluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja excluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <?php echo "<a href='apagar_solicitacao.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
      </div>
    </div>
  </div>
</div>
<!------------------------------>
<!-- Janela Confirma Concluir Solicitação -->
<div class="modal fade" id="concluirSolicitacao<?php echo $rows_solicitacoes['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Concluir Certificado Digital</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Deseja Concluir a solicitação de <?php echo $rows_solicitacoes['nome']; ?>?

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <?php echo "<a href='solicitacoes.php?id=" . $rows_solicitacoes['id'] . "' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
      </div>
    </div>
  </div>
</div>
<!------------------------------><?php } ?>
</tbody>
</table>
</main>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por <a href="https://www.linkedin.com/in/rafaelcarvalho-ti">Rafael Carvalho</a></p>
</footer>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>