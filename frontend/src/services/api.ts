import axios from 'axios';
import { ConsultaRequest, ConsultaResponse } from '@/types/api';

const API_BASE_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000';

const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

// Interceptor para tratar erros
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 429) {
      return Promise.reject(new Error('Muitas tentativas. Tente novamente em alguns minutos.'));
    }
    return Promise.reject(error);
  }
);

export const cidadaoService = {
  consultar: async (cpf: string): Promise<ConsultaResponse> => {
    try {
      const response = await api.post<ConsultaResponse>('/consultar', { cpf });
      return response.data;
    } catch (error: any) {
      if (error.response?.data?.message) {
        throw new Error(error.response.data.message);
      }
      throw new Error('Erro ao consultar CPF. Tente novamente.');
    }
  }
};

export default api; 