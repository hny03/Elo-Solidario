// Função para verificar autenticação do usuário na sessão
function verificarAutenticacao() {
    $.ajax({
        url: '../backend/verificar_sessao.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (!response.logado) {
                window.location.href = 'login.html';
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro ao verificar autenticação:', error);
        }
    });
}

// Sistema de navegação e controle de sessão
$(document).ready(function() {
    
    // Verifica se o usuário está logado
    function isLoggedIn() {
        return localStorage.getItem('userLoggedIn') === 'true';
    }
    
    // Faz login do usuário
    function loginUser(userData) {
        localStorage.setItem('userLoggedIn', 'true');
        localStorage.setItem('userData', JSON.stringify(userData));
        updateNavigation();
    }
    
    // Faz logout do usuário
    function logoutUser() {
        localStorage.removeItem('userLoggedIn');
        localStorage.removeItem('userData');
        updateNavigation();
        // Redireciona para a página inicial
        window.location.href = '../index.html';
    }
    
    // Atualiza a navegação baseada no status de login
    function updateNavigation() {
        const isLogged = isLoggedIn();
        const currentPage = window.location.pathname;
        
        // Determina o caminho correto baseado na página atual
        const isInRootPage = currentPage === '/' || currentPage.endsWith('index.html');
        const loginPath = isInRootPage ? 'html/login.html' : 'login.html';
        const cadastroPath = isInRootPage ? 'html/cadastro.html' : 'cadastro.html';
        const perfilPath = isInRootPage ? 'html/perfil.html' : 'perfil.html';
        const profileImgPath = isInRootPage ? 'img/profile.png' : '../img/profile.png';
        
        if (isLogged) {
            // Usuário logado - mostra menu de perfil
            $('.nav-login-section').html(`
                <li class="nav-item dropdown">
                    <a class="nav-link px-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="${profileImgPath}" alt="Perfil" class="img-fluid" style="max-height: 40px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="${perfilPath}">Meu Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger logout-btn" href="#">Sair</a></li>
                    </ul>
                </li>
            `);
        } else {
            // Usuário não logado - mostra opções de login/cadastro
            $('.nav-login-section').html(`
                <li class="nav-item dropdown">
                    <a class="nav-link px-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Entre agora
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="${loginPath}">Login</a></li>
                        <li><a class="dropdown-item" href="${cadastroPath}">Cadastro</a></li>
                    </ul>
                </li>
            `);
        }
    }
    
    // Protege páginas que requerem login
    function protectPage() {
        const currentPage = window.location.pathname;
        const protectedPages = ['/perfil.html', '/html/perfil.html'];
        
        if (protectedPages.some(page => currentPage.includes(page))) {
            if (!isLoggedIn()) {
                alert('Você precisa fazer login para acessar esta página!');
                window.location.href = 'login.html';
                return false;
            }
        }
        return true;
    }
    
    // Event listeners
    $(document).on('click', '.logout-btn', function(e) {
        e.preventDefault();
        if (confirm('Tem certeza que deseja sair?')) {
            logoutUser();
        }
    });
    
    // Corrige links das redes sociais
    $(document).on('click', 'a[aria-label="Instagram"]', function(e) {
        e.preventDefault();
        window.open('https://instagram.com', '_blank');
    });
    
    $(document).on('click', 'a[aria-label="Facebook"]', function(e) {
        e.preventDefault();
        window.open('https://facebook.com', '_blank');
    });
    
    // Inicializa a navegação
    updateNavigation();
    protectPage();
    
    // Verifica se está na página de perfil e requer autenticação
    if (window.location.href.includes('perfil.html')) {
        verificarAutenticacao();
    }
    
    // Expõe funções globalmente para uso em outros scripts
    window.NavigationSystem = {
        loginUser: loginUser,
        logoutUser: logoutUser,
        isLoggedIn: isLoggedIn,
        updateNavigation: updateNavigation
    };
});

