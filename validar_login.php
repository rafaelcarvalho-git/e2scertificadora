<?php
	session_start();
	include_once("conexao.php");
	if(isset($_POST['btnLogin']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$consultar_usuarios = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
  		$usuarios = mysqli_query($connect, $consultar_usuarios);
		if(mysqli_num_rows($usuarios) < 1) {
			unset($_SESSION['usuario']);
			unset($_SESSION['senha']);
			echo "<br><strong>usuario nao existe no banco de dados</strong>";
			$_SESSION['log'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
			header('Location: login.php');
		}else {
			$_SESSION['usuario'] = $usuario;
			$_SESSION['senha'] = $senha;
			echo "<br><strong>usuario EXISTE no banco de dados</strong>";
			$consultar_privilegio = "SELECT privilegio FROM `usuarios` WHERE usuario = '$usuario'";
  			$privilegio_usuario = mysqli_query($connect, $consultar_privilegio);
			$privilegio = mysqli_fetch_assoc($privilegio_usuario); 
			$_SESSION['privilegio'] = $privilegio['privilegio'];
			echo $_SESSION['privilegio'];
			if ($_SESSION['privilegio'] =='Administrador') {
				header('Location: solicitacoes.php');
			}else {
				header('Location: solicitar.php');
			}	
		}
	}else {
		$_SESSION['log'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
		header('Location: login.php');
	}
?>
