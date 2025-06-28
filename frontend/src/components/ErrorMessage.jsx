import { ExclamationTriangleIcon } from '@heroicons/react/24/outline';

const ErrorMessage = ({ message, onRetry }) => {
  return (
    <div className="card border border-red-200 bg-red-50">
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
          className="btn-secondary mt-4 w-full"
        >
          Tentar Novamente
        </button>
      )}
    </div>
  );
};

export default ErrorMessage; 