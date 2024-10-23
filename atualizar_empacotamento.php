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

    $empacotamento_id = $_POST['empacotamento_id'];
    $usuario = $_POST['usuario'] ?? '';
    $romaneio = $_POST['romaneio'] ?? '';
    $quant_kg = $_POST['quant_kg'] ?? '';
    $quant_file = $_POST['quant_file'] ?? '';
    $quant_ovinha = $_POST['quant_ovinha'] ?? '';
    $quant_ova = $_POST['quant_ova'] ?? '';
    $quant_uarini = $_POST['quant_uarini'] ?? '';
    $data_empacotamento = $_POST['data_empacotamento'] ?? '';
    $obsevarcao = $_POST['obsevarcao'] ?? '';

    // Query para atualizar o registro
    $sqlUpdate = "UPDATE empacotamento 
                   SET usuario=?, romaneio=?, quant_kg=?, quant_file=?, 
                       quant_ovinha=?, quant_ova=?, quant_uarini=?, 
                       data_empacotamento=?, obsevarcao=? 
                   WHERE empacotamento_id=?";
    
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("sssssssssi", $usuario, $romaneio, $quant_kg, $quant_file, $quant_ovinha, $quant_ova, $quant_uarini, $data_empacotamento, $obsevarcao, $empacotamento_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
