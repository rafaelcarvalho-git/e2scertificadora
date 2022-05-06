<?php /*Apagar usuario*/
  session_start();
  include_once("conexao.php");
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  if (isset($id)) {
    $confirmaId = true;
  }else {
    $confirmaId = false;
  }
  if ($confirmaId==true) {
    $apagar_usuario = "DELETE FROM usuarios WHERE id='$id'";
    $apagar = mysqli_query($connect, $apagar_usuario);
    $_SESSION['apagarUsuario'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      Usuário excluido com sucesso!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";   
    header("Location: usuarios.php");    
    $confirmaId = false;
  }
?>