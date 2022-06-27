<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mx-auto" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav mx-auto">   
      <li class="nav-item">          
        <div class="nav-link">          
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Solicitações
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</a></li>
              <li><a class="dropdown-item" href="solicitacoes_ativas.php">Solicitações Ativas</a></li>
              <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Solicitações Concluidas</a></li>
            </ul>
          </div>
        </div> 
      </li>
      <li class="nav-item">          
        <div class="nav-link">          
            <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#vencimentos">
              Vencimentos
            </button>
        </div> 
      </li>
      <li class="nav-item">
        <div class="dropdown nav-link">
            <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Usuários
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario">Cadastrar Usuário</a></li>
                <li><a class="dropdown-item" href="usuarios.php">Listar Usuários</a></li>
            </ul>
        </div>       
      </li>    
      <li class="nav-item">
        <a class="nav-link"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</button></a>  
      </li>      
    </ul>   
  </div>
</nav>
<?php include('modals/vencimentos.php'); ?>
<?php include('modals/nova_solicitacao.php'); ?>
<?php include('modals/sair_do_sistema.php'); ?>
<?php include('modals/novo_usuario.php'); ?>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/script.js"></script>