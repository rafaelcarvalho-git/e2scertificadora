<?php
  session_start();
	include_once('conexao.php');	
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  $privilegio = $_POST['privilegio'];		
  $result_cadastro = "INSERT INTO usuarios(usuario, senha, privilegio) VALUES ('$usuario', '$senha', '$privilegio')";
  $resultado_cadastro= mysqli_query($connect, $result_cadastro);
  $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Usuário cadastrado com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
  header("Location: usuarios.php");
?>
