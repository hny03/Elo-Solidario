$(function(){
    let idPostExcluir = null;
    
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
});