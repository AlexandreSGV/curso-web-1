# 05 — POST seguido de redirecionamento

Siga as [instruções de execução](../) e abra [o formulário](http://localhost:8000/05-redirecionamento/index.html).

1. O [index.html](index.html) envia um nome fictício por POST.
2. O [processar.php](processar.php) verifica o método e rejeita um nome vazio com `400`.
3. Se o nome for válido, prepara `Location: confirmacao.php?nome=...` com status `303` e encerra o script.
4. O navegador faz GET para [confirmacao.php](confirmacao.php), que responde com uma mensagem HTML e status `200`.

`rawurlencode()` codifica o nome para a URL. `htmlspecialchars()` permite apresentá-lo como texto no HTML. Experimente um nome com espaço e acento.

Ative **Preservar registro/Preserve log** na aba **Rede/Network** para observar as duas requisições. Recarregar a página final repete o GET, sem reenviar o POST.

Este exemplo não salva dados nem realiza autenticação. O nome está na URL e pode ser alterado; a página final apenas apresenta o valor recebido. Acesse a página sem o parâmetro para ver o nome padrão `Visitante`.
