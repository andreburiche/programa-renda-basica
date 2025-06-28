'use client';

import { useState } from 'react';
import ConsultaForm from '@/components/ConsultaForm';
import ResultadoConsulta from '@/components/ResultadoConsulta';
import ErrorMessage from '@/components/ErrorMessage';
import { useConsulta } from '@/hooks/useConsulta';

export default function Home() {
  const { loading, error, resultado, consultarCPF, limparResultado } = useConsulta();
  const [lastCPF, setLastCPF] = useState('');

  const handleConsulta = (cpf: string) => {
    setLastCPF(cpf);
    consultarCPF(cpf);
  };

  const handleNovaConsulta = () => {
    limparResultado();
  };

  const handleRetry = () => {
    if (lastCPF) {
      consultarCPF(lastCPF);
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 py-8">
      <div className="max-w-2xl mx-auto px-4">
        {/* Header */}
        <div className="text-center mb-8">
          <h1 className="text-4xl font-bold text-gray-900 mb-2">
            Programa Renda Básica
          </h1>
          <p className="text-lg text-gray-600">
            Consulte o status do seu benefício
          </p>
        </div>

        {/* Main Content */}
        <div className="space-y-6">
          {/* Form */}
          <div className="bg-white rounded-lg shadow-md p-6">
            <div className="text-center mb-6">
              <h2 className="text-2xl font-bold text-gray-900 mb-2">
                Consulta de CPF
              </h2>
              <p className="text-gray-600">
                Digite o CPF para verificar o status do benefício
              </p>
            </div>

            <ConsultaForm 
              onSubmit={handleConsulta}
              loading={loading}
            />
          </div>

          {/* Error Message */}
          {error && (
            <ErrorMessage 
              message={error}
              onRetry={handleRetry}
            />
          )}

          {/* Result */}
          {resultado && (
            <ResultadoConsulta 
              resultado={resultado}
              onNovaConsulta={handleNovaConsulta}
            />
          )}
        </div>

        {/* Footer */}
        <div className="text-center mt-12 text-sm text-gray-500">
          <p>© 2025 Programa Renda Básica. Todos os direitos reservados.</p>
        </div>
      </div>
    </div>
  );
}
