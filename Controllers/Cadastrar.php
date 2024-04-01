<?php
session_start();
//! Processamento do Formulário
// Cadastrar.php

include '../core/conn.php';
include '../core/Encurtador.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tituloCodigo = $_POST['titulo_codigo'];
    $descCodigo = $_POST['desc_codigo'];
    $url = $_POST['url'];

    $encurtador = new Encurtador($conn);
    $resultado = $encurtador->inserir($tituloCodigo, $descCodigo, $url);

    if ($resultado) {
        $_SESSION['mensagem_sucesso'] = "Link encurtado com sucesso!";
        header("Location: ../listar/index.php");
        exit;
    } else {
        echo "Erro ao encurtar o link.";
    }
}
