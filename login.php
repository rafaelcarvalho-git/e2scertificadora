<?php

session_start();

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S - Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
</head>
<body class="text-center">
<main class="form-signin">
  <form method="post" action="validar_login.php">
    <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <?php
        if(isset($_SESSION['msg'])) {
            echo($_SESSION['msg']);
            unset($_SESSION['msg']);
        }
    ?>

    <div class="form-floating">
      <input type="text" class="form-control"  name="login" required>
      <label>Login</label>
    </div><br>

    <div class="form-floating">
      <input type="text" class="form-control" name="senha" required>
      <label>Senha</label>
    </div><br>

    <input class="w-100 btn btn-lg btn-primary" type="submit" name="btnLogin" value="Acessar">
    <p class="mt-5 mb-3 text-muted">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  </form>
</main>
</body>
</html>
