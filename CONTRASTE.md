# Funcionalidade de Contraste - Programa de Renda Básica

## 🎨 Sobre a Funcionalidade

A página agora inclui um **botão de contraste** que permite alternar entre o tema claro (padrão) e o tema escuro, melhorando a acessibilidade e a experiência do usuário.

## 🔧 Como Usar

### Localização do Botão
- **Posição**: Canto superior direito da página
- **Ícone**: 
  - 🌙 (lua) - para alternar para modo escuro
  - ☀️ (sol) - para alternar para modo claro

### Funcionalidades

1. **Alternância de Temas**:
   - Clique no botão para alternar entre tema claro e escuro
   - A mudança é instantânea e afeta toda a página

2. **Persistência**:
   - A preferência do usuário é salva no navegador
   - Na próxima visita, o tema escolhido será aplicado automaticamente

3. **Acessibilidade**:
   - Melhora o contraste para usuários com dificuldades visuais
   - Reduz a fadiga visual em ambientes com pouca luz

## 🎯 Elementos Afetados

### Tema Escuro Aplica-se a:
- ✅ Fundo da página
- ✅ **Header** (gradiente escuro adaptado)
- ✅ **Footer** (cores ajustadas)
- ✅ Cards e containers
- ✅ Textos e títulos
- ✅ Campos de input
- ✅ Botões
- ✅ Ícones
- ✅ Bordas e divisores
- ✅ Seção de resultados

### Cores do Tema Escuro:
- **Fundo principal**: Gradiente escuro (#1a1a2e → #16213e → #0f3460)
- **Header**: Gradiente escuro (#2d3748 → #4a5568 → #718096)
- **Footer**: Cinza muito escuro (#1a202c)
- **Cards**: Cinza escuro (#2d3748)
- **Textos**: Branco (#ffffff) e cinza claro (#cbd5e0)
- **Inputs**: Cinza médio (#4a5568)
- **Botões**: Azul (#4299e1)

## 🔍 Benefícios

1. **Acessibilidade**: Melhora a legibilidade para usuários com problemas visuais
2. **Conforto**: Reduz a fadiga visual em ambientes escuros
3. **Preferência**: Permite personalização da experiência
4. **Modernidade**: Interface mais moderna e profissional

## 🛠️ Implementação Técnica

### Tecnologias Utilizadas:
- **CSS**: Classes condicionais para tema escuro
- **JavaScript**: Controle de alternância e persistência
- **localStorage**: Armazenamento da preferência do usuário
- **Font Awesome**: Ícones para o botão

### Estrutura do Código:
```javascript
// Controle de contraste
const contrastBtn = document.getElementById('contrastBtn');
const body = document.body;

// Verificar preferência salva
const savedTheme = localStorage.getItem('theme');

// Alternar tema
contrastBtn.addEventListener('click', function() {
    body.classList.toggle('dark-theme');
    // Salvar preferência
});
```

## 📱 Responsividade

O botão de contraste é totalmente responsivo e funciona em:
- ✅ Desktop
- ✅ Tablet
- ✅ Mobile
- ✅ Todos os navegadores modernos

## 🎨 Personalização

As cores e estilos podem ser facilmente personalizados editando as classes CSS:
- `.dark-theme` - Classe principal do tema escuro
- `.contrast-btn` - Estilo do botão de contraste
- Várias classes específicas para elementos individuais

---

**Desenvolvido para melhorar a acessibilidade e experiência do usuário no Programa de Renda Básica.** 