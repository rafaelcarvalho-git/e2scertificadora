<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mx-auto" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    <ul class="navbar-nav mx-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Solicitações</a>
        <ul class="dropdown-menu" aria-labelledby="dropdown04">
          <li><a class="dropdown-item" href="#">Nova Solicitação</a></li>
          <li><a class="dropdown-item" href="solicitacoes_ativas.php">Solicitações Ativas</a></li>
          <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Solicitação Concluídas</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Usuários</a>
        <ul class="dropdown-menu" aria-labelledby="dropdown04">
          <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario">Cadastrar Usuário</a></li>
          <li><a class="dropdown-item" href="usuarios.php">Usuários de Sistema</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#vencimentos">Vencimentos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="#" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</a>
      </li>    
    </ul>   
  </div>
</nav>
<?php include('modals/sair_do_sistema.php'); ?>
<?php include('modals/novo_usuario.php'); ?>

