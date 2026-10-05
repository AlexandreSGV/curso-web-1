import { Body, Controller, Delete, Get, Post, Put, Query } from '@nestjs/common';
import type { DadosAluno } from './aluno';
import { AlunosService } from './alunos.service';

@Controller('api/alunos')
export class AlunosController {
    constructor(private alunos: AlunosService) {}

    @Get()
    consultar(@Query('id') id?: string) {
        if (id !== undefined) {
            return this.alunos.buscar(id);
        }
        return this.alunos.listar();
    }

    @Post()
    cadastrar(@Body() dados: DadosAluno) {
        return this.alunos.cadastrar(dados);
    }

    @Put()
    alterar(@Query('id') id: string, @Body() dados: DadosAluno) {
        return this.alunos.alterar(id, dados);
    }

    @Delete()
    excluir(@Query('id') id: string) {
        return this.alunos.excluir(id);
    }
}
