<?php include 'dadosIn.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'header.php'; ?>
    <style>
        .dashboard {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* Espaçamento entre os cards */
            padding: 20px;
        }

        .caixa1,
        .caixa2,
        .caixa3,
        .caixa4 {
            background-color: #f7f7f7;
            margin-bottom: 20px;
            border-radius: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            /* Para distribuir os cards */
        }


        .dashboard h3 {
            text-align: center;

        }

        .card1,
        .card2 {
            background-color: #58BBBE;

        }

        .card3,
        .card4,
        .card5,
        .card6,
        .card7,
        .card8,
        .card9,
        .card10 {
            background-color: #5F9EA0;

        }

        .metric {
            flex: 1 1 200px;
            /* Ajusta a largura mínima dos cards */
            height: 150px;
            /* Altura fixa dos cards */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin: 10px;
            /* Espaçamento interno entre os cards */
        }



        .metric i {
            font-size: 24px;
            margin-bottom: 10px;

        }

        .value {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        .label {
            font-size: 18px;
            color: #fff;
            margin-top: 10px;
        }


        @media (max-width: 768px) {
            .metric {
                flex: 1 1 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .metric {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Recebimento de Farinha</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Essencial</div>
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
                                        <a class="nav-link" href="login.php">Login</a>
                                        <a class="nav-link" href="cadastro.php">Cadastro</a>
                                        <a class="nav-link" href="#">Reset Senha</a>
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
                        <div class="sb-sidenav-menu-heading">Complementos</div>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tabela de Dados
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small"></div>
                    <a href="final.php">
                        <p style=" color: #ccc; text-decoration: none;">Sair do sistema</p>
                    </a>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Painel de Controle</h1>

                    <div class="row teste">

                        <h3>Estoque Peso kg:</h3>
                        <!-- Tipo de farinha peso e sac :) -->
                        <div class="dashboard caixa3">
                            <div class="metric card3">
                                <i class="fas fa-weight"></i>
                                <div class="value">
                                    <?php echo $saldoPesoOva; ?> kg
                                </div>
                                <div class="label">Saldo Peso Ova</div>
                            </div>
                            <div class="metric card3">
                                <i class="fas fa-weight"></i>
                                <div class="value">
                                    <?php echo $saldoPesoTorrada; ?> kg
                                </div>
                                <div class="label">Saldo Peso Torrada</div>
                            </div>

                            <div class="metric card3">
                                <i class="fas fa-weight"></i>
                                <div class="value">
                                    <?php echo $saldoPesoFile; ?> kg
                                </div>
                                <div class="label">Saldo Peso Filé</div>
                            </div>
                        </div>

                        <!-- Começo de uma nova vida :) -->
                        <h3>Estoque Sacas:</h3>
                        <div class="dashboard caixa3">
                            <div class="metric card2">
                                <i class="fas fa-box"></i>
                                <div class="value">
                                    <?php echo $saldoSacaOva; ?> sacas
                                </div>
                                <div class="label">Saldo Sacas Ova</div>
                            </div>
                            <div class="metric card2">
                                <i class="fas fa-box"></i>
                                <div class="value">
                                    <?php echo $saldoSacaTorrada; ?> sacas
                                </div>
                                <div class="label">Saldo Sacas Torrada</div>
                            </div>
                            <div class="metric card2">
                                <i class="fas fa-box"></i>
                                <div class="value">
                                    <?php echo $saldoSacaFile; ?> sacas
                                </div>
                                <div class="label">Saldo Sacas Filé</div>
                            </div>

                        </div>



                        <h3>Estoque da Empacotadora</h3>
                        <div class="dashboard caixa2">
                            <div class="metric card7">
                                <i class="fas fa-boxes"></i>
                                <div class="value">
                                    <?php echo $saldoFile; ?> Fardos
                                </div>
                                <div class="label">SALDO FARINHA FILÉ</div>
                            </div>
                            <div class="metric card8">
                                <i class="fas fa-boxes"></i>
                                <div class="value">
                                    <?php echo $saldoOvinha; ?> Fardos
                                </div>
                                <div class="label">SALDO FARINHA OVINHA</div>
                            </div>
                            <div class="metric card9">
                                <i class="fas fa-boxes"></i>
                                <div class="value">
                                    <?php echo $saldoOva; ?> Fardos
                                </div>
                                <div class="label">SALDO FARINHA OVA</div>
                            </div>
                            <div class="metric card10">
                                <i class="fas fa-boxes"></i>
                                <div class="value">
                                    <?php echo $saldoUarini;?> Fardos
                                </div>
                                <div class="label">SALDO FARINHA UARINI</div>
                            </div>
                        </div>
                    </div><!-- FIM ROW -->
                    <!-- Formulário de Filtros -->
                    <form method="post" action="">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="dataInicio" class="form-label">Data Início:</label>
                                <input type="date" id="dataInicio" name="dataInicio" class="form-control"
                                    value="<?php echo $dataInicio; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="dataFim" class="form-label">Data Fim:</label>
                                <input type="date" id="dataFim" name="dataFim" class="form-control"
                                    value="<?php echo $dataFim; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="fornecedores" class="form-label">Fornecedores:</label>
                                <input type="text" id="fornecedores" name="fornecedores" class="form-control"
                                    value="<?php echo $fornecedores; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="lotes" class="form-label">Lotes:</label>
                                <input type="text" id="lotes" name="lotes" class="form-control"
                                    value="<?php echo $lotes; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                        </div>
                    </form>



                    <!--tabela de empacotamento-->
                    <div class="container">
                        <h4 class="mt-5">Saldo por tipo de Farinha e Lote</h4>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Saldo Farinha Filé</th>
                                    <th>Saldo Farinha Ova</th>
                                    <th>Saldo Farinha Ovinha</th>
                                    <th>Saldo Farinha Uarini</th>
                                </tr>
                            </thead>
                            <tbody id="saldosTableBody">
                                <?php while ($row = mysqli_fetch_assoc($saldos)): ?>
                                <tr>
                                    <td>
                                        <?php echo $row['lote']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['saldo_file']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['saldo_ova']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['saldo_ovinha']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['saldo_uarini']; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- SALDO RECEBIMENTO POR LOTE -->

                    

                    <!-- Inclua esses links no <head> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


<!-- Tabela de Recebimento de Farinha -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabela de Recebimento de Farinha
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableRecebimento" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fornecedor</th>
                        <th>Lote</th>
                        <th>Data</th>
                        <th>Peso de Ova</th>
                        <th>Sacas de Ova</th>
                        <th>Peso de Torrada</th>
                        <th>Sacas de Torrada</th>
                        <th>Peso de Filé</th>
                        <th>Sacas de Filé</th>
                        <th>Total de Sacas</th>
                        <th>Peso Total (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recebimentoData as $item): ?>
                    <tr>
                        <td><?php echo $item['fornecedores']; ?></td>
                        <td><?php echo $item['lotes']; ?></td>
                        <td><?php echo $item['data']; ?></td>
                        <td><?php echo $item['peso_ova']; ?></td>
                        <td><?php echo $item['saca_ova']; ?></td>
                        <td><?php echo $item['peso_torrada']; ?></td>
                        <td><?php echo $item['saca_torrada']; ?></td>
                        <td><?php echo $item['peso_file']; ?></td>
                        <td><?php echo $item['saca_file']; ?></td>
                        <td><?php echo $item['total_sacas']; ?></td>
                        <td><?php echo $item['total_peso']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Tabela de Envio de Farinha -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Tabela de Envio de Farinha
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTableEnvio" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fornecedor</th>
                        <th>Lote</th>
                        <th>Data</th>
                        <th>Peso de Ova</th>
                        <th>Sacas de Ova</th>
                        <th>Peso de Torrada</th>
                        <th>Sacas de Torrada</th>
                        <th>Peso de Filé</th>
                        <th>Sacas de Filé</th>
                        <th>Total de Sacas</th>
                        <th>Peso Total (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($envioData as $item): ?>
                    <tr>
                        <td><?php echo $item['fornecedores']; ?></td>
                        <td><?php echo $item['lotes']; ?></td>
                        <td><?php echo $item['data']; ?></td>
                        <td><?php echo $item['peso_ova']; ?></td>
                        <td><?php echo $item['saca_ova']; ?></td>
                        <td><?php echo $item['peso_torrada']; ?></td>
                        <td><?php echo $item['saca_torrada']; ?></td>
                        <td><?php echo $item['peso_file']; ?></td>
                        <td><?php echo $item['saca_file']; ?></td>
                        <td><?php echo $item['total_sacas']; ?></td>
                        <td><?php echo $item['total_peso']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Inicialização do DataTables -->
<script>
    $(document).ready(function () {
        $('#dataTableEnvio').DataTable({
            "pageLength": 6, // Define linhas por página
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
            }
        });
        $('#dataTableRecebimento').DataTable({
            "pageLength": 6, 
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json"
            }
        });
    });
</script>



                    <!-- GRAFICO -->
                    <?php include 'corpo.php';?>
                    <!--fim  GRAFICO --> <br> <br><br>


                </div>
            </main>
            <?php include 'rodape.php';?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>