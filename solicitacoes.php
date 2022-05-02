<?php
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
</head>
<body class="bg-light">

<nav class="navbar navbar-light bg-primary">
<!--<img class="logo-img" src="img/logo.png" alt="" width='50px'>-->
  <form class="container-fluid justify-content-start">
    <button type="button" class="btn btn-warning">Warning</button>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#myModalCad">Cadastrar Usuário</button>
  </form>
</nav>

<!-- Modal Cadastrar Usuário -->
<div class="modal fade" id="myModalCad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel">Cadastrar Usuário</h4>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

         <form method="post" action="cadastro_sucesso.php">
          <div class="form-floating">
            <input type="text" class="form-control" name="usuario" required>
            <label>Nome Usuario</label>
          </div><br>

          <div class="text-center">
              <label class="form-label">Privilégio de Sistema</label>
              <select class="form-select" name="privilegio" required>
              <option value="Administrador">Administrador</option>
              <option value="Contador">Contador</option>
              </select>
          </div><br>

          <div class="form-floating">
            <input type="text" class="form-control" name="senha" required>
            <label>Senha</label>
          </div><br>

          <button class="w-100 btn btn-lg btn-primary" type="submit">Cadastrar</button>
        </form>

         </div>
    
       </div>
     </div>
  </div>

<div class="container">
  <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
        <h2>Solicitação de Certificado Digital</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>
    
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col"><i class="bi bi-trash"></i>Cliente</th>
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
                  <td><button type="button" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg></i></button><button type="button" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
  <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
</svg></button></td>
								</tr>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Modal -->
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

							<?php } ?>

        </tbody>
      </table>
      

      </div>
    </div>
  </main>

<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por <a href="https://www.linkedin.com/in/rafaelcarvalho-ti">Rafael Carvalho</a></p>
</footer>
</div>

</body>
 <!-- Importando o jQuery -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  
  <!-- Importando o js do bootstrap -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
