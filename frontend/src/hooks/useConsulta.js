import { useState } from 'react';
import { cidadaoService } from '../services/api';

export const useConsulta = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [resultado, setResultado] = useState(null);

  const consultarCPF = async (cpf) => {
    setLoading(true);
    setError(null);
    setResultado(null);

    try {
      const response = await cidadaoService.consultar(cpf);
      setResultado(response.data);
    } catch (err) {
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