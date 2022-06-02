<?php
  session_start();
  include_once("conexao.php");
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    unset($_SESSION['privilegio']);
    $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
    header('Location: index.php');
  }else {
    if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Administrador'){
      $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso somente para Administradores!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
      header("Location: index.php");
    }else {
      if((isset($_POST['usuario'])==true) and (isset($_POST['senha'])==true) and (isset($_POST['privilegio'])==true)) {
        $usuario = strtoupper($_POST['usuario']);
        $senha = $_POST['senha'];
        $privilegio = $_POST['privilegio'];	
        if((isset($_POST['comissao'])==true) and (isset($_POST['telefone-contador'])==true) and (isset($_POST['email-contador'])==true)) {
          $comissao = $_POST['comissao'];
          $email = strtolower($_POST['email-contador']);
          $telefone = $_POST['telefone-contador'];
          $telefone = preg_replace("/[^0-9]()/", "", $telefone);
        }else {
          $comissao = null;
          $email = null;
          $telefone = null;
        }        
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio, comissao, telefone, email) VALUES ('$usuario', '$senha_criptografada', '$privilegio', '$comissao', '$telefone', '$email')";
        $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
      }      
    }
    header("Location: usuarios.php");    
  }
?>