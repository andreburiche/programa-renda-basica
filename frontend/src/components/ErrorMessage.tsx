'use client';

import { ExclamationTriangleIcon } from '@heroicons/react/24/outline';

interface ErrorMessageProps {
  message: string;
  onRetry?: () => void;
}

const ErrorMessage = ({ message, onRetry }: ErrorMessageProps) => {
  return (
    <div className="bg-white rounded-lg shadow-md p-6 border border-red-200 bg-red-50">
      <div className="flex items-center space-x-3">
        <ExclamationTriangleIcon className="h-6 w-6 text-red-500 flex-shrink-0" />
        <div className="flex-1">
          <h3 className="text-sm font-medium text-red-800">Erro na consulta</h3>
          <p className="text-sm text-red-700 mt-1">{message}</p>
        </div>
      </div>
      
      {onRetry && (
        <button
          onClick={onRetry}
          className="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-lg transition-colors duration-200 mt-4"
        >
          Tentar Novamente
        </button>
      )}
    </div>
  );
};

export default ErrorMessage; 