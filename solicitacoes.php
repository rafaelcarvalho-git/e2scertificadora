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
<nav class="navbar navbar-light bg-primary">
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModalCad">Cadastrar Usuário</button>
    <a href="usuarios_cadastrados.php"><button type="button" class="btn btn-success">Usuários</button></a> 
</nav>
<!-- Janela Cadastrar Usuário -->
<div class="modal fade" id="myModalCad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cadastrar Usuário</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="post" action="cadastro_sucesso.php">
        <div class="form-floating">
          <input type="text" class="form-control" name="usuario" required>
          <label>Nome Usuario</label>
        </div><br>
        <div class="form-floating">
          <input type="text" class="form-control" name="senha" required>
          <label>Senha</label>
        </div><br>
        <div class="form-floating">              
          <select class="form-select" name="privilegio" required>
            <option value="Administrador">Administrador</option>
            <option value="Contador">Contador</option>
          </select>
          <label class="form-label">Privilégio de Sistema</label>
        </div><br>          
        <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!--------------------------------->
<main class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
      <h2>Solicitações de Certificados Digitais</h2>
      <p class="lead">Lista com todas as solicitações feitas por contadores ou administradores de sistema.</p>
    </div>  
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
          <td><button type="button" class="btn btn-primary">X</button> <button type="button" class="btn btn-primary">V</button></td>
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