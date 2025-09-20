<?php
    session_start();

    $host = "sql204.infinityfree.com"; 
    $user = "if0_39911081";
    $pass = "dL2ZaY7Ct1";
    $dbname = "if0_39911081_elo_solidario";
    $charset = "utf8mb4"; 

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
        exit;
    }
?>