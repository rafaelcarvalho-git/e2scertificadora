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
    $excluir_solicitacao = "DELETE FROM solicitacoes WHERE id='$id'";
	  $excluir = mysqli_query($connect, $excluir_solicitacao);
    $_SESSION['excluirSolicitacao'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      Solicitação excluida com sucesso!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    header("Location: solicitacoes.php");    
    $confirmaId = false;
  }
?>