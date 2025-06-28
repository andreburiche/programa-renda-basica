import { useState } from 'react';
import { cidadaoService } from '@/services/api';
import { CidadaoData } from '@/types/api';

export const useConsulta = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [resultado, setResultado] = useState<CidadaoData | null>(null);

  const consultarCPF = async (cpf: string) => {
    setLoading(true);
    setError(null);
    setResultado(null);

    try {
      const response = await cidadaoService.consultar(cpf);
      if (response.success && response.data) {
        setResultado(response.data);
      } else {
        setError(response.message || 'Erro na consulta');
      }
    } catch (err: any) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  const limparResultado = () => {
    setResultado(null);
    setError(null);
  };

  return {
    loading,
    error,
    resultado,
    consultarCPF,
    limparResultado,
  };
}; 