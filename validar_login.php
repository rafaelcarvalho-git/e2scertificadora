<?php
	session_start();
	include_once("conexao.php");
	/*print_r($_REQUEST);*/
	if(isset($_POST['btnLogin']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
		$_SESSION['log'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 

		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];

		$consultar_usuarios = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
  		$usuarios = mysqli_query($connect, $consultar_usuarios);

/*FAZER IF E SELECT PARA DIFERENCIAR LOGIN DE CONTADOR E ADMINISTRADOR*/

		if(mysqli_num_rows($usuarios) < 1)
		{
			unset($_SESSION['usuario']);
			unset($_SESSION['senha']);
			$_SESSION['log'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Usuário ou senha incorretos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
			header('Location: login.php');
		}
		else
		{
			$_SESSION['usuario'] = $usuario;
			$_SESSION['senha'] = $senha;
			header('Location: solicitacoes.php');
		}
	}else {
		$_SESSION['log'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
		header('Location: login.php');
	}
?>
