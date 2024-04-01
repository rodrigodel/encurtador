<?php

//include 'login/auth.php';
include 'core/conn.php';

// Bloco: Incidentes por Motivo
try {
    $stmt = $conn->prepare("SELECT m.desc_motivo, COUNT(i.id) as total_incidentes
                            FROM ref_incidentes i
                            INNER JOIN ref_motivos m ON i.motivo = m.id
                            GROUP BY i.motivo
                            ORDER BY total_incidentes DESC");
    $stmt->execute();
    $resultadosPorMotivo = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Primeiro bloco: Incidentes Ativos
try {
    $stmt = $conn->prepare("SELECT e.desc_estados, COUNT(i.id) as total_incidentes
                            FROM ref_incidentes i
                            INNER JOIN ref_estados e ON i.estado = e.id
                            WHERE i.situacao = 0
                            GROUP BY i.estado
                            ORDER BY total_incidentes DESC");
    $stmt->execute();
    $resultadosAtivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Segundo bloco: Incidentes Inativos
try {
    $stmt = $conn->prepare("SELECT e.desc_estados, COUNT(i.id) as total_incidentes
                            FROM ref_incidentes i
                            INNER JOIN ref_estados e ON i.estado = e.id
                            WHERE i.situacao != 0
                            GROUP BY i.estado
                            ORDER BY total_incidentes DESC");
    $stmt->execute();
    $resultadosInativos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

//Últimos Comentários
try {
    $stmt = $conn->prepare("SELECT o.id_incidente, o.nome_usuario, o.observacoes, o.data_insercao
                            FROM ref_observacoes o
                            ORDER BY o.data_insercao DESC
                            LIMIT 5");
    $stmt->execute();
    $ultimosComentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

?>

<!-- Estilos -->
<style>
    .custom-label {
        padding: 12px;
        width: 100%;
        font-size: 16px;
        text-align: left;
    }
</style>

<!-- Bloco de Incidentes por Motivo -->
<div class="card-body">
    <span class="badge bg-light text-dark custom-label">Contagem de Motivos</span>
    <table class="table">
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Total de Incidentes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadosPorMotivo as $linha) {
                echo "<tr>";
                echo "<td>" . $linha['desc_motivo'] . "</td>";
                echo "<td style='text-align: center;'>" . $linha['total_incidentes'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bloco de Incidentes Ativos -->
<div class="card-body">
    <span class="badge bg-light text-dark custom-label">Contagem de Incidentes Ativos</span>
    <table class="table">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Total de Incidentes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadosAtivos as $linha) {
                echo "<tr>";
                echo "<td>" . $linha['desc_estados'] . "</td>";
                echo "<td style='text-align: center;'>" . $linha['total_incidentes'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bloco de Últimos Comentários -->
<div class="card-body">
    <span class="badge bg-light text-dark custom-label">Últimos Comentários Adicionados</span>
    <?php
    foreach ($ultimosComentarios as $comentario) {
             
        // Exibir a data de inserção
        $dataFormatada = date('d/m/Y', strtotime($comentario['data_insercao']));
        echo "<small>" . $comentario['nome_usuario'] . ' - ' . $dataFormatada . "</small><br>";

        // Link para a página de edição
        echo "<a href='editar.php?id=" . $comentario['id_incidente'] . "'>";

        // Exibir o comentário
        echo "<p>" . $comentario['observacoes'] . "</p>";
        
        // Fechar o link
        echo "</a>";

        // Linha horizontal para separar os comentários
        echo "<hr>";
    }
    ?>
</div>

<!-- Bloco de Incidentes Inativos -->
<div class="card-body">
    <span class="badge bg-light text-dark custom-label">Contagem de Incidentes Inativos</span>
    <table class="table">
        <thead>
            <tr>
                <th>Estado</th>
                <th>Total de Incidentes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultadosInativos as $linha) {
                echo "<tr>";
                echo "<td>" . $linha['desc_estados'] . "</td>";
                echo "<td style='text-align: center;'>" . $linha['total_incidentes'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
