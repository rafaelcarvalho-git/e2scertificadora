<?php
  session_start();
  include_once("conexao.php");
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);; 
    header('Location: ../login.php');
  }else {
    if(isset($_SESSION['privilegio']) == true and $_SESSION['privilegio'] != 'Administrador'){
      header("Location: ../login.php");
    }else {
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      if (isset($id)) {    
        $renovar_solicitacao = "SELECT * FROM solicitacoes_concluidas WHERE id=$id";
        $renovar = mysqli_query($connect, $renovar_solicitacao);
        $solicitacao_renovada = "UPDATE solicitacoes_concluidas SET renovado = 1 WHERE id=$id;";
        $solicitacao = mysqli_query($connect, $solicitacao_renovada);         
        header("Location: ../solicitacoes.php");
      }                  
    }
    header("Location: ../solicitacoes.php");
  }
?>