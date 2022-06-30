<?php
	session_start();
	include_once("conexao.php");
	$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
	if($btnLogin){
		$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
		$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
		if((!empty($usuario)) AND (!empty($senha))){
			$result_usuario = "SELECT id, usuario, senha, privilegio FROM usuarios WHERE usuario='$usuario' LIMIT 1";
			$resultado_usuario = mysqli_query($connect, $result_usuario);
			if($resultado_usuario){
				$row_usuario = mysqli_fetch_assoc($resultado_usuario);
				if(password_verify($senha, $row_usuario['senha'])){
					$_SESSION['id'] = $row_usuario['id'];
					$_SESSION['usuario'] = $row_usuario['usuario'];
					$_SESSION['senha'] = $row_usuario['senha'];
					$_SESSION['privilegio'] = $row_usuario['privilegio'];
					if($_SESSION['privilegio'] == 'Administrador'){
						header("Location: ../solicitacoes.php");
					}else {
						header("Location: ../parceiros.php");
					}
				}else{
					$_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 400px;'>Login ou senha incorretos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
					header("Location: ../login.php");
				}
			}
		}else{
			$_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto' role='alert' style='width: 400px;'>Login ou senha incorretos!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
			header("Location: ../login.php");
		}
	}else{
		header("Location: ../login.php");
	}
?>