$(function(){
    // Mascara para CNPJ
    $("#cnpjEditarUsuario").on("input", function(){
        let value = $(this).val().replace(/\D/g, "");
        value = value.replace(/^(\d{2})(\d)/, "$1.$2");
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        value = value.replace(/\.(\d{3})(\d)/, ".$1/$2");
        value = value.replace(/(\d{4})(\d)/, "$1-$2");
        $(this).val(value);
    });
    
    // Mascara para telefone
    $("#telefoneEditarUsuario").on("input", function(){
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

    /* Preenche os inputs com os valores existentes */
    $("#infosUsuario").on("click", "[data-bs-target='#modalEditarUsuario']", function(){
        const usuario = $(this).closest("#infosUsuario");

        const dados = {
            nomeOrg: usuario.data("nomeOrg"),
            cnpj: usuario.data("cnpj"),
            telefone: usuario.data("telefone"),
            email: usuario.data("email"),
            senha: usuario.data("senha"),
            nomeRep: usuario.data("nomeRep"),
            emailRep: usuario.data("emailRep")
        }

        $("#nomeOrgEditarUsuario").val(dados.nomeOrg);
        $("#cnpjEditarUsuario").val(dados.cnpj);
        $("#telefoneEditarUsuario").val(dados.telefone);
        $("#emailEditarUsuario").val(dados.email);
        $("#senhaEditarUsuario").val(dados.senha);
        $("#nomeRepEditarUsuario").val(dados.nomeRep);
        $("#emailRepEditarUsuario").val(dados.emailRep);
    });

    /* Validação completa ao salvar */
    $("#modalEditarUsuario .btn-success").click(function(){
        const nomeOrg = $("#nomeOrgEditarUsuario").val().trim();
        const cnpj = $("#cnpjEditarUsuario").val().trim();
        const telefone = $("#telefoneEditarUsuario").val().trim();
        const email = $("#emailEditarUsuario").val().trim();
        const senha = $("#senhaEditarUsuario").val().trim();
        const nomeRep = $("#nomeRepEditarUsuario").val().trim();
        const emailRep = $("#emailRepEditarUsuario").val().trim();

        // Validação de campos vazios
        if(nomeOrg === "" || cnpj === "" || telefone === "" || 
           email === "" || senha === "" || nomeRep === "" || 
           emailRep === "") {
            alert("Campos marcados com (*) devem ser preenchidos!");
            return false;
        }

        // Validação do CNPJ
        const cnpjLimpo = cnpj.replace(/\D/g, "");
        if(cnpjLimpo.length !== 14) {
            alert("CNPJ deve ter 14 dígitos!");
            return false;
        }

        // Validação do telefone
        const telefoneLimpo = telefone.replace(/\D/g, "");
        if(telefoneLimpo.length < 10 || telefoneLimpo.length > 11) {
            alert("Telefone deve ter 10 ou 11 dígitos!");
            return false;
        }

        // Validação de email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!emailRegex.test(email)) {
            alert("Por favor, insira um e-mail válido!");
            return false;
        }

        if(!emailRegex.test(emailRep)) {
            alert("Por favor, insira um e-mail do representante válido!");
            return false;
        }

        // Validação da senha
        if(senha.length < 6) {
            alert("A senha deve ter pelo menos 6 caracteres!");
            return false;
        }

        // Se passou por todas as validações, salva
        salvarEdicao();
        $("#modalEditarUsuario .btn-secondary").click();
    });

    /* Limpa campos ao fechar modal */
    $("#modalEditarUsuario").on("hide.bs.modal", function(){
        $("#nomeOrgEditarUsuario").val("");
        $("#cnpjEditarUsuario").val("");
        $("#telefoneEditarUsuario").val("");
        $("#emailEditarUsuario").val("");
        $("#senhaEditarUsuario").val("");
        $("#nomeRepEditarUsuario").val("");
        $("#emailRepEditarUsuario").val("");
    });

    // Efeito visual nos campos
    $(".form-control").focus(function(){
        $(this).parent().addClass("focused");
    });
    
    $(".form-control").blur(function(){
        if($(this).val() === "") {
            $(this).parent().removeClass("focused");
        }
    });
});

function verificarSessao() {
    return $.ajax({
        url: '../backend/verificar_sessao.php',
        method: 'GET',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        error: function(xhr, status, error) {
            console.log('Status:', status);
            console.log('Erro:', error);
            console.log('Resposta:', xhr.responseText);
        }
    });
}

function salvarEdicao() {
    verificarSessao()
        .then(function(response) {
            console.log('Resposta da verificação:', response);
            
            if (!response.logado) {
                alert('Sessão não encontrada. Por favor, faça login novamente.');
                window.location.href = 'login.html';
                return;
            }

            // Se chegou aqui, usuário está logado
            const novosDados = {
                id: response.usuario_id,
                nome_organizacao: $("#nomeOrgEditarUsuario").val(),
                cnpj: $("#cnpjEditarUsuario").val(),
                telefone: $("#telefoneEditarUsuario").val(),
                email: $("#emailEditarUsuario").val(),
                nome_representante: $("#nomeRepEditarUsuario").val(),
                email_representante: $("#emailRepEditarUsuario").val()
            };

            // Continua com a atualização...
            atualizarDados(novosDados);
        })
        .catch(function(error) {
            console.error('Erro detalhado:', error);
            alert('Erro ao verificar sessão. Por favor, tente novamente ou faça login novamente.');
        });
}

function atualizarDados(dados) {
    $.ajax({
        url: '../backend/atualizar_usuario.php',
        method: 'POST',
        data: JSON.stringify(dados),
        contentType: 'application/json',
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            if(response.message && response.message.includes('sucesso')) {
                alert('Dados atualizados com sucesso!');
                // Chama a função atualizarInterface que foi definida na página de perfil
                if (typeof atualizarInterface === 'function') {
                    atualizarInterface(dados);
                } else {
                    // Fallback: atualiza manualmente se a função não estiver disponível
                    $('#nomeOrg').text(dados.nome_organizacao);
                    $('#cnpj').text(dados.cnpj);
                    $('#telefone').text(dados.telefone);
                    $('#email').text(dados.email);
                    $('#nomeRep').text(dados.nome_representante);
                    $('#emailRep').text(dados.email_representante);

                    // Atualiza os data attributes
                    $('#infosUsuario').attr({
                        'data-nome-org': dados.nome_organizacao,
                        'data-cnpj': dados.cnpj,
                        'data-telefone': dados.telefone,
                        'data-email': dados.email,
                        'data-nome-rep': dados.nome_representante,
                        'data-email-rep': dados.email_representante
                    });
                }
            } else {
                alert('Erro ao atualizar: ' + (response.message || 'Erro desconhecido'));
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na atualização:', error);
            let errorMessage = 'Erro ao atualizar dados. Por favor, tente novamente.';
            
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.message) {
                    errorMessage = response.message;
                }
            } catch (e) {
                console.error('Erro ao processar resposta de erro:', e);
            }
            
            alert(errorMessage);
        }
    });
}