<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit;
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
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Envio de Farinha</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
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
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Operações
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="recebimento.php">Recebimento</a>
                                <a class="nav-link" href="envio.php">Transferência</a>
                                <a class="nav-link" href="empacotamento.php">Empacotamento</a>
                                <a class="nav-link" href="embarque.php">Embarque</a>
                                <a class="nav-link" href="teste3.php">Cadastro de Fornecedor ou Lote</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                            aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Páginas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                    aria-controls="pagesCollapseAuth">
                                    Autenticação
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="html/login.html">Login</a>
                                        <a class="nav-link" href="register.html">Cadastro</a>
                                        <a class="nav-link" href="password.html">Reset Senha</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tabela de Dados
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"></div>
                    Jutica - Produtos da Amazônia
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>

                    <!-- Verificação e processamento do formulário -->
                    <?php
                    // Verifica se o método de requisição é POST para processar o formulário
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Configurações de conexão com o banco de dados
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

                        // Recebe os dados do formulário via POST
                        $lote = $_POST['lote'];
                        $quant_file = $_POST['quant_file'];
                        $quant_ovinha = $_POST['quant_ovinha'];
                        $quant_ova = $_POST['quant_ova'];
                        $quant_uarini = $_POST['quant_uarini'];
                        $data_embarque = $_POST['data_embarque'];
                        $barco = $_POST['barco'];
                        $observacao = $_POST['observacao'];
                        $usuario = $_POST['usuario'];

                        // Prepara e executa a query SQL para inserção de dados
                        $sql = "INSERT INTO embarque (lote, quant_file, quant_ovinha, quant_ova, quant_uarini, data_embarque, barco, observacao, usuario)
                                VALUES ('$lote', '$quant_file', '$quant_ovinha', '$quant_ova', '$quant_uarini', '$data_embarque', '$barco', '$observacao', '$usuario')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Erro: " . $sql . "<br>" . $conn->error . "</div>";
                        }

                        // Fecha a conexão com o banco de dados
                        $conn->close();
                    }
                    ?>

                    <!-- Formulário de embarque de Farinha -->
                    <div class="container form-container">
                        <h2 class="mb-4">Embarque de Farinha</h2>
                        <form method="post" action="<?php echo($_SERVER["PHP_SELF"]); ?>">
                            <br>
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário:</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="lote" class="form-label">Lote:</label>
                                <input type="text" class="form-control" id="lote" name="lote" required>
                            </div>
                            <div class="mb-3">
                                <label for="quant_file" class="form-label">Quantidade de File:</label>
                                <input type="number" class="form-control" id="quant_file" name="quant_file" required>
                            </div>
                            <div class="mb-3">
                                <label for="quant_ovinha" class="form-label">Quantidade de Ovinha:</label>
                                <input type="number" class="form-control" id="quant_ovinha" name="quant_ovinha"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="quant_ova" class="form-label">Quantidade de Ova:</label>
                                <input type="number" class="form-control" id="quant_ova" name="quant_ova" required>
                            </div>
                            <div class="mb-3">
                                <label for="quant_uarini" class="form-label">Quantidade de Uarini:</label>
                                <input type="number" class="form-control" id="quant_uarini" name="quant_uarini"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="data_embarque" class="form-label">Data de Embarque:</label>
                                <input type="date" class="form-control" id="data_embarque" name="data_embarque" required>
                            </div>
                            <div class="mb-3">
                                <label for="barco" class="form-label">Barco:</label>
                                <input type="text" class="form-control" id="barco" name="barco" required>
                            </div>
                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observações:</label>
                                <textarea class="form-control" id="observacao" name="observacao"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </main>
            <?php include 'rodape.php';?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
