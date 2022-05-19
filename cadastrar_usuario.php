<?php
  session_start();
	include_once('conexao.php');	
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    unset($_SESSION['privilegio']);
    $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
    header('Location: index.php');
  }else {
    $usuario = strtoupper($_POST['usuario']);
    $senha = $_POST['senha'];
    $privilegio = $_POST['privilegio'];	
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
    $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio) VALUES ('$usuario', '$senha_criptografada', '$privilegio')";
    $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
    header("Location: usuarios.php");
  }
?>