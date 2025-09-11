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

    // Verifica se email e senha foram enviados
    if(!empty($data->email) && !empty($data->senha)) {
        // Define os valores do usuario
        $usuario->email = $data->email;
        $usuario->senha = $data->senha;

        // Tenta fazer login
        if($usuario->login()) {
            http_response_code(200);
            echo json_encode(array(
                "message" => "Login realizado com sucesso.",
                "usuario" => array(
                    "id" => $usuario->id,
                    "nome_organizacao" => $usuario->nome_organizacao,
                    "cnpj" => $usuario->cnpj,
                    "telefone" => $usuario->telefone,
                    "email" => $usuario->email,
                    "nome_representante" => $usuario->nome_representante,
                    "email_representante" => $usuario->email_representante
                )
            ));
        }
        // Credenciais invalidas
        else {
            http_response_code(401);
            echo json_encode(array("message" => "E-mail ou senha incorretos."));
        }
    }
    // Dados incompletos
    else {
        http_response_code(400);
        echo json_encode(array("message" => "E-mail e senha sao obrigatorios."));
    }
}
// Metodo nao permitido
else {
    http_response_code(405);
    echo json_encode(array("message" => "Metodo nao permitido."));
}
?>

