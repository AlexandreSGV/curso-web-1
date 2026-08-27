# Tutorial de Git, GitHub e entrega das atividades

Este tutorial apresenta somente o necessário para organizar e entregar as atividades de **Web 1** e **Web 2**.

Você criará **um repositório por disciplina no início do semestre**. Depois, usará o mesmo repositório em todas as atividades.

Você não precisará trabalhar com branches, pull requests, rebase ou outros recursos avançados.

## Quatro palavras importantes

- **Repositório:** pasta do projeto acompanhada pelo Git.
- **Commit:** registro de uma versão do seu trabalho.
- **Push:** envia seus commits do computador para o GitHub.
- **Pull:** traz para o computador as alterações que estão no GitHub.

## Parte 1 — preparação feita uma única vez

### 1. Verifique se o Git está funcionando

Abra o terminal indicado para sua disciplina — **CMD** em Web 1 ou **Ubuntu/WSL** em Web 2 — e execute:

```bash
git --version
```

Deve aparecer uma versão do Git. Se o comando não for encontrado, siga primeiro o material de preparação do ambiente da disciplina.

### 2. Configure seu nome e e-mail

Esta configuração precisa ser feita apenas uma vez em cada ambiente.

```bash
git config --global user.name "Seu Nome Completo"
git config --global user.email "seu-email@example.com"
```

Use preferencialmente o mesmo e-mail cadastrado na sua conta do GitHub.

Exemplo:

```bash
git config --global user.name "Maria da Silva"
git config --global user.email "maria@email.com"
```

### 3. Crie o repositório no GitHub

