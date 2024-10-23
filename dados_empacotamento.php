<?php
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024"; // Senha do banco de dados, se houver
$dbname = "jutica31_dashboard";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['userid'])) { 
    header("Location: login.php");
    exit;
}

// Verifica se é uma requisição AJAX para buscar a quantidade de quilos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fetch_peso_total'])) {
    $romaneio = mysqli_real_escape_string($conn, $_POST['romaneio']);

    // Consulta para obter a quantidade de quilos correspondente ao romaneio
    $sql = "SELECT peso_total FROM envio_farinha WHERE numero_romaneio = '$romaneio'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $peso_total = $row['peso_total'];

        // Retorna a quantidade de quilos como JSON
        header('Content-Type: application/json');
        echo json_encode(['peso_total' => $peso_total]);
    } else {
        // Caso não encontre o romaneio, retorna vazio
        header('Content-Type: application/json');
        echo json_encode(['peso_total' => '']);
    }
    exit;
}

// Verifica se o formulário foi enviado para inserir dados
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['fetch_peso_total'])) {
    $romaneio = mysqli_real_escape_string($conn, $_POST['romaneio']);
    $lote = mysqli_real_escape_string($conn, $_POST['lote']);
    $quant_file = mysqli_real_escape_string($conn, $_POST['quant_file']);
    $quant_ovinha = mysqli_real_escape_string($conn, $_POST['quant_ovinha']);
    $quant_ova = mysqli_real_escape_string($conn, $_POST['quant_ova']);
    $quant_uarini = mysqli_real_escape_string($conn, $_POST['quant_uarini']);
    $data_empacotamento = mysqli_real_escape_string($conn, $_POST['data_empacotamento']);
    $obsevarcao = mysqli_real_escape_string($conn, $_POST['obsevarcao']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

    // Insere os dados no banco de dados
    $sql = "INSERT INTO empacotamento (romaneio, lote, quant_file, quant_ovinha, quant_ova, quant_uarini, data_empacotamento, obsevarcao, usuario) 
            VALUES ('$romaneio', '$lote', '$quant_file', '$quant_ovinha', '$quant_ova', '$quant_uarini', '$data_empacotamento', '$obsevarcao', '$usuario')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Dados inseridos com sucesso!');</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>