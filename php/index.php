<?php
require_once 'conexao.php';

try {
    $sql = "SELECT * FROM anuncios ORDER BY data_criacao DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao carregar anúncios: " . $e->getMessage();
    $anuncios = [];
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elo Solidário - Conectando Causas</title>

    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!--CSS-->
    <link href="../css/index.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/header-footer.css">

</head>

<body>
    <!-- Navegação -->
    <div class="container-fluid">
        <header
            class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 shadow-bottom">

            <!-- Logo -->
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../imagens/EloSolidario.png" alt="Elo Solidário" class="img-fluid"
                        style="max-height: 60px;">
                </a>
            </div>

            <!-- Links centrais -->
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.html" class="nav-link px-2">Início</a></li>
                <li><a href="sobre-nos.html" class="nav-link px-2">Sobre nós</a></li>
            </ul>

            <!-- Link para entrar -->
            <div class="col-md-3 text-end">
                <ul class="nav justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link px-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Entre agora
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../php/login.php">Login</a></li>
                            <li><a class="dropdown-item" href="cadastro.html">Cadastro</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </header>
    </div>

    <main class="container my-5">
        <div class="row g-4">

            <?php foreach ($anuncios as $anuncio): ?>
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title"><?= htmlspecialchars($anuncio['titulo']) ?></h5>
                                    <p class="card-text">
                                        <?= htmlspecialchars($anuncio['descricao_curta']) ?>
                                    </p>
                                </div>
                                <div class="col-4 d-flex flex-column align-items-center text-center">
                                    <img src="<?= htmlspecialchars($anuncio['imagem_organizacao']) ?>"
                                        alt="Logo <?= htmlspecialchars($anuncio['nome_organizacao']) ?>"
                                        class="img-fluid mb-2" style="max-height: 200px;">
                                    <a href="#" class="btn btn-sm btn-outline-primary mb-2">Visualizar perfil</a>
                                </div>
                            </div>
                            <div class="mt-auto pt-3">
                                <div class="d-flex gap-2 mb-2">
                                    <span class="badge-doacao"><?= htmlspecialchars($anuncio['tipo_acao']) ?></span>
                                    <span class="badge-presencial"><?= htmlspecialchars($anuncio['modalidade']) ?></span>
                                </div>
                            </div>
                            <a href="#" class="stretched-link" data-bs-toggle="modal"
                                data-bs-target="#modalAnuncio<?= $anuncio['id'] ?>">
                                <i class="bi bi-arrows-fullscreen position-absolute bottom-0 end-0 p-3"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalAnuncio<?= $anuncio['id'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= htmlspecialchars($anuncio['titulo']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-4">
                                    <dl class="row">
                                        <dt class="col-sm-4"><i class="bi bi-building"></i> Organização:</dt>
                                        <dd class="col-sm-8"><?= htmlspecialchars($anuncio['nome_organizacao']) ?></dd>

                                        <dt class="col-sm-4"><i class="bi bi-heart"></i> Causa Principal:</dt>
                                        <dd class="col-sm-8"><?= htmlspecialchars($anuncio['causa_principal']) ?></dd>

                                        <dt class="col-sm-4"><i class="bi bi-geo-alt"></i> Localização:</dt>
                                        <dd class="col-sm-8"><?= htmlspecialchars($anuncio['localizacao']) ?></dd>
                                    </dl>
                                </div>
                                <hr>
                                <h6>Descrição:</h6>
                                <p><?= nl2br(htmlspecialchars($anuncio['descricao_completa'])) ?></p>
                            </div>
                            <div class="modal-footer">
                                <?php if ($anuncio['tipo_acao'] === 'Doação' && !empty($anuncio['contato'])): ?>
                                    <p class="mb-0"><strong>PIX para doação:
                                            <?= htmlspecialchars($anuncio['contato']) ?></strong></p>
                                <?php elseif ($anuncio['tipo_acao'] === 'Voluntariado' && !empty($anuncio['contato'])): ?>
                                    <p class="mb-0"><strong>Entre em contato:
                                            <?= htmlspecialchars($anuncio['contato']) ?></strong></p>
                                <?php endif; ?>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

<!-- Rodapé -->
<div class="container-fluid">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 border-top footer-orange">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1" aria-label="Bootstrap">
                <svg class="bi" width="30" height="24" aria-hidden="true">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">Elo Solidário © 2025</span>
        </div>


        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-body-secondary" href="#" aria-label="Instagram">
                    <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                        <img src="../imagens/instagram.png" alt="Elo Solidário" class="img-fluid"
                            style="max-height: 20px;">
                    </a>
                </a>
            </li>

            <li class="ms-3">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../imagens/facebook.png" alt="Elo Solidário" class="img-fluid" style="max-height: 20px;">
                </a>
            </li>
        </ul>

    </footer>
</div>

</html>