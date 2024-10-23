<?php
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
    $peso_total = mysqli_real_escape_string($conn, $_POST['peso_total']);
    $peso_utilizado = mysqli_real_escape_string($conn, $_POST['peso_uti']);
    $quant_file = mysqli_real_escape_string($conn, $_POST['quant_file']);
    $quant_ovinha = mysqli_real_escape_string($conn, $_POST['quant_ovinha']);
    $quant_ova = mysqli_real_escape_string($conn, $_POST['quant_ova']);
    $quant_uarini = mysqli_real_escape_string($conn, $_POST['quant_uarini']);
    $data_empacotamento = mysqli_real_escape_string($conn, $_POST['data_empacotamento']);
    $obsevarcao = mysqli_real_escape_string($conn, $_POST['obsevarcao']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);

    // Calcula o saldo restante
    $saldo_restante = $peso_total - $peso_utilizado;

    // Atualiza a quantidade de quilos restante no banco de dados
    $sql = "UPDATE envio_farinha SET peso_total = $saldo_restante WHERE numero_romaneio = '$romaneio'";
    $conn->query($sql);

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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        .form-container {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Empacotamento de Farinha</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Operações
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="recebimento.php">Recebimento</a>
                                <a class="nav-link" href="envio.php">Transferência</a>
                                <a class="nav-link" href="empacotamento.php">Empacotamento</a>
                                <a class="nav-link" href="embarque.php">Embarque</a>
                                <a class="nav-link" href="teste3.php">Cadastro de Fornecedor ou Lote</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Páginas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Autenticação
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Cadastro</a>
                                        <a class="nav-link" href="password.html">Reset Senha</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Gráficos
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tabelas
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logado como:</div>
                    Usuário
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Empacotamento de Farinha</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Empacotamento</li>
                    </ol>
                    <div class="container form-container">
                        <form id="empacotamentoForm" method="POST" action="">
                            <div class="form-group mb-3">
                                <label for="romaneio">Número do Romaneio:</label>
                                <select name="romaneio" id="romaneio" class="form-select" required>
                                            <option value="">Selecione um romaneio</option>
                                            <?php
                                            $sql = "SELECT numero_romaneio FROM envio_farinha";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value=\"" . $row["numero_romaneio"] . "\">" . $row["numero_romaneio"] . "</option>";
                                                }
                                            }
                                            ?>
                                 </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="peso_total">Peso Total:</label>
                                <input type="text" class="form-control" id="peso_total" name="peso_total" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="peso_uti">Peso Utilizado/Empacotado:</label>
                                <input type="number" class="form-control" id="peso_uti" name="peso_uti" required>
                            </div>
                            <div class="form-group">
                                <label for="lote">Lote:</label>
                                <input type="text" name="lote" id="lote" class="form-control" required>
                            </div> <br>
                            <div class="form-group mb-3">
                                <label for="quant_file">Quantidade de File:</label>
                                <input type="text" class="form-control" id="quant_file" name="quant_file" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="quant_ovinha">Quantidade de Ovinha:</label>
                                <input type="text" class="form-control" id="quant_ovinha" name="quant_ovinha" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="quant_ova">Quantidade de Ova:</label>
                                <input type="text" class="form-control" id="quant_ova" name="quant_ova" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="quant_uarini">Quantidade de Uarini:</label>
                                <input type="text" class="form-control" id="quant_uarini" name="quant_uarini" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="data_empacotamento">Data de Empacotamento:</label>
                                <input type="date" class="form-control" id="data_empacotamento" name="data_empacotamento" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="obsevarcao">Observação:</label>
                                <textarea class="form-control" id="obsevarcao" name="obsevarcao"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="usuario">Usuário:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; Your Website 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        document.getElementById('romaneio').addEventListener('blur', function() {
            var romaneio = this.value;
            if (romaneio) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.peso_total) {
                            document.getElementById('peso_total').value = response.peso_total;
                        } else {
                            document.getElementById('peso_total').value = '';
                        }
                    }
                };
                xhr.send('fetch_peso_total=true&romaneio=' + romaneio);
            }
        });
    </script>
</body>
</html>
