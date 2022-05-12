<?php
    session_start();
    unset($_SESSION['id'], $_SESSION['usuario'], $_SESSION['senha'], $_SESSION['privilegio']);

    $_SESSION['msg'] = "Deslogado com sucesso";

    header("Location: login.php");
?>