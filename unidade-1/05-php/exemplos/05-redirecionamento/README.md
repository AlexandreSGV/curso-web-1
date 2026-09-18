# 05 — POST seguido de redirecionamento

Siga as [instruções de execução](../) e abra [o formulário](http://localhost:8000/05-redirecionamento/index.html).

1. O [index.html](index.html) envia um nome fictício por POST.
2. O [processar.php](processar.php) lê o nome em `$_POST['nome']`.
3. Prepara `Location: confirmacao.php?nome=...` com status `303` e encerra o script.
4. O navegador faz GET para [confirmacao.php](confirmacao.php), que responde com uma mensagem HTML e status `200`.

`rawurlencode()` codifica o nome para a URL. A página final lê `$_GET['nome']` e apresenta o valor com `<?= $nome ?>`. Experimente um nome com espaço e acento.

Ative **Preservar registro/Preserve log** na aba **Rede/Network** para observar as duas requisições. Recarregar a página final repete o GET, sem reenviar o POST.

Comece pelo formulário e preencha um nome. O nome chega à página final pela URL; este exemplo não armazena dados.
