<?php
include 'config.php'; // Inclua seu arquivo de configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];

    // Prepare e execute a consulta
    $stmt = $conn->prepare("INSERT INTO fornecedores (nome, telefone) VALUES (?, ?)");
    $stmt->bind_param("ss", $nome, $telefone);

    if ($stmt->execute()) {
        echo "Fornecedor cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar fornecedor: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
