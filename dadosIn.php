<?php
include 'config.php';

session_start();

if (!isset($_SESSION['userid'])) { 
    header("Location: login.php");
    exit;
}
// Filtros
$dataInicio = isset($_POST['dataInicio']) ? $_POST['dataInicio'] : '';
$dataFim = isset($_POST['dataFim']) ? $_POST['dataFim'] : '';
$fornecedores = isset($_POST['fornecedores']) ? $_POST['fornecedores'] : '';
$lotes = isset($_POST['lotes']) ? $_POST['lotes'] : '';

// Função para executar consulta com filtros
function consultarDados($table, $dataInicio, $dataFim, $fornecedores, $lotes) {
    global $conn;

    $sql = "SELECT fornecedores, lotes, data, peso_ova, saca_ova, peso_torrada, saca_torrada, peso_file, saca_file, SUM(quantidade_sacas) as total_sacas, SUM(peso_total) as total_peso 
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
$envioResult = consultarDados('envio_farinha', $dataInicio, $dataFim, $fornecedores, $lotes);
$envioData = $envioResult['data'];
$totalSacasEnviadas = $envioResult['totalSacas'];
$totalPesoEnviado = $envioResult['totalPeso'];

// Consulta os dados de recebimento de farinha com filtros
$recebimentoResult = consultarDados('recebimento_farinha', $dataInicio, $dataFim, $fornecedores, $lotes);
$recebimentoData = $recebimentoResult['data'];
$totalSacasRecebidas = $recebimentoResult['totalSacas'];
$totalPesoRecebido = $recebimentoResult['totalPeso'];

// Calcula o saldo de farinhas
$saldoSacas = $totalSacasRecebidas - $totalSacasEnviadas;
$saldoPeso = $totalPesoRecebido - $totalPesoEnviado;

// Trazendo o peso e quantidade de cada saco por tipo de farinha
// Consulta SQL para obter os totais de cada tipo de farinha
// Função para obter totais de recebimento
function getTotalRecebido($conn) {
    $sql = "SELECT 
                SUM(peso_ova) AS total_peso_ova, 
                SUM(peso_file) AS total_peso_file, 
                SUM(peso_torrada) AS total_peso_torrada,
                SUM(saca_ova) AS total_saca_ova, 
                SUM(saca_file) AS total_saca_file, 
                SUM(saca_torrada) AS total_saca_torrada
            FROM recebimento_farinha";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return [
        'total_peso_ova' => 0,
        'total_peso_file' => 0,
        'total_peso_torrada' => 0,
        'total_saca_ova' => 0,
        'total_saca_file' => 0,
        'total_saca_torrada' => 0,
    ];
}

// Função para obter totais de envio
function getTotalEnviado($conn) {
    $sql = "SELECT 
                SUM(peso_ova) AS total_peso_ova, 
                SUM(peso_file) AS total_peso_file, 
                SUM(peso_torrada) AS total_peso_torrada,
                SUM(saca_ova) AS total_saca_ova, 
                SUM(saca_file) AS total_saca_file, 
                SUM(saca_torrada) AS total_saca_torrada
            FROM envio_farinha";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return [
        'total_peso_ova' => 0,
        'total_peso_file' => 0,
        'total_peso_torrada' => 0,
        'total_saca_ova' => 0,
        'total_saca_file' => 0,
        'total_saca_torrada' => 0,
    ];
}

// Obter totais de recebimento e envio
$recebido = getTotalRecebido($conn);
$enviado = getTotalEnviado($conn);

// Calcular os saldos
$saldoPesoOva = $recebido['total_peso_ova'] - $enviado['total_peso_ova'];
$saldoPesoFile = $recebido['total_peso_file'] - $enviado['total_peso_file'];
$saldoPesoTorrada = $recebido['total_peso_torrada'] - $enviado['total_peso_torrada'];
$saldoSacaOva = $recebido['total_saca_ova'] - $enviado['total_saca_ova'];
$saldoSacaFile = $recebido['total_saca_file'] - $enviado['total_saca_file'];
$saldoSacaTorrada = $recebido['total_saca_torrada'] - $enviado['total_saca_torrada'];
// Consulta de estoque empacotado
$sqlEmpacotamento = "SELECT SUM(quant_file) as quant_file, SUM(quant_ovinha) as quant_ovinha, SUM(quant_ova) as quant_ova, SUM(quant_uarini) as quant_uarini FROM empacotamento";
$resultEmpacotamento = $conn->query($sqlEmpacotamento);

