<?php
session_start();

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

// Função para verificar se o usuário é administrador
function checkAdmin($usuario, $senha) {
    global $conn;
    $query = "SELECT perfil FROM usuarios WHERE usuario = ? AND senha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['perfil'] === 'administrador';
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['user'];
    $senha = $_POST['password'];
    $response = ['success' => checkAdmin($usuario, $senha)];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Farinha</title>
        <link rel="icon" href="logo/logo.png" type="image/x-icon">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
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
                            <th>Usuário</th>
                            <th>Fornecedores</th>
                            <th>Número do romaneio</th>
                            <th>Data</th>
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
                        // Query para buscar os dados de envio
                        $sqlEnvio = "SELECT * FROM envio_farinha";
                        $resultEnvio = $conn->query($sqlEnvio);

                        if ($resultEnvio->num_rows > 0) {
                            while ($row = $resultEnvio->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['fornecedores']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['numero_romaneio']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['data']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['peso_ova']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['saca_ova']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['peso_torrada']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['saca_torrada']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['peso_file']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['saca_file']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lotes']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['quantidade_sacas']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['peso_total']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['observacoes']) . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary' onclick='showAuthModal(" . $row['id'] . ", \"update\")'>Atualizar</button> ";
                                echo "<button class='btn btn-danger' onclick='showAuthModal(" . $row['id'] . ", \"delete\")'>Deletar</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='15'>Nenhum dado encontrado.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Autenticação -->
    <div class="modal fade" id="modalAuth" tabindex="-1" role="dialog" aria-labelledby="modalAuthLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAuthLabel">Autenticação de Administrador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="authForm" method="post">
                        <input type="hidden" name="id" id="authId">
                        <input type="hidden" name="action" id="authAction">
                        <div class="form-group">
                            <label for="authUser">Usuário:</label>
                            <input type="text" class="form-control" id="authUser" name="user" required>
                        </div>
                        <div class="form-group">
                            <label for="authPassword">Senha:</label>
                            <input type="password" class="form-control" id="authPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Autenticar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showAuthModal(id, action) {
            $('#authId').val(id);
            $('#authAction').val(action);
            $('#modalAuth').modal('show');
        }

        $(document).ready(function() {
    $('#authForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: '', // Certifique-se de que isso é o mesmo arquivo PHP
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response && typeof response.success === 'boolean') {
                    if (response.success) {
                        alert('Usuário com o perfil de adm');
                        var action = $('#authAction').val();
                        var id = $('#authId').val();
                        if (action === 'update') {
                            window.location.href = 'update_page.php?id=' + id;
                        } else if (action === 'delete') {
                            window.location.href = 'delete_page.php?id=' + id;
                        }
                    } else {
                        alert('Usuário não tem perfil de adm');
                    }
                } else {
                    alert('Erro ao processar a resposta: resposta inesperada');
                }
            },
            error: function(xhr, status, error) {
                alert('Erro na requisição: ' + error);
            }
        });
    });
});

    </script>
</body>
</html>
