<?php
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_post = $_POST["idEditarPost"];
    $titulo = $_POST["tituloEditarPost"];
    $local = $_POST["localEditarPost"];
    $data = $_POST["dataEditarPost"];
    $horario = $_POST["horarioEditarPost"];
    $tipo = $_POST["tipoEditarPost"];
    $modalidade = $_POST["modalidadeEditarPost"];
    $id_usuario = $_SESSION["usuario"]["id"];

    try {
        $sql = "UPDATE posts SET 
                titulo = :titulo,
                local = :local,
                data = :data,
                horario = :horario,
                tipo = :tipo,
                modalidade = :modalidade
                WHERE id = :id AND id_usuario = :id_usuario";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":local", $local);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":horario", $horario);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":modalidade", $modalidade);
        $stmt->bindParam(":id", $id_post);
        $stmt->bindParam(":id_usuario", $id_usuario);
        
        if ($stmt->execute()) {
            header("Location: perfil.php");
            exit;
        } else {
            echo "Erro ao editar post";
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
    }
}
?>