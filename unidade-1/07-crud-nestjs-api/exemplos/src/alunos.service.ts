import { Injectable, NotFoundException } from '@nestjs/common';
import type { ResultSetHeader, RowDataPacket } from 'mysql2';
import type { DadosAluno } from './aluno';
import { banco } from './conexao';

@Injectable()
export class AlunosService {
    async listar() {
        const [alunos] = await banco.execute<RowDataPacket[]>(
            'SELECT * FROM alunos ORDER BY id DESC'
        );
        return alunos;
    }

    async buscar(id: string) {
        const [alunos] = await banco.execute<RowDataPacket[]>(
            'SELECT * FROM alunos WHERE id = ?', [id]
        );
        if (alunos.length === 0) {
            throw new NotFoundException({ mensagem: 'Aluno não encontrado.' });
        }
        return alunos[0];
    }

    async cadastrar(dados: DadosAluno) {
        const [resultado] = await banco.execute<ResultSetHeader>(
            'INSERT INTO alunos (nome, email, data_nascimento, telefone) VALUES (?, ?, ?, ?)',
            [dados.nome, dados.email, dados.data_nascimento, dados.telefone]
        );
        return { id: resultado.insertId, mensagem: 'Aluno cadastrado.' };
    }

    async alterar(id: string, dados: DadosAluno) {
        await banco.execute(
            'UPDATE alunos SET nome = ?, email = ?, data_nascimento = ?, telefone = ? WHERE id = ?',
            [dados.nome, dados.email, dados.data_nascimento, dados.telefone, id]
        );
        return { mensagem: 'Alteração concluída.' };
    }

    async excluir(id: string) {
        await banco.execute('DELETE FROM alunos WHERE id = ?', [id]);
        return { mensagem: 'Exclusão concluída.' };
    }
}
