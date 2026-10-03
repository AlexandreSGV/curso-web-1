const api = "../api/alunos.php";
const formulario = document.querySelector("#formulario");
const lista = document.querySelector("#alunos");
const modelo = document.querySelector("#linha-aluno");
const mensagem = document.querySelector("#mensagem");
const detalhes = document.querySelector("#detalhes");
const campos = ["nome", "email", "data_nascimento", "telefone"];

formulario.addEventListener("submit", salvarAluno);
document.querySelector("#cancelar").addEventListener("click", novoCadastro);
document.querySelector("#atualizar").addEventListener("click", listarAlunos);
listarAlunos();

function lerResposta(resposta) {
    if (!resposta.ok) {
        throw new Error(`A API respondeu com HTTP ${resposta.status}.`);
    }
    return resposta.json();
}

function mostrarErro(erro) {
    mensagem.textContent = "Não foi possível concluir a operação. " + erro.message;
    document.querySelector("#salvar").disabled = false;
}

function listarAlunos() {
    fetch(api)
        .then(lerResposta)
        .then(mostrarLista)
        .catch(mostrarErro);
}

function mostrarLista(alunos) {
    lista.textContent = "";
    document.querySelector("#total").textContent = alunos.length;
    document.querySelector("#lista-vazia").hidden = alunos.length > 0;

    for (const aluno of alunos) {
        // Copia a linha definida no HTML e preenche suas células.
        const linha = modelo.content.cloneNode(true);
        linha.querySelector("[data-campo='id']").textContent = aluno.id;
        for (const campo of campos) {
            linha.querySelector(`[data-campo='${campo}']`).textContent = aluno[campo];
        }
        for (const botao of linha.querySelectorAll("button")) {
            botao.dataset.id = aluno.id;
        }
        linha.querySelector("[data-acao='ver']").addEventListener("click", verAluno);
        linha.querySelector("[data-acao='editar']").addEventListener("click", editarAluno);
        linha.querySelector("[data-acao='excluir']").addEventListener("click", excluirAluno);
        lista.append(linha);
    }
}

function salvarAluno(evento) {
    evento.preventDefault();
    const aluno = {};
    for (const campo of campos) {
        aluno[campo] = formulario.elements[campo].value;
    }

    const id = formulario.elements["id"].value;
    let url = api;
    let metodo = "POST";
    if (id !== "") {
        url = api + "?id=" + id;
        metodo = "PUT";
    }

    document.querySelector("#salvar").disabled = true;
    mensagem.textContent = "Salvando...";
    fetch(url, {
        method: metodo,
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(aluno)
    })
        .then(lerResposta)
        .then(concluirOperacao)
        .catch(mostrarErro);
}

function verAluno(evento) {
    const id = evento.currentTarget.dataset.id;
    fetch(api + "?id=" + id)
        .then(lerResposta)
        .then(mostrarDetalhes)
        .catch(mostrarErro);
}

function mostrarDetalhes(aluno) {
    document.querySelector("#detalhe-id").textContent = aluno.id;
    for (const campo of campos) {
        detalhes.querySelector(`[data-campo='${campo}']`).textContent = aluno[campo];
    }
    detalhes.hidden = false;
    detalhes.scrollIntoView();
}

function editarAluno(evento) {
    const id = evento.currentTarget.dataset.id;
    fetch(api + "?id=" + id)
        .then(lerResposta)
        .then(preencherFormulario)
        .catch(mostrarErro);
}

function preencherFormulario(aluno) {
    formulario.elements["id"].value = aluno.id;
    for (const campo of campos) {
        formulario.elements[campo].value = aluno[campo];
    }
    document.querySelector("#titulo-formulario").textContent = "Editar aluno " + aluno.id;
    detalhes.hidden = true;
    formulario.elements["nome"].focus();
}

function excluirAluno(evento) {
    const id = evento.currentTarget.dataset.id;
    if (!confirm("Excluir o aluno " + id + "?")) {
        return;
    }
    fetch(api + "?id=" + id, { method: "DELETE" })
        .then(lerResposta)
        .then(concluirOperacao)
        .catch(mostrarErro);
}

function concluirOperacao(resposta) {
    novoCadastro();
    mensagem.textContent = resposta.mensagem;
    listarAlunos();
}

function novoCadastro() {
    formulario.reset();
    formulario.elements["id"].value = "";
    document.querySelector("#titulo-formulario").textContent = "Cadastrar aluno";
    document.querySelector("#salvar").disabled = false;
    detalhes.hidden = true;
}
