<?php
	include_once('conexao.php');	
    $usuario = $_POST['usuario'];
	$privilegio = $_POST['privilegio'];
    $email = $_POST['email'];
    $login = $_POST['login'];
	$senha = $_POST['senha'];
	
	$result_msg_login = "INSERT INTO usuarios(usuario, privilegio, email, login, senha) VALUES ('$usuario', '$privilegio', '$email', '$login', '$senha')";
	$resultado_msg_login= mysqli_query($connect, $result_msg_login)

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E2S</title>    
    <link href="css/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap core CSS -->
<style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
  }@media (min-width: 768px) {.bd-placeholder-img-lg{font-size:3.5rem;}}
  .container{max-width:768px;padding:25px;}p a{text-decoration:none;}
</style>
</head>
<body class="bg-light">
<div class="container">
  <main>
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="80" height="50">
        <h2>Usuário cadastrado com sucesso.</h2>
        <p class="lead">Sua solicitação de certificado digital foi enviada, iremos realizar o cadastro e a videoconferência. Aguarde o contato da nossa empresa.</p>
      </div>
  </main>
<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2022 - E2S Corretora de Seguros LTDA-ME</p>
  <p>Site desenvolvido por<a href="https://www.linkedin.com/in/rafaelcarvalho-ti"> Rafael Carvalho</a></p>
</footer>
</div>
</body>
</html>
