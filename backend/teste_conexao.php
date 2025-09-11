<?php
// Arquivo para testar a conexão com o banco de dados
header("Content-Type: application/json; charset=UTF-8");

// Inclui o arquivo de configuração
include_once 'config.php';

try {
    // Instancia o banco de dados e tenta conectar
    $database = new Database();
    $db = $database->getConnection();
    
    if ($db) {
        // Testa uma query simples
        $query = "SELECT 1 as teste";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo json_encode([
                "status" => "sucesso",
                "message" => "Conexão com o banco de dados estabelecida com sucesso!",
                "teste_query" => $result
            ]);
        } else {
            echo json_encode([
                "status" => "erro",
                "message" => "Conexão estabelecida, mas falha na query de teste"
            ]);
        }
    } else {
        echo json_encode([
            "status" => "erro",
            "message" => "Falha ao estabelecer conexão com o banco de dados"
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        "status" => "erro",
        "message" => "Erro na conexão: " . $e->getMessage()
    ]);
}
?>

