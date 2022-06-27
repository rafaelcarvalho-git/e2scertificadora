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
  <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="text-center bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto text-white" href="http://e2scertificadoradigital.com.br/" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top"> AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
    </div>
  </nav>
  <h1 class="mt-5 mb-4">Sistema para solicitar Certificados Digitais</h1>
  <form class="mx-auto" method="post" action="validar_login.php">
    <?php
        if(isset($_SESSION['msgLogin'])){
          echo $_SESSION['msgLogin'];
          unset($_SESSION['msgLogin']);
        }
    ?>
    <h2 class="py-1">Login</h2>
    <div class="form-floating mx-auto" style="width: 350px;">
      <input type="text" class="form-control"  name="usuario" required>
      <label>Usuário</label>
    </div><br>
    <div class="form-floating mx-auto" style="width: 350px;">
      <input type="password" class="form-control" name="senha" required>
      <label>Senha</label>
    </div><br>
    <input id="btnLogin" class="btn btn-lg btn-primary mt-3" type="submit" name="btnLogin" value="Acessar" style="width: 350px;">
  </form>
</body>
<script src="js/bootstrap.bundle.js"></script>
</html>