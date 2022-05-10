<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S - Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <link href="css/bootstrap.min.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" integrity="sha512-6KY5s6UI5J7SVYuZB4S/CZMyPylqyyNZco376NM2Z8Sb8OxEdp02e1jkKk/wZxIEmjQ6DRCEBhni+gpr9c4tvA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="css/login.css" rel="stylesheet">
    <link rel="shortcut icon" type="imagex/png" href="img/icone.ico">
</head>
<body class="text-center bg-light">
<main>
  <div class="logomarca">
    <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="85" height="50">
    <h4>AR E2S CORRETORA DE SEGUROS LTDA-ME</h4>
  </div>
  <h1>Sistema para solicitar Certificados Digitais</h1>
  <form method="post" action="validar_login.php">
    <h2>Login</h2>
    <div class="form-floating">
      <input type="text" class="form-control"  name="usuario" required>
      <label>Usuário</label>
    </div><br>

    <div class="form-floating">
      <input type="password" class="form-control" name="senha" required>
      <label>Senha</label>
    </div><br>
    <input class="btn btn-lg btn-primary" type="submit" name="btnLogin" value="Acessar">
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date("Y");?> - AR E2S Corretora de Seguros LTDA-ME</p>
  </form>
</main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js" integrity="sha512-ewfXo9Gq53e1q1+WDTjaHAGZ8UvCWq0eXONhwDuIoaH8xz2r96uoAYaQCm1oQhnBfRXrvJztNXFsTloJfgbL5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>