<?php
include 'config.php';

// Filtros
$dataInicio = isset($_POST['dataInicio']) ? $_POST['dataInicio'] : '';
$dataFim = isset($_POST['dataFim']) ? $_POST['dataFim'] : '';
$fornecedores = isset($_POST['fornecedores']) ? $_POST['fornecedores'] : '';
$lotes = isset($_POST['lotes']) ? $_POST['lotes'] : '';

// Função para executar consulta com filtros
function consultarDadosGrafico($table, $dataInicio, $dataFim, $fornecedores, $lotes) {
    global $conn;

    $sql = "SELECT fornecedores, lotes, data, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file, 
                   SUM(quantidade_sacas) as total_sacas, SUM(peso_total) as total_peso 
            FROM $table 
            WHERE 1=1";

    if (!empty($dataInicio)) {
        $sql .= " AND data >= '$dataInicio'";
    }
    if (!empty($dataFim)) {
        $sql .= " AND data <= '$dataFim'";
    }
    if (!empty($fornecedores)) {
        $sql .= " AND fornecedores LIKE '%$fornecedores%'";
    }
    if (!empty($lotes)) {
        $sql .= " AND lotes LIKE '%$lotes%'";
    }

    $sql .= " GROUP BY fornecedores, lotes, data, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file";
    $result = $conn->query($sql);

    $data = array();
    $totalSacas = 0;
    $totalPeso = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            $totalSacas += $row['total_sacas'];
            $totalPeso += $row['total_peso'];
        }
    }

    return array('data' => $data, 'totalSacas' => $totalSacas, 'totalPeso' => $totalPeso);
}

// Consulta os dados de envio de farinha com filtros
$envioResult = consultarDadosGrafico('envio_farinha', $dataInicio, $dataFim, $fornecedores, $lotes);
$envioData = $envioResult['data'];
$totalSacasEnviadas = $envioResult['totalSacas'];
$totalPesoEnviado = $envioResult['totalPeso'];

// Consulta os dados de recebimento de farinha com filtros
$recebimentoResult = consultarDadosGrafico('recebimento_farinha', $dataInicio, $dataFim, $fornecedores, $lotes);
$recebimentoData = $recebimentoResult['data'];
$totalSacasRecebidas = $recebimentoResult['totalSacas'];
$totalPesoRecebido = $recebimentoResult['totalPeso'];

// Calcula o saldo de farinhas
$saldoSacas = $totalSacasRecebidas - $totalSacasEnviadas;
$saldoPeso = $totalPesoRecebido - $totalPesoEnviado;

// Fechando a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Farinha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <style>
        .container-fluid {
            margin-left: 0;
        }
        #envioChart{
            height: 400px; /* Ajustado para melhor visualização */
        }
        #recebimentoChart{
            height: 400px; /* Ajustado para melhor visualização */
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <main>
        <!-- Gráficos -->
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Gráfico de Barras Horizontais - Envio de Farinha
                    </div>
                    <div class="card-body"><canvas id="envioChart"  width="20" height="20"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Gráfico de Pizza - Recebimento de Farinha
                    </div>
                    <div class="card-body"><canvas id="recebimentoChart"  width="20" height="20"></canvas></div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dados do PHP
            const envioData = <?php echo json_encode($envioData); ?>;
            const recebimentoData = <?php echo json_encode($recebimentoData); ?>;
            
            // Extrair dados para o gráfico de barras horizontais (Envio de Farinha)
            const envioLabels = envioData.map(data => data.data);
            const envioPesoOva = envioData.map(data => data.peso_ova);
            const envioSacaOva = envioData.map(data => data.saca_ova);
            const envioPesoTorrada = envioData.map(data => data.peso_torrada);
            const envioSacaTorrada = envioData.map(data => data.saca_torrada);
            const envioPesoFile = envioData.map(data => data.peso_file);
            const envioSacaFile = envioData.map(data => data.saca_file);
            
            // Extrair dados para o gráfico de pizza (Recebimento de Farinha)
            const totalSacasRecebidas = <?php echo $totalSacasRecebidas; ?>;
            const totalPesoRecebido = <?php echo $totalPesoRecebido; ?>;
            
            // Configuração do gráfico de barras horizontais (Envio de Farinha)
            const envioChartCtx = document.getElementById('envioChart').getContext('2d');
            new Chart(envioChartCtx, {
                type: 'bar', // Alterado para 'bar' ao invés de 'horizontalBar'
                data: {
                    labels: envioLabels,
                    datasets: [
                        {
                            label: 'Peso Ova',
                            data: envioPesoOva,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Saca Ova',
                            data: envioSacaOva,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Peso Torrada',
                            data: envioPesoTorrada,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Saca Torrada',
                            data: envioSacaTorrada,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Peso File',
                            data: envioPesoFile,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Saca File',
                            data: envioSacaFile,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Envio de Farinha'
                        }
                    }
                }
            });

            // Configuração do gráfico de pizza (Recebimento de Farinha)
            const recebimentoChartCtx = document.getElementById('recebimentoChart').getContext('2d');
            new Chart(recebimentoChartCtx, {
                type: 'pie',
                data: {
                    labels: ['Total de Sacas Recebidas', 'Total de Sacas Enviadas'],
                    datasets: [{
                        label: 'Recebimento de Farinha',
                        data: [totalSacasRecebidas, <?php echo $totalSacasEnviadas; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Recebimento de Farinha'
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
