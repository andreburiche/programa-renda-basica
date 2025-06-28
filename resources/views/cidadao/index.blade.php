<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa de Renda Básica - Consulta de Benefícios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-shadow { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
        .hover-scale { transition: transform 0.2s ease-in-out; }
        .hover-scale:hover { transform: scale(1.02); }
        .fade-in { animation: fadeIn 0.6s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .slide-in { animation: slideIn 0.5s ease-out; }
        @keyframes slideIn { from { transform: translateX(-100%); } to { transform: translateX(0); } }
        
        /* Melhorias para os resultados */
        #results {
            transition: opacity 0.3s ease-in-out;
        }
        
        #results:not(.hidden) {
            opacity: 1;
            visibility: visible;
        }
        
        #results.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        /* Garantir que os resultados permaneçam visíveis */
        #successResult:not(.hidden),
        #errorResult:not(.hidden) {
            display: block !important;
        }
        
        /* Melhorar a transição dos resultados */
        .result-transition {
            transition: all 0.3s ease-in-out;
        }
        
        /* Botão de contraste */
        .contrast-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .contrast-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }
        
        /* Tema escuro */
        body.dark-theme {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #ffffff;
        }
        
        body.dark-theme .bg-white {
            background-color: #2d3748 !important;
            color: #ffffff;
        }
        
        body.dark-theme .text-gray-800 {
            color: #ffffff !important;
        }
        
        body.dark-theme .text-gray-600 {
            color: #cbd5e0 !important;
        }
        
        body.dark-theme .text-gray-700 {
            color: #e2e8f0 !important;
        }
        
        body.dark-theme .border-gray-200 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .bg-gray-50 {
            background-color: #2d3748 !important;
        }
        
        body.dark-theme .bg-blue-50 {
            background-color: #2c5282 !important;
        }
        
        body.dark-theme .bg-purple-50 {
            background-color: #553c9a !important;
        }
        
        body.dark-theme .bg-amber-50 {
            background-color: #744210 !important;
        }
        
        body.dark-theme .bg-emerald-50 {
            background-color: #22543d !important;
        }
        
        body.dark-theme .bg-green-50 {
            background-color: #22543d !important;
        }
        
        body.dark-theme .bg-cyan-50 {
            background-color: #234e52 !important;
        }
        
        body.dark-theme .bg-indigo-50 {
            background-color: #2c5282 !important;
        }
        
        body.dark-theme .border-blue-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .border-purple-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .border-amber-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .border-emerald-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .border-green-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .border-cyan-100 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme .bg-gray-900 {
            background-color: #1a202c !important;
        }
        
        body.dark-theme .text-gray-400 {
            color: #a0aec0 !important;
        }
        
        body.dark-theme .text-gray-500 {
            color: #a0aec0 !important;
        }
        
        body.dark-theme .border-gray-800 {
            border-color: #4a5568 !important;
        }
        
        /* Melhorias adicionais para o tema escuro */
        body.dark-theme input[type="text"] {
            background-color: #4a5568 !important;
            border-color: #718096 !important;
            color: #ffffff !important;
        }
        
        body.dark-theme input[type="text"]::placeholder {
            color: #a0aec0 !important;
        }
        
        body.dark-theme input[type="text"]:focus {
            border-color: #4299e1 !important;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1) !important;
        }
        
        body.dark-theme button {
            background-color: #4299e1 !important;
            color: #ffffff !important;
        }
        
        body.dark-theme button:hover {
            background-color: #3182ce !important;
        }
        
        body.dark-theme button:disabled {
            background-color: #4a5568 !important;
            color: #a0aec0 !important;
        }
        
        /* Melhorar contraste dos ícones no tema escuro */
        body.dark-theme .text-blue-600 {
            color: #63b3ed !important;
        }
        
        body.dark-theme .text-purple-600 {
            color: #b794f4 !important;
        }
        
        body.dark-theme .text-amber-600 {
            color: #f6ad55 !important;
        }
        
        body.dark-theme .text-emerald-600 {
            color: #68d391 !important;
        }
        
        body.dark-theme .text-green-600 {
            color: #68d391 !important;
        }
        
        body.dark-theme .text-cyan-600 {
            color: #7dd3fc !important;
        }
        
        /* Melhorar contraste das mensagens */
        body.dark-theme .text-blue-700 {
            color: #90cdf4 !important;
        }
        
        body.dark-theme .text-blue-800 {
            color: #63b3ed !important;
        }
        
        /* Header no tema escuro */
        body.dark-theme .gradient-bg {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 50%, #718096 100%) !important;
        }
        
        body.dark-theme header {
            background: linear-gradient(135deg, #2d3748 0%, #4a5568 50%, #718096 100%) !important;
        }
        
        body.dark-theme .text-white {
            color: #ffffff !important;
        }
        
        body.dark-theme .text-white\/90 {
            color: rgba(255, 255, 255, 0.9) !important;
        }
        
        body.dark-theme .text-white\/80 {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        
        /* Melhorar contraste dos elementos do header no tema escuro */
        body.dark-theme .bg-white\/20 {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }
        
        body.dark-theme .backdrop-blur-sm {
            backdrop-filter: blur(8px) !important;
        }
        
        /* Ajustar cores dos ícones no header para melhor contraste */
        body.dark-theme header .fas {
            color: #ffffff !important;
        }
        
        body.dark-theme header .text-blue-400 {
            color: #63b3ed !important;
        }
        
        /* Footer no tema escuro */
        body.dark-theme footer {
            background-color: #1a202c !important;
        }
        
        body.dark-theme footer .text-gray-400 {
            color: #a0aec0 !important;
        }
        
        body.dark-theme footer .text-gray-500 {
            color: #a0aec0 !important;
        }
        
        body.dark-theme footer .border-gray-800 {
            border-color: #4a5568 !important;
        }
        
        body.dark-theme footer .text-blue-400 {
            color: #63b3ed !important;
        }
        
        /* Melhorar contraste geral no tema escuro */
        body.dark-theme .bg-gradient-to-br {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
        }
        
        body.dark-theme .from-slate-50 {
            background-color: #1a1a2e !important;
        }
        
        body.dark-theme .via-blue-50 {
            background-color: #16213e !important;
        }
        
        body.dark-theme .to-indigo-100 {
            background-color: #0f3460 !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen">
    <!-- Botão de Contraste -->
    <button id="contrastBtn" class="contrast-btn" title="Alternar Contraste">
        <i class="fas fa-adjust"></i> 
    </button>
    
    <!-- Header -->
    <header class="gradient-bg text-white py-8">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 backdrop-blur-sm rounded-full mb-6 hover-scale">
                    <i class="fas fa-hand-holding-heart text-white text-4xl"></i>
                    <!-- <img src="{{ asset('img/MARCA_PRETA_EXTENSIVA.png') }}" alt="Logo" class=" h-24"> -->
                </div>
                <h1 class="text-5xl font-bold mb-4 tracking-tight">Programa de Renda Básica</h1>
                <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
                    Consulte o status do seu benefício de renda básica de forma segura e rápida
                </p>
                <div class="mt-6 flex justify-center space-x-4 text-sm text-white/80">
                    <div class="flex items-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span>100% Seguro</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        <span>Consulta Rápida</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user-shield mr-2"></i>
                        <span>LGPD Compliant</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-12">
        <!-- Search Section -->
        <div class="max-w-4xl mx-auto mb-16">
            <div class="bg-white rounded-3xl card-shadow p-10 fade-in">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Consulta de Benefício</h2>
                    <p class="text-gray-600 text-lg">Digite seu CPF para verificar o status do seu benefício</p>
                </div>
                
                <form id="searchForm" class="space-y-8">
                    <div class="max-w-md mx-auto">
                        <label for="cpf" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-id-card mr-2 text-blue-600"></i>CPF
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="cpf" 
                                name="cpf" 
                                placeholder="000.000.000-00"
                                class="w-full px-6 py-4 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 text-lg transition-all duration-300"
                                maxlength="14"
                                required
                            >
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Digite apenas os números ou use a máscara automática
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <button 
                            type="submit" 
                            id="searchBtn"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-4 px-12 rounded-xl transition-all duration-300 transform hover:scale-105 focus:ring-4 focus:ring-blue-500/30 flex items-center justify-center mx-auto"
                        >
                            <i class="fas fa-search mr-3"></i>
                            <span id="btnText">Consultar Benefício</span>
                            <div id="loadingSpinner" class="hidden ml-3">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Section -->
        <div id="results" class="max-w-6xl mx-auto hidden result-transition">
            <div class="bg-white rounded-3xl card-shadow overflow-hidden slide-in">
                <!-- Success Result -->
                <div id="successResult" class="hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white p-8 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                            <i class="fas fa-check-circle text-white text-3xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">Benefício Encontrado!</h2>
                        <p class="text-white/90 text-lg">Aqui estão os detalhes do seu benefício</p>
                    </div>
                    
                    <div class="p-8">
                        <div class="grid lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-user-circle mr-3 text-blue-600"></i>Nome do Beneficiário
                                    </h3>
                                    <p id="nomeCompleto" class="text-2xl font-semibold text-gray-800"></p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-id-card mr-3 text-purple-600"></i>CPF
                                    </h3>
                                    <p id="cpfResult" class="text-2xl font-mono font-semibold text-gray-800"></p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-calendar-alt mr-3 text-amber-600"></i>Data de Cadastro
                                    </h3>
                                    <p id="dataCadastro" class="text-2xl font-semibold text-gray-800"></p>
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-info-circle mr-3 text-emerald-600"></i>Status do Benefício
                                    </h3>
                                    <div id="statusContainer" class="flex items-center">
                                        <span id="status" class="px-4 py-2 rounded-full text-sm font-bold text-white"></span>
                                    </div>
                                </div>
                                
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-dollar-sign mr-3 text-green-600"></i>Valor do Benefício
                                    </h3>
                                    <p id="valorBeneficio" class="text-3xl font-bold text-green-600"></p>
                                </div>
                                
                                <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl p-6 border border-cyan-100" id="dataPagamentoContainer">
                                    <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                                        <i class="fas fa-calendar-check mr-3 text-cyan-600"></i>Data de Pagamento
                                    </h3>
                                    <p id="dataPagamento" class="text-2xl font-semibold text-gray-800"></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Message Section -->
                        <div class="mt-8">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-2xl p-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-comment-dots text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Mensagem Importante</h3>
                                        <p id="mensagem" class="text-blue-700 leading-relaxed"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Error Result -->
                <div id="errorResult" class="hidden">
                    <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white p-8 text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full mb-4">
                            <i class="fas fa-exclamation-triangle text-white text-3xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold mb-2">CPF Não Encontrado</h2>
                        <p id="errorMessage" class="text-white/90 text-lg mb-6"></p>
                        <button onclick="resetForm()" class="bg-white/20 hover:bg-white/30 text-white font-semibold py-3 px-8 rounded-xl transition-all duration-300 backdrop-blur-sm">
                            <i class="fas fa-arrow-left mr-2"></i>Nova Consulta
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Por que usar nosso sistema?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Sistema seguro e confiável para consulta de benefícios sociais</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl p-8 text-center card-shadow hover-scale">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">100% Seguro</h3>
                    <p class="text-gray-600">Seus dados são protegidos com criptografia avançada e seguindo as diretrizes da LGPD.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center card-shadow hover-scale">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-bolt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Consulta Rápida</h3>
                    <p class="text-gray-600">Resultados instantâneos com apenas um clique. Sem filas, sem espera.</p>
                </div>
                
                <div class="bg-white rounded-2xl p-8 text-center card-shadow hover-scale">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-mobile-alt text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Totalmente Responsivo</h3>
                    <p class="text-gray-600">Acesse de qualquer dispositivo: celular, tablet ou computador.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-20">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="flex justify-center items-center mb-6">
                    <i class="fas fa-hand-holding-heart text-blue-400 text-2xl mr-3"></i>
                    <span class="text-xl font-semibold">Programa de Renda Básica</span>
                </div>
                <p class="text-gray-400 mb-4">Sistema oficial de consulta de benefícios sociais</p>
                <div class="flex justify-center space-x-6 text-sm text-gray-400">
                    <span><i class="fas fa-phone mr-2"></i>0800 123 4567</span>
                    <span><i class="fas fa-envelope mr-2"></i>contato@rendabasica.gov.br</span>
                    <span><i class="fas fa-clock mr-2"></i>24h por dia</span>
                </div>
                <div class="mt-6 pt-6 border-t border-gray-800">
                    <p class="text-gray-500">&copy; 2024 Programa de Renda Básica. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Controle de Contraste
        const contrastBtn = document.getElementById('contrastBtn');
        const body = document.body;
        
        // Verificar se há preferência salva
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            body.classList.add('dark-theme');
            contrastBtn.innerHTML = '<i class="fas fa-sun"></i>';
        }
        
        // Alternar tema
        contrastBtn.addEventListener('click', function() {
            body.classList.toggle('dark-theme');
            
            if (body.classList.contains('dark-theme')) {
                localStorage.setItem('theme', 'dark');
                contrastBtn.innerHTML = '<i class="fas fa-sun"></i>';
                contrastBtn.title = 'Modo Claro';
            } else {
                localStorage.setItem('theme', 'light');
                contrastBtn.innerHTML = '<i class="fas fa-adjust"></i>';
                contrastBtn.title = 'Modo Escuro';
            }
        });
        
        // CPF Mask with improved UX
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });

        // Form Submission with improved UX
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const cpf = document.getElementById('cpf').value;
            const btnText = document.getElementById('btnText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const searchBtn = document.getElementById('searchBtn');
            
            // Show loading with better UX
            btnText.textContent = 'Consultando...';
            loadingSpinner.classList.remove('hidden');
            searchBtn.disabled = true;
            searchBtn.classList.add('opacity-75');
            
            // Hide previous results immediately
            const results = document.getElementById('results');
            results.classList.add('hidden');
            
            fetch('/consultar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ cpf: cpf })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccessResult(data.data);
                } else {
                    showErrorResult(data.message);
                }
            })
            .catch(error => {
                console.error('Erro na consulta:', error);
                showErrorResult('Erro ao consultar. Verifique sua conexão e tente novamente.');
            })
            .finally(() => {
                // Hide loading
                btnText.textContent = 'Consultar Benefício';
                loadingSpinner.classList.add('hidden');
                searchBtn.disabled = false;
                searchBtn.classList.remove('opacity-75');
            });
        });

        function showSuccessResult(data) {
            // Populate data
            document.getElementById('nomeCompleto').textContent = data.nome_completo;
            document.getElementById('cpfResult').textContent = data.cpf;
            document.getElementById('dataCadastro').textContent = data.data_cadastro;
            document.getElementById('valorBeneficio').textContent = `R$ ${data.valor_beneficio}`;
            document.getElementById('mensagem').textContent = data.mensagem;
            
            const statusElement = document.getElementById('status');
            statusElement.textContent = data.status;
            
            // Enhanced status colors
            statusElement.className = 'px-4 py-2 rounded-full text-sm font-bold text-white ';
            switch(data.status) {
                case 'Aprovado':
                    statusElement.className += 'bg-gradient-to-r from-green-500 to-emerald-600';
                    break;
                case 'Em análise':
                    statusElement.className += 'bg-gradient-to-r from-yellow-500 to-orange-500';
                    break;
                case 'Rejeitado':
                    statusElement.className += 'bg-gradient-to-r from-red-500 to-pink-600';
                    break;
                case 'Pendente':
                    statusElement.className += 'bg-gradient-to-r from-gray-500 to-slate-600';
                    break;
                default:
                    statusElement.className += 'bg-gradient-to-r from-blue-500 to-indigo-600';
            }
            
            // Show/hide payment date
            const dataPagamentoContainer = document.getElementById('dataPagamentoContainer');
            const dataPagamento = document.getElementById('dataPagamento');
            if (data.data_pagamento) {
                dataPagamento.textContent = data.data_pagamento;
                dataPagamentoContainer.classList.remove('hidden');
            } else {
                dataPagamentoContainer.classList.add('hidden');
            }
            
            // Hide error result first
            document.getElementById('errorResult').classList.add('hidden');
            
            // Show success result
            document.getElementById('successResult').classList.remove('hidden');
            
            // Show results container
            const results = document.getElementById('results');
            results.classList.remove('hidden');
            
            // Force display to ensure visibility
            results.style.display = 'block';
            results.style.opacity = '1';
            results.style.visibility = 'visible';
            
            // Scroll to results
            setTimeout(() => {
                results.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }

        function showErrorResult(message) {
            document.getElementById('errorMessage').textContent = message;
            
            // Hide success result first
            document.getElementById('successResult').classList.add('hidden');
            
            // Show error result
            document.getElementById('errorResult').classList.remove('hidden');
            
            // Show results container
            const results = document.getElementById('results');
            results.classList.remove('hidden');
            
            // Force display to ensure visibility
            results.style.display = 'block';
            results.style.opacity = '1';
            results.style.visibility = 'visible';
            
            // Scroll to results
            setTimeout(() => {
                results.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }

        function resetForm() {
            document.getElementById('searchForm').reset();
            const results = document.getElementById('results');
            
            // Hide results properly
            results.classList.add('hidden');
            results.style.display = 'none';
            results.style.opacity = '0';
            results.style.visibility = 'hidden';
            
            // Hide both result types
            document.getElementById('successResult').classList.add('hidden');
            document.getElementById('errorResult').classList.add('hidden');
        }

        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html> 