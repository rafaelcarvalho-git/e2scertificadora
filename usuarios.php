<?php
    session_start();
    include_once('conexao.php');
    if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Administrador'){
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso somente para Administradores!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header("Location: index.php");
    }
    if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
      unset($_SESSION['usuario']);
      unset($_SESSION['senha']);
      unset($_SESSION['privilegio']);
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header('Location: index.php');
    }else {
      $logado = $_SESSION['usuario'];
    }    
?>
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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav">   
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
  <div class="usuario bg-primary">
    <h4 class="text-center mx-auto">Olá, <strong><?php echo $logado; ?></strong>. Seja bem vindo(a).</h4>
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
        <td><?php echo $rows_usuarios['telefone']; ?></td>
        <td><?php echo $rows_usuarios['email']; ?></td>
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
            <section>
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
  <!-- Janela Confirma Sair do Sistema (logout) -->
  <div class="modal fade" id="sairSistema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sair do Sistema</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Deseja sair do sistema e ir para tela de login? <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <a href="sair.php"><button type='button' class='btn btn-primary'>Sair</button></a> 
        </div>
      </div>
    </div>
  </div>
</main>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; <?php echo date("Y");?> - AR E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>