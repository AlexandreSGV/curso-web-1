# Sistema de uma clínica

Desenvolva em PHP e MySQL um sistema para a secretária de uma clínica cadastrar
pacientes e médicos e agendar consultas. Use dados e fotos fictícios nos testes.

Você pode se inspirar no exemplo da Aula 09. Assim como a matrícula liga um
aluno a uma turma, a consulta liga um paciente a um médico.
[Exemplo de alunos, turmas e matrículas](../unidade-1/09-relacionamentos-n-n/exemplos/)

## Cadastros

Implemente o CRUD completo de **pacientes, médicos, consultas e usuários**. Em
cada cadastro, a secretária deve poder **cadastrar, listar, ver detalhes, editar
e excluir** registros.

| Cadastro | Campos mínimos |
| --- | --- |
| Paciente | Nome, telefone e foto de perfil |
| Médico | Nome, CRM e especialidade |
| Consulta | Paciente, médico, data e horário |
| Usuário | Nome, nome de usuário único e senha |

## Consultas

Cada consulta vincula **um paciente** a **um médico**. Um paciente pode ter
consultas com vários médicos, e um médico pode atender vários pacientes. Esse é
o relacionamento **N–N (muitos para muitos)**. O mesmo paciente pode ter novas
consultas com o mesmo médico em datas ou horários diferentes.

Ao cadastrar ou editar uma consulta, escolha um paciente e um médico que já
estejam cadastrados. Guarde os IDs dos dois como chaves estrangeiras na tabela
de consultas. Na listagem e nos detalhes, mostre os nomes do paciente e do
médico, a data e o horário.

## Login da secretária

Prepare uma conta inicial de teste. A secretária deve entrar com nome de usuário
e senha e encerrar a sessão ao clicar em **Sair**. Use a sessão para proteger as
telas e ações dos quatro cadastros. Gere o hash da senha com `password_hash()`
para guardar no banco e confira a senha no login com `password_verify()`.

## Foto de perfil do paciente

Peça uma foto no cadastro e mostre-a na tela de detalhes do paciente. Aceite
apenas arquivos de imagem. Ao editar os dados sem enviar uma nova foto, mantenha
a imagem atual. Ao enviar outra, substitua a anterior para manter **uma única
foto por paciente**. Ao excluir o paciente, remova também a foto.

## Checklist de testes

- [ ] Tentei entrar com uma senha incorreta e o acesso foi recusado. Com a senha
      correta, consegui entrar.
- [ ] Em uma janela anônima, abri a URL de uma tela de cadastro e o sistema
      pediu login. Entrei, cliquei em **Sair** e confirmei que o acesso voltou a
      exigir login.
- [ ] Cadastrei, listei, consultei os detalhes, editei e excluí um paciente de
      teste.
- [ ] Cadastrei, listei, consultei os detalhes, editei e excluí um médico de
      teste.
- [ ] Agendei consultas para um paciente com dois médicos e para um desses
      médicos com outro paciente. Também agendei duas consultas para o mesmo par
      em horários diferentes.
- [ ] Conferi os nomes, a data e o horário na lista e nos detalhes de uma
      consulta. Alterei o horário, excluí a consulta e confirmei que o paciente
      e o médico continuaram cadastrados.
- [ ] Cadastrei, listei, consultei os detalhes, editei e excluí uma segunda conta
      de usuário. Conferi que a senha foi guardada como hash no banco.
- [ ] Enviei uma foto e conferi sua exibição nos detalhes do paciente. Editei
      apenas o telefone e a foto foi mantida. Enviei outra foto e confirmei que
      só a nova apareceu no perfil.
- [ ] Tentei enviar um arquivo de texto e o sistema recusou o envio. Ao excluir
      um paciente de teste, conferi também a remoção da foto.
