$(function(){
    /* Preenche os inputs com os valores já existentes do Usuário quando abrir a edição */
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

    /* Valida edição de usuário */
    $("#modalEditarUsuario .btn-success").click(function(){
        const nomeOrg = $("#nomeOrgEditarUsuario").val();
        const cnpj = $("#cnpjEditarUsuario").val();
        const telefone = $("#telefoneEditarUsuario").val();
        const email = $("#emailEditarUsuario").val();
        const senha = $("#senhaEditarUsuario").val();
        const nomeRep = $("#nomeRepEditarUsuario").val();
        const emailRep = $("#emailRepEditarUsuario").val();

        /* Trata para padrão sem letras, pontuações ou espaços */
        let cnpjTratado = cnpj.replace(/\D/g, "");
        let telefoneTratado = telefone.replace(/\D/g, "");

        if(nomeOrg.trim() === "" || cnpj.trim() === "" || telefone.trim() === "" || 
           email.trim() === "" || senha.trim() === "" || nomeRep.trim() === "" ||
           emailRep.trim() === "") {
            alert("Campos marcados com (*) devem ser preenchidos!");
        } else if(cnpjTratado.length != 14) {
            alert("CNPJ inválido!");
        } else if(telefoneTratado.length != 10 && telefoneTratado.length != 11) {
            alert("Telefone inválido!");
        } else {
            salvarEdicao();
            $("#modalEditarUsuario .btn-secondary").click();
        }
    });

    /* Apaga infos ao fechar modal de edição de usuário */
    $("#modalEditarUsuario").on("hide.bs.modal", function(){
        $("#nomeOrgEditarUsuario").val("");
        $("#cnpjEditarUsuario").val("");
        $("#telefoneEditarUsuario").val("");
        $("#emailEditarUsuario").val("");
        $("#senhaEditarUsuario").val("");
        $("#nomeRepEditarUsuario").val("");
        $("#emailRepEditarUsuario").val("");
    });
});

function salvarEdicao() {
    const usuario = $("#infosUsuario");

    const novosDados = {
        nomeOrg: $("#nomeOrgEditarUsuario").val(),
        cnpj: $("#cnpjEditarUsuario").val(),
        telefone: $("#telefoneEditarUsuario").val(),
        email: $("#emailEditarUsuario").val(),
        senha: $("#senhaEditarUsuario").val(),
        nomeRep: $("#nomeRepEditarUsuario").val(),
        emailRep: $("#emailRepEditarUsuario").val()
    }

    usuario.find("#nomeOrg").text(novosDados.nomeOrg);
    usuario.find("#cnpj").text(novosDados.cnpj);
    usuario.find("#telefone").text(novosDados.telefone);
    usuario.find("#email").text(novosDados.email);
    usuario.find("#senha").text(novosDados.senha);
    usuario.find("#nomeRep").text(novosDados.nomeRep);
    usuario.find("#emailRep").text(novosDados.emailRep);

    usuario.data("nomeOrg", novosDados.nomeOrg);
    usuario.data("cnpj", novosDados.cnpj);
    usuario.data("telefone", novosDados.telefone);
    usuario.data("email", novosDados.email);
    usuario.data("senha", novosDados.senha);
    usuario.data("nomeRep", novosDados.nomeRep);
    usuario.data("emailRep", novosDados.emailRep);
}