Entre em [github.com](https://github.com) e siga estes passos:

1. clique no botão **+**, no canto superior da página;
2. escolha **New repository**;
3. informe o nome do repositório:
   - Web 1: `atividades-web1-nome-sobrenome`;
   - Web 2: `atividades-web2-nome-sobrenome`;
4. selecione **Private**;
5. marque a opção **Add a README file**;
6. clique em **Create repository**.

Exemplo:

```text
atividades-web1-maria-silva
```

O repositório deve ser criado somente uma vez. Não crie outro repositório para cada atividade.

### 4. Adicione o professor como colaborador

Dentro do repositório criado:

1. abra **Settings**;
2. no menu de acesso, abra **Collaborators**;
3. clique em **Add people**;
4. procure pelo usuário:

```text
AlexandreSGV
```

5. confirme o convite.

Isso permite que o professor acesse o repositório privado para corrigir as atividades.

### 5. Copie o endereço do repositório

Na página principal do repositório:

1. clique no botão **Code**;
2. mantenha a opção **HTTPS** selecionada;
3. copie o endereço apresentado.

O endereço será parecido com:

```text
https://github.com/SEU-USUARIO/atividades-web1-nome-sobrenome.git
```

### 6. Clone o repositório

**Clonar** significa baixar o repositório do GitHub e criar uma pasta de trabalho no computador.

Abra o terminal na pasta onde deseja guardar seus projetos e execute:

```bash
git clone COLE_AQUI_O_ENDERECO
```

Exemplo:

```bash
git clone https://github.com/maria/atividades-web1-maria-silva.git
```

Entre na pasta criada:

```bash
cd atividades-web1-maria-silva
```

No exemplo de Web 2, use o nome correspondente:

```bash
cd atividades-web2-maria-silva
```

Abra a pasta no Visual Studio Code:

```bash
code .
```

> Se uma janela do navegador for aberta para autenticação durante o clone ou o primeiro push, entre na sua conta e autorize o Git.

### 7. Complete o README

Abra o arquivo `README.md` e informe:

```markdown
# Atividades de Web 1

**Aluno:** Seu nome completo

**Turma:** Sua turma

**Semestre:** 2026.2
```

Em Web 2, altere o título para `Atividades de Web 2`.

Salve o arquivo e execute:

```bash
git add README.md
git commit -m "Prepara repositorio da disciplina"
git push
```

Atualize a página do repositório no GitHub. O README com seu nome deverá aparecer.

Se isso aconteceu, a preparação está concluída.

## Parte 2 — rotina de cada atividade

### 1. Abra a pasta correta

Abra o terminal dentro do seu repositório. Se necessário, entre na pasta com `cd`:

```bash
cd atividades-web1-maria-silva
```

Confirme que está no local correto:

```bash
git status
```

Se aparecer a mensagem `not a git repository`, você ainda não está dentro da pasta do repositório.

### 2. Atualize antes de começar

Execute:

```bash
git pull
```

Esse comando traz para o computador alguma alteração que já esteja no GitHub.

### 3. Faça a atividade

Crie ou altere os arquivos solicitados no enunciado.

Em Web 1:

- atividades iniciais ficam em `atividades-iniciais/`;
- o sistema acumulativo fica em `projeto-consultorio/`.

Em Web 2:

- a aplicação Laravel fica em `projeto-biblioteca/`.

Salve todos os arquivos antes de continuar.

### 4. Veja o que foi alterado

Execute:

```bash
git status
```

O Git mostrará os arquivos criados, modificados ou removidos.

Confira se as alterações pertencem à atividade. Pastas como `vendor/` e `node_modules/`, além do arquivo `.env`, não devem aparecer na entrega.

### 5. Prepare os arquivos

Execute:

```bash
git add .
```

O ponto significa: preparar as alterações existentes nesta pasta e em suas subpastas.

### 6. Crie o commit

Use uma mensagem curta que identifique a atividade:

```bash
git commit -m "Conclui atividade 03 - calculadora PHP"
```

Outros exemplos:

```bash
git commit -m "Conclui atividade 05 - CRUD de pacientes"
git commit -m "Conclui atividade 02 - migrations da biblioteca"
```

Não use mensagens genéricas como `alterações`, `teste` ou `pronto`.

### 7. Envie para o GitHub

Execute:

```bash
git push
```

Espere o comando terminar. Se não aparecer uma mensagem de erro, atualize a página do repositório no GitHub e confira se o novo commit está visível.

## Parte 3 — entrega no Google Classroom

### Como copiar o link do repositório

1. abra a página principal do seu repositório no GitHub;
2. copie o endereço completo da barra do navegador.

O link deve terminar com o nome do repositório:

```text
https://github.com/usuario/atividades-web1-nome-sobrenome
```

### O que enviar no Google Classroom

Envie apenas o link do repositório:

```text
https://github.com/maria/atividades-web1-maria-silva
```

Se precisar informar algo ao professor, acrescente uma observação abaixo do link:

```text
https://github.com/maria/atividades-web1-maria-silva

Observação: não consegui concluir a validação do formulário.
```

O Google Classroom já identifica o aluno e a atividade. Não é necessário repetir essas informações na resposta.

Depois de enviar, abra o link a partir do próprio Google Classroom e confirme que ele mostra a página principal do seu repositório.

## Parte 4 — se precisar corrigir depois

Não apague o commit anterior.

Faça a correção e repita:

```bash
git add .
git commit -m "Corrige atividade 03 - calculadora PHP"
git push
```

O endereço do repositório continua o mesmo. Se o professor permitir uma nova entrega, atualize a resposta no Google Classroom apenas se for solicitado.

## Ajuda rápida

### `not a git repository`

Você abriu o terminal na pasta errada.

Entre na pasta do repositório:

```bash
cd NOME-DO-REPOSITORIO
```

Depois tente novamente:

```bash
git status
```

### `nothing to commit, working tree clean`

O Git não encontrou alterações.

Confira se:

- os arquivos foram salvos;
- os arquivos estão dentro da pasta do repositório;
- a atividade já não foi incluída em um commit anterior.

### `Author identity unknown`

Configure seu nome e e-mail:

```bash
git config --global user.name "Seu Nome Completo"
git config --global user.email "seu-email@example.com"
```

Depois repita o commit.

### O push foi rejeitado

Tente:

```bash
git pull
git push
```

Se aparecer a expressão **conflict** ou **conflito**, pare e peça orientação antes de continuar. Não apague arquivos nem use comandos encontrados aleatoriamente na Internet.

### O Git pediu autenticação

No primeiro `clone` ou `push`, o gerenciador de credenciais poderá abrir o navegador:

1. entre na sua conta do GitHub;
2. autorize o acesso;
3. volte ao terminal.

Não envie senha, código de autenticação ou token ao professor ou a colegas.

Se o navegador não abrir:

- em Web 1, confira se o Git for Windows foi instalado com o Git Credential Manager;
- em Web 2, consulte a seção de autenticação do material de preparação do WSL.

A criação manual de token não faz parte do procedimento normal da disciplina.

### O professor não consegue abrir o link

Confira se:

1. o repositório está no GitHub;
2. o professor `AlexandreSGV` foi adicionado como colaborador;
3. o convite de colaboração ainda não está pendente ou apresentou erro;
4. o link enviado abre a página principal do repositório.

## Cola rápida

No início da atividade:

```bash
git pull
```

Depois de terminar e salvar:

```bash
git status
git add .
git commit -m "Conclui atividade XX - nome da atividade"
git push
```

No GitHub:

1. abra a página principal do repositório;
2. copie o endereço da barra do navegador;
3. envie apenas esse link no Google Classroom e acrescente uma observação somente se necessário.

## Referências oficiais

- [Criar um repositório — GitHub Docs](https://docs.github.com/en/repositories/creating-and-managing-repositories/quickstart-for-repositories)
- [Clonar um repositório — GitHub Docs](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository)
- [Convidar colaboradores — GitHub Docs](https://docs.github.com/articles/inviting-collaborators-to-a-personal-repository)
- [Autenticação e Git Credential Manager — GitHub Docs](https://docs.github.com/en/get-started/git-basics/caching-your-github-credentials-in-git)
- [Git no WSL — Microsoft Learn](https://learn.microsoft.com/en-us/windows/wsl/tutorials/wsl-git)
