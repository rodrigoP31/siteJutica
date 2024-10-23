<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024";
$dbname = "jutica31_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $confirma_senha = $_POST["confirma_senha"];

    // Verifica se as senhas correspondem
    if ($senha == $confirma_senha) {
        // Criptografa a senha
        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, usuario, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nome, $usuario, $senha_hashed);

        if ($stmt->execute()) {
            $message = "Cadastro realizado com sucesso!";
        } else {
            $message = "Erro: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        $message = "As senhas não correspondem.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="icon" href="logo/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 400px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .logo-container {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            max-width: 225px; /* Ajuste o tamanho da logo conforme necessário */
            width: 100%; /* Garante que a logo se ajuste dentro do max-width */
        }
        h2 {
            margin-bottom: 30px;
            margin-top: 30px;
            text-align: center;
        }
        .btn-primary {
            background-color: #17952f; /* Cor do botão */
            border-color: #17952f; /* Cor da borda do botão */
        }
        .btn-primary:hover {
            background-color: #148e27; /* Cor de fundo do botão quando o mouse passa sobre ele */
            border-color: #148e27; /* Cor da borda do botão quando o mouse passa sobre ele */
        }
        .alert {
            margin-top: 20px;
        }
        p {
            text-align: center;
            text-decoration:
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="logo/Logo2.png" alt="Logo" class="logo">
        </div>
        <h2>Cadastro de Usuário</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirma_senha">Confirma Senha:</label>
                <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            <br>
            <p>Já tem conta? Clique <a href="login.php">AQUI</a></p>
        </form>
    </div>
</body>
</html>
