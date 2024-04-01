<?php
// redirecionar.php
include 'core/conn.php';
include 'Controllers/Redirecionador.php';

$codigo = $_GET['codigo'] ?? ''; // Obter o código da URL

if ($codigo) {
    $redirecionador = new Redirecionador($conn);
    $redirecionador->redirecionar($codigo);
} else {
    echo "Nenhum código fornecido.";
}