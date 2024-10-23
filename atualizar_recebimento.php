<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "jutica31_dashboard";
    $password = "Jutica.#2024";
    $dbname = "jutica31_dashboard";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $nome = $_POST['nome'] ?? '';
    $fornecedores = $_POST['fornecedores'] ?? '';
    $numero_romaneio = $_POST['numero_romaneio'] ?? '';
    $data = $_POST['data'] ?? '';
    $peso_ova = $_POST['peso_ova'] ?? 0;
    $saca_ova = $_POST['saca_ova'] ?? 0;
    $peso_torrada = $_POST['peso_torrada'] ?? 0;
    $saca_torrada = $_POST['saca_torrada'] ?? 0;
    $peso_file = $_POST['peso_file'] ?? 0;
    $saca_file = $_POST['saca_file'] ?? 0;
    $lotes = $_POST['lotes'] ?? '';
    $quantidade_sacas = $_POST['quantidade_sacas'] ?? 0;
    $peso_total = $_POST['peso_total'] ?? 0.0;
    $observacoes = $_POST['observacoes'] ?? '';

    // Query para atualizar o registro
    $sqlUpdate = "UPDATE recebimento_farinha SET nome=?, fornecedores=?, numero_romaneio=?, data=?, peso_ova=?, saca_ova=?, peso_torrada=?, saca_torrada=?, peso_file=?, saca_file=?, lotes=?, quantidade_sacas=?, peso_total=?, observacoes=? WHERE id=?";
    $stmt = $conn->prepare($sqlUpdate);

    // Corrigindo a string de tipos para corresponder ao número de parâmetros
    $stmt->bind_param("ssssiiiiiiisssi", $nome, $fornecedores, $numero_romaneio, $data, $peso_ova, $saca_ova, $peso_torrada, $saca_torrada, $peso_file, $saca_file, $lotes, $quantidade_sacas, $peso_total, $observacoes, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
