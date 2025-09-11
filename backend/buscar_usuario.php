<?php
// Headers para permitir CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Para ambiente de desenvolvimento (local)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

session_start();

// Inclui os arquivos necessários
include_once 'config.php';
include_once 'Usuario.php';

try {
    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
        http_response_code(401);
        echo json_encode([
            'status' => 'error',
            'message' => 'Usuário não está logado'
        ]);
        exit;
    }

    // Instancia o banco de dados e conecta
    $database = new Database();
    $db = $database->getConnection();

    // Instancia o objeto usuario
    $usuario = new Usuario($db);
    $usuario->id = $_SESSION['usuario_id'];

    // Busca os dados do usuário
    if ($usuario->buscarPorId()) {
        echo json_encode([
            'status' => 'success',
            'data' => [
                'id' => $usuario->id,
                'nome_organizacao' => $usuario->nome_organizacao,
                'cnpj' => $usuario->cnpj,
                'telefone' => $usuario->telefone,
                'email' => $usuario->email,
                'nome_representante' => $usuario->nome_representante,
                'email_representante' => $usuario->email_representante
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'status' => 'error',
            'message' => 'Usuário não encontrado'
        ]);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro interno do servidor: ' . $e->getMessage()
    ]);
}
?>

