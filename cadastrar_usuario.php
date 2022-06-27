<?php
  session_start();
  include_once("conexao.php");/*  
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);
    header('Location: login.php');
  }else {
    if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Administrador'){
      header("Location: login.php");
    }else {
      if((isset($_POST['usuario'])==true) and (isset($_POST['senha'])==true) and (isset($_POST['privilegio'])==true)) {*/
        $usuario = strtoupper($_POST['usuario']);
        $senha = $_POST['senha'];
        $privilegio = $_POST['privilegio'];	
        if((isset($_POST['comissao'])==true) and (isset($_POST['telefone-usuario'])==true) and (isset($_POST['email-usuario'])==true)) {
          $comissao = $_POST['comissao'];
          $email = strtolower($_POST['email-usuario']);
          $telefone = $_POST['telefone-usuario'];
          $telefone = preg_replace("/[^0-9]()/", "", $telefone);
        }else {
          $comissao = null;
          $email = null;
          $telefone = null;
        }        
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        $usuario_cript = base64_encode($usuario);
        $privilegio_cript = base64_encode($privilegio);
        $email_cript = base64_encode($email);        
        $telefone_cript = base64_encode($telefone);
        $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio, comissao, telefone, email) VALUES ('$usuario', '$senha_criptografada', '$privilegio_cript', '$comissao', '$telefone_cript', '$email_cript')";
        $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
     // }      
  //  }
    header("Location: usuarios.php");    
  //}
?>