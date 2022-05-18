<?php
  session_start();
  include_once("conexao.php");
  if((!isset($_SESSION['usuario']) == true) or (!isset($_SESSION['senha']) == true) or (!isset($_SESSION['privilegio']) == true)) {
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    unset($_SESSION['privilegio']);
    $_SESSION['msgLogin'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Acesso restrito!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"; 
    header('Location: index.php');
  }
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  if (isset($id)) {
    $confirmaId = true;
  }else {
    $confirmaId = false;
  }
  if ($confirmaId==true) {
    $select_documentos = "SELECT * FROM solicitacoes WHERE id='$id'";
    $documentos = mysqli_query($connect, $select_documentos);
    $doc = mysqli_fetch_assoc($documentos);
    $destino = "documentos/".$doc['documentos'];
    if(file_exists($destino)) {
      unlink($destino);
    }
    $excluir_solicitacao = "DELETE FROM solicitacoes WHERE id='$id'";
	  $excluir = mysqli_query($connect, $excluir_solicitacao);
    $_SESSION['excluirSolicitacao'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
      Solicitação excluida com sucesso!
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    header("Location: solicitacoes_ativas.php");
    $confirmaId = false;
  }
?>