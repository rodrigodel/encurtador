<?php

include '../core/conn.php';

// Redirecionador.php
class Redirecionador {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function incrementarAcesso($codigo) {
        $sql = "UPDATE encurtador SET acessos = acessos + 1 WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$codigo]);
    }

    public function redirecionar($codigo) {
        $this->incrementarAcesso($codigo); // Incrementa o acesso antes de redirecionar

        $sql = "SELECT url FROM encurtador WHERE codigo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$codigo]);
        $resultado = $stmt->fetch();

        if ($resultado) {
            header("Location: " . $resultado['url']);
            exit;
        } else {
            echo "Código de link encurtado não encontrado.";
        }
    }
}