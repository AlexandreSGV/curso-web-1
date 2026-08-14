# Orientações permanentes — Web 1

## Autoridade e fontes

- As decisões de `../planejamento/` têm prioridade. Havendo conflito, não reproduza a orientação antiga.
- Os slides, atividades e avaliações de `../fontes-atuais/web-1/` são a principal base de produção. Comece pelo catálogo `../fontes-atuais/README.md` e abra somente os arquivos e páginas relacionados ao assunto em produção.
- Prefira corrigir, atualizar, simplificar e reorganizar o material existente a recriá-lo. Preserve identidade, exemplos, sequências e explicações que continuem corretos.
- Não copie automaticamente todo o conteúdo antigo. Retire excessos e itens fora do plano; corrija erros técnicos/editoriais, links, versões e formas de entrega desatualizadas. Produza conteúdo novo quando houver lacuna real.

## Alunos e linguagem

- Use a mesma abordagem no Técnico e no Tecnólogo. Produza para alunos que conhecem fundamentos de TypeScript — variáveis, condições, repetições, funções, arrays e objetos — mas ainda não dominam DOM e cursam Banco de Dados em paralelo. Não pressuponha domínio de SQL, PDO ou modelagem.
- Use português simples, apresente termos técnicos quando necessários e explique o propósito antes de comandos ou código. Divida construções em passos testáveis, com arquivos, checkpoints e resultados esperados claros.
- A apostila deve permitir recuperar uma aula perdida. Diferencie o essencial do aprofundamento opcional, retire o apoio gradualmente e não use recursos ainda não ensinados.

## Tecnologia e organização

- Use Windows nativo, HTML, CSS, Grid, JavaScript/DOM, PHP procedural, MySQL, PDO, Composer e uma API JSON pequena consumida com `fetch`. Não introduza orientação a objetos nem testes automatizados.
- Use o consultório médico como domínio principal. Conclua o CRUD de pacientes na Unidade 1 e evolua uma única pasta `projeto-consultorio/` para médicos, consultas, autenticação, upload, relatório e API. Forneça banco, SQL, conexão PDO e consultas-base enquanto necessário.
- O `README.md` da raiz é o índice. Cada assunto fica em `unidade-1/` ou `unidade-2/`, com apostila em `README.md`; `exemplo/` e `atividade.md` existem somente quando úteis. Google Slides e Forms são apenas vinculados.
- O kit é flexível: assuntos podem ser reunidos, ocupar vários encontros ou compartilhar recursos. Não imponha seções, páginas, slides, exemplos ou atividades artificiais. Tutoriais comuns devem ter uma única versão canônica apontada por `apoio/`.
- Exemplos iniciais independentes ficam no assunto; o projeto acumulativo não deve ser copiado a cada etapa. Use commits e, quando útil, tags para preservar a evolução.

## Restrições

- Não versione `vendor/`, `node_modules/`, `.env`, credenciais ou temporários; não exija branches por atividade, pull requests, GitHub Projects ou PDF obrigatório dos slides.
- Mantenha gabaritos, rubricas internas e PetVet fora deste repositório. Em cada unidade: 4 a 6 atividades somam 20%, a teórica individual no Google Forms vale 40% e a prática em dupla vale 40%; os minitestes podem acrescentar até 0,5 ponto. Avaliações antigas servem apenas como fonte seletiva de questões fechadas.
- Google Classroom concentra avisos, prazos, entregas e notas. Cada aluno usa um repositório privado de Web 1, adiciona `AlexandreSGV` e entrega somente o link geral.
