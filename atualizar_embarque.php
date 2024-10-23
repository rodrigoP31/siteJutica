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

    $embarque_id = $_POST['embarque_id'];
    $usuario = $_POST['usuario'] ?? '';
    $lote = $_POST['lote'] ?? '';
    $quant_file = $_POST['quant_file'] ?? '';
    $quant_ovinha = $_POST['quant_ovinha'] ?? '';
    $quant_ova = $_POST['quant_ova'] ?? '';
    $quant_uarini = $_POST['quant_uarini'] ?? '';
    $data_embarque = $_POST['data_embarque'] ?? '';
    $observacao = $_POST['observacao'] ?? '';

    // Query para atualizar o registro
    $sqlUpdate = "UPDATE embarque 
                   SET usuario=?, lote=?, quant_file=?, 
                       quant_ovinha=?, quant_ova=?, quant_uarini=?, 
                       data_embarque=?, observacao=? 
                   WHERE embarque_id=?";
    
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssssssssi", $usuario, $lote, $quant_file, $quant_ovinha, $quant_ova, $quant_uarini, $data_embarque, $observacao, $embarque_id);

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
