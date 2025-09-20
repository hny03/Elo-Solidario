<?php
    require_once 'conexao.php';

    if (isset($_SESSION["usuario"]["id"])) {
        $id_usuario = $_SESSION["usuario"]["id"];
        
        try {
            $sql = "SELECT * FROM posts WHERE id_usuario = :id_usuario ORDER BY id DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id_usuario", $id_usuario);
            $stmt->execute();
            
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["postsUsuario"] = $posts;
        } catch (PDOException $e) {
            echo "Erro ao carregar posts: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Página de Perfil</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
            4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/header-footer.css">

    <!-- Sistema de navegação -->
    <script src="../javascript/navigation.js"></script>

    <script>
        // Passar os dados da sessão para o JavaScript
        var postsData = <?php echo json_encode($_SESSION["postsUsuario"]); ?>;
    </script>

    <!-- JavaScript -->
    <script src="../javascript/criarPost.js"></script>
    <script src="../javascript/editarPost.js"></script>
    <script src="../javascript/editarUsuario.js"></script>
    <script src="../javascript/excluirPost.js"></script>
</head>

<body>
    <!--Navegação Perfil-->
    <header class="shadow-bottom">
        <div class="header-content d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
            <!-- Logo -->
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="../imagens/EloSolidario.png" alt="Elo Solidário" class="img-fluid" style="max-height: 60px;">
                </a>
            </div>

            <!-- Links centrais -->
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2">Início</a></li>
                <li><a href="sobre-nos.html" class="nav-link px-2 ">Sobre nós</a></li>
            </ul>

            <!-- Link para entrar -->
            <div class="col-md-3 text-end">
                <ul class="nav justify-content-end nav-login-section">
                    <li class="nav-item dropdown">
                        <a class="nav-link px-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="../imagens/profile.png" alt="Perfil" class="img-fluid" style="max-height: 40px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="perfil.php">Meu Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger logout-btn" href="#">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid p-5">
        <div class="row g-5">
            <main class="col-lg-9">
                <div class="row">
                    <div class="col-lg-10">
                        <h1>PUBLICAÇÕES</h1>
                    </div>
                    <div class="col-lg-2">
                        <button type="button" class="btn btn-success criarButton p-0 ps-2 pe-2 ms-4"
                            data-bs-toggle="modal" data-bs-target="#modalCriarPost">+ Criar</button>
                    </div>
                </div>

                <section id="feedPost">
                    <?php foreach ($_SESSION["postsUsuario"] as $post): ?>
                        <?php $classeTipo = ($post["tipo"] === "trabalhoVoluntario") ? "trabalhoVoluntario" : "doacao"; ?>
                        <?php $classeModalidade = ($post["modalidade"] === "presencial") ? "presencial" : "remoto"; ?>
                        <?php $tipo = ($post["tipo"] === "trabalhoVoluntario") ? "Trabalho Voluntário" : "Doação" ?>
                        <?php $modalidade = ($post["modalidade"] === "presencial") ? "Presencial" : "Remoto" ?>
                        <section id=<?= $post["id"] ?> class="containerPost mb-3">
                            <div class="row p-3 pb-0">
                                <div class="col-lg-6">
                                    <h2 id="tituloPost"> <?= $post["titulo"] ?> </h2>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <img src="../imagens/local.png" width="20" height="20">
                                        </div>
                                        <div class="col-lg-10">
                                            <p id="localizacaoPost"> <?= $post["localizacao"] ?> </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <img src="../imagens/relogio.png" width="20" height="20">
                                        </div>
                                        <div class="col-lg-10">
                                            <p id="dataHorarioPost"> <?= $post["data"] ?> às <?= $post["horario"] ?> </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <p id="tipoPost" class= <?= $classeTipo ?> > <?= $tipo ?> </p>
                                    <p id="modalidadePost" class= <?= $classeModalidade ?> > <?= $modalidade ?> </p>
                                </div>
                                <div class="col-lg-3">
                                    <p id="contatoPost"> <?= $post["contato"] ?> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-1 offset-lg-11">
                                    <button type="button" class="btn btn-secondary transparentButton p-0 mb-2 ms-2" 
                                        data-bs-toggle="modal" data-bs-target="#modalEditarPost"
                                        data-post-id="<?= $post["id"] ?>">
                                        <img src="../imagens/ampliar.png" width="25" height="25">
                                    </button>
                                </div>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </section>
            </main>

            <aside id="infosUsuario" class="col-lg-3 p-3 containerInfosUsuario">
                <div class="row pe-4">
                    <div class="offset-lg-10 col-lg-2">
                        <button type="button" class="btn btn-secondary transparentButton p-1 ms-3"
                            data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">
                            <img src="../imagens/lapis.png" width="25" height="25">
                        </button>
                    </div>
                </div>
                <div>
                    <p class="infosUsuarioLabel">Nome da Organização</p>
                    <p id="nomeOrg" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["nomeOrganizacao"]) ?>
                    </p>
                </div>
                <div>
                    <p class="infosUsuarioLabel">CNPJ</p>
                    <p id="cnpj" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["cnpj"]) ?>
                    </p>
                </div>
                <div>
                    <p class="infosUsuarioLabel">Telefone</p>
                    <p id="telefone" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["telefone"]) ?>
                    </p>
                </div>
                <div>
                    <p class="infosUsuarioLabel">E-mail</p>
                    <p id="email" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["email"]) ?>
                    </p>
                </div>
                <div>
                    <p class="infosUsuarioLabel">Nome Representante</p>
                    <p id="nomeRep" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["nomeRepresentante"]) ?>
                    </p>
                </div>
                <div>
                    <p class="infosUsuarioLabel">E-mail Representante</p>
                    <p id="emailRep" class="infosUsuarioValue">
                        <?= htmlspecialchars($_SESSION["usuario"]["emailRepresentante"]) ?>
                    </p>
                </div>
                <div class="row pe-4">
                    <div class="offset-lg-10 col-lg-2">
                        <button type="button" class="btn btn-secondary transparentButton p-1 ms-3"
                            data-bs-toggle="modal" data-bs-target="#modalExcluirUsuario">
                            <img src="../imagens/lixeira.png" width="25" height="25">
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modalCriarPost">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Post</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formCriarPost" method="POST" action="criarPost.php">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder=""
                            name="tituloCriarPost" id="id_tituloCriarPost">
                            <label for="id_tituloCriarPost">Título Post (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder=""
                            name="localizacaoCriarPost" id="id_localizacaoCriarPost">
                            <label for="id_localizacaoCriarPost">Local</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" placeholder=""
                            name="dataCriarPost" id="id_dataCriarPost">
                            <label for="id_dataCriarPost">Data (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" placeholder=""
                            name="horarioCriarPost" id="id_horarioCriarPost">
                            <label for="id_horarioCriarPost">Horário (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="tipoCriarPost" id="id_tipoCriarPost">
                                <option selected>-</option>
                                <option value="trabalhoVoluntario">Trabalho Voluntário</option>
                                <option value="doacao">Doação</option>
                            </select>
                            <label for="id_tipoCriarPost">Tipo (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="modalidadeCriarPost" id="id_modalidadeCriarPost">
                                <option selected>-</option>
                                <option value="presencial">Presencial</option>
                                <option value="remoto">Remoto</option>
                            </select>
                            <label for="id_modalidadeCriarPost">Modalidade (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder=""
                            name="contatoCriarPost" id="id_contatoCriarPost">
                            <label for="id_contatoCriarPost">Contato</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formCriarPost">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarPost">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Post</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarPost" method="POST" action="editarPost.php">
                        <input type="hidden" name="idEditarPost" id="id_editarPost" value="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder=""
                            name="tituloEditarPost" id="id_tituloEditarPost">
                            <label for="id_tituloEditarPost">Título Post (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder=""
                            name="localEditarPost" id="id_localEditarPost">
                            <label for="id_localEditarPost">Local</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" placeholder=""
                            name="dataEditarPost" id="id_dataEditarPost">
                            <label for="id_dataEditarPost">Data (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" placeholder=""
                            name="horarioEditarPost" id="id_horarioEditarPost">
                            <label for="id_horarioEditarPost">Horário (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="tipoEditarPost" id="id_tipoEditarPost">
                                <option selected>-</option>
                                <option value="trabalhoVoluntario">Trabalho Voluntário</option>
                                <option value="doacao">Doação</option>
                            </select>
                            <label for="id_tipoEditarPost">Tipo (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="modalidadeEditarPost" id="id_modalidadeEditarPost">
                                <option selected>-</option>
                                <option value="presencial">Presencial</option>
                                <option value="remoto">Remoto</option>
                            </select>
                            <label for="id_modalidadeEditarPost">Modalidade (*)</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger me-auto" 
                    data-bs-toggle="modal" data-bs-target="#modalExcluirPost"
                    form="formEditarPost">Excluir Post</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formEditarPost">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExcluirPost">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Post</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>ATENÇÃO!</p>
                    <p>Você deseja excluir seu post? Esta ação não pode ser desfeita.</p>
                    <form id="formExcluirPost" method="POST" action="excluirPost.php">
                        <input type="hidden" name="excluirPost" id="id_excluirPost" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger" form="formExcluirPost">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarUsuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuário</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditarUsuario" method="POST" action="editarUsuario.php">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="nomeOrgEditarUsuario" id="id_nomeOrgEditarUsuario"
                            value="<?= htmlspecialchars($_SESSION['usuario']['nomeOrganizacao'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_nomeOrgEditarUsuario">Nome da Organização (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="cnpjEditarUsuario" id="id_cnpjEditarUsuario"
                            value="<?= htmlspecialchars($_SESSION['usuario']['cnpj'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_cnpjEditarUsuario">CNPJ (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="telefoneEditarUsuario" id="id_telefoneEditarUsuario"
                            value = "<?= htmlspecialchars($_SESSION['usuario']['telefone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_telefoneEditarUsuario">Telefone (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="emailEditarUsuario" id="id_emailEditarUsuario"
                            value="<?= htmlspecialchars($_SESSION['usuario']['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_emailEditarUsuario">E-mail (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="" required
                            name="senhaEditarUsuario" id="id_senhaEditarUsuario">
                            <label for="id_senhaEditarUsuario">Senha (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="nomeRepEditarUsuario" id="id_nomeRepEditarUsuario"
                            value="<?= htmlspecialchars($_SESSION['usuario']['nomeRepresentante'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_nomeRepEditarUsuario">Nome Representante (*)</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="" required
                            name="emailRepEditarUsuario" id="id_emailRepEditarUsuario"
                            value="<?= htmlspecialchars($_SESSION['usuario']['emailRepresentante'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <label for="id_emailRepEditarUsuario">E-mail Representante (*)</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" form="formEditarUsuario">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExcluirUsuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Usuário</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>ATENÇÃO!</p>
                    <p>Você deseja excluir seu usuário? Esta ação não pode ser desfeita.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                    onclick="window.location.href='excluirUsuario.php'">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</body>

 <!-- Rodapé -->
    <footer class="footer-orange">
        <div class="footer-content d-flex flex-wrap justify-content-between align-items-center py-3">
            <div class="col-md-4 d-flex align-items-center">
                <span class="mb-3 mb-md-0">Elo Solidário © 2025</span>
            </div>

            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3">
                    <a href="#" aria-label="Instagram">
                        <img src="../imagens/instagram.png" alt="Elo Solidário" class="img-fluid"
                            style="max-height: 20px;">
                    </a>
                </li>

                <li class="ms-3">
                    <a href="#" aria-label="Facebook">
                        <img src="../imagens/facebook.png" alt="Elo Solidário" class="img-fluid" 
                            style="max-height: 20px;">
                    </a>
                </li>
            </ul>
        </div>
    </footer>
</html>