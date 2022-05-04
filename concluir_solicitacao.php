
<?php
/*
  include_once("conexao.php");
  include('solicitacoes.php');
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  if (isset($id)) {
    $confirmaId = true;
  }else {
    $confirmaId = false;
  }
  if ($confirmaId==true) {
    $id_solicitacao = $rows_solicitacoes['id'];
    $tipo = $rows_solicitacoes['tipo_certificado'];
    $nome = $rows_solicitacoes['nome'];
    $data1 = $rows_solicitacoes['data_solicitacao'];
    $cont = $rows_solicitacoes['contador'];/*
    $solicitacao_concluida = "INSERT INTO solicitacoes_concluidas(id, tipo_certificado, nome, data_solicitacao, contador, data_conclusao) VALUES ('$id_solicitacao', '$tipo', '$nome', '$data1', '$cont', NOW())";
    $solicitacao = mysqli_query($connect, $solicitacao_concluida);
    header("Location: solicitacoes.php");    
    $confirmaId = false;
  }*/
?>
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
    $solicitacao_concluida = "INSERT INTO solicitacoes_concluidas(id, tipo_certificado, nome, data_solicitacao, contador, data_conclusao) VALUES ('11', 'Cert A1', 'Rafa', NOW(), '$cont', NOW())";
    $solicitacao = mysqli_query($connect, $solicitacao_concluida);
    $_SESSION['concluirSolicitacao'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    header("Location: solicitacoes.php");    
    $confirmaId = false;
  }
?>