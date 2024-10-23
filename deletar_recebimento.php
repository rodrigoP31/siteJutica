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

    // Query para deletar o registro
    $sqlDelete = "DELETE FROM recebimento_farinha WHERE id=?";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao deletar o registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
