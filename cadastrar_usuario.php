<?php
  session_start();
	include_once('conexao.php');	
  $usuario = strtoupper($_POST['usuario']);
  $senha = $_POST['senha'];
  $privilegio = $_POST['privilegio'];	
  $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
  $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio) VALUES ('$usuario', '$senha_criptografada', '$privilegio')";
  $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
  header("Location: usuarios.php");
?>