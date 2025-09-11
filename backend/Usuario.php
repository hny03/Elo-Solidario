<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    // Propriedades do usuario
    public $id;
    public $nome_organizacao;
    public $cnpj;
    public $telefone;
    public $email;
    public $senha;
    public $nome_representante;
    public $email_representante;

    // Construtor com conexao do banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Cadastrar novo usuario
    public function cadastrar() {
        // Query para inserir usuario
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nome_organizacao=:nome_organizacao, 
                      cnpj=:cnpj, 
                      telefone=:telefone, 
                      email=:email, 
                      senha=:senha, 
                      nome_representante=:nome_representante, 
                      email_representante=:email_representante";

        // Prepara a query
        $stmt = $this->conn->prepare($query);

        // Limpa os dados
        $this->nome_organizacao = htmlspecialchars(strip_tags($this->nome_organizacao));
        $this->cnpj = htmlspecialchars(strip_tags($this->cnpj));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        $this->nome_representante = htmlspecialchars(strip_tags($this->nome_representante));
        $this->email_representante = htmlspecialchars(strip_tags($this->email_representante));

        // Bind dos valores
        $stmt->bindParam(":nome_organizacao", $this->nome_organizacao);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->bindParam(":nome_representante", $this->nome_representante);
        $stmt->bindParam(":email_representante", $this->email_representante);

        // Executa a query
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Login do usuario
    public function login() {
        // Query para buscar usuario por email
        $query = "SELECT id, nome_organizacao, cnpj, telefone, email, senha, nome_representante, email_representante 
                  FROM " . $this->table_name . " 
                  WHERE email = :email 
                  LIMIT 0,1";

        // Prepara a query
        $stmt = $this->conn->prepare($query);

        // Limpa o email
        $this->email = htmlspecialchars(strip_tags($this->email));

        // Bind do valor
        $stmt->bindParam(":email", $this->email);

        // Executa a query
        $stmt->execute();

        // Verifica se encontrou o usuario
        if($stmt->rowCount() > 0) {
            // Busca os dados do usuario
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica a senha
            if(password_verify($this->senha, $row['senha'])) {
                // Define as propriedades do usuario
                $this->id = $row['id'];
                $this->nome_organizacao = $row['nome_organizacao'];
                $this->cnpj = $row['cnpj'];
                $this->telefone = $row['telefone'];
                $this->email = $row['email'];
                $this->nome_representante = $row['nome_representante'];
                $this->email_representante = $row['email_representante'];
                
                return true;
            }
        }

        return false;
    }

    // Verificar se email ja existe
    public function emailExiste() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    // Verificar se CNPJ ja existe
    public function cnpjExiste() {
        $query = "SELECT id FROM " . $this->table_name . " WHERE cnpj = :cnpj LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $this->cnpj = htmlspecialchars(strip_tags($this->cnpj));
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    // Buscar usuario por ID
    public function buscarPorId() {
        $query = "SELECT id, nome_organizacao, cnpj, telefone, email, nome_representante, email_representante 
                  FROM " . $this->table_name . " 
                  WHERE id = :id 
                  LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $row['id'];
            $this->nome_organizacao = $row['nome_organizacao'];
            $this->cnpj = $row['cnpj'];
            $this->telefone = $row['telefone'];
            $this->email = $row['email'];
            $this->nome_representante = $row['nome_representante'];
            $this->email_representante = $row['email_representante'];
            
            return true;
        }
        return false;
    }

    // Atualizar usuario
    public function atualizar() {
        $query = "UPDATE " . $this->table_name . "
                  SET nome_organizacao = :nome_organizacao,
                      cnpj = :cnpj,
                      telefone = :telefone,
                      email = :email,
                      nome_representante = :nome_representante,
                      email_representante = :email_representante
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Limpa os dados
        $this->nome_organizacao = htmlspecialchars(strip_tags($this->nome_organizacao));
        $this->cnpj = htmlspecialchars(strip_tags($this->cnpj));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->nome_representante = htmlspecialchars(strip_tags($this->nome_representante));
        $this->email_representante = htmlspecialchars(strip_tags($this->email_representante));

        // Bind dos valores
        $stmt->bindParam(":nome_organizacao", $this->nome_organizacao);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->bindParam(":telefone", $this->telefone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":nome_representante", $this->nome_representante);
        $stmt->bindParam(":email_representante", $this->email_representante);
        $stmt->bindParam(":id", $this->id);

        // Executa a query
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}

