<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cidadao;

class CidadaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cidadaos = [
            [
                'nome_completo' => 'João Silva Santos',
                'cpf' => '09528697720',
                'status' => 'Aprovado',
                'mensagem' => 'Seu benefício foi aprovado e será pago até o dia 05 do próximo mês.',
                'data_cadastro' => '2024-01-15',
                'data_pagamento' => '2024-02-05',
                'valor_beneficio' => 600.00
            ],
            [
                'nome_completo' => 'Maria Oliveira Costa',
                'cpf' => '98765432100',
                'status' => 'Em análise',
                'mensagem' => 'Sua documentação está sendo analisada. Aguarde o contato.',
                'data_cadastro' => '2024-01-20',
                'data_pagamento' => null,
                'valor_beneficio' => 600.00
            ],
            [
                'nome_completo' => 'Pedro Almeida Lima',
                'cpf' => '45678912345',
                'status' => 'Rejeitado',
                'mensagem' => 'Documentação insuficiente. Entre em contato para mais informações.',
                'data_cadastro' => '2024-01-10',
                'data_pagamento' => null,
                'valor_beneficio' => 600.00
            ],
            [
                'nome_completo' => 'Ana Paula Ferreira',
                'cpf' => '78912345678',
                'status' => 'Aprovado',
                'mensagem' => 'Benefício aprovado! O pagamento será realizado no dia 10.',
                'data_cadastro' => '2024-01-25',
                'data_pagamento' => '2024-02-10',
                'valor_beneficio' => 600.00
            ],
            [
                'nome_completo' => 'Carlos Eduardo Souza',
                'cpf' => '32165498732',
                'status' => 'Pendente',
                'mensagem' => 'Aguardando envio da documentação complementar.',
                'data_cadastro' => '2024-01-30',
                'data_pagamento' => null,
                'valor_beneficio' => 600.00
            ]
        ];

        foreach ($cidadaos as $cidadao) {
            Cidadao::create($cidadao);
        }
    }
}
