<?php
    session_start();
    unset($_SESSION['id'], $_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);
    $_SESSION['msgLogin'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>Usuário deslogado com sucesso!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";  
    header("Location: index.php");
?>