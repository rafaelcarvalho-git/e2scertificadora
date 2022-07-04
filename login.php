<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E2S</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="shortcut icon" type="imagex/png" href="css/icone.ico">
</head>
<body class="text-center bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid mx-auto d-flex">
    <img src="css/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top me-1 ms-auto"><a class="navbar-brand text-white me-auto ms-1" href="http://e2scertificadoradigital.com.br/" target="_blank"> AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
  </div><style>@media(max-width:480px){.navbar-brand{display:none;}}</style>
</nav>
  <h1 class="mt-5 mb-4">Sistema para solicitar Certificados Digitais</h1>
  <form class="container mx-auto" method="post" action="modals/validar_login.php">
    <?php if(isset($_SESSION['msgLogin'])){echo $_SESSION['msgLogin'];unset($_SESSION['msgLogin']);}?>
    <h2 class="py-1">Login</h2>
    <div class="form-floating mx-auto" style="min-width: 300px;max-width: 380px;">
      <input type="text" class="form-control"  name="usuario" required>
      <label>Usuário</label>
    </div><br>
    <div class="form-floating mx-auto" style="min-width: 300px;max-width: 380px;">
      <input type="password" class="form-control" name="senha" required>
      <label>Senha</label>
    </div><br>
    <input id="btnLogin" class="btn btn-lg btn-primary mt-3" type="submit" name="btnLogin" value="Acessar" style="min-width: 300px;max-width: 380px;">
  </form>
</body><script src="js/bootstrap.bundle.js"></script>
</html>