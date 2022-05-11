<?php
  session_start();
  include_once("conexao.php");
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $excluir_usuario = "DELETE FROM usuarios WHERE id='$id'";
  $excluir = mysqli_query($connect, $excluir_usuario);   
  header("Location: usuarios.php");    
?>