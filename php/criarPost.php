<?php
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["tituloCriarPost"];
    $localizacao = $_POST["localizacaoCriarPost"];
    $data = $_POST["dataCriarPost"];
    $horario = $_POST["horarioCriarPost"];
    $tipo = $_POST["tipoCriarPost"];
    $modalidade = $_POST["modalidadeCriarPost"];
    $contato = $_POST["contatoCriarPost"];
    $nomeOrganizacao = $_SESSION["usuario"]["nomeOrganizacao"];
    $id_usuario = $_SESSION["usuario"]["id"];

    try {
        $sql = "INSERT INTO posts (titulo, localizacao, data, horario, tipo, modalidade, id_usuario, contato
        descricao_curta, descricao_completa, meta_arrecadacao, valor_arrecadado, detalhes_voluntariado, causa_principal,
        nomeOrganizacao)
        VALUES (:titulo, :localizacao, :data, :horario, :tipo, :modalidade, :id_usuario, 
        :contato, :descricao_curta, :descricao_completa, :meta_arrecadacao, :valor_arrecadado,
        :detalhes_voluntariado, :causa_principal, :nomeOrganizacao)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":localizacao", $localizacao);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":horario", $horario);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":modalidade", $modalidade);
        $stmt->bindParam(":id_usuario", $id_usuario);
        $stmt->bindParam(":contato", $contato);
        $stmt->bindParam(":descricao_curta", $descricao_curta);
        $stmt->bindParam(":descricao_completa", $descricao_completa);
        $stmt->bindParam(":meta_arrecadacao", $meta_arrecadacao);
        $stmt->bindParam(":valor_arrecadado", $valor_arrecadado);
        $stmt->bindParam(":detalhes_voluntariado", $detalhes_voluntariado);
        $stmt->bindParam(":causa_principal", $causa_principal);
        $stmt->bindParam(":nomeOrganizacao", $nomeOrganizacao);
        
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