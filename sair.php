<?php
    session_start();
    unset($_SESSION['id'], $_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);
    $_SESSION['msgLogin'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Certificado Digital solicitado com sucesso! Iremos realizar o cadastro do cliente e o atendimento. Aguarde nosso contato.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";  
    header("Location: login.php");
?>