# Frontend - Programa Renda Básica

Frontend React para o sistema de consulta de benefícios do Programa Renda Básica.

## Tecnologias

- React 18
- Vite
- Tailwind CSS
- Axios
- React Router DOM
- Headless UI
- Heroicons

## Instalação

```bash
npm install
```

## Desenvolvimento

```bash
npm run dev
```

## Build para Produção

```bash
npm run build
```

## Configuração

1. Copie o arquivo `env.example` para `.env.local`
2. Configure a URL da API Laravel:
   ```
   VITE_API_URL=http://localhost:8000
   ```

## Estrutura do Projeto

```
src/
├── components/          # Componentes React
│   ├── ConsultaForm.jsx
│   ├── ResultadoConsulta.jsx
│   └── ErrorMessage.jsx
├── hooks/              # Hooks personalizados
│   └── useConsulta.js
├── services/           # Serviços de API
│   └── api.js
├── App.jsx            # Componente principal
├── main.jsx           # Ponto de entrada
└── index.css          # Estilos globais
```

## Funcionalidades

- Consulta de CPF com validação
- Exibição de resultados formatados
- Tratamento de erros
- Interface responsiva
- Loading states
- Retry automático em caso de erro
