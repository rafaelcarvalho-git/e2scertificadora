<?php
  session_start();
	include_once('conexao.php');	
  $usuario = strtoupper($_POST['usuario']);
  $senha = $_POST['senha'];
  $privilegio = $_POST['privilegio'];	
  //$senha_criptografada = md5($senha);	
  $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio) VALUES ('$usuario', '$senha', '$privilegio')";
  $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
  header("Location: usuarios.php");
?>