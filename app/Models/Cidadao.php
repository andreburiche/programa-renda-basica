<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;

class Cidadao extends Model
{
    use HasFactory;

    protected $table = 'cidadaos';

    protected $fillable = [
        'nome_completo',
        'cpf',
        'status',
        'mensagem',
        'data_cadastro',
        'data_pagamento',
        'valor_beneficio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'data_cadastro' => 'date',
        'data_pagamento' => 'date',
        'valor_beneficio' => 'decimal:2'
    ];

    public static function rules()
    {
        return [
            'nome_completo' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s]+$/',
            'cpf' => [
                'required',
                'string',
                'size:11',
                'regex:/^\d{11}$/',
                Rule::unique('cidadaos', 'cpf')->ignore(request()->route('cidadao'))
            ],
            'status' => 'required|in:Aprovado,Em análise,Rejeitado,Pendente',
            'mensagem' => 'nullable|string|max:1000',
            'data_cadastro' => 'required|date|before_or_equal:today',
            'data_pagamento' => 'nullable|date|after_or_equal:data_cadastro',
            'valor_beneficio' => 'required|numeric|min:0|max:999999.99'
        ];
    }

    public static function messages()
    {
        return [
            'nome_completo.regex' => 'O nome deve conter apenas letras e espaços.',
            'cpf.regex' => 'CPF deve conter exatamente 11 dígitos numéricos.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'status.in' => 'Status deve ser um dos valores permitidos.',
            'data_cadastro.before_or_equal' => 'Data de cadastro não pode ser futura.',
            'data_pagamento.after_or_equal' => 'Data de pagamento deve ser posterior à data de cadastro.',
            'valor_beneficio.max' => 'Valor do benefício não pode exceder R$ 999.999,99.'
        ];
    }

    // Mutator para sanitizar CPF
    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Mutator para sanitizar nome
    public function setNomeCompletoAttribute($value)
    {
        $this->attributes['nome_completo'] = trim(strip_tags($value));
    }

    // Mutator para sanitizar mensagem
    public function setMensagemAttribute($value)
    {
        if ($value) {
            $this->attributes['mensagem'] = trim(strip_tags($value));
        }
    }
}
