$(function(){
    // Validacao do formulario de login
    $("#loginForm").submit(function(e){
        
        const email = $("#email").val().trim();
        const senha = $("#senha").val().trim();
        
        // Validacao basica dos campos
        if(email === "" || senha === "") {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
        
        // Validacao do formato do email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email)) {
            alert("Por favor, insira um e-mail valido!");
            return false;
        }
        
        
        return true;
    });
    
    // Adiciona efeito visual nos campos quando focados
    $(".form-control").focus(function(){
        $(this).parent().addClass("focused");
    });
    
    $(".form-control").blur(function(){
        if($(this).val() === "") {
            $(this).parent().removeClass("focused");
        }
    });
});

