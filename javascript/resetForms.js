$(function(){
    /* Apaga infos ao fechar modal de criação de post */
    $("#modalCriarPost").on("hide.bs.modal", function(){
        $("#tituloCriarPost").val("");
        $("#localCriarPost").val("");
        $("#dataCriarPost").val("");
        $("#horarioCriarPost").val("");
        $("#tipoCriarPost").val("-");
        $("#modalidadeCriarPost").val("-");
    });

    /* Apaga infos ao fechar modal de edição de post */
    $("#modalEditarPost").on("hide.bs.modal", function(){
        $("#tituloCriarPost").val("");
        $("#localCriarPost").val("");
        $("#dataCriarPost").val("");
        $("#horarioCriarPost").val("");
        $("#tipoCriarPost").val("-");
        $("#modalidadeCriarPost").val("-");
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

