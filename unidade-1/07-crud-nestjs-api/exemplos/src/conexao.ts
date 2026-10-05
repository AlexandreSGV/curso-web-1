import { createPool } from 'mysql2/promise';

export const banco = createPool({
    host: '127.0.0.1',
    port: 3306,
    user: 'root',
    password: 'SUA_SENHA',
    database: 'crud_alunos',
    charset: 'utf8mb4',
    dateStrings: ['DATE'],
});
