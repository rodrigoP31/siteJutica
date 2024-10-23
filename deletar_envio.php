<?php
// deletar.php
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024";
$dbname = "jutica31_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

// Deleta o registro
$sql = "DELETE FROM envio_farinha WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Registro deletado com sucesso";
} else {
    echo "Erro ao deletar registro: " . $conn->error;
}

$conn->close();
header('Location: index.php'); // Redireciona para a página principal
?>
