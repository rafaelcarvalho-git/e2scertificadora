<?php
  session_start();
  include_once("conexao.php");
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  if (isset($id)) {
    $confirmaId = true;
  }else {
    $confirmaId = false;
  }
  if ($confirmaId==true) {
    $excluir_usuario = "DELETE FROM usuarios WHERE id='$id'";
    $excluir = mysqli_query($connect, $excluir_usuario);
    $_SESSION['excluirUsuario'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      Usuário excluido com sucesso!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";   
    header("Location: usuarios.php");    
    $confirmaId = false;
  }
?>