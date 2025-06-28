<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidadao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class CidadaoController extends Controller
{
    public function index()
    {
        return view('cidadao.index');
    }

    public function consultar(Request $request)
    {
        // Rate limiting para prevenir ataques de força bruta
        $key = 'consultar:' . ($request->ip() ?? 'unknown');
        $maxAttempts = 10; // Máximo 10 tentativas por minuto
        
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return response()->json([
                'success' => false,
                'message' => 'Muitas tentativas. Tente novamente em alguns minutos.'
            ], 429);
        }
        
        RateLimiter::hit($key, 60); // 1 minuto de expiração

        // Validação mais rigorosa
        $validator = Validator::make($request->all(), [
            'cpf' => 'required|string|max:14|regex:/^[0-9\.\-]+$/'
        ], [
            'cpf.required' => 'CPF é obrigatório.',
            'cpf.regex' => 'CPF deve conter apenas números, pontos e hífens.',
            'cpf.max' => 'CPF deve ter no máximo 14 caracteres.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Formato de CPF inválido.'
            ], 422);
        }

        $cpf = $request->input('cpf');
        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);

        // Validação rigorosa de CPF
        if (!$this->validarCPF($cpfLimpo)) {
            return response()->json([
                'success' => false,
                'message' => 'CPF inválido.'
            ], 422);
        }

        try {
            $cidadao = Cidadao::where('cpf', $cpfLimpo)->first();

            if (!$cidadao) {
                return response()->json([
                    'success' => false,
                    'message' => 'CPF não encontrado no sistema.'
                ], 404);
            }

            // Sanitização e camuflagem LGPD
            $nome = $this->mascararNome($this->sanitizarTexto($cidadao->nome_completo));
            $cpfFormatado = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cidadao->cpf);
            $cpfMascara = preg_replace('/(\d{3})\.(\d{3})\.(\d{3})-(\d{2})/', '$1.***.***-$4', $cpfFormatado);

            return response()->json([
                'success' => true,
                'data' => [
                    'nome_completo' => $nome,
                    'cpf' => $cpfMascara,
                    'status' => $this->sanitizarTexto($cidadao->status),
                    'mensagem' => $this->sanitizarTexto($cidadao->mensagem),
                    'data_cadastro' => $cidadao->data_cadastro->format('d/m/Y'),
                    'data_pagamento' => $cidadao->data_pagamento ? $cidadao->data_pagamento->format('d/m/Y') : null,
                    'valor_beneficio' => number_format($cidadao->valor_beneficio, 2, ',', '.')
                ]
            ]);
            
        } catch (\Exception $e) {
            // Log do erro para administradores (sem expor dados sensíveis)
            \Log::error('Erro na consulta de CPF: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor.'
            ], 500);
        }
    }

    private function validarCPF($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se tem exatamente 11 dígitos
        if (strlen($cpf) !== 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }
        
        // Validação rigorosa dos dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += (int)$cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ((int)$cpf[$c] !== $d) {
                return false;
            }
        }
        
        return true;
    }

    // Função para sanitizar texto (prevenir XSS)
    private function sanitizarTexto($texto)
    {
        if (empty($texto)) {
            return '';
        }
        
        // Remove tags HTML e caracteres perigosos
        $texto = strip_tags($texto);
        $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
        
        // Remove caracteres de controle
        $texto = preg_replace('/[\x00-\x1F\x7F]/', '', $texto);
        
        return trim($texto);
    }

    // Função para camuflar nome (primeiro nome + inicial do último sobrenome)
    private function mascararNome($nomeCompleto)
    {
        $nomeCompleto = $this->sanitizarTexto($nomeCompleto);
        $partes = explode(' ', trim($nomeCompleto));
        
        if (count($partes) === 1) {
            $primeiro = $partes[0];
            return substr($primeiro, 0, 1) . str_repeat('*', max(strlen($primeiro) - 1, 0));
        }
        
        $primeiro = $partes[0];
        $ultimo = end($partes);
        
        return $primeiro . ' ' . strtoupper(substr($ultimo, 0, 1)) . '.';
    }
}
