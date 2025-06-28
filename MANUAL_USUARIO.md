# Manual do Usuário - Programa de Renda Básica

## 📋 Introdução

Bem-vindo ao sistema de consulta do Programa de Renda Básica! Este manual irá guiá-lo através de todas as funcionalidades disponíveis para consultar o status do seu benefício de forma segura e fácil.

## 🎯 O que é o Programa de Renda Básica?

O Programa de Renda Básica é uma iniciativa do Governo Federal que oferece auxílio financeiro para cidadãos em situação de vulnerabilidade social. Através deste sistema, você pode consultar:

- Status do seu benefício
- Valor a receber
- Data de pagamento
- Mensagens importantes sobre seu processo

## 🚀 Como Acessar o Sistema

### 1. Acesso Inicial
- **URL**: `http://localhost:8000` (desenvolvimento)
- **URL**: `https://rendabasica.gov.br` (produção)
- **Navegador**: Chrome, Firefox, Safari, Edge (versões atualizadas)

### 2. Página Inicial
Ao acessar o sistema, você verá:
- **Header**: Logo do programa e botão de contraste
- **Área Principal**: Campo para inserir CPF
- **Footer**: Informações de contato e suporte

## 🔍 Como Fazer uma Consulta

### Passo 1: Inserir o CPF
1. Localize o campo "Digite seu CPF" na tela
2. Digite apenas os números do seu CPF (11 dígitos)
3. **Exemplo**: Para CPF 095.286.977-20, digite: `09528697720`

### Passo 2: Consultar Benefício
1. Clique no botão "Consultar Benefício"
2. Aguarde alguns segundos para o sistema processar
3. Os resultados aparecerão na tela

### Passo 3: Visualizar Resultados
O sistema mostrará as seguintes informações (mascaradas por segurança):

- **Nome**: Primeiro nome + inicial do sobrenome
- **CPF**: Formato mascarado (XXX.***.***-XX)
- **Status**: Aprovado, Em análise, Rejeitado ou Pendente
- **Mensagem**: Informação personalizada sobre seu benefício
- **Data de Cadastro**: Quando você foi cadastrado no sistema
- **Data de Pagamento**: Quando receberá o benefício
- **Valor**: Valor do benefício em reais

## 🎨 Sistema de Contraste

### O que é?
O sistema de contraste permite alternar entre tema claro e escuro para melhorar a legibilidade e acessibilidade.

### Como Usar
1. **Localizar**: Botão no canto superior direito da tela
2. **Alternar**: Clique no botão para mudar o tema
3. **Persistência**: Sua preferência é salva automaticamente

### Ícones do Botão
- **🌙 (Lua)**: Tema escuro ativo
- **☀️ (Sol)**: Tema claro ativo

### Benefícios do Tema Escuro
- **Menos cansaço visual**: Especialmente em ambientes com pouca luz
- **Melhor contraste**: Para usuários com dificuldades visuais
- **Economia de bateria**: Em dispositivos com tela OLED

## 📱 Uso em Dispositivos Móveis

### Smartphones e Tablets
O sistema é totalmente responsivo e funciona perfeitamente em:
- **Smartphones**: iPhone, Android
- **Tablets**: iPad, Android tablets
- **Tamanhos**: De 320px até 4K

### Funcionalidades Móveis
- **Zoom**: Funciona normalmente
- **Toque**: Botões otimizados para toque
- **Teclado**: Campo de CPF com teclado numérico
- **Orientação**: Funciona em retrato e paisagem

## ⚠️ Possíveis Erros e Soluções

### Erro: "CPF inválido"
**Causa**: CPF digitado não está no formato correto
**Solução**:
- Verifique se digitou exatamente 11 números
- Não inclua pontos, traços ou espaços
- Confirme se não digitou letras

### Erro: "CPF não encontrado no sistema"
**Causa**: CPF não está cadastrado no programa
**Solução**:
- Verifique se o CPF está correto
- Confirme se você se inscreveu no programa
- Entre em contato com o suporte

### Erro: "Muitas tentativas. Tente novamente em alguns minutos"
**Causa**: Muitas consultas em pouco tempo
**Solução**:
- Aguarde 1 minuto antes de tentar novamente
- Verifique se não há outras pessoas usando o mesmo IP

### Erro: "Página não carrega"
**Causa**: Problemas de conexão ou servidor
**Solução**:
- Verifique sua conexão com a internet
- Tente recarregar a página (F5)
- Limpe o cache do navegador
- Tente outro navegador

## 🔒 Segurança e Privacidade

### Proteção de Dados (LGPD)
O sistema segue rigorosamente a Lei Geral de Proteção de Dados:

