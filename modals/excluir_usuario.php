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
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      $excluir_usuario = "DELETE FROM usuarios WHERE id='$id'";
      $excluir = mysqli_query($connect, $excluir_usuario);   
      header("Location: ../usuarios.php");    
    }
  }
?>