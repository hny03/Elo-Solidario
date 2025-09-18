<?php
require_once 'conexao.php';

try {
    $id_usuario = $_SESSION["usuario"]["id"];

    $sql = "DELETE FROM usuarios
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(":id", $id_usuario);
    
    if ($stmt->execute()) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        echo "Erro ao excluir usuario";
    }
} catch (PDOException $e) {
    echo "Erro no banco de dados: " . $e->getMessage();
}