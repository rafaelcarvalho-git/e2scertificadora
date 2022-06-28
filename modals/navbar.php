<nav class="navbar navbar-expand-lg navbar-dark bg-primary" aria-label="Fourth navbar example">
    <div class="container-fluid container">
      <img src="css/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top ms-5"><a class="navbar-brand mx-auto ms-2" href="http://e2scertificadoradigital.com.br/" target="_blank"> AR E2S CORRETORA DE SEGUROS LTDA-ME</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button><style>@media(max-width:770px){.navbar-brand{display:none;}}</style>
      <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownSolicitacoes" data-bs-toggle="dropdown" aria-expanded="false">Solicitações</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownSolicitacoes">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#solicitarCertificado">Nova Solicitação</a></li>
              <li><a class="dropdown-item" href="solicitacoes_ativas.php">Solicitações Ativas</a></li>
              <li><a class="dropdown-item" href="solicitacoes_concluidas.php">Solicitações Concluidas</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="" data-bs-toggle="modal" data-bs-target="#vencimentos">Vencimentos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="dropdownUsuarios" data-bs-toggle="dropdown" aria-expanded="false">Usuários</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownUsuarios">
              <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario">Cadastrar Usuário</a></li>
              <li><a class="dropdown-item" href="usuarios.php">Listar Usuários</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="" data-bs-toggle="modal" data-bs-target="#sairSistema">Sair</a>  
          </li>  
        </ul>
      </div>
    </div>
</nav>
<?php include('modals/vencimentos.php'); ?>
<?php include('modals/nova_solicitacao.php'); ?>
<?php include('modals/sair_do_sistema.php'); ?>
<?php include('modals/novo_usuario.php'); ?>
<script src="js/bootstrap.bundle.js"></script>