<?php
// Configuracao do banco de dados
class Database {
    private $host = 'sql204.infinityfree.com';
    private $db_name = 'if0_39911081_elo_solidario';
    private $username = 'if0_39911081';
    private $password = 'dL2ZaY7Ct1';
    private $conn;

    // Conecta ao banco de dados usando PDO
    public function getConnection() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro de conexao: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}
?>

