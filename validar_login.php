<?php
	session_start();
	include_once("conexao.php");
	if(isset($_POST['btnLogin']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
		$usuario = $_POST['usuario'];
		$senha = $_POST['senha'];
		$privilegio = $_POST['privilegio'];
		$consultar_usuarios = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
  		$usuarios = mysqli_query($connect, $consultar_usuarios);
		if(mysqli_num_rows($usuarios) < 1) {
			unset($_SESSION['usuario']);
			unset($_SESSION['senha']);
			$_SESSION['msg'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Usuário ou senha incorretos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
			header('Location: login.php');
		}else {
			echo "<br><strong>usuario EXISTE no banco de dados</strong><br>";
			$consultar_privilegio = "SELECT privilegio FROM `usuarios` WHERE usuario = '$usuario'";
  			$privilegio_usuario = mysqli_query($connect, $consultar_privilegio);
			$privilegio = mysqli_fetch_assoc($privilegio_usuario); 
			$_SESSION['usuario'] = $usuario;
			$_SESSION['senha'] = $senha;
			$_SESSION['privilegio'] = $privilegio['privilegio'];
			echo $_SESSION['privilegio'];
			if ($_SESSION['privilegio'] =='Administrador') {
				echo "<br>adm {$_SESSION['privilegio']} <br";
				header('Location: solicitacoes.php');
			}else if ($_SESSION['privilegio'] =='Contador'){
				echo "cont", $_SESSION['privilegio'];
				header('Location: sistema_contadores.php');
			}	
		}
	}else {   
		header('Location: login.php');
	}
?>
