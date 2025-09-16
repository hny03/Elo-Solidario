$(function(){
    // Mascara para CNPJ
    $("#cnpj").on("input", function(){
        let value = $(this).val().replace(/\D/g, "");
        value = value.replace(/^(\d{2})(\d)/, "$1.$2");
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
        value = value.replace(/(\d{4})(\d)/, "$1-$2");
        $(this).val(value);
    });
    
    // Mascara para telefone
    $("#telefone").on("input", function(){
        let value = $(this).val().replace(/\D/g, "");
        if(value.length <= 10) {
            value = value.replace(/^(\d{2})(\d)/, "($1) $2");
            value = value.replace(/(\d{4})(\d)/, "$1-$2");
        } else {
            value = value.replace(/^(\d{2})(\d)/, "($1) $2");
            value = value.replace(/(\d{5})(\d)/, "$1-$2");
        }
        $(this).val(value);
    });
    
    // Validacao do formulario de cadastro
    $("#cadastroForm").submit(function(e){
        e.preventDefault(); // Impede o envio padrao do formulario
        
        const nomeOrganizacao = $("#nomeOrganizacao").val().trim();
        const cnpj = $("#cnpj").val().trim();
        const telefone = $("#telefone").val().trim();
        const email = $("#email").val().trim();
        const senha = $("#senha").val().trim();
        const nomeRepresentante = $("#nomeRepresentante").val().trim();
        const emailRepresentante = $("#emailRepresentante").val().trim();
        
        // Validacao basica dos campos obrigatorios
        if(nomeOrganizacao === "" || cnpj === "" || telefone === "" || 
           email === "" || senha === "" || nomeRepresentante === "" || 
           emailRepresentante === "") {
            alert("Por favor, preencha todos os campos!");
            return false;
        }
        
        // Validacao do CNPJ (formato basico)
        const cnpjLimpo = cnpj.replace(/\D/g, "");
        if(cnpjLimpo.length !== 14) {
            alert("CNPJ deve ter 14 digitos!");
            return false;
        }
        
        // Validacao do telefone
        const telefoneLimpo = telefone.replace(/\D/g, "");
        if(telefoneLimpo.length < 10 || telefoneLimpo.length > 11) {
            alert("Telefone deve ter 10 ou 11 digitos!");
            return false;
        }
        
        // Validacao do formato do email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email)) {
            alert("Por favor, insira um e-mail valido!");
            return false;
        }
        
        if(!emailRegex.test(emailRepresentante)) {
            alert("Por favor, insira um e-mail do representante valido!");
            return false;
        }
        
        // Validacao da senha (minimo 6 caracteres)
        if(senha.length < 6) {
            alert("A senha deve ter pelo menos 6 caracteres!");
            return false;
        }
        
<<<<<<< HEAD
        // Dados para envio ao backend
        const dadosCadastro = {
            nome_organizacao: nomeOrganizacao,
=======
        // Simulacao de cadastro bem-sucedido
        alert("Cadastro realizado com sucesso!");
        
        // Aqui seria feita a integracao com o backend
        console.log("Dados de cadastro:", {
            nomeOrganizacao: nomeOrganizacao,
>>>>>>> origin/maria
            cnpj: cnpjLimpo,
            telefone: telefoneLimpo,
            email: email,
            senha: senha,
<<<<<<< HEAD
            nome_representante: nomeRepresentante,
            email_representante: emailRepresentante
        };
        
        // Desabilita o botão de envio para evitar duplo clique
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.text();
        submitBtn.prop('disabled', true).text('Cadastrando...');
        
        // Envia dados para o backend
        $.ajax({
            url: '../backend/cadastro.php',
            method: 'POST',
            data: JSON.stringify(dadosCadastro),
            contentType: 'application/json',
            success: function(response) {
                alert("Cadastro realizado com sucesso! Você será redirecionado para a página de login.");
                
                // Limpa o formulário
                $("#cadastroForm")[0].reset();
                
                // Redireciona para a página de login após 1 segundo
                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 1000);
            },
            error: function(xhr, status, error) {
                let errorMessage = "Erro ao realizar cadastro. Tente novamente.";
                
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    console.error('Erro ao processar resposta:', e);
                }
                
                alert(errorMessage);
            },
            complete: function() {
                // Reabilita o botão de envio
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
        
        return false; // Impede o envio padrão do formulário
=======
            nomeRepresentante: nomeRepresentante,
            emailRepresentante: emailRepresentante
        });
        
        // Limpa o formulario apos o cadastro
        $("#cadastroForm")[0].reset();
        
        return true;
>>>>>>> origin/maria
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
<<<<<<< HEAD
=======

>>>>>>> origin/maria
