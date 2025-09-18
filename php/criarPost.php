<?php
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["tituloCriarPost"];
    $local = $_POST["localCriarPost"];
    $data = $_POST["dataCriarPost"];
    $horario = $_POST["horarioCriarPost"];
    $tipo = $_POST["tipoCriarPost"];
    $modalidade = $_POST["modalidadeCriarPost"];
    $id_usuario = $_SESSION["usuario"]["id"];

    try {
        $sql = "INSERT INTO posts (titulo, local, data, horario, tipo, modalidade, id_usuario)
        VALUES (:titulo, :local, :data, :horario, :tipo, :modalidade, :id_usuario)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":local", $local);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":horario", $horario);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":modalidade", $modalidade);
        $stmt->bindParam(":id_usuario", $id_usuario);
        
        if ($stmt->execute()) {
          header("Location: perfil.php");
            exit;
        } else {
            echo "Erro ao criar post";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
}