<?php include('modals/verificar_acesso.php'); ?>
<?php
  include_once("conexao.php");
  $listar_usuarios = "SELECT * FROM usuarios ORDER BY id DESC";
  $usuarios = mysqli_query($connect, $listar_usuarios);
  if($usuarios === FALSE) { 
    die(mysqli_error($connect));
  }
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <?php include('modals/head.php'); ?>
  </head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mx-auto" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav mx-auto">   
      <li class="nav-item">
        <a class="nav-link" href="#"><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario">Cadastrar Usuário</button></a>          
      </li>   
      <li class="nav-item">          
        <div class="nav-link">          
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Solicitações
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="solicitacoes_ativas.php">Ativas</a></li>
              <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Concluidas</a></li>
            </ul>
          </div>
        </div> 
      </li>
      <li class="nav-item">
      <a class="nav-link"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</button></a>              
      </li>       
    </ul>   
  </div>
</nav>
<header class="py-4 text-center">
  <div class="usuario bg-primary d-flex mx-auto align-items-center rounded mb-4" style="max-width: 460px;height: 52px;">
    <h4 class="text-center text-white mx-auto">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h4>
  </div>     
  <h2>Usuários do Sistema</h2>
  <p class="lead">Lista de usuários do sistema, cria e exclui usuários, define o tipo de acesso (privilégio).</p>
    <p><strong>Contador:</strong> Apenas faz solicitações de certificados digitais.<br><strong>Administrador:</strong> Tem acesso a todas as funções do sistema.</p>       
</header>
<main class="container">
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Usuário</th>
        <th scope="col">Privilégio</th>
        <th scope="col">Comissão</th>
        <th scope="col">Telefone</th>
        <th scope="col">E-mail</th>
        <th scope="col">Excluir</th>
      </tr>
    </thead>
    <tbody><?php while($rows_usuarios = mysqli_fetch_assoc($usuarios)){ ?>
      <tr>
        <td><?php echo $rows_usuarios['id']; ?></td>
        <td><?php echo $rows_usuarios['usuario']; ?></td>
        <td><?php echo $rows_usuarios['privilegio']; ?></td>         
        <td><?php echo $rows_usuarios['comissao']; ?>%</td>
        <td><a href="https://api.whatsapp.com/send/?phone=55<?php echo base64_decode($rows_usuarios['telefone']); ?>&text&app_absent=0" target="_blank"><?php echo base64_decode($rows_usuarios['telefone']); ?></a></td>
        <td><?php echo base64_decode($rows_usuarios['email']); ?></td>
        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excluirUsuario<?php echo $rows_usuarios['id']; ?>" >X</button></td>                                                  
      </tr>
  <!-- Janela Confirma excluir Usuário -->
  <div class="modal fade" id="excluirUsuario<?php echo $rows_usuarios['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Deseja excluir o usuário <?php echo $rows_usuarios['usuario']; ?>?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <?php echo "<a href='excluir_usuario.php?id=" . $rows_usuarios['id'] . "' data-confirm='Tem certeza de que deseja excluir o item selecionado?' style='color: white;'><button type='button' class='btn btn-primary'>Excluir</button></a>";?>
        </div>
      </div>
    </div>
  </div><?php } ?>
  </tbody>
  </table>
  <!-- Janela Cadastrar Usuário -->
  <div class="modal fade" id="cadastrarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar Usuário</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="cadastrar_usuario.php">
            <div class="form-floating">
              <input type="text" class="form-control" name="usuario" required>
              <label>Nome Usuario</label>
            </div><br>
            <div class="form-floating">
              <input type="text" class="form-control" name="senha" required>
              <label>Senha</label>
            </div><br>
            <div id="iscontador">
              <section class="d-flex py-2">
                <div class="form-floating mx-auto">
                  <input type="number" class="form-control" name="comissao">
                  <label>Comissão</label>
                </div><br>
                <div class="form-floating mx-auto">
                  <input type="text" class="form-control" name="telefone-contador">
                  <label>Telefone</label>
                </div><br>
              </section><br>
              <div class="form-floating">
                <input type="email" class="form-control" name="email-contador">
                <label>E-mail</label>
              </div><br>
            </div>          
            <div class="form-floating">              
              <select id="privilegio" class="form-select" name="privilegio" required>
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
<?php include('modals/sair_do_sistema.php'); ?>
</main>
</body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>