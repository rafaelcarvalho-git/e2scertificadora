<?php
  session_start();
  include_once("conexao.php");
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);
    header('Location: ../login.php');
  }else {
    if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Administrador'){
      header("Location: ../login.php");
    }else {
      if((isset($_POST['usuario'])==true) and (isset($_POST['senha'])==true) and (isset($_POST['privilegio'])==true)) {
        $usuario = strtoupper($_POST['usuario']);
        $senha = $_POST['senha'];
        $privilegio = $_POST['privilegio'];	
        if((isset($_POST['comissao'])==true) or (isset($_POST['telefone-usuario'])==true) or (isset($_POST['email-usuario'])==true)) {    
          $comissao = $_POST['comissao'];
          if((is_numeric($comissao)==false) or ($comissao==0)){$comissao=0;}
          $email = strtolower($_POST['email-usuario']);
          $telefone = $_POST['telefone-usuario'];
          $telefone = preg_replace("/[^0-9]()/", "", $telefone);
        }else {
          $comissao = 0;
          $email = null;
          $telefone = null;
        }       
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
        /*$usuario= base64_encode($usuario);
        $privilegio= base64_encode($privilegio);
        $email= base64_encode($email);        
        $telefone= base64_encode($telefone);*/
        $cadastrar_usuario = "INSERT INTO usuarios(usuario, senha, privilegio, comissao, telefone, email) VALUES ('$usuario', '$senha_criptografada', '$privilegio', '$comissao', '$telefone', '$email')";
        $cadastrar = mysqli_query($connect, $cadastrar_usuario);  
      }      
    }
    //$_SESSION['teste'] = "<div class='alert alert-danger alert-dismissible fade show mx-auto overflow-hidden' role='alert' style='width: 360px;'>$usuario Acesso $senha somente $senha_criptografada para $cadastrar_usuario Parceiros!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    header("Location: ../usuarios.php");
  }
?>