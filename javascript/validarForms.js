$(function(){
    let idPostExcluir = null;

    /* Valida criação de post */
    $("#modalCriarPost .btn-success").click(function(){
        const titulo = $("#tituloCriarPost").val();
        const local = $("#localCriarPost").val();
        const data = $("#dataCriarPost").val();
        const horario = $("#horarioCriarPost").val();
        const tipo = $("#tipoCriarPost").val();
        const modalidade = $("#modalidadeCriarPost").val();

        const dadosPost = {
            titulo,
            local,
            data,
            horario,
            tipo,
            modalidade
        };

        if(titulo.trim() === "" || data.trim() === "" || horario.trim() === "" || 
            tipo.trim() === "-" || modalidade.trim() === "-") {
            alert("Campos marcados com (*) devem ser preenchidos!");
        } else {
            const novoPostHTML = criarPost(dadosPost);

            $("#feedPost").prepend(novoPostHTML);
            $("#modalCriarPost .btn-secondary").click();
        }
    });

    /* Valida edição de post */
    $("#modalEditarPost .btn-success").click(function(){
        const titulo = $("#tituloEditarPost").val();
        const data = $("#dataEditarPost").val();
        const horario = $("#horarioEditarPost").val();
        const tipo = $("#tipoEditarPost").val();
        const modalidade = $("#modalidadeEditarPost").val();

        if(titulo.trim() === "" || data.trim() === "" || horario.trim() === "" || 
            tipo.trim() === "-" || modalidade.trim() === "-") {
            alert("Campos marcados com (*) devem ser preenchidos!");
        } else {
            $("#modalEditarPost .btn-secondary").click();
        }
    });

    /* Valida exclusão de post */
    $("#feedPost").on("click", "[data-bs-target='#modalEditarPost']", function(){
        idPostExcluir = $(this).data("post-id");
    });

    $("#modalExcluirPost .btn-danger").click(function(){
        if(idPostExcluir) {
            $(`#${idPostExcluir}`).remove();
            idPostExcluir = null;
        }
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
            $("#modalEditarUsuario .btn-secondary").click();
        }
    });
});
