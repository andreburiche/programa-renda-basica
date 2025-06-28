import { useState } from 'react';
import { MagnifyingGlassIcon } from '@heroicons/react/24/outline';

const ConsultaForm = ({ onSubmit, loading }) => {
  const [cpf, setCpf] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (cpf.trim()) {
      onSubmit(cpf.trim());
    }
  };

  const formatarCPF = (value) => {
    const cpfLimpo = value.replace(/\D/g, '');
    return cpfLimpo.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
  };

  const handleCPFChange = (e) => {
    const value = e.target.value;
    const cpfFormatado = formatarCPF(value);
    setCpf(cpfFormatado);
  };

  return (
    <form onSubmit={handleSubmit} className="space-y-4">
      <div>
        <label htmlFor="cpf" className="block text-sm font-medium text-gray-700 mb-2">
          CPF
        </label>
        <div className="relative">
          <input
            type="text"
            id="cpf"
            value={cpf}
            onChange={handleCPFChange}
            placeholder="000.000.000-00"
            maxLength="14"
            className="input-field pr-10"
            disabled={loading}
          />
          <div className="absolute inset-y-0 right-0 flex items-center pr-3">
            <MagnifyingGlassIcon className="h-5 w-5 text-gray-400" />
          </div>
        </div>
      </div>
      
      <button
        type="submit"
        disabled={loading || !cpf.trim()}
        className="btn-primary w-full flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
      >
        {loading ? (
          <>
            <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
            Consultando...
          </>
        ) : (
          'Consultar CPF'
        )}
      </button>
    </form>
  );
};

export default ConsultaForm; 