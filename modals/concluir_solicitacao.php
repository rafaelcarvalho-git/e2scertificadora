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
        $select_documentos = "SELECT * FROM `solicitacoes` WHERE id='$id'";
        $documentos = mysqli_query($connect, $select_documentos);
        $doc = mysqli_fetch_assoc($documentos);
        $destino = "../documentos/".$doc['documentos'];
        if(file_exists($destino)) {
          unlink($destino);
        }        
        $concluir_solicitacao = "SELECT * FROM solicitacoes WHERE id=$id";
        $concluir = mysqli_query($connect, $concluir_solicitacao);
        $row = mysqli_fetch_assoc($concluir);  
        $certificado = $row['tipo_certificado'];
        $certificado_string = substr($certificado, -7);   
        $validade = preg_replace('/[^0-9]/', '', $certificado_string);
        $solicitacao_concluida = "INSERT INTO solicitacoes_concluidas(id, tipo_certificado, nome, data_solicitacao, usuario, data_conclusao, validade, data_vencimento, renovado, telefone) VALUES ({$row['id']}, '{$row['tipo_certificado']}', '{$row['nome']}', '{$row['data_solicitacao']}', '{$row['usuario']}', NOW(), '$validade', DATE_ADD(NOW(), INTERVAL $validade YEAR), 0, '{$row['telefone']}')";
        $solicitacao = mysqli_query($connect, $solicitacao_concluida);
        $apagar_solicitacao = "DELETE FROM solicitacoes WHERE id='$id'";
        $apagar = mysqli_query($connect, $apagar_solicitacao);
        $_SESSION['concluirSolicitacao'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Solicitação concluida com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";    
        header("Location: ../solicitacoes.php");
      }                  
    }
    header("Location: ../solicitacoes.php");
  }
?>