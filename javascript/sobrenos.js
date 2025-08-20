$(function(){
    // Animacao suave para rolagem quando clicar em links internos
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        const target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 600);
        }
    });
    
    // Efeito de fade-in nas secoes quando aparecem na tela
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                $(entry.target).addClass('fade-in');
            }
        });
    }, observerOptions);
    
    // Observa todas as secoes de conteudo
    $('.content-section').each(function() {
        observer.observe(this);
    });
    
    // Adiciona classe CSS para animacao de fade-in
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .content-section {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            .content-section.fade-in {
                opacity: 1;
                transform: translateY(0);
            }
        `)
        .appendTo('head');
    
    // Efeito hover nos icones sociais
    $('.social-icon').hover(
        function() {
            $(this).css('transform', 'scale(1.2)');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );
    
    // Responsividade do menu mobile
    $('.navbar-toggler').click(function() {
        $('.navbar-collapse').toggleClass('show');
    });
    
    // Fecha o menu mobile quando clicar em um link
    $('.nav-link').click(function() {
        if ($(window).width() < 992) {
            $('.navbar-collapse').removeClass('show');
        }
    });
});

