<?php
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeOrg = $_POST["nomeOrgEditarUsuario"];
    $cnpj = $_POST["cnpjEditarUsuario"];
    $telefone = $_POST["telefoneEditarUsuario"];
    $email = $_POST["emailEditarUsuario"];
    $senha = $_POST["senhaEditarUsuario"];
    $nomeRep = $_POST["nomeRepEditarUsuario"];
    $emailRep = $_POST["emailRepEditarUsuario"];

    try {
        $id_usuario = $_SESSION["usuario"]["id"];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE usuarios SET 
                nomeOrganizacao = :nomeOrg,
                cnpj = :cnpj,
                telefone = :telefone,
                email = :email,
                senha_hash = :senha_hash,
                nomeRepresentante = :nomeRep,
                emailRepresentante = :emailRep
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":nomeOrg", $nomeOrg);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha_hash", $senha_hash);
        $stmt->bindParam(":nomeRep", $nomeRep);
        $stmt->bindParam(":emailRep", $emailRep);
        $stmt->bindParam(":id", $id_usuario);
        
        if ($stmt->execute()) {
            $_SESSION['usuario']['nomeOrganizacao'] = $nomeOrg;
            $_SESSION['usuario']['cnpj'] = $cnpj;
            $_SESSION['usuario']['telefone'] = $telefone;
            $_SESSION['usuario']['email'] = $email;
            $_SESSION['usuario']['senha_hash'] = $senha_hash;
            $_SESSION['usuario']['nomeRepresentante'] = $nomeRep;
            $_SESSION['usuario']['emailRepresentante'] = $emailRep;

            header("Location: perfil.php");
            exit;
        } else {
            echo "Erro ao editar usuario";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
}