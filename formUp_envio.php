<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "jutica31_dashboard";
    $password = "Jutica.#2024";
    $dbname = "jutica31_dashboard";

    // Estabelecendo a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];


    // Query para buscar os dados atuais do registro
    $sqlSelect = "SELECT * FROM envio_farinha WHERE id = ?";
    $stmt = $conn->prepare($sqlSelect);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Registro não encontrado.";
        exit();
    }


    // Exibir formulário de atualização com os dados atuais
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Atualizar Dados de Envio</title>
        <link rel="icon" href="logo/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/estilo.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Atualizar Dados de Envio</div>
                        <div class="card-body">
    <form action="atualizar_envio.php" method="post">
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="<?php echo $data['nome']; ?>" required>
    </div>
    <div class="form-group">
        <label>Fornecedores</label>
        <input type="text" name="fornecedores" class="form-control" value="<?php echo $data['fornecedores']; ?>" required>
    </div>
    <div class="form-group">
        <label>Número do Romaneio</label>
        <input type="text" name="numero_romaneio" class="form-control" value="<?php echo $data['numero_romaneio']; ?>" required>
    </div>
    <div class="form-group">
        <label>Data</label>
        <input type="date" name="data" class="form-control" value="<?php echo $data['data']; ?>" required>
    </div>
    <div class="form-group">
        <label>Peso Ova</label>
        <input type="number" name="peso_ova" class="form-control" value="<?php echo $data['peso_ova']; ?>" required>
    </div>
    <div class="form-group">
        <label>Saca Ova</label>
        <input type="number" name="saca_ova" class="form-control" value="<?php echo $data['saca_ova']; ?>" required>
    </div>
    <div class="form-group">
        <label>Peso Torrada</label>
        <input type="number" name="peso_torrada" class="form-control" value="<?php echo $data['peso_torrada']; ?>" required>
    </div>
    <div class="form-group">
        <label>Saca Torrada</label>
        <input type="number" name="saca_torrada" class="form-control" value="<?php echo $data['saca_torrada']; ?>" required>
    </div>
    <div class="form-group">
        <label>Peso File</label>
        <input type="number" name="peso_file" class="form-control" value="<?php echo $data['peso_file']; ?>" required>
    </div>
    <div class="form-group">
        <label>Saca File</label>
        <input type="number" name="saca_file" class="form-control" value="<?php echo $data['saca_file']; ?>" required>
    </div>
    <div class="form-group">
        <label>Lotes</label>
        <input type="text" name="lotes" class="form-control" value="<?php echo $data['lotes']; ?>" required>
    </div>
    <div class="form-group">
        <label>Quantidade de Sacas</label>
        <input type="number" name="quantidade_sacas" class="form-control" value="<?php echo $data['quantidade_sacas']; ?>" required>
    </div>
    <div class="form-group">
        <label>Peso Total</label>
        <input type="number" name="peso_total" class="form-control" value="<?php echo $data['peso_total']; ?>" required>
    </div>
    <div class="form-group">
        <label>Observações</label>
        <textarea name="observacoes" class="form-control" required><?php echo $data['observacoes']; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Atualizar">
    </div>
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
