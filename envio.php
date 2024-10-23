<?php
$servername = "localhost";
$username = "jutica31_dashboard";
$password = "Jutica.#2024";
$dbname = "jutica31_dashboard";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
// Processamento do formulário
$msg = '';

session_start();

if (!isset($_SESSION['userid'])) { 
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'form_submit') {
    // Dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $fornecedores = $conn->real_escape_string($_POST['fornecedores']);
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

    // Query para inserir os dados na tabela envio_farinha
    $sql = "INSERT INTO envio_farinha (nome, fornecedores, numero_romaneio, data, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file, lotes, quantidade_sacas, peso_total) 
            VALUES ('$nome', '$fornecedores', '$numero_romaneio', '$data', '$peso_ova', '$saca_ova', '$peso_torrada', '$saca_torrada', '$peso_file', '$saca_file', '$lotes', '$quantidade_sacas', '$peso_total')";

    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success">Registro adicionado com sucesso!</div>';
    } else {
        $msg = '<div class="alert alert-danger">Erro ao adicionar registro: ' . $conn->error . '</div>';
    }
}

// Função para buscar o peso da Ova, saca_ova, peso_torrada e saca_torrada
if (isset($_GET['fetch_peso_ova']) && $_GET['fetch_peso_ova'] == 'true') {
    $numero_romaneio = $conn->real_escape_string($_GET['numero_romaneio']);
    $query = "SELECT fornecedores, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file, lotes, quantidade_sacas, peso_total FROM recebimento_farinha WHERE numero_romaneio = '$numero_romaneio'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'fornecedores' => $row['fornecedores'], 
            'peso_ova' => $row['peso_ova'], 
            'saca_ova' => $row['saca_ova'],
            'peso_torrada' => $row['peso_torrada'],
            'saca_torrada' => $row['saca_torrada'],
            'peso_file' => $row['peso_file'],
            'saca_file' => $row['saca_file'],
            'lotes' => $row['lotes'],
            'quantidade_sacas' => $row['quantidade_sacas'],
            'peso_total' => $row['peso_total']
            
        ]);
    } else {
        echo json_encode([
            'fornecedores' => '',
            'peso_ova' => '', 
            'saca_ova' => '',
            'peso_torrada' => '',
            'saca_torrada' => '',
            'peso_file' => '',
            'saca_file' => '',
            'lotes' => '',
            'quantidade_sacas' => '',
            'peso_total' => ''
        ]);
    }
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

                    <!-- Formulário de Recebimento de Farinha -->
                    <div class="container form-container">
                        <h2>Transferência de Farinha</h2>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div> <br>

                    <div class="form-group">
                        <label for="numero_romaneio">Romaneio:</label>
                        <select name="numero_romaneio" id="numero_romaneio" class="form-select" required>
                            <option value="">Selecione um romaneio</option>
                            <?php
                            $sql = "SELECT numero_romaneio FROM recebimento_farinha";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=\"" . $row["numero_romaneio"] . "\">" . $row["numero_romaneio"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div> <br>

                    <div class="form-group">
                        <label for="fornecedores">Fornecedor</label>
                        <input type="text" class="form-control" id="fornecedores" name="fornecedores" readonly>
                    </div> <br>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" id="data" name="data" require>
                    </div> <br>                    
                    <div class="form-group">
                        <label for="peso_ova">Peso da Ova</label>
                        <input type="text" class="form-control" id="peso_ova" name="peso_ova" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_ova">Saca da Ova (kg)</label>
                        <input type="text" class="form-control" id="saca_ova" name="saca_ova" >
                    </div> <br>
                    <div class="form-group">
                        <label for="peso_torrada">Peso da Torrada (kg)</label>
                        <input type="text" class="form-control" id="peso_torrada" name="peso_torrada" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_torrada">Saca da Torrada (kg)</label>
                        <input type="text" class="form-control" id="saca_torrada" name="saca_torrada" >
                    </div> <br>
                    <div class="form-group">
                        <label for="peso_file">Peso do File (kg)</label>
                        <input type="text" class="form-control" id="peso_file" name="peso_file" >
                    </div> <br>
                    <div class="form-group">
                        <label for="saca_file">Saca do File (kg)</label>
                        <input type="text" class="form-control" id="saca_file" name="saca_file" >
                    </div> <br>
                    <div class="form-group">
                        <label for="lotes">Lote</label>
                        <input type="text" class="form-control" id="lotes" name="lotes" >
                    </div> <br>
                    <div class="form-group">
                        <label for="quantidade_sacas">Quantidade de Sacas</label>
                        <input type="text" class="form-control" id="quantidade_sacas" name="quantidade_sacas" >
                    </div> <br>
                    <div class="form-group">
                        <label for="peso_total">Peso Total (kg)</label>
                        <input type="text" class="form-control" id="peso_total" name="peso_total" >
                    </div> <br>
                    <input type="hidden" name="action" value="form_submit">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                    </div> <br>
                </div>
            </main>
            <?php include 'rodape.php'; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>

    <!-- jQuery (necessário para Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Popper.js (necessário para Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- Script JavaScript para carregar o peso da Ova, saca_ova, peso_torrada e saca_torrada -->
    <script>
        document.getElementById('numero_romaneio').addEventListener('change', function () {
            var numero_romaneio = this.value;
            if (numero_romaneio) {
                fetchPesoOva(numero_romaneio);
            } else {
                document.getElementById('fornecedores').value = '';
                document.getElementById('peso_ova').value = '';
                document.getElementById('saca_ova').value = '';
                document.getElementById('peso_torrada').value = '';
                document.getElementById('saca_torrada').value = '';
                document.getElementById('peso_file').value = '';
                document.getElementById('saca_file').value = '';
                document.getElementById('lotes').value = '';
                document.getElementById('quantidate_sacas').value = '';
                document.getElementById('peso_total').value = '';
            }
        });

        function fetchPesoOva(numero_romaneio) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '?fetch_peso_ova=true&numero_romaneio=' + encodeURIComponent(numero_romaneio), true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('fornecedores').value = response.fornecedores || '';
                    document.getElementById('peso_ova').value = response.peso_ova || '';
                    document.getElementById('saca_ova').value = response.saca_ova || '';
                    document.getElementById('peso_torrada').value = response.peso_torrada || '';
                    document.getElementById('saca_torrada').value = response.saca_torrada || '';
                    document.getElementById('peso_file').value = response.peso_file || '';
                    document.getElementById('saca_file').value = response.saca_file || '';
                    document.getElementById('lotes').value = response.lotes || '';
                    document.getElementById('quantidade_sacas').value = response.quantidade_sacas || '';
                    document.getElementById('peso_total').value = response.peso_total || '';
                } else {
                    console.error('Erro ao buscar peso da Ova, saca_ova, peso_torrada e saca_torrada:', xhr.status, xhr.statusText);
                }
            };
            xhr.onerror = function () {
                console.error('Erro de requisição.');
            };
            xhr.send();
        }
    </script>
</body>

</html>
