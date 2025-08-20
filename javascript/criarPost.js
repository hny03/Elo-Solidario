function criarPost(dadosPost) {
    const postID = `post-${Date.now()}`;

    let classeTipo = dadosPost.tipo;
    let textoTipo = (dadosPost.tipo === "trabalhoVoluntario") ? "Trabalho Voluntário" : "Doação";

    let classeModalidade = dadosPost.modalidade;
    let textoModalidade = (dadosPost.modalidade === "presencial") ? "Presencial" : "Remoto";

    const dataTratado = dadosPost.data.split("/");
    const dataInput = `${dataTratado[2]}-${dataTratado[1]}-${dataTratado[0]}`;

    const postHTML = `
        <section id="${postID}" class="containerPost mb-3" 
            id="${postID}" 
            data-titulo="${dadosPost.titulo}" 
            data-local="${dadosPost.local}" 
            data-data="${dadosPost.data}" 
            data-horario="${dadosPost.horario}" 
            data-tipo="${dadosPost.tipo}" 
            data-modalidade="${dadosPost.modalidade}">
            <div class="row p-3 pb-0">
                <div class="col-lg-6">
                <h2 id="tituloPost">${dadosPost.titulo}</h2>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="../imagens/local.png" width="20" height="20">
                        </div>
                        <div class="col-lg-10">
                            <p id="localPost">${dadosPost.local}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <img src="../imagens/relogio.png" width="20" height="20">
                        </div>
                        <div class="col-lg-10">
                            <p id="dataHorarioPost">${dadosPost.data} às ${dadosPost.horario}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p id="tipoPost" class="${classeTipo}">${textoTipo}</p>
                    <p id="modalidadePost" class="${classeModalidade}">${textoModalidade}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 offset-lg-11">
                    <button type="button" class="btn btn-secondary transparentButton p-0 mb-2 ms-2" 
                        data-bs-toggle="modal" data-bs-target="#modalEditarPost" data-post-id="${postID}">
                        <img src="../imagens/ampliar.png" width="25" height="25">
                    </button>
                </div>
            </div>
        </section>
        `

    return postHTML;
}