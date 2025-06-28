# Programa de Renda Básica - Sistema de Consulta

## 📋 Descrição

Sistema web desenvolvido em Laravel para consulta de benefícios de renda básica. Permite aos cidadãos consultarem o status de seus benefícios de forma segura, rápida e acessível.

## ✨ Funcionalidades Principais

### 🔍 Consulta de Benefícios
- **Consulta por CPF**: Sistema de busca por CPF com validação rigorosa
- **Resultados em Tempo Real**: Resposta instantânea com dados do benefício
- **Camuflagem LGPD**: Proteção de dados pessoais conforme LGPD
- **Interface Responsiva**: Funciona em desktop, tablet e mobile

### 🎨 Sistema de Contraste
- **Tema Claro/Escuro**: Alternância entre temas para melhor acessibilidade
- **Persistência**: Preferência salva no navegador
- **Adaptação Completa**: Header, footer e todos os elementos se adaptam
- **Botão Fácil**: Localizado no canto superior direito

### 🛡️ Segurança Avançada
- **Rate Limiting**: Proteção contra ataques de força bruta
- **Validação Rigorosa**: CPF com algoritmo oficial
- **Sanitização**: Prevenção de XSS e injeção de dados
- **Headers de Segurança**: CSP, XSS Protection, Frame Options
- **Logs Seguros**: Sem exposição de dados sensíveis

## 🚀 Instalação

### Pré-requisitos
- PHP 8.1 ou superior
- Composer
- MySQL/MariaDB
- XAMPP (recomendado para desenvolvimento)

### Passos de Instalação

1. **Clone o repositório**
```bash
git clone [url-do-repositorio]
cd programa_renda_basica
```

2. **Instale as dependências**
```bash
composer install
npm install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
```

4. **Configure o banco de dados no .env**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3309  # Para XAMPP
DB_DATABASE=cidadaos
DB_USERNAME=root
DB_PASSWORD=
```

5. **Gere a chave da aplicação**
```bash
php artisan key:generate
```

6. **Execute as migrações**
```bash
php artisan migrate
```

7. **Popule o banco com dados de teste**
```bash
php artisan db:seed
```

8. **Inicie o servidor**
```bash
php artisan serve
```

## 📊 Estrutura do Banco de Dados

### Tabela: cidadaos
```sql
CREATE TABLE cidadaos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    status ENUM('Aprovado', 'Em análise', 'Rejeitado', 'Pendente') NOT NULL,
    mensagem TEXT NULL,
    data_cadastro DATE NOT NULL,
    data_pagamento DATE NULL,
    valor_beneficio DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

## 🔧 Configuração

### Variáveis de Ambiente (.env)
```env
APP_NAME="Programa de Renda Básica"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3309
DB_DATABASE=cidadaos
DB_USERNAME=root
DB_PASSWORD=

LOG_CHANNEL=stack
LOG_LEVEL=debug
```

### Configurações de Segurança
```env
# Para produção
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true
```

## 🎯 Como Usar

### 1. Acesso ao Sistema
- URL: `http://localhost:8000`
- Interface intuitiva e responsiva

### 2. Consulta de Benefício
1. Digite o CPF no campo de busca
2. Clique em "Consultar Benefício"
3. Visualize os resultados mascarados

### 3. Sistema de Contraste
1. Clique no botão de contraste (canto superior direito)
2. Alterna entre tema claro e escuro
3. Preferência é salva automaticamente

## 🛡️ Medidas de Segurança

### Rate Limiting
- **Limite**: 10 tentativas por minuto por IP
- **Proteção**: Contra ataques de força bruta

### Validação de CPF
- **Algoritmo**: Validação oficial rigorosa
- **Regex**: `/^[0-9\.\-]+$/` para entrada
- **Sanitização**: Remove caracteres especiais

### Headers de Segurança
```http
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
X-XSS-Protection: 1; mode=block
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https:; connect-src 'self'; frame-ancestors 'none';
```

### Proteção de Dados (LGPD)
- **Nomes Mascarados**: Primeiro nome + inicial do último
- **CPF Mascarado**: Formato `XXX.***.***-XX`
- **Logs Seguros**: Sem exposição de dados pessoais

## 🎨 Sistema de Contraste

### Funcionalidades
- **Alternância**: Tema claro ↔ escuro
- **Persistência**: Salvo no localStorage
- **Adaptação**: Header, footer e todos os elementos
- **Acessibilidade**: Melhora legibilidade

### Cores do Tema Escuro
- **Fundo**: Gradiente escuro (#1a1a2e → #16213e → #0f3460)
- **Header**: Gradiente escuro (#2d3748 → #4a5568 → #718096)
- **Cards**: Cinza escuro (#2d3748)
- **Textos**: Branco (#ffffff) e cinza claro (#cbd5e0)

## 📁 Estrutura do Projeto

```
programa_renda_basica/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── CidadaoController.php
│   │   └── Middleware/
│   │       └── SecurityHeaders.php
│   └── Models/
│       └── Cidadao.php
├── resources/
│   └── views/
│       └── cidadao/
│           └── index.blade.php
├── routes/
│   └── web.php
├── config/
│   └── logging.php
├── bootstrap/
│   └── app.php
├── storage/
│   └── logs/
├── .env
├── README.md
├── SECURITY.md
└── CONTRASTE.md
```

## 🧪 Testes

### Teste de Rate Limiting
```bash
# Teste de força bruta
for i in {1..12}; do 
  curl -X POST http://localhost:8000/consultar \
    -H "Content-Type: application/json" \
    -d '{"cpf": "12345678901"}'
done
# Resultado: Bloqueado após 10 tentativas
```

### Teste de Validação de CPF
```bash
# CPF inválido
curl -X POST http://localhost:8000/consultar \
  -H "Content-Type: application/json" \
  -d '{"cpf": "12345678901"}'
# Resultado: 422 - CPF inválido

# CPF válido
curl -X POST http://localhost:8000/consultar \
  -H "Content-Type: application/json" \
  -d '{"cpf": "09528697720"}'
# Resultado: 200 - Dados mascarados
```

### Teste de Headers de Segurança
```bash
curl -I http://localhost:8000/
# Verifica: X-Content-Type-Options, X-Frame-Options, CSP, etc.
```

## 🔍 API Endpoints

### POST /consultar
Consulta de benefício por CPF

**Request:**
```json
{
  "cpf": "09528697720"
}
```

**Response (Sucesso):**
```json
{
  "success": true,
  "data": {
    "nome_completo": "João S.",
    "cpf": "095.***.***-20",
    "status": "Aprovado",
    "mensagem": "Seu benefício foi aprovado e será pago até o dia 05 do próximo mês.",
    "data_cadastro": "15/01/2024",
    "data_pagamento": "05/02/2024",
    "valor_beneficio": "600,00"
  }
}
```

**Response (Erro):**
```json
{
  "success": false,
  "message": "CPF não encontrado no sistema."
}
```

## 🚨 Troubleshooting

### Problemas Comuns

1. **Erro de Conexão com Banco**
   - Verifique se o MySQL está rodando
   - Confirme as credenciais no .env
   - Verifique a porta (3309 para XAMPP)

2. **Erro 422 (Unprocessable Content)**
   - Verifique se o CPF está no formato correto
   - Confirme se o CPF existe no banco

3. **Erro 429 (Too Many Requests)**
   - Rate limiting ativo
   - Aguarde 1 minuto antes de tentar novamente

4. **Tema Escuro Não Funciona**
   - Verifique se o JavaScript está habilitado
   - Limpe o cache do navegador

## 📈 Monitoramento

### Logs de Segurança
```php
// Log de tentativas suspeitas
Log::channel('security')->warning('Tentativa de acesso suspeita', [
    'ip' => request()->ip(),
    'user_agent' => request()->userAgent()
]);
```

### Métricas Importantes
- Tentativas de consulta por IP
- CPFs consultados (sem dados pessoais)
- Erros de validação
- Performance da API

## 🔄 Manutenção

### Backup do Banco
```bash
mysqldump -u root -p cidadaos > backup_$(date +%Y%m%d).sql
```

### Limpeza de Logs
```bash
# Logs são rotacionados automaticamente
# Manter apenas últimos 30 dias
find storage/logs -name "*.log" -mtime +30 -delete
```

### Atualizações
```bash
composer update
php artisan migrate
php artisan config:clear
php artisan cache:clear
```

## 📞 Suporte

### Contatos
- **Telefone**: 0800 123 4567
- **Email**: contato@rendabasica.gov.br
- **Horário**: 24h por dia

### Documentação Adicional
- [SECURITY.md](SECURITY.md) - Detalhes de segurança
- [CONTRASTE.md](CONTRASTE.md) - Sistema de contraste

## 📄 Licença

Este projeto é desenvolvido para o Programa de Renda Básica do Governo Federal.

## 🤝 Contribuição

Para contribuir com o projeto:
1. Fork o repositório
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

---

**Desenvolvido com ❤️ para melhorar a vida dos cidadãos brasileiros.**
