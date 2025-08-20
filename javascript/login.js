$(function(){
    // Validacao do formulario de login
    $("#loginForm").submit(function(e){
        e.preventDefault(); // Impede o envio padrao do formulario
        
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
        
        // Simulacao de login bem-sucedido
        alert("Login realizado com sucesso!");
        
        // Aqui seria feita a integracao com o backend
        // Por enquanto, apenas simula o redirecionamento
        console.log("Dados de login:", {
            email: email,
            senha: senha
        });
        
        // Limpa o formulario apos o "login"
        $("#loginForm")[0].reset();
        
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

