<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024"; // Deixe vazio se não houver senha
$dbname = "jutica31_dashboard";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


?>