if ($resultEmpacotamento->num_rows > 0) {
    $rowEmpacotamento = $resultEmpacotamento->fetch_assoc();
    $empacotadoFile = $rowEmpacotamento['quant_file'];
    $empacotadoOvinha = $rowEmpacotamento['quant_ovinha'];
    $empacotadoOva = $rowEmpacotamento['quant_ova'];
    $empacotadoUarini = $rowEmpacotamento['quant_uarini'];
} else {
    $empacotadoFile = 0;
    $empacotadoOvinha = 0;
    $empacotadoOva = 0;
    $empacotadoUarini = 0;
}


// Consulta de estoque embarcado
$sqlEmbarque = "SELECT SUM(quant_file) as quant_file, SUM(quant_ovinha) as quant_ovinha, SUM(quant_ova) as quant_ova, SUM(quant_uarini) as quant_uarini FROM embarque";
$resultEmbarque = $conn->query($sqlEmbarque);

if ($resultEmbarque->num_rows > 0) {
    $rowEmbarque = $resultEmbarque->fetch_assoc();
    $embarcadoFile = $rowEmbarque['quant_file'];
    $embarcadoOvinha = $rowEmbarque['quant_ovinha'];
    $embarcadoOva = $rowEmbarque['quant_ova'];
    $embarcadoUarini = $rowEmbarque['quant_uarini'];
} else {
    $embarcadoFile = 0;
    $embarcadoOvinha = 0;
    $embarcadoOva = 0;
    $embarcadoUarini = 0;
}

// Calcula os saldos
$saldoFile = $empacotadoFile - $embarcadoFile;
$saldoOvinha = $empacotadoOvinha - $embarcadoOvinha;
$saldoOva = $empacotadoOva - $embarcadoOva;
$saldoUarini = $empacotadoUarini - $embarcadoUarini;

function getSaldos($conn) {
    $sql = "
        SELECT 
            lote,
            SUM(quant_file) AS saldo_file,
            SUM(quant_ova) AS saldo_ova,
            SUM(quant_ovinha) AS saldo_ovinha,
            SUM(quant_uarini) AS saldo_uarini
        FROM (
            SELECT lote, quant_file, quant_ova, quant_ovinha, quant_uarini FROM empacotamento
            UNION ALL
            SELECT lote, -quant_file, -quant_ova, -quant_ovinha, -quant_uarini FROM embarque
        ) AS movimento
        GROUP BY lote
    ";

    $result = mysqli_query($conn, $sql);
    return $result;
}

$saldos = getSaldos($conn);

//saldo por recebimento
function getSaldos2($conn) {
    $sql = "
        SELECT 
            lotes,
            SUM(peso_file) AS saldo_peso_file,
            SUM(saca_file) AS saldo_saca_file,
            SUM(peso_ova) AS saldo_peso_ova,
            SUM(saca_ova) AS saldo_saca_ova,
            SUM(peso_torrada) AS saldo_peso_torrada,
            SUM(saca_torrada) AS saldo_saca_torrada
        FROM (
            SELECT lotes, peso_file, saca_file, peso_ova, saca_ova, peso_torrada, saca_torrada FROM recebimento_farinha
            UNION ALL
            SELECT lotes, -peso_file, -saca_file, -peso_ova, -saca_ova, -peso_torrada, -saca_torrada FROM envio_farinha
        ) AS movimento
        GROUP BY lotes
    ";

    $result = mysqli_query($conn, $sql);
    return $result;
}

$saldos2 = getSaldos2($conn);

$conn->close();
?>