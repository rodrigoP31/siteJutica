<?php
session_start();
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024";
$dbname = "jutica31_dashboard";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['empacotamento_id'];

    // Query para buscar os dados atuais do registro
    $sqlSelect = "SELECT * FROM empacotamento WHERE empacotamento_id = ?";
    $stmt = $conn->prepare($sqlSelect);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Registro não encontrado.";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Dados de Empacotamento</title>
    <link rel="icon" href="logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Atualizar Dados de Empacotamento</div>
                    <div class="card-body">
                        <form action="atualizar_empacotamento.php" method="post">
                            <input type="hidden" name="empacotamento_id" value="<?php echo htmlspecialchars($data['empacotamento_id']); ?>">
                            <div class="form-group">
                                <label>Usuário</label>
                                <input type="text" name="usuario" class="form-control" value="<?php echo htmlspecialchars($data['usuario']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Romaneio</label>
                                <input type="text" name="romaneio" class="form-control" value="<?php echo htmlspecialchars($data['romaneio']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Quantidade Quilos</label>
                                <input type="text" name="quant_kg" class="form-control" value="<?php echo htmlspecialchars($data['quant_kg']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Filé</label>
                                <input type="text" name="quant_file" class="form-control" value="<?php echo htmlspecialchars($data['quant_file']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Ovinha</label>
                                <input type="text" name="quant_ovinha" class="form-control" value="<?php echo htmlspecialchars($data['quant_ovinha']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Ova</label>
                                <input type="text" name="quant_ova" class="form-control" value="<?php echo htmlspecialchars($data['quant_ova']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Uarini</label>
                                <input type="text" name="quant_uarini" class="form-control" value="<?php echo htmlspecialchars($data['quant_uarini']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Data do Empacotamento</label>
                                <input type="date" name="data_empacotamento" class="form-control" value="<?php echo htmlspecialchars($data['data_empacotamento']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Observações</label>
                                <textarea name="obsevarcao" class="form-control" required><?php echo htmlspecialchars($data['obsevarcao']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    $stmt->close();
    $conn->close();
}
?>
