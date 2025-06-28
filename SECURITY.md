# Segurança - Programa de Renda Básica

## 🛡️ Medidas de Segurança Implementadas

### 1. **Rate Limiting (Proteção contra Força Bruta)**
- **Limite**: 10 tentativas por minuto por IP
- **Implementação**: Laravel Rate Limiter
- **Proteção**: Previne ataques de força bruta na consulta de CPFs

### 2. **Validação Rigorosa de CPF**
- **Regex**: `/^[0-9\.\-]+$/` para entrada
- **Validação**: Algoritmo oficial de CPF
- **Sanitização**: Remove caracteres especiais
- **Proteção**: Previne injeção de dados maliciosos

### 3. **Sanitização de Dados (XSS Prevention)**
- **Função**: `sanitizarTexto()`
- **Métodos**: `strip_tags()`, `htmlspecialchars()`
- **Proteção**: Remove tags HTML e caracteres perigosos
- **Aplicação**: Nomes, mensagens, status

### 4. **Headers de Segurança**
```http
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: geolocation=(), microphone=(), camera=()
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdn.tailwindcss.com https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com; img-src 'self' data: https:; connect-src 'self'; frame-ancestors 'none';
```

### 5. **Proteção de Dados Sensíveis**
- **Camuflagem LGPD**: Nomes mascarados (primeiro nome + inicial do último)
- **CPF Mascarado**: Formato `XXX.***.***-XX`
- **Logs Seguros**: Sem exposição de dados pessoais
- **Hidden Fields**: Campos sensíveis ocultos do modelo

### 6. **Validação de Modelo**
- **Regex para Nomes**: `/^[a-zA-ZÀ-ÿ\s]+$/`
- **Validação de CPF**: Exatamente 11 dígitos numéricos
- **Limites de Valor**: Máximo R$ 999.999,99
- **Validação de Datas**: Lógica temporal

### 7. **Tratamento de Erros**
- **Try-Catch**: Captura de exceções
- **Logs Seguros**: Sem exposição de dados sensíveis
- **Mensagens Genéricas**: Não revelam informações internas
- **Status Codes**: Respostas HTTP apropriadas

### 8. **Frontend Seguro**
- **Console.log Removido**: Sem exposição de dados no console
- **Sanitização**: Dados exibidos são sanitizados
- **CSP**: Content Security Policy ativo
- **Headers Removidos**: X-Powered-By, Server ocultos

## 🔒 Vulnerabilidades Corrigidas

### ❌ **Antes (Vulnerabilidades)**
1. **Rate Limiting**: Ausente - vulnerável a força bruta
2. **Validação Fraca**: CPF com validação básica
3. **XSS**: Possível através de dados não sanitizados
4. **Logs Expostos**: Console.log com dados sensíveis
5. **Headers Faltando**: Sem proteções de segurança
6. **Erro Handling**: Exposição de informações internas

### ✅ **Depois (Corrigido)**
1. **Rate Limiting**: 10 tentativas/minuto por IP
2. **Validação Rigorosa**: CPF com algoritmo oficial
3. **XSS Prevention**: Sanitização completa de dados
4. **Logs Seguros**: Console.log removido
5. **Security Headers**: CSP, XSS Protection, etc.
6. **Error Handling**: Mensagens genéricas seguras

## 🚨 Testes de Segurança

### Rate Limiting
```bash
# Teste de força bruta
for i in {1..12}; do 
  curl -X POST http://localhost:8000/consultar \
    -H "Content-Type: application/json" \
    -d '{"cpf": "12345678901"}'
done
# Resultado: Bloqueado após 10 tentativas
```

### Validação de CPF
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

### Headers de Segurança
```bash
curl -I http://localhost:8000/
# Verifica: X-Content-Type-Options, X-Frame-Options, CSP, etc.
```

## 📋 Checklist de Segurança

- [x] Rate Limiting implementado
- [x] Validação rigorosa de CPF
- [x] Sanitização de dados (XSS prevention)
- [x] Headers de segurança configurados
- [x] Logs seguros (sem dados sensíveis)
- [x] Tratamento de erros seguro
- [x] Camuflagem LGPD implementada
- [x] CSP (Content Security Policy) ativo
- [x] Validação de modelo rigorosa
- [x] Mutators para sanitização automática

## 🔧 Configurações Recomendadas

### Produção
```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
SESSION_SECURE_COOKIE=true
```

### Logs
```php
// Usar canal de segurança para logs sensíveis
Log::channel('security')->warning('Tentativa de acesso suspeita', [
    'ip' => request()->ip(),
    'user_agent' => request()->userAgent()
]);
```

## 🚀 Próximos Passos

1. **Implementar HTTPS** em produção
2. **Configurar WAF** (Web Application Firewall)
3. **Auditoria de Segurança** regular
4. **Monitoramento** de tentativas de ataque
5. **Backup** seguro dos dados
6. **Testes de Penetração** periódicos

---

**Sistema seguro e em conformidade com LGPD e boas práticas de segurança web.** 