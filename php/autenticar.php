<?php
    session_start();
    require_once 'conexao.php'; # Garante que a conexão seja carregada só uma vez
    
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    function verificaLogin($pdo, $email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            if (password_verify($senha, $usuario["senha_hash"])) {
                return $usuario;
            }
        }

        $_SESSION["erro_login"] = "Erro ao realizar login.";

        return false;
    }

    $usuario = verificaLogin($pdo, $email, $senha);

    if ($usuario) {
        # Armazena informações na sessão global
        $_SESSION["logado"] = true;
        $_SESSION["id_usuario"] = $usuario["id"];
        $_SESSION["nome_usuario"] = $usuario["nome"];

        header("Location: ../html/perfil.html"); # Redireciona o usuário para página de painel
        exit();
    } else {
        # Login incorreto
        header("Location: login.php?erro=1"); # Redireciona o usuário para página de login
        exit();
    }

   