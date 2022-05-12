<?php
session_start();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="text-center bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://e2scertificadoradigital.com.br/" style="color: white;" target="_blank"><img src="img/logo.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
    AR E2S CORRETORA DE SEGUROS LTDA-ME</a>    
  </div>
</nav>
<h1 class="h1-login">Sistema para solicitar Certificados Digitais</h1>
<main class="login">
  <form id="formLogin" method="post" action="validar_login.php">
    <?php
        if(isset($_SESSION['msgLogin'])){
          echo $_SESSION['msgLogin'];
          unset($_SESSION['msgLogin']);
        }
    ?>
    <h2>Login</h2>
    <div id="loginUsuario" class="form-floating">
      <input type="text" class="form-control"  name="usuario" required>
      <label>Usuário</label>
    </div><br>

    <div id="loginSenha" class="form-floating">
      <input type="password" class="form-control" name="senha" required>
      <label>Senha</label>
    </div><br>

    <input id="btnLogin" class="btn btn-lg btn-primary" type="submit" name="btnLogin" value="Acessar">
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y");?> - AR E2S Corretora de Seguros LTDA-ME</p>
  </form>
</main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>