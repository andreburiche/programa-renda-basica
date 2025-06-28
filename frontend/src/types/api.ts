export interface CidadaoData {
  nome_completo: string;
  cpf: string;
  status: 'Aprovado' | 'Em análise' | 'Rejeitado' | 'Pendente';
  mensagem?: string;
  data_cadastro: string;
  data_pagamento?: string;
  valor_beneficio: string;
}

export interface ConsultaResponse {
  success: boolean;
  data?: CidadaoData;
  message?: string;
}

export interface ConsultaRequest {
  cpf: string;
} 