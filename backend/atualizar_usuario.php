<?php
session_start(); // Iniciar sessão

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Adicionar OPTIONS
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Verificar se é uma requisição OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Verificar se usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Usuário não autenticado']);
    exit;
}

include_once 'config.php';
include_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

// Receber dados do POST
$data = json_decode(file_get_contents("php://input"));

// Verificar se o ID da sessão corresponde ao usuário sendo editado
if ($_SESSION['usuario_id'] != $data->id) {
    http_response_code(403);
    echo json_encode(['message' => 'Não autorizado a editar este usuário']);
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if(!empty($data->id) &&
       !empty($data->nome_organizacao) &&
       !empty($data->cnpj) &&
       !empty($data->telefone) &&
       !empty($data->email) &&
       !empty($data->nome_representante) &&
       !empty($data->email_representante)) {

        $usuario->id = $data->id;
        $usuario->nome_organizacao = $data->nome_organizacao;
        $usuario->cnpj = $data->cnpj;
        $usuario->telefone = $data->telefone;
        $usuario->email = $data->email;
        $usuario->nome_representante = $data->nome_representante;
        $usuario->email_representante = $data->email_representante;

        if($usuario->atualizar()) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Usuário atualizado com sucesso."
            ]);
        } else {
            http_response_code(503);
            echo json_encode([
                "status" => "error", 
                "message" => "Não foi possível atualizar o usuário."
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Dados incompletos."));
    }
} else {
    http_response_code(405);
    echo json_encode(array("message" => "Método não permitido."));
}
