<?php
session_start();
include '../core/conn.php';
include '../core/Encurtador.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $encurtador = new Encurtador($conn);
    if ($encurtador->deletar($id)) {
        $_SESSION['mensagem_sucesso'] = "Link deletado com sucesso!";
    } else {
        $_SESSION['mensagem_sucesso'] = "Erro ao deletar o link.";
    }
} else {
    $_SESSION['mensagem_sucesso'] = "ID inválido.";
}

// Redireciona para index.php
header("Location: index.php");
exit;