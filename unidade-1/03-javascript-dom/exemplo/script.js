const formulario = document.querySelector("#formulario-atendimento");
const campoNome = document.querySelector("#nome");
const campoEspecialidade = document.querySelector("#especialidade");
const campoData = document.querySelector("#data");
const mensagem = document.querySelector("#mensagem-formulario");

console.log("JavaScript carregado. Formulário localizado:", formulario);

formulario.addEventListener("submit", function (evento) {
  evento.preventDefault();

  const nomeInformado = campoNome.value.trim();
  const especialidadeInformada = campoEspecialidade.value;
  const dataInformada = campoData.value;

  console.log("Valores lidos:", nomeInformado, especialidadeInformada, dataInformada);

  if (nomeInformado.length < 3 || especialidadeInformada === "" || dataInformada === "") {
    mensagem.textContent = "Informe um nome com pelo menos 3 letras, a especialidade e a data.";
    return;
  }

  mensagem.textContent = `Solicitação registrada para ${nomeInformado}: ${especialidadeInformada} em ${dataInformada}.`;
});
