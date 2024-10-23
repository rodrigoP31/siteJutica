<?php
session_start();

if (!isset($_SESSION['userid'])) { 
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header.php'; ?>
    <link rel="icon" href="logo/logo.png" type="image/x-icon">

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Tabelas</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button"><i
        class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown"  role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="index.php">Home</a></li>
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
                    <h1 class="mt-4">Tabela de Entrada e Saída de Farinha</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>

                    <!-- Tabela de Envio de Farinha -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Dados de Envio de Farinha</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEnvio" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Usuário</th>
                        <th>Fornecedores</th>
                        <th>Número do romaneio</th>
                        <th>Peso Ova</th>
                        <th>Sacas Ova</th>
                        <th>Peso Torrada</th>
                        <th>Sacas Torrada</th>
                        <th>Peso Filé</th>
                        <th>Sacas Filé</th>
                        <th>Lotes</th>
                        <th>Quantidade de sacas</th>
                        <th>Peso total (Kg)</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conexão com o banco de dados
                    $servername = "localhost";
                    $username = "jutica31_dashboard";
                    $password = "Jutica.#2024";
                    $dbname = "jutica31_dashboard";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verifica a conexão
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Query para buscar os dados de envio
                    $sqlEnvio = "SELECT * FROM envio_farinha";
                    $resultEnvio = $conn->query($sqlEnvio);

                    if ($resultEnvio->num_rows > 0) {
                        // Output dos dados de cada linha de envio
                        while($row = $resultEnvio->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['data'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['fornecedores'] . "</td>";
                            echo "<td>" . $row['numero_romaneio'] . "</td>";
                            echo "<td>" . $row['peso_ova'] . "</td>";
                            echo "<td>" . $row['saca_ova'] . "</td>";
                            echo "<td>" . $row['peso_torrada'] . "</td>";
                            echo "<td>" . $row['saca_torrada'] . "</td>";
                            echo "<td>" . $row['peso_file'] . "</td>";
                            echo "<td>" . $row['saca_file'] . "</td>";
                            echo "<td>" . $row['lotes'] . "</td>";
                            echo "<td>" . $row['quantidade_sacas'] . "</td>";
                            echo "<td>" . $row['peso_total'] . "</td>";
                            echo "<td>" . $row['observacoes'] . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='formUp_envio.php ' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn btn-primary' value='Atualizar'>";
                            echo "</form> ";
                            echo "<form method='post' action='deletar_envio.php' style='display:inline;'  onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Deletar'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


                    <!-- Tabela de Recebimento de Farinha -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Dados de Recebimento de Farinha</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableRecebimento" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Usuário</th>
                        <th>Fornecedores</th>
                        <th>Número do romaneio</th>
                        <th>Peso Ova</th>
                        <th>Sacas Ova</th>
                        <th>Peso Torrada</th>
                        <th>Sacas Torrada</th>
                        <th>Peso Filé</th>
                        <th>Sacas Filé</th>
                        <th>Lotes</th>
                        <th>Quantidade de sacas</th>
                        <th>Peso total (Kg)</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query para buscar os dados de recebimento
                    $sqlRecebimento = "SELECT * FROM recebimento_farinha";
                    $resultRecebimento = $conn->query($sqlRecebimento);

                    if ($resultRecebimento->num_rows > 0) {
                        // Output dos dados de cada linha de recebimento
                        while($row = $resultRecebimento->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['data'] . "</td>";
                            echo "<td>" . $row['nome'] . "</td>";
                            echo "<td>" . $row['fornecedores'] . "</td>";
                            echo "<td>" . $row['numero_romaneio'] . "</td>";
                            echo "<td>" . $row['peso_ova'] . "</td>";
                            echo "<td>" . $row['saca_ova'] . "</td>";
                            echo "<td>" . $row['peso_torrada'] . "</td>";
                            echo "<td>" . $row['saca_torrada'] . "</td>";
                            echo "<td>" . $row['peso_file'] . "</td>";
                            echo "<td>" . $row['saca_file'] . "</td>";
                            echo "<td>" . $row['lotes'] . "</td>";
                            echo "<td>" . $row['quantidade_sacas'] . "</td>";
                            echo "<td>" . $row['peso_total'] . "</td>";
                            echo "<td>" . $row['observacoes'] . "</td>";
                            echo "<td>";
                            echo "<form method='post' action='formUp_recebimento.php' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn btn-primary' value='Atualizar'>";
                            echo "</form> ";
                            echo "<form method='post' action='deletar_recebimento.php' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Deletar'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Dados de Empacotamento de Farinha</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEmpacotamento" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data do Empacotamento</th>
                        <th>Usuário</th>
                        <th>Romaneio</th>
                        <th>Lote</th>
                        <th>Quantidade Quilos</th>
                        <th>Filé</th>
                        <th>Ovinha</th>
                        <th>Ova</th>
                        <th>Uarini</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query para buscar os dados de empacotamento
                    $sqlEmpacotamento = "SELECT * FROM empacotamento";
                    $resultEmpacotamento = $conn->query($sqlEmpacotamento);

                    if ($resultEmpacotamento->num_rows > 0) {
                        while ($row = $resultEmpacotamento->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['data_empacotamento'] . "</td>";
                            echo "<td>" . $row['usuario'] . "</td>";
                            echo "<td>" . $row['romaneio'] . "</td>";
                            echo "<td>" . $row['lote'] . "</td>";
                            echo "<td>" . $row['quant_kg'] . "</td>";
                            echo "<td>" . $row['quant_file'] . "</td>";
                            echo "<td>" . $row['quant_ovinha'] . "</td>";
                            echo "<td>" . $row['quant_ova'] . "</td>";
                            echo "<td>" . $row['quant_uarini'] . "</td>";
                            echo "<td>" . $row['obsevarcao'] . "</td>";
                            echo "<td>";
                            echo "<form method='get' action='formUp_empacotamento.php' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='empacotamento_id' value='" . $row['empacotamento_id'] . "'>";
                            echo "<input type='submit' class='btn btn-primary' value='Atualizar'>";
                            echo "</form> ";
                            echo "<form method='post' action='deletar_empacotamento.php' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='empacotamento_id' value='" . $row['empacotamento_id'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Deletar'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Tabela de Embarque de Farinha -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 class="m-0 font-weight-bold text-primary">Dados de Embarque de Farinha</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEmbarque" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Data do Embarque</th>
                        <th>Usuário</th>
                        <th>Nome do Barco</th>
                        <th>Lote</th>
                        <th>Filé</th>
                        <th>Ovinha</th>
                        <th>Ova</th>
                        <th>Uarini</th>
                        
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query para buscar os dados de embarque
                    $sqlEmbarque = "SELECT * FROM embarque";
                    $resultEmbarque = $conn->query($sqlEmbarque);

                    if ($resultEmbarque->num_rows > 0) {
                        // Output dos dados de cada linha de embarque
                        while($row = $resultEmbarque->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['data_embarque'] . "</td>";
                            echo "<td>" . $row['usuario'] . "</td>";
                            echo "<td>" . $row['barco'] . "</td>";
                            echo "<td>" . $row['lote'] . "</td>";
                            echo "<td>" . $row['quant_file'] . "</td>";
                            echo "<td>" . $row['quant_ovinha'] . "</td>";
                            echo "<td>" . $row['quant_ova'] . "</td>";
                            echo "<td>" . $row['quant_uarini'] . "</td>";
                            echo "<td>" . $row['observacao'] . "</td>";
                            echo "<td>";
                            echo "<form method='get' action='formUp_embarque.php' style='display:inline;' onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='embarque_id' value='" . $row['embarque_id'] . "'>";
                            echo "<input type='submit' class='btn btn-primary' value='Atualizar'>";
                            echo "</form> ";
                            echo "<form method='post' action='deletar_embarque.php' style='display:inline;'onsubmit='return confirm(\"Confirma fazer essa ação?\");'>";
                            echo "<input type='hidden' name='embarque_id' value='" . $row['embarque_id'] . "'>";
                            echo "<input type='submit' class='btn btn-danger' value='Deletar'>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Nenhum dado encontrado.</td></tr>";
                    }

                    // Fecha a conexão com o banco de dados
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



                </div>
            </main>
            <?php include 'rodape.php' ?>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="js/scripts.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    
    <!-- Datatables scripts -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    
    <!-- Bootstrap 5 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#dataTableEnvio').DataTable();
            $('#dataTableRecebimento').DataTable();
            $('#dataTableEmpacotamento').DataTable();
            $('#dataTableEmbarque').DataTable();

            // Sidebar toggle behavior
            $('#sidebarToggle').on('click', function(event) {
                event.preventDefault();
                $('body').toggleClass('sb-sidenav-toggled');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="js/scripts.js"></script>

</body>
</html>
