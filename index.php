<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S - Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="text-center bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mx-auto" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
  </div>
</nav>
<h1 class="mt-5 mb-4">Sistema para solicitar Certificados Digitais</h1>
<main class="mx-auto">
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

    <input id="btnLogin" class="btn btn-lg btn-primary mt-3" type="submit" name="btnLogin" value="Acessar"  style="width: 350px;">
  </form>
</main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>