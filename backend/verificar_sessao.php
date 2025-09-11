<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Verifica se existe uma sessão ativa
if (isset($_SESSION['usuario_id']) && !empty($_SESSION['usuario_id'])) {
    echo json_encode([
        'status' => 'success',
        'logado' => true,
        'usuario_id' => $_SESSION['usuario_id']
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'logado' => false,
        'message' => 'Sessão não encontrada'
    ]);
}