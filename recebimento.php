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
        <a class="navbar-brand ps-3" href="index.php">Envio de Farinha</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
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
                                        <a class="nav-link" href="login.html">Login</a>
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

                    // Processamento do formulário
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Dados do formulário
                        $nome = $conn->real_escape_string($_POST['nome']);
                        $fornecedores = $conn->real_escape_string($_POST['fornecedores']);
                        $entregador = $conn->real_escape_string($_POST['entregador']);
                        $numero_romaneio = $conn->real_escape_string($_POST['numero_romaneio']);
                        $data = $conn->real_escape_string($_POST['data']);
                        $peso_ova = $conn->real_escape_string($_POST['peso_ova']);
                        $saca_ova = $conn->real_escape_string($_POST['saca_ova']);
                        $peso_torrada = $conn->real_escape_string($_POST['peso_torrada']);
                        $saca_torrada = $conn->real_escape_string($_POST['saca_torrada']);
                        $peso_file = $conn->real_escape_string($_POST['peso_file']);
                        $saca_file = $conn->real_escape_string($_POST['saca_file']);
                        $lotes = $conn->real_escape_string($_POST['lotes']);
                        $quantidade_sacas = $conn->real_escape_string($_POST['quantidade_sacas']);
                        $peso_total = $conn->real_escape_string($_POST['peso_total']);
                        $observacoes = $conn->real_escape_string($_POST['observacoes']);

                        // Prepared statement para inserção de dados
                        $stmt = $conn->prepare("INSERT INTO recebimento_farinha (nome, fornecedores, entregador, numero_romaneio, data, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file, lotes, quantidade_sacas, peso_total, observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
                         // Corrigi os tipos de dados para corresponder às colunas da tabela
                        $stmt->bind_param("sssssssssssssss", $nome, $fornecedores, $entregador, $numero_romaneio, $data, $peso_ova, $saca_ova, $peso_torrada, $saca_torrada, $peso_file, $saca_file, $lotes, $quantidade_sacas, $peso_total, $observacoes);

                        // Executa a query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success' role='alert'>Registro inserido com sucesso!</div>";
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Erro: " . $stmt->error . "</div>";
                        }

                        // Fecha o statement
                        $stmt->close();
                    }

                    // Query para obter os fornecedores e lotes
                    $fornecedores_result = $conn->query("SELECT fornecedor_id, nome FROM fornecedores");
                    $lotes_result = $conn->query("SELECT lote_id, lote FROM lotes");

                    // Fecha a conexão
                    $conn->close();
                    ?>

                    <!-- Formulário de Recebimento de Farinha -->
                    <div class="container form-container">
                        <h2>Recebimento de Farinha</h2>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="mb-3">
                                <label for="entregador" class="form-label">Entregador:</label>
                                <input type="text" class="form-control" id="entregador" name="entregador" required>
                            </div>
                            <div class="mb-3">
                                <label for="numero_romaneio" class="form-label">Número do Romaneio:</label>
                                <input type="text" class="form-control" id="numero_romaneio" name="numero_romaneio" required>
                            </div><br>
                            <div class="form-group">
                                <label for="fornecedores">Fornecedores:</label>
                                <select name="fornecedores" id="fornecedores" class="form-control" required>
                                    <option value="">Selecione um fornecedor</option>
                                    <?php while($row = $fornecedores_result->fetch_assoc()): ?>
                                    <option value="<?php echo htmlspecialchars($row['nome']); ?>">
                                        <?php echo htmlspecialchars($row['nome']); ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select><br>
                            </div>
                           
                            <div class="form-group">
                                <label for="lotes">Lotes:</label>
                                <select name="lotes" id="lotes" class="form-control" required>
                                    <option value="">Selecione um lote</option>
                                    <?php while($row = $lotes_result->fetch_assoc()): ?>
                                    <option value="<?php echo htmlspecialchars($row['lote']); ?>">
                                        <?php echo htmlspecialchars($row['lote']); ?>
                                    </option>
                                    <?php endwhile; ?>
                                </select>
                            </div><br>
                            <div class="mb-3">
                                <label for="data" class="form-label">Data:</label>
                                <input type="date" class="form-control" id="data" name="data" required>
                            </div>
                    <div class="form-group">
                        <label for="peso_ova">Peso da Ova</label>
                        <input type="text" class="form-control" id="peso_ova" name="peso_ova" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_ova">Saca da Ova </label>
                        <input type="text" class="form-control" id="saca_ova" name="saca_ova" >
                    </div> <br>
                    
                    <div class="form-group">
                        <label for="peso_torrada">Peso da Torrada </label>
                        <input type="text" class="form-control" id="peso_torrada" name="peso_torrada" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_torrada">Saca da Torrada </label>
                        <input type="text" class="form-control" id="saca_torrada" name="saca_torrada" >
                    </div> <br>
                    <div class="form-group">
                        <label for="peso_file">Peso do File </label>
                        <input type="text" class="form-control" id="peso_file" name="peso_file" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_file">Saca do File </label>
                        <input type="text" class="form-control" id="saca_file" name="saca_file" >
                    </div> <br>
                            
                            <div class="mb-3">
                                <label for="quantidade_sacas" class="form-label">Quantidade Total de Sacas:</label>
                                <input type="number" class="form-control" id="quantidade_sacas" name="quantidade_sacas" required>
                            </div>
                            <div class="mb-3">
                                <label for="peso_total" class="form-label">Peso Total:</label>
                                <input type="text" class="form-control" id="peso_total" name="peso_total" required>
                            </div>
                            <div class="mb-3">
                                <label for="observacoes" class="form-label">Observações:</label>
                                <textarea class="form-control" id="observacoes" name="observacoes"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </main>
            <?php include 'rodape.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
