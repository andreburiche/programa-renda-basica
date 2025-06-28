'use client';

import { CheckCircleIcon, XCircleIcon, ClockIcon, ExclamationTriangleIcon } from '@heroicons/react/24/outline';
import { CidadaoData } from '@/types/api';

interface ResultadoConsultaProps {
  resultado: CidadaoData;
  onNovaConsulta: () => void;
}

const ResultadoConsulta = ({ resultado, onNovaConsulta }: ResultadoConsultaProps) => {
  const getStatusIcon = (status: string) => {
    switch (status) {
      case 'Aprovado':
        return <CheckCircleIcon className="h-6 w-6 text-green-500" />;
      case 'Rejeitado':
        return <XCircleIcon className="h-6 w-6 text-red-500" />;
      case 'Em análise':
        return <ClockIcon className="h-6 w-6 text-yellow-500" />;
      case 'Pendente':
        return <ExclamationTriangleIcon className="h-6 w-6 text-orange-500" />;
      default:
        return <ClockIcon className="h-6 w-6 text-gray-500" />;
    }
  };

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'Aprovado':
        return 'text-green-600 bg-green-50 border-green-200';
      case 'Rejeitado':
        return 'text-red-600 bg-red-50 border-red-200';
      case 'Em análise':
        return 'text-yellow-600 bg-yellow-50 border-yellow-200';
      case 'Pendente':
        return 'text-orange-600 bg-orange-50 border-orange-200';
      default:
        return 'text-gray-600 bg-gray-50 border-gray-200';
    }
  };

  return (
    <div className="bg-white rounded-lg shadow-md p-6 space-y-6">
      <div className="text-center">
        <h2 className="text-2xl font-bold text-gray-900 mb-2">Resultado da Consulta</h2>
        <p className="text-gray-600">Informações do beneficiário</p>
      </div>

      <div className="space-y-4">
        <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <span className="font-medium text-gray-700">Nome:</span>
          <span className="text-gray-900">{resultado.nome_completo}</span>
        </div>

        <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <span className="font-medium text-gray-700">CPF:</span>
          <span className="text-gray-900">{resultado.cpf}</span>
        </div>

        <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <span className="font-medium text-gray-700">Status:</span>
          <div className="flex items-center space-x-2">
            {getStatusIcon(resultado.status)}
            <span className={`px-3 py-1 rounded-full text-sm font-medium border ${getStatusColor(resultado.status)}`}>
              {resultado.status}
            </span>
          </div>
        </div>

        <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <span className="font-medium text-gray-700">Valor do Benefício:</span>
          <span className="text-lg font-bold text-primary-600">R$ {resultado.valor_beneficio}</span>
        </div>

        <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
          <span className="font-medium text-gray-700">Data de Cadastro:</span>
          <span className="text-gray-900">{resultado.data_cadastro}</span>
        </div>

        {resultado.data_pagamento && (
          <div className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <span className="font-medium text-gray-700">Data de Pagamento:</span>
            <span className="text-gray-900">{resultado.data_pagamento}</span>
          </div>
        )}

        {resultado.mensagem && (
          <div className="p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <span className="font-medium text-blue-700">Mensagem:</span>
            <p className="text-blue-600 mt-1">{resultado.mensagem}</p>
          </div>
        )}
      </div>

      <button
        onClick={onNovaConsulta}
        className="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200"
      >
        Nova Consulta
      </button>
    </div>
  );
};

export default ResultadoConsulta; 