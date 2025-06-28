# Frontend - Programa Renda Básica (Next.js)

Frontend Next.js moderno para o sistema de consulta de benefícios do Programa Renda Básica.

## Tecnologias

- **Next.js 14** com App Router
- **TypeScript** para type safety
- **Tailwind CSS** para estilização
- **Axios** para comunicação com API
- **Headless UI** para componentes acessíveis
- **Heroicons** para ícones
- **ESLint** para qualidade de código

## Funcionalidades

- ✅ **SSR/SSG** - Server-Side Rendering e Static Generation
- ✅ **TypeScript** - Type safety completo
- ✅ **Responsivo** - Interface adaptável
- ✅ **Acessível** - Componentes com acessibilidade
- ✅ **SEO otimizado** - Meta tags e estrutura semântica
- ✅ **Performance** - Otimizações automáticas do Next.js

## Instalação

```bash
npm install
```

## Desenvolvimento

```bash
npm run dev
```

Acesse [http://localhost:3000](http://localhost:3000) para ver o resultado.

## Build para Produção

```bash
npm run build
npm start
```

## Configuração

1. Copie o arquivo `env.local.example` para `.env.local`
2. Configure a URL da API Laravel:
   ```
   NEXT_PUBLIC_API_URL=http://localhost:8000
   ```

## Estrutura do Projeto

```
src/
├── app/                   # App Router (Next.js 13+)
│   ├── layout.tsx        # Layout principal
│   ├── page.tsx          # Página inicial
│   └── globals.css       # Estilos globais
├── components/           # Componentes React
│   ├── ConsultaForm.tsx
│   ├── ResultadoConsulta.tsx
│   └── ErrorMessage.tsx
├── hooks/               # Hooks personalizados
│   └── useConsulta.ts
├── services/            # Serviços de API
│   └── api.ts
└── types/               # Tipos TypeScript
    └── api.ts
```

## Vantagens do Next.js

- **Performance**: Otimizações automáticas
- **SEO**: Server-Side Rendering
- **TypeScript**: Suporte nativo
- **Deploy**: Fácil deploy na Vercel
- **Escalabilidade**: Arquitetura robusta
- **Developer Experience**: Hot reload e debugging

## Scripts Disponíveis

- `npm run dev` - Servidor de desenvolvimento
- `npm run build` - Build para produção
- `npm run start` - Servidor de produção
- `npm run lint` - Verificação de código
