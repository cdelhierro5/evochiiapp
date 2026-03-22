<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVOCHII | Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05050a;
            --bg-card: rgba(12, 12, 22, 0.7);
            --neon-blue: #00d1ff;
            --neon-green: #00ff99;
            --neon-pink: #ff0055;
            --neon-purple: #9d00ff;
            --text-main: #f0f0ff;
            --text-dim: #9090a0;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.12);
        }

        body.light-mode {
            --bg-dark: #f0f4f8;
            --bg-card: rgba(255, 255, 255, 0.9);
            --text-main: #1a1a2e;
            --text-dim: #5c5c70;
            --neon-blue: #0066ee;
            --neon-pink: #d50044;
            --neon-green: #008f5d;
            --neon-purple: #6200ea;
            --glass-border: rgba(0, 0, 0, 0.12);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 209, 255, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(157, 0, 255, 0.05) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(20, 20, 40, 0.1) 0%, var(--bg-dark) 100%);
            min-height: 100vh;
            display: flex; justify-content: center; align-items: center;
            padding: 20px; color: var(--text-main);
            overflow-x: hidden;
            transition: background 0.4s, color 0.4s;
        }

        body.light-mode {
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 102, 238, 0.03) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(98, 0, 234, 0.03) 0%, transparent 40%),
                linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
        }

        /* Ambient Background Particles */
        .bg-glow {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; z-index: -1;
            overflow: hidden;
        }
        .glow-circle {
            position: absolute; border-radius: 50%; 
            filter: blur(80px); opacity: 0.15;
            animation: move 20s infinite alternate;
        }

        @keyframes move {
            from { transform: translate(-20%, -20%); }
            to { transform: translate(20%, 20%); }
        }

        .container {
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            max-width: 440px; width: 100%; overflow: hidden;
            backdrop-filter: blur(25px);
            position: relative;
            animation: fadeIn 0.8s ease-out;
        }
        body.light-mode .container { background: rgba(255, 255, 255, 0.9); box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08); border-color: rgba(0,0,0,0.1); }
        
        /* TOP BAR: Mode & Lang */
        .top-bar { 
            position: absolute; top:0; left:0; width: 100%; padding: 15px 25px; 
            display: flex; justify-content: space-between; align-items: center; z-index: 100;
        }
        .mode-btn { 
            background: var(--glass); border: 1px solid var(--glass-border); color: var(--text-main); 
            padding: 8px 12px; border-radius: 12px; cursor: pointer; transition: all 0.3s; font-size: 1.1em; 
            display: flex; align-items: center; justify-content: center;
        }
        .mode-btn:hover { background: var(--glass-border); transform: translateY(-2px); }
        body.light-mode .mode-btn { background: rgba(0,0,0,0.05); border-color: rgba(0,0,0,0.1); color: #1a1a2e; }

        .lang-selector { display: flex; gap: 8px; }
        .lang-btn { 
            background: var(--glass); border: 1px solid var(--glass-border); padding: 5px 8px; 
            border-radius: 8px; cursor: pointer; transition: all 0.3s; font-size: 0.8em; opacity: 0.6;
            filter: grayscale(1);
        }
        .lang-btn.active { opacity: 1; filter: grayscale(0); border-color: var(--neon-blue); background: rgba(0, 209, 255, 0.1); }
        .lang-btn:hover { opacity: 1; filter: grayscale(0); transform: scale(1.1); }
        body.light-mode .lang-btn { background: rgba(0,0,0,0.05); border-color: rgba(0,0,0,0.1); }
        
        body.light-mode input { background: rgba(0, 0, 0, 0.03); border-color: rgba(0, 0, 0, 0.1); color: #1a1a2e; }
        body.light-mode input:focus { background: white; border-color: var(--neon-blue); box-shadow: 0 0 15px rgba(0, 102, 238, 0.1); }
        body.light-mode label { color: #5c5c70; }
        body.light-mode .demo-info { background: rgba(0, 102, 238, 0.05); border-color: rgba(0, 102, 238, 0.1); color: #5c5c70; }
        body.light-mode .tab-buttons { background: rgba(0, 0, 0, 0.05); }
        body.light-mode .header p { color: var(--neon-blue); opacity: 1; }
        body.light-mode .tab-btn { color: #5c5c70; }
        body.light-mode .tab-btn.active { color: white; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            padding: 60px 40px 40px; text-align: center;
            border-bottom: 1px solid var(--glass-border);
            position: relative;
        }

        .header h1 {
            font-family: 'JetBrains Mono', monospace; font-size: 2.5em;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            font-weight: 800; letter-spacing: -2px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 0.85em; color: var(--neon-blue);
            text-transform: uppercase; letter-spacing: 4px; font-weight: 700;
            opacity: 0.8;
        }

        .content { padding: 40px; }

        /* Custom Tab Styling */
        .tab-buttons {
            display: flex; position: relative;
            background: rgba(0, 0, 0, 0.3);
            padding: 5px; border-radius: 16px; margin-bottom: 40px;
            border: 1px solid var(--glass-border);
        }

        .tab-btn {
            flex: 1; padding: 14px; border: none; background: none;
            cursor: pointer; color: var(--text-dim); font-size: 0.85em;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
            z-index: 1; position: relative;
        }

        .tab-btn.active { color: white; }

        .tab-indicator {
            position: absolute; top: 5px; left: 5px; width: calc(50% - 5px); height: calc(100% - 10px);
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            border-radius: 12px; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 209, 255, 0.3);
        }

        /* Tab Content */
        .tab-content { display: none; animation: slideIn 0.4s ease-out; }
        .tab-content.active { display: block; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .form-group { margin-bottom: 30px; position: relative; }

        label {
            display: block; margin-bottom: 12px;
            color: var(--text-dim); font-size: 0.7em;
            text-transform: uppercase; letter-spacing: 2px;
            font-family: 'JetBrains Mono', monospace; font-weight: 600;
        }

        input {
            width: 100%; padding: 16px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px;
            color: white; font-size: 1em; transition: all 0.3s;
        }

        input:focus {
            outline: none; border-color: var(--neon-blue);
            background: rgba(255, 255, 255, 0.08);
            box-shadow: 0 0 20px rgba(0, 209, 255, 0.15);
        }

        .btn-container { margin-top: 20px; }

        button.main-btn {
            width: 100%; padding: 20px; border: none; border-radius: 50px;
            font-size: 0.95em; font-weight: 800; cursor: pointer;
            transition: all 0.4s; text-transform: uppercase; letter-spacing: 3px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            color: white; box-shadow: 0 10px 30px rgba(0, 209, 255, 0.3);
        }

        button.main-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 209, 255, 0.5);
        }

        button.main-btn:active { transform: translateY(-1px); }

        .demo-info {
            background: rgba(0, 209, 255, 0.05); padding: 25px;
            border-radius: 20px; margin-bottom: 35px;
            font-size: 0.85em; color: var(--text-dim);
            border: 1px solid rgba(0, 209, 255, 0.1);
            line-height: 1.6;
        }

        .demo-info strong { color: var(--neon-blue); display: block; margin-bottom: 8px; font-size: 1.1em; }

        .message { 
            padding: 16px; border-radius: 16px; margin-bottom: 30px; 
            display: none; font-size: 0.9em; font-weight: 600; text-align: center;
        }
        .message.success { background: rgba(0, 255, 153, 0.1); color: var(--neon-green); border: 1px solid rgba(0, 255, 153, 0.2); display: block; }
        .message.error { background: rgba(255, 0, 85, 0.1); color: var(--neon-pink); border: 1px solid rgba(255, 0, 85, 0.2); display: block; }

        /* Loader */
        .loading { display: none; text-align: center; margin: 15px 0; }
        .spinner {
            width: 24px; height: 24px; border: 3px solid rgba(255, 255, 255, 0.1);
            border-top: 3px solid var(--neon-blue); border-radius: 50%;
            animation: spin 1s linear infinite; display: inline-block;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 500px) {
            .container { border-radius: 0; min-height: 100vh; max-width: 100%; border: none; }
            .header { padding: 80px 30px 40px; }
            .content { padding: 30px; }
        }
    </style>
</head>
<body>
    <script>if(localStorage.getItem('evo_mode') === 'light') document.body.classList.add('light-mode');</script>

    <div class="bg-glow">
        <div class="glow-circle" style="width: 400px; height: 400px; background: var(--neon-blue); top: -100px; left: -100px;"></div>
        <div class="glow-circle" style="width: 300px; height: 300px; background: var(--neon-purple); bottom: -50px; right: -50px;"></div>
    </div>

    <div class="container" id="login-container">
        <div class="top-bar">
            <div class="lang-selector">
                <button class="lang-btn" onclick="setLang('es')" id="btn-es">🇪🇸</button>
                <button class="lang-btn" onclick="setLang('en')" id="btn-en">🇬🇧</button>
                <button class="lang-btn" onclick="setLang('pt')" id="btn-pt">🇵🇹</button>
                <button class="lang-btn" onclick="setLang('de')" id="btn-de">🇩🇪</button>
                <button class="lang-btn" onclick="setLang('fr')" id="btn-fr">🇫🇷</button>
            </div>
            <button class="mode-btn" onclick="toggleMode()" id="mode-btn">🌙</button>
        </div>
        <div class="header">
            <h1>EVOCHII</h1>
            <p data-i18n="lang_acc_title">Acceso al Ecosistema</p>
        </div>

        <div class="content">
            <!-- Tabs Navigator -->
            <div class="tab-buttons">
                <div class="tab-indicator" id="tab-indicator"></div>
                <button class="tab-btn active" onclick="switchTab('login')" data-i18n="lang_tab_login">Login</button>
                <button class="tab-btn" onclick="switchTab('register')" data-i18n="lang_tab_reg">Registrarse</button>
            </div>

            <!-- Tab: Login -->
            <div id="login-tab" class="tab-content active">
                <div class="demo-info">
                    <strong data-i18n="lang_demo">Demo:</strong>
                    Email: demo@tamagochi.test<br>
                    <span data-i18n="lang_pass">Contraseña</span>: password123
                </div>

                <div id="login-message" class="message"></div>

                <form id="login-form" onsubmit="handleLogin(event)">
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="login-password" data-i18n="lang_pass">Contraseña</label>
                        <input type="password" id="login-password" name="password" required placeholder="••••••••">
                    </div>

                    <div class="loading" id="login-loading"><div class="spinner"></div></div>

                    <div class="btn-container">
                        <button type="submit" class="main-btn" data-i18n="lang_btn_in">Ingresar</button>
                    </div>
                </form>
            </div>

            <!-- Tab: Register -->
            <div id="register-tab" class="tab-content">
                <div id="register-message" class="message"></div>

                <form id="register-form" onsubmit="handleRegister(event)">
                    <div class="form-group">
                        <label for="register-name" data-i18n="lang_name">Nombre</label>
                        <input type="text" id="register-name" name="name" required placeholder="Tu nombre completo">
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" required placeholder="tu@email.com">
                    </div>

                    <div class="form-group">
                        <label for="register-password" data-i18n="lang_pass">Contraseña</label>
                        <input type="password" id="register-password" name="password" required placeholder="••••••••" minlength="4">
                    </div>

                    <div class="loading" id="register-loading"><div class="spinner"></div></div>

                    <div class="btn-container">
                        <button type="submit" class="main-btn" data-i18n="lang_btn_reg">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const API_URL = '/api';
        
        // I18N and Theme Initialization
    let currentLang = localStorage.getItem('evo_lang') || 'es';
    let currentMode = localStorage.getItem('evo_mode') || 'dark';

    function setMode(mode) {
        currentMode = mode;
        localStorage.setItem('evo_mode', mode);
        const btn = document.getElementById('mode-btn');
        if (mode === 'light') {
            document.body.classList.add('light-mode');
            if (btn) btn.textContent = '🌙';
        } else {
            document.body.classList.remove('light-mode');
            if (btn) btn.textContent = '☀️';
        }
    }

    function toggleMode() {
        setMode(currentMode === 'dark' ? 'light' : 'dark');
    }

    function setLang(lang) {
        currentLang = lang;
        localStorage.setItem('evo_lang', lang);
        
        // Highlight active flag
        document.querySelectorAll('.lang-btn').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.getElementById(`btn-${lang}`);
        if (activeBtn) activeBtn.classList.add('active');

        // Translate
        const dict = I18N[lang] || I18N['es'];
        document.querySelectorAll('[data-i18n]').forEach(el => {
            const key = el.getAttribute('data-i18n');
            if (dict[key]) {
                if (el.tagName === 'INPUT') el.placeholder = dict[key];
                else el.textContent = dict[key];
            }
        });
    }

    const I18N = {
            es: {
                lang_acc_title: 'Mejora tu vida de forma divertida', lang_tab_login: 'Login', lang_tab_reg: 'Registrarse',
                lang_demo: 'Demo:', lang_pass: 'Contraseña', lang_name: 'Nombre',
                lang_btn_in: 'Ingresar', lang_btn_reg: 'Registrarse', lang_err_login: 'Error en el acceso',
                lang_err_reg: 'Error en el registro', lang_msg_wait: 'Procesando biometría...'
            },
            en: {
                lang_acc_title: 'Improve your life the fun way', lang_tab_login: 'Login', lang_tab_reg: 'Register',
                lang_demo: 'Demo:', lang_pass: 'Password', lang_name: 'Name',
                lang_btn_in: 'Login', lang_btn_reg: 'Register', lang_err_login: 'Access error',
                lang_err_reg: 'Registration error', lang_msg_wait: 'Processing biometrics...'
            },
            pt: {
                lang_acc_title: 'Melhore sua vida de forma divertida', lang_tab_login: 'Login', lang_tab_reg: 'Registrar',
                lang_demo: 'Demo:', lang_pass: 'Senha', lang_name: 'Nome',
                lang_btn_in: 'Entrar', lang_btn_reg: 'Registrar', lang_err_login: 'Erro no acesso',
                lang_err_reg: 'Erro no registro', lang_msg_wait: 'Processando biometria...'
            },
            de: {
                lang_acc_title: 'Verbessere dein Leben auf spielerische Weise', lang_tab_login: 'Login', lang_tab_reg: 'Registrieren',
                lang_demo: 'Demo:', lang_pass: 'Passwort', lang_name: 'Name',
                lang_btn_in: 'Anmelden', lang_btn_reg: 'Registrieren', lang_err_login: 'Fehler beim Zugang',
                lang_err_reg: 'Fehler bei der Registrierung', lang_msg_wait: 'Biometrie-Verarbeitung...'
            },
            fr: {
                lang_acc_title: 'Améliore ta vie de façon amusante', lang_tab_login: 'Login', lang_tab_reg: 'S\'inscrire',
                lang_demo: 'Démo:', lang_pass: 'Mot de passe', lang_name: 'Nom',
                lang_btn_in: 'Entrer', lang_btn_reg: 'S\'inscrire', lang_err_login: 'Erreur d\'accès',
                lang_msg_conn_error: 'Error de conexión', lang_msg_invalid: 'Datos inválidos',
                lang_msg_loading: 'Cargando...', lang_msg_streak: 'Racha'
            }
        };

    // Initialize state
    setMode(currentMode);
    setLang(currentLang);


        function switchTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            const indicator = document.getElementById('tab-indicator');
            
            document.getElementById(tab + '-tab').classList.add('active');
            const activeBtn = Array.from(document.querySelectorAll('.tab-btn')).find(b => b.onclick.toString().includes(tab));
            if (activeBtn) activeBtn.classList.add('active');

            indicator.style.left = tab === 'login' ? '5px' : 'calc(50% + 0px)';
        }

        function showMessage(elementId, message, type) {
            const el = document.getElementById(elementId);
            el.textContent = message;
            el.className = `message ${type}`;
            setTimeout(() => el.style.display = 'block', 10);
        }

        async function handleLogin(event) {
            event.preventDefault();
            const dict = I18N[currentLang] || I18N['es'];
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            const loading = document.getElementById('login-loading');
            
            loading.style.display = 'block';
            try {
                const response = await fetch(`${API_URL}/auth/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await response.json();
                loading.style.display = 'none';

                if (!response.ok) {
                    showMessage('login-message', '❌ ' + (data.message || dict['lang_err_login']), 'error');
                    return;
                }
                localStorage.setItem('auth_token', data.token);
                window.location.href = '/dashboard';
            } catch (error) {
                loading.style.display = 'none';
                showMessage('login-message', '❌ ' + error.message, 'error');
            }
        }

        async function handleRegister(event) {
            event.preventDefault();
            const dict = I18N[currentLang] || I18N['es'];
            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;
            const loading = document.getElementById('register-loading');
            
            loading.style.display = 'block';
            try {
                const response = await fetch(`${API_URL}/auth/register`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ name, email, password })
                });
                const data = await response.json();
                loading.style.display = 'none';

                if (!response.ok) {
                    showMessage('register-message', '❌ ' + (data.message || dict['lang_err_reg']), 'error');
                    return;
                }
                localStorage.setItem('auth_token', data.token);
                // Auto login after register
                window.location.href = '/dashboard';
            } catch (error) {
                loading.style.display = 'none';
                showMessage('register-message', '❌ ' + error.message, 'error');
            }
        }

        // Initial state set by setLang(currentLang) and setMode(currentMode)
    </script>
</body>
</html>