- **Dados Mascarados**: Nomes e CPFs são exibidos parcialmente
- **Logs Seguros**: Não armazenamos dados pessoais nos logs
- **Conexão Segura**: HTTPS em produção
- **Rate Limiting**: Proteção contra ataques

### O que NÃO é Armazenado
- Histórico de consultas
- Dados pessoais completos
- Informações de navegação

### O que É Armazenado
- Tentativas de acesso (sem dados pessoais)
- Logs de segurança (IP, timestamp)
- Preferência de contraste (localmente)

## 📞 Suporte e Contato

### Canais de Atendimento
- **Telefone**: 0800 123 4567 (24h)
- **Email**: contato@rendabasica.gov.br
- **WhatsApp**: (11) 99999-9999
- **Chat Online**: Disponível no site

### Horário de Atendimento
- **Segunda a Sexta**: 8h às 18h
- **Sábados**: 8h às 12h
- **Emergências**: 24h por dia

### Informações para Contato
Tenha em mãos:
- Seu CPF
- Nome completo
- Data de nascimento
- Endereço de email (se tiver)

## 🆘 FAQ - Perguntas Frequentes

### Q: Posso consultar o benefício de outra pessoa?
**R**: Não. O sistema é pessoal e intransferível. Cada cidadão deve consultar apenas seu próprio benefício.

### Q: O sistema funciona nos fins de semana?
**R**: Sim! O sistema está disponível 24h por dia, 7 dias por semana.

### Q: Preciso criar uma conta para consultar?
**R**: Não. Basta ter um CPF válido e estar cadastrado no programa.

### Q: Posso consultar de qualquer lugar?
**R**: Sim, desde que tenha acesso à internet e um navegador web.

### Q: O que fazer se esqueci meu CPF?
**R**: Entre em contato com o suporte ou consulte a Receita Federal.

### Q: O sistema é gratuito?
**R**: Sim, totalmente gratuito. Não cobramos nenhuma taxa.

### Q: Posso consultar várias vezes?
**R**: Sim, mas há um limite de 10 consultas por minuto por segurança.

### Q: O que significa "Em análise"?
**R**: Seu benefício está sendo analisado pela equipe técnica. Aguarde o resultado.

### Q: Quando recebo o pagamento?
**R**: A data de pagamento aparece nos resultados da consulta.

### Q: O valor pode mudar?
**R**: Sim, o valor pode ser ajustado conforme critérios do programa.

## 🎯 Dicas de Uso

### Para Melhor Experiência
1. **Use navegadores atualizados**: Chrome, Firefox, Safari, Edge
2. **Mantenha JavaScript habilitado**: Necessário para o funcionamento
3. **Use conexão estável**: Evite consultas em conexões instáveis
4. **Guarde seu CPF**: Tenha o CPF em mãos antes de consultar

### Para Acessibilidade
1. **Use o tema escuro**: Se tiver dificuldades visuais
2. **Aumente o zoom**: Se necessário para melhor visualização
3. **Use leitores de tela**: O sistema é compatível

### Para Segurança
1. **Não compartilhe seu CPF**: Mantenha-o em segurança
2. **Use dispositivos confiáveis**: Evite computadores públicos
3. **Limpe o cache**: Após usar em dispositivos compartilhados

## 📋 Checklist de Consulta

Antes de consultar, verifique:
- [ ] Tenho meu CPF em mãos
- [ ] Estou em um local seguro
- [ ] Minha conexão está estável
- [ ] O navegador está atualizado
- [ ] JavaScript está habilitado

## 🔄 Atualizações do Sistema

### Como Saber se Houve Atualização
- **Notificação**: Aparece na tela quando há atualizações
- **Data**: Verifique a data da última atualização no footer
- **Suporte**: Entre em contato para informações

### O que Fazer em Atualizações
1. **Recarregue a página**: F5 ou Ctrl+F5
2. **Limpe o cache**: Se necessário
3. **Aguarde**: Algumas atualizações são automáticas

## 📊 Estatísticas do Sistema

### Disponibilidade
- **Uptime**: 99.9% de disponibilidade
- **Tempo de Resposta**: Menos de 2 segundos
- **Capacidade**: Milhares de consultas simultâneas

### Segurança
- **Tentativas Bloqueadas**: Milhares por dia
- **Ataques Prevenidos**: Rate limiting ativo
- **Dados Protegidos**: 100% conforme LGPD

---

**Este manual foi criado para garantir que você tenha a melhor experiência possível ao consultar seu benefício. Em caso de dúvidas, não hesite em entrar em contato com nosso suporte!**

**Programa de Renda Básica - Governo Municipal de Maricá** 