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
    $apagar_solicitacao = "DELETE FROM solicitacoes WHERE id='$id'";
	$apagar = mysqli_query($connect, $apagar_solicitacao);
    header("Location: solicitacoes.php");    
    $confirmaId = false;
  }
?>