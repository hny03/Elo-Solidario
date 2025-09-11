<?php
// Headers para permitir CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Inclui os arquivos necessarios
include_once 'config.php';
include_once 'Usuario.php';

// Instancia o banco de dados e conecta
$database = new Database();
$db = $database->getConnection();

// Instancia o objeto usuario
$usuario = new Usuario($db);

// Verifica se eh uma requisicao POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados JSON enviados
    $data = json_decode(file_get_contents("php://input"));

    // Verifica se todos os campos obrigatorios foram enviados
    if(!empty($data->nome_organizacao) && 
       !empty($data->cnpj) && 
       !empty($data->telefone) && 
       !empty($data->email) && 
       !empty($data->senha) && 
       !empty($data->nome_representante) && 
       !empty($data->email_representante)) {

        // Define os valores do usuario
        $usuario->nome_organizacao = $data->nome_organizacao;
        $usuario->cnpj = $data->cnpj;
        $usuario->telefone = $data->telefone;
        $usuario->email = $data->email;
        $usuario->senha = $data->senha;
        $usuario->nome_representante = $data->nome_representante;
        $usuario->email_representante = $data->email_representante;

        // Verifica se o email ja existe
        if($usuario->emailExiste()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este e-mail ja esta cadastrado."));
        }
        // Verifica se o CNPJ ja existe
        else if($usuario->cnpjExiste()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este CNPJ ja esta cadastrado."));
        }
        // Tenta cadastrar o usuario
        else if($usuario->cadastrar()) {
            http_response_code(201);
            echo json_encode(array("message" => "Usuario cadastrado com sucesso."));
        }
        // Erro ao cadastrar
        else {
            http_response_code(503);
            echo json_encode(array("message" => "Nao foi possivel cadastrar o usuario."));
        }
    }
    // Dados incompletos
    else {
        http_response_code(400);
        echo json_encode(array("message" => "Dados incompletos. Preencha todos os campos obrigatorios."));
    }
}
// Metodo nao permitido
else {
    http_response_code(405);
    echo json_encode(array("message" => "Metodo nao permitido."));
}
?>

