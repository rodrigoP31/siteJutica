<?php
include 'config.php'; // Inclua seu arquivo de configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lote = $_POST['lote'];

    // Prepare e execute a consulta
    $stmt = $conn->prepare("INSERT INTO lotes (lote) VALUES (?)");
    $stmt->bind_param("s", $lote);

    if ($stmt->execute()) {
        echo "Lote cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar lote: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
