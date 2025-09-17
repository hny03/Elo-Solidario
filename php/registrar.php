<?php

require_once 'conexao.php';
                    
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeOrganizacao = $_POST['nomeOrganizacao'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nomeRepresentante = $_POST['nomeRepresentante'];
    $emailRepresentante = $_POST['emailRepresentante'];

    try {

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (nomeOrganizacao, cnpj, telefone, email, senha_hash, nomeRepresentante, emailRepresentante) VALUES (:nomeOrganizacao, :cnpj, :telefone, :email, :senha_hash, :nomeRepresentante, :emailRepresentante)";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(':nomeOrganizacao', $nomeOrganizacao);
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha_hash', $senha_hash);
        $stmt->bindParam(':nomeRepresentante', $nomeRepresentante);
        $stmt->bindParam(':emailRepresentante', $emailRepresentante);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        }

        else {
            echo "Erro ao registrar usuario";
        }


    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
}



/*

CREATE TABLE usuarios(
	id INT AUTO_INCREMENT PRIMARY KEY, 
    nomeOrganizacao VARCHAR(100) NOT NULL,
    cnpj VARCHAR(100) NOT NULL,
    telefone VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE, 
    senha_hash VARCHAR(255) NOT NULL,
    nomeRepresentante VARCHAR(100) NOT NULL,
    emailRepresentante VARCHAR(100) NOT NULL
);

*/