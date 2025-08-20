$(function(){
    idPostEditar = null;
    
    /* Preenche os inputs com os valores já existentes do Post quando abrir a edição */
    $("#feedPost").on("click", "[data-bs-target='#modalEditarPost']", function(){
        const post = $(this).closest("[id^='post-']");

        idPostEditar = post.attr("id");

        const dados = {
            titulo: post.data("titulo"),
            local: post.data("local"),
            data: post.data("data"),
            horario: post.data("horario"),
            tipo: post.data("tipo"),
            modalidade: post.data("modalidade")
        }

        $("#tituloEditarPost").val(dados.titulo);
        $("#localEditarPost").val(dados.local);
        $("#dataEditarPost").val(dados.data);
        $("#horarioEditarPost").val(dados.horario);
        $("#tipoEditarPost").val(dados.tipo);
        $("#modalidadeEditarPost").val(dados.modalidade);
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
            salvarEdicao();
            $("#modalEditarPost .btn-secondary").click();
        }
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
});

function salvarEdicao() {
    if(!idPostEditar) {
        alert("Erro ao selecionar post para edição.");
        return;
    }

    const post = $(`#${idPostEditar}`);

    const novosDados = {
        titulo: $("#tituloEditarPost").val(),
        local: $("#localEditarPost").val(),
        data: $("#dataEditarPost").val(),
        horario: $("#horarioEditarPost").val(),
        tipo: $("#tipoEditarPost").val(),
        modalidade: $("#modalidadeEditarPost").val(),
    }

    const textoTipo = (novosDados.tipo === "trabalhoVoluntario") ? "Trabalho Voluntário" : "Doação";
    const textoModalidade = (novosDados.modalidade === "presencial") ? "Presencial" : "Remoto";

    post.find("#tituloPost").text(novosDados.titulo);
    post.find("#localPost").text(novosDados.local);
    post.find("#dataHorarioPost").text(`${novosDados.data} às ${novosDados.horario}`);
    post.find("#tipoPost").text(textoTipo).attr("class", novosDados.tipo);
    post.find("#modalidadePost").text(textoModalidade).attr("class", novosDados.modalidade);

    post.data("titulo", novosDados.titulo);
    post.data("local", novosDados.local);
    post.data("data", novosDados.data);
    post.data("horario", novosDados.horario);
    post.data("tipo", novosDados.tipo);
    post.data("modalidade", novosDados.modalidade);
}