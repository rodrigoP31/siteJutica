<?php
session_start();

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
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    // Verifica se o usuário existe
    $sql = "SELECT id, nome, senha FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $senha_hashed);
        $stmt->fetch();

        // Verifica a senha
        if (password_verify($senha, $senha_hashed)) {
            // Inicia uma sessão e redireciona o usuário para uma página protegida
            $_SESSION['userid'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['usuario'] = $usuario;
            header("Location: index.php");
            exit;
        } else {
            $message = "Senha incorreta.";
        }
    } else {
        $message = "Usuário não encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="logo/logo.png" type="image/x-icon">

    <style>
body {
    background-color: #f8f9fa;
}

.form-group{
    text-align: left;
}

.container {
    margin-top: 50px;
    max-width: 400px;
    background-color: #fff;
    padding: 30px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.login-container {
    text-align: center; /* Centraliza todo o conteúdo dentro do login-container */
}

.login-container .logo {
    max-width: 225px; /* Tamanho máximo da logo */
    width: 100%; /* Garante que a logo se ajuste dentro do max-width */
    margin: 0 auto; /* Centraliza a logo horizontalmente */
}

.login-container h2 {
    margin-bottom: 30px;
    margin-top: 30px;
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



    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="login-container">
            <img src="logo/Logo2.png" alt="Logo" class="logo"> <br>
            <h2>Login:</h2>
            <?php if (isset($message)): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
            </form>
            <br>
            <div class="register-link">
            Foco, força e coragem para que hoje seja um dia marcado por metas concluídas.
            </div>
        </div>
    </div>
</body>
</html>
