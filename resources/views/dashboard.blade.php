<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚡ Evochii - Tu Evolución Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #05050a;
            --bg-card: rgba(12, 12, 22, 0.7);
            --text-main: #ffffff;
            --text-dim: #a0a0b0;
            --neon-blue: #00d1ff;
            --neon-pink: #ff0055;
            --neon-green: #00ff99;
            --border-glow: rgba(0, 209, 255, 0.3);
            --glass-border: rgba(255, 255, 255, 0.08);
            --bg-nav: rgba(5, 5, 10, 0.95);
        }

        body.light-mode {
            --bg-dark: #f0f4f8;
            --bg-card: rgba(255, 255, 255, 0.9);
            --text-main: #1a1a2e;
            --text-dim: #5c5c70;
            --neon-blue: #0066ee;
            --neon-pink: #d50044;
            --neon-green: #008f5d;
            --border-glow: rgba(0, 102, 238, 0.15);
            --glass-border: rgba(0, 0, 0, 0.12);
            --bg-nav: rgba(255, 255, 255, 0.98);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            background-image: 
                var(--bg-grad),
                linear-gradient(rgba(10, 10, 20, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(10, 10, 20, 0.05) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background-color 0.5s, color 0.5s;
        }

        /* ONBOARDING SCREEN */
        #onboarding-screen {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: var(--bg-dark);
            z-index: 5000;
            display: flex; justify-content: center; align-items: center; padding: 20px;
            overflow-y: auto;
        }

        .onboarding-card {
            background: var(--bg-card);
            border: 1px solid var(--neon-blue);
            box-shadow: 0 0 30px var(--border-glow);
            padding: 40px; border-radius: 24px;
            max-width: 800px; width: 100%; text-align: center;
            margin: auto;
        }

        .onboarding-card h2 {
            font-size: 2.8em; margin-bottom: 30px;
            color: var(--neon-blue);
            text-shadow: 0 0 15px rgba(0, 209, 255, 0.4);
            font-weight: 800; letter-spacing: -1px;
        }

        .form-label {
            display: block; margin-bottom: 15px; text-align: left;
            font-size: 0.8em; color: var(--neon-blue);
            text-transform: uppercase; letter-spacing: 2px;
            font-family: 'JetBrains Mono', monospace; font-weight: 700;
        }

        /* HABIT SELECTION GRID */
        .habit-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;
            margin-bottom: 35px;
        }

        .habit-opt {
            background: var(--bg-card); border: 1px solid var(--text-dim);
            padding: 15px 5px; border-radius: 14px; cursor: pointer;
            transition: all 0.3s; font-size: 0.75em;
            display: flex; flex-direction: column; align-items: center; gap: 8px;
            color: var(--text-main);
        }
        .habit-opt:hover { border-color: var(--neon-blue); background: rgba(0, 209, 255, 0.05); }
        .habit-opt.selected { border-color: var(--neon-green); background: rgba(0, 255, 153, 0.1); box-shadow: 0 0 15px rgba(0, 255, 153, 0.2); }
        .habit-opt span { font-size: 1.4em; }
        .habit-opt label { cursor: pointer; font-weight: 600; }

        /* PERSONALITY SELECTOR */
        .personality-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;
            margin-bottom: 35px;
        }

        .personality-opt {
            background: var(--bg-card); border: 1px solid var(--text-dim);
            padding: 15px; border-radius: 12px; cursor: pointer;
            transition: all 0.3s; font-size: 0.75em;
            display: flex; flex-direction: column; align-items: center; gap: 5px;
            color: var(--text-main);
        }
        .personality-opt:hover { border-color: var(--neon-blue); }
        .personality-opt.selected { border-color: var(--neon-purple); background: rgba(157, 0, 255, 0.1); box-shadow: 0 0 15px rgba(157, 0, 255, 0.2); }
        .personality-opt i { font-size: 1.6em; font-style: normal; }

        /* AVATAR SELECTOR */
        .avatar-grid {
            display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px;
            margin-bottom: 35px;
        }
        .avatar-opt {
            font-size: 2em; padding: 12px;
            border: 2px solid var(--text-dim); border-radius: 12px;
            cursor: pointer; transition: all 0.3s; background: var(--bg-card);
        }
        .avatar-opt:hover { border-color: var(--neon-blue); }
        .avatar-opt.selected { border-color: var(--neon-blue); background: rgba(0, 209, 255, 0.2); box-shadow: 0 0 20px var(--border-glow); }

        .btn-sync {
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            color: white; border: none; padding: 22px 70px;
            border-radius: 50px; font-weight: 800; cursor: pointer;
            text-transform: uppercase; letter-spacing: 4px;
            margin-top: 10px; box-shadow: 0 0 25px rgba(0, 209, 255, 0.4);
            transition: all 0.3s;
        }
        .btn-sync:hover { transform: scale(1.05); box-shadow: 0 0 45px rgba(0, 209, 255, 0.6); }

        /* MAIN LAYOUT */
        #main-content-area { padding-top: 20px; }
        #main-dashboard { 
            display: flex; 
            flex-direction: column; 
            gap: 30px; 
            align-items: center; 
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .evo-hub { 
            width: 100%;
            background: rgba(15, 15, 30, 0.6); 
            padding: 40px; 
            border-radius: 30px; 
            border: 1px solid rgba(0, 209, 255, 0.2);
            display: flex; flex-direction: column; align-items: center; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        body.light-mode .evo-hub { background: rgba(255, 255, 255, 0.6); border-color: rgba(0,0,0,0.1); box-shadow: 0 20px 50px rgba(0,0,0,0.05); }

        .habits-section { width: 100%; margin-top: 20px; }

        /* Ambient Glow Layers - Fixed Selectors */
        .winter .env-visual { background: linear-gradient(to bottom, #001020, #003366); }
        .spring .env-visual { background: linear-gradient(to bottom, #100520, #2d1b4d); }
        .summer .env-visual { background: linear-gradient(to bottom, #051020, #142850); }
        .autumn .env-visual { background: linear-gradient(to bottom, #201005, #5d2e13); }
        /* HEADER CLOCK */
        .header-clock { text-align: center; flex: 1; }
        #h-time { font-family: 'JetBrains Mono', monospace; font-size: 1.2em; font-weight: 800; color: var(--neon-blue); }
        #h-date { font-size: 0.6em; color: var(--text-dim); text-transform: uppercase; letter-spacing: 1px; }

        /* DASHBOARD NAV */
        .nav-bar {
            padding: 10px 40px; display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid var(--glass-border); 
            background: var(--bg-nav);
            backdrop-filter: blur(15px); position: fixed; top: 0; left: 0; width: 100%; z-index: 10000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .nav-bar .logo { font-family: 'JetBrains Mono', monospace; font-size: 1.2em; color: var(--text-main); letter-spacing: 1px; font-weight: 800; }

        .container { max-width: 900px; margin: 0 auto; padding: 40px 20px; }

        .evo-hub { display: flex; flex-direction: column; align-items: center; margin-bottom: 50px; position: relative; }

        /* NOTIFICATION / ALERT */
        .evo-alert {
            position: absolute; top: -20px; right: 50%; transform: translateX(50%);
            background: var(--neon-pink); color: white; padding: 8px 16px; border-radius: 20px;
            font-size: 0.8em; font-weight: 800; font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 0 20px rgba(255, 0, 85, 0.5);
            animation: bounce 2s infinite; display: none; z-index: 10;
        }
        @keyframes bounce { 0%, 100% { transform: translate(50%, 0); } 50% { transform: translate(50%, -10px); } }

        .thought-bubble {
            background: var(--bg-card); border: 1px solid var(--neon-blue);
            padding: 18px 28px; border-radius: 24px; margin-bottom: 30px;
            max-width: 450px; text-align: center; box-shadow: 0 0 25px var(--border-glow);
            font-style: italic; relative; transition: all 0.5s;
        }
        .avatar-container { 
            position: relative; width: 280px; height: 280px; margin-bottom: 40px; 
            display: flex; justify-content: center; align-items: center; border-radius: 50%;
            overflow: hidden; border: 1px solid var(--glass-border);
            background: #000; transition: all 1s ease;
        }
        
        .env-visual { position: absolute; top:0; left:0; width: 100%; height: 100%; z-index: 0; transition: all 1s; }

        /* ATMOSPHERIC ENVIRONMENTS v2.5 (Fixed) */
        .env-visual { 
            position: absolute; top:0; left:0; width: 100%; height: 100%; 
            z-index: 0; transition: all 1s; overflow: hidden; 
        }

        /* ATMOSPHERIC ENVIRONMENTS v2.6 (Reinforced) */
        .avatar-container.winter .env-visual { background: linear-gradient(to bottom, #001020, #003366) !important; }
        .avatar-container.spring .env-visual { background: linear-gradient(to bottom, #1a0533, #3d1b5d) !important; }
        .avatar-container.summer .env-visual { background: linear-gradient(to bottom, #051020, #1a3a6d) !important; }
        .avatar-container.autumn .env-visual { background: linear-gradient(to bottom, #2d1405, #6d3a1a) !important; }

        .particle {
            position: absolute; pointer-events: none; user-select: none;
            font-size: 1.4rem; opacity: 0; animation: particle-fall var(--d) linear infinite;
            filter: drop-shadow(0 0 5px rgba(255,255,255,0.3));
            z-index: 5;
        }

        @keyframes particle-fall {
            0% { transform: translateY(-30px) rotate(0deg); opacity: 0; }
            10%, 90% { opacity: 0.8; }
            100% { transform: translateY(320px) rotate(360deg); opacity: 0; }
        }

        .celestial-body {
            position: absolute; top: 15px; right: 25px; font-size: 2.2rem;
            filter: drop-shadow(0 0 10px currentColor); transition: all 2s; z-index: 1;
        }

        .avatar-visual { 
            position: relative; width: 160px; height: 160px; 
            z-index: 2; transition: all 0.5s; 
            display: flex; justify-content: center; align-items: center;
        }

        .evo-face {
            position: relative; width: 130px; height: 130px; border-radius: 50%; 
            display: flex; justify-content: center; align-items: center;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: inset -8px -8px 15px rgba(0,0,0,0.1), inset 8px 8px 20px rgba(255,255,255,0.4), 0 10px 30px rgba(0,0,0,0.3);
        }

        /* SPECIES BIOLOGY */
        .face-chick  { background: radial-gradient(circle at 30% 30%, #fff275, #ffeb3b 60%, #fbc02d); }
        .face-frog   { background: radial-gradient(circle at 30% 30%, #a2ff75, #4caf50 60%, #2e7d32); }
        .face-cat    { background: radial-gradient(circle at 30% 30%, #ff80ab, #e91e63 60%, #880e4f); }
        .face-dog    { background: radial-gradient(circle at 30% 30%, #ffa726, #ef6c00 60%, #bf360c); }
        .face-panda  { background: radial-gradient(circle at 30% 30%, #ffffff, #e0e0e0 60%, #9e9e9e); }
        .face-robot  { background: radial-gradient(circle at 30% 30%, #b0bec5, #78909c 60%, #37474f); border-radius: 24px; }
        .face-ghost  { background: radial-gradient(circle at 30% 30%, #f5f5f5, #e0e0e0 60%, #ffffff); opacity: 0.8; }
        .face-alien  { background: radial-gradient(circle at 30% 30%, #ccff00, #9dff00 60%, #00ff99); }
        .face-dragon { background: radial-gradient(circle at 30% 30%, #ff5252, #d32f2f 60%, #b71c1c); }
        .face-unicorn{ background: radial-gradient(circle at 30% 30%, #f8bbd0, #f06292 60%, #ad1457); }
        .face-monkey { background: radial-gradient(circle at 30% 30%, #8d6e63, #5d4037 60%, #3e2723); }
        .face-owl    { background: radial-gradient(circle at 30% 30%, #d7ccc8, #a1887f 60%, #4e342e); }
        .face-fox    { background: radial-gradient(circle at 30% 30%, #ffb74d, #fb8c00 60%, #e65100); }
        .face-koala  { background: radial-gradient(circle at 30% 30%, #cfd8dc, #90a4ae 60%, #455a64); }
        .face-penguin{ background: radial-gradient(circle at 30% 30%, #424242, #212121 60%, #000000); }
        .face-lion   { background: radial-gradient(circle at 30% 30%, #ffc107, #ff9800 60%, #e65100); }
        .face-tiger  { background: radial-gradient(circle at 30% 30%, #ff9800, #fb8c00 60%, #212121 95%); }
        .face-raccoon{ background: radial-gradient(circle at 30% 30%, #9e9e9e, #616161 60%, #212121); }
        .face-wizard { background: radial-gradient(circle at 30% 30%, #9575cd, #673ab7 60%, #311b92); }
        .face-hamster{ background: radial-gradient(circle at 30% 30%, #ffe0b2, #ffcc80 60%, #a1887f); }

        /* SPECIES FEATURES (Ears/Horns/Etc) */
        .evo-face::before, .evo-face::after { content: ''; position: absolute; transition: all 0.5s; z-index: -1; }
        
        /* 1. Pointy Ears (Cat, Fox, Tiger) */
        .face-cat::before, .face-cat::after, .face-fox::before, .face-fox::after, .face-tiger::before, .face-tiger::after {
            width: 45px; height: 45px; background: inherit; top: -18px; clip-path: polygon(50% 0, 0 100%, 100% 100%);
        }
        .face-cat::before, .face-fox::before, .face-tiger::before { left: 5px; transform: rotate(-20deg); }
        .face-cat::after, .face-fox::after, .face-tiger::after   { right: 5px; transform: rotate(20deg); }

        /* 2. Round Ears (Panda, Monkey, Koala, Lion, Raccoon, Hamster) */
        .face-panda::before, .face-panda::after, .face-monkey::before, .face-monkey::after, .face-koala::before, .face-koala::after,
        .face-lion::before, .face-lion::after, .face-raccoon::before, .face-raccoon::after, .face-hamster::before, .face-hamster::after {
            width: 45px; height: 45px; background: inherit; top: -8px; border-radius: 50%;
        }
        .face-panda::before, .face-monkey::before, .face-koala::before, .face-lion::before, .face-raccoon::before, .face-hamster::before { left: -8px; }
        .face-panda::after, .face-monkey::after, .face-koala::after, .face-lion::after, .face-raccoon::after, .face-hamster::after { right: -8px; }
        .face-panda::before, .face-panda::after, .face-raccoon::before, .face-raccoon::after { background: #212121; }
        .face-lion::before { width: 150px; height: 150px; border-radius: 50%; background: #e65100; top: -10px; left: -10px; z-index: -2; opacity: 0.8; }

        /* 3. Special Species (Robot, Dragon, Unicorn, Penguin, Wizard) */
        .face-robot::before { width: 4px; height: 35px; background: #607d8b; top: -30px; left: 50%; transform: translateX(-50%); }
        .face-robot::after  { width: 12px; height: 12px; background: var(--neon-pink); top: -40px; left: 50%; transform: translateX(-50%); border-radius: 50%; box-shadow: 0 0 15px var(--neon-pink); }
        
        .face-dragon::before, .face-dragon::after { width: 25px; height: 55px; background: #ffeb3b; top: -30px; clip-path: polygon(50% 0, 0 100%, 100% 100%); }
        .face-dragon::before { left: 20px; transform: rotate(-30deg); } .face-dragon::after { right: 20px; transform: rotate(30deg); }
        
        .face-unicorn::before { width: 18px; height: 70px; background: linear-gradient(to top, #fff, #9d00ff); top: -55px; left: 50%; transform: translateX(-50%); clip-path: polygon(50% 0, 0 100%, 100% 100%); }
        
        .face-penguin::before { width: 70px; height: 70px; background: white; bottom: 0; border-radius: 50%; z-index: 0; }
        .face-wizard::before  { width: 140px; height: 80px; background: #4a148c; top: -60px; left: 50%; transform: translateX(-50%); clip-path: polygon(50% 0, 0 100%, 100% 100%); }

        /* Eyes with Pupiles & Reflections */
        .eye {
            position: absolute; width: 22px; height: 22px;
            background: #1a1a1a; border-radius: 50%; top: 35%;
            overflow: hidden; border: 2px solid rgba(0,0,0,0.1);
        }
        .eye.left { left: 22%; }
        .eye.right { right: 22%; }

        .eye::after { /* Reflection */
            content: ''; position: absolute; width: 6px; height: 6px;
            background: #fff; border-radius: 50%; top: 3px; left: 4px; opacity: 0.8;
        }

        /* Eyelids for realistic blink */
        .eyelid {
            position: absolute; top: -100%; left: 0; width: 100%; height: 100%;
            background: inherit; transition: top 0.15s ease-in-out;
            border-bottom: 2px solid rgba(0,0,0,0.1);
        }
        .blink .eyelid { top: 0; }

        .beak {
            position: absolute; width: 24px; height: 18px; background: #ff9800; clip-path: polygon(0 0, 100% 0, 50% 100%);
            top: 55%; transition: all 0.3s; box-shadow: 0 4px 5px rgba(0,0,0,0.2); z-index: 3;
        }

        .nose {
            position: absolute; width: 12px; height: 8px; background: rgba(0,0,0,0.2); border-radius: 50%;
            top: 58%; transition: all 0.3s; z-index: 3; display: none;
        }
        .face-koala .nose { width: 20px; height: 26px; background: #333; border-radius: 12px 12px 8px 8px; top: 48%; display: block; }
        .face-cat .nose, .face-dog .nose, .face-fox .nose { width: 10px; height: 6px; background: #333; display: block; }

        .blush {
            position: absolute; width: 20px; height: 10px;
            background: rgba(255, 100, 150, 0.3); border-radius: 50%;
            top: 52%; filter: blur(4px); opacity: 0; transition: opacity 0.5s;
        }
        .blush.left { left: 15%; }
        .blush.right { right: 15%; }
        .state-high .blush { opacity: 1; }

        /* Specific Styles */
        .face-chick { background: radial-gradient(circle at 30% 30%, #fff275, #ffeb3b 60%, #fbc02d); }
        .face-frog { background: radial-gradient(circle at 30% 30%, #a5d6a7, #4caf50 60%, #2e7d32); }
        .face-fox { background: radial-gradient(circle at 30% 30%, #ffab91, #ff5722 60%, #d84315); }
        .face-panda { 
            background: #fff; 
            border: 8px solid #1a1a1a;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        }
        .face-panda .eye { border: 4px solid #1a1a1a; width: 26px; height: 26px; }
        .face-panda .beak { background: #1a1a1a; width: 12px; height: 8px; border-radius: 50%; clip-path: none; }

        .face-cat { background: radial-gradient(circle at 30% 30%, #ffccbc, #ff8a65 60%, #e64a19); }
        .face-cat::before, .face-cat::after { /* Ears */
            content: ''; position: absolute; top: -15px; width: 30px; height: 30px;
            background: inherit; clip-path: polygon(50% 0%, 0% 100%, 100% 100%); z-index: -1;
        }
        .face-cat::before { left: 10px; transform: rotate(-20deg); }
        .face-cat::after { right: 10px; transform: rotate(20deg); }

        .face-robot { 
            background: linear-gradient(135deg, #b0bec5, #78909c); 
            border-radius: 20% 20% 40% 40%;
            border: 2px solid rgba(0,0,0,0.2);
        }
        .face-robot .eye { background: #000; border: 2px solid #00d1ff; box-shadow: 0 0 10px #00d1ff; }
        .face-robot .eye::after { background: #00d1ff; }
        .face-robot .beak { background: #455a64; height: 6px; border-radius: 2px; clip-path: none; width: 40px; }

        /* EVO ANIMS */
        .anim-idle { animation: evo-float 3s ease-in-out infinite; }
        .anim-happy { animation: evo-bounce 0.6s ease-in-out infinite; }
        .anim-tired { animation: evo-droop 4s ease-in-out infinite; }
        .anim-stressed { animation: evo-shake 0.3s ease-in-out infinite; }
        .anim-focus { animation: evo-pulse-intense 2s ease-in-out infinite; }

        @keyframes evo-float { 0%, 100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-10px) rotate(2deg); } }
        @keyframes evo-bounce { 0%, 100% { transform: translateY(0) scale(1, 1); } 50% { transform: translateY(-30px) scale(0.9, 1.1); } }
        @keyframes evo-droop { 0%, 100% { transform: translateY(0) scale(1, 1); filter: grayscale(0.5); } 50% { transform: translateY(8px) scale(1.1, 0.85); filter: grayscale(0.8); } }
        @keyframes evo-shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-4px) rotate(-3deg); } 75% { transform: translateX(4px) rotate(3deg); } }
        @keyframes evo-pulse-intense { 0%, 100% { transform: scale(1); filter: brightness(1.1); } 50% { transform: scale(1.08); filter: brightness(1.3); } }

        .stats-panel { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; width: 100%; margin-bottom: 50px; }
        .stat-card { background: var(--bg-card); padding: 22px; border-radius: 18px; border: 1px solid #1a1a2a; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
        .form-label { display: block; margin-bottom: 12px; font-weight: 700; color: var(--neon-blue); text-transform: uppercase; letter-spacing: 2px; font-size: 0.85em; }
        body.light-mode .form-label, body.light-mode label { color: #004499; }
        body.light-mode .onboarding-card h2 { color: #1a1a2e; text-shadow: none; }
        body.light-mode .onboarding-card { background: white; border-color: rgba(0,0,0,0.1); box-shadow: 0 10px 40px rgba(0,0,0,0.1); }
        .stat-card label { display: block; font-size: 0.75em; color: var(--text-dim); text-transform: uppercase; margin-bottom: 12px; font-weight: 600; letter-spacing: 1px; }
        .stat-card .value { font-family: 'JetBrains Mono', monospace; font-size: 1.5em; color: white; font-weight: 800; }
        body.light-mode .stat-card .value { color: #1a1a2e; }
        .stat-bar-bg { height: 6px; background: #151525; border-radius: 3px; margin-top: 15px; overflow: hidden; }
        body.light-mode .stat-bar-bg { background: rgba(0,0,0,0.1); }
        .stat-bar-fill { height: 100%; width: 0%; transition: width 0.8s cubic-bezier(0.1, 0.7, 1.0, 1.0); box-shadow: 0 0 10px currentColor; }

        .actions-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; width: 100%; }
        .action-btn {
            background: #0f0f1f; border: 1px solid #252535; padding: 20px; border-radius: 18px;
            color: var(--text-main); cursor: pointer; transition: all 0.3s;
            display: flex; flex-direction: column; align-items: center; gap: 8px;
        }
        .action-btn:hover { border-color: var(--neon-blue); background: #151525; transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0, 209, 255, 0.2); }
        body.light-mode .action-btn { background: white; border-color: rgba(0, 0, 0, 0.1); color: #1a1a2e; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        body.light-mode .action-btn:hover { background: #f8fbff; border-color: var(--neon-blue); box-shadow: 0 10px 30px rgba(0, 102, 238, 0.15); transform: translateY(-5px); }
        .action-btn strong { font-size: 1em; letter-spacing: 1px; }
        .action-btn span { font-size: 0.75em; color: var(--text-dim); font-family: 'JetBrains Mono', monospace; }
        body.light-mode .action-btn span { color: #5c5c70; }

        .habits-section { width: 100%; margin-top: 50px; border-top: 1px solid #202030; padding-top: 40px; }
        .habits-section h2 { font-size: 1.2em; color: var(--neon-blue); margin-bottom: 30px; text-transform: uppercase; letter-spacing: 4px; text-align: center; }
        .habit-card { background: var(--bg-card); padding: 20px; border-radius: 16px; margin-bottom: 15px; display: flex; align-items: center; gap: 20px; border: 1px solid #1a1a2a; transition: all 0.3s; }
        .habit-card.completed { border-color: var(--neon-green); opacity: 0.6; transform: scale(0.98); }
        .habit-check { width: 30px; height: 30px; border: 2px solid #303045; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s; }
        .habit-check.checked { background: var(--neon-green); border-color: var(--neon-green); color: black; }

        .nav-btn {
            background: rgba(255, 0, 85, 0.05); border: 1px solid var(--neon-pink);
            color: var(--neon-pink); padding: 10px 22px; border-radius: 12px;
            font-family: 'JetBrains Mono', monospace; font-weight: 700;
            font-size: 0.75em; cursor: pointer; transition: all 0.3s;
            text-transform: uppercase; letter-spacing: 2px;
            box-shadow: 0 0 5px rgba(255, 0, 85, 0.1);
        }
        .nav-btn:hover { background: var(--neon-pink); color: white; box-shadow: 0 0 20px rgba(255, 0, 85, 0.5); transform: translateY(-2px); }

        .message { position: fixed; bottom: 30px; right: 30px; padding: 20px 35px; border-radius: 15px; color: white; transform: translateY(150px); transition: transform 0.4s; z-index: 10000; font-weight: 700; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .message.show { transform: translateY(0); }
        .message.success { background: var(--neon-green); color: black; border-left: 5px solid #00c776; }
        .message.warning { background: #ff9900; color: black; }
        .message.error { background: var(--neon-pink); }
    </style>
</head>
<body>
    <script>if(localStorage.getItem('evo_mode') === 'light') document.body.classList.add('light-mode');</script>


    <div class="nav-bar">
        <div class="logo">⚡ EVOCHII</div>
        
        <!-- RELOJ CENTRAL -->
        <div class="header-clock">
            <div id="h-time">00:00</div>
            <div id="h-date">Sábado, 21 de Marzo</div>
        </div>

        <div style="display: flex; gap: 10px; align-items: center;">
            <button class="nav-btn" onclick="toggleMode()" id="mode-btn">🌙</button>
            <button class="nav-btn" onclick="openSettings()" data-i18n="lang_options">⚙️ Configuración</button>
            <button class="nav-btn logout-btn" onclick="logout()" data-i18n="lang_logout">🚪 Desconectar</button>
        </div>
    </div>

    <!-- ONBOARDING / CONFIG SCREEN (Consolidated v2.8) -->
    <div id="onboarding-screen" class="onboarding-screen" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: var(--bg-dark); z-index: 5000; padding-top: 80px;">
        <div class="onboarding-card" style="max-height: 90vh; overflow-y: auto;">
            <h2 id="onboarding-title" data-i18n="lang_sync_title">Centro de Control Evochii</h2>
            <form id="onboarding-form">
                
                <!-- 0. IDIOMA (ARRIBA) -->
                <label class="form-label" data-i18n="lang_select_language">Idioma / Language</label>
                <div style="display: flex; gap: 10px; margin-bottom: 30px; justify-content: center; flex-wrap: wrap;">
                    <button type="button" class="nav-btn" onclick="setLanguage('es')">🇪🇸 ES</button>
                    <button type="button" class="nav-btn" onclick="setLanguage('en')">🇬🇧 EN</button>
                    <button type="button" class="nav-btn" onclick="setLanguage('pt')">🇵🇹 PT</button>
                    <button type="button" class="nav-btn" onclick="setLanguage('de')">🇩🇪 DE</button>
                    <button type="button" class="nav-btn" onclick="setLanguage('fr')">🇫🇷 FR</button>
                </div>

                <!-- 1. SELECCIÓN DE EVO -->
                <label class="form-label" data-i18n="lang_select_avatar">Selecciona tu Evochii</label>
                <div class="avatar-grid" id="avatar-selector" style="grid-template-columns: repeat(5, 1fr);">
                    <div class="avatar-opt" onclick="setAvatar('chick')" data-key="chick">🐤</div>
                    <div class="avatar-opt" onclick="setAvatar('robot')" data-key="robot">🤖</div>
                    <div class="avatar-opt" onclick="setAvatar('frog')" data-key="frog">🐸</div>
                    <div class="avatar-opt" onclick="setAvatar('fox')" data-key="fox">🦊</div>
                    <div class="avatar-opt" onclick="setAvatar('hamster')" data-key="hamster">🐹</div>
                    <div class="avatar-opt" onclick="setAvatar('owl')" data-key="owl">🦉</div>
                    <div class="avatar-opt" onclick="setAvatar('lion')" data-key="lion">🦁</div>
                    <div class="avatar-opt" onclick="setAvatar('tiger')" data-key="tiger">🐯</div>
                    <div class="avatar-opt" onclick="setAvatar('raccoon')" data-key="raccoon">🦝</div>
                    <div class="avatar-opt" onclick="setAvatar('wizard')" data-key="wizard">🧙</div>
                    <div class="avatar-opt" onclick="setAvatar('cat')" data-key="cat">🐱</div>
                    <div class="avatar-opt" onclick="setAvatar('dog')" data-key="dog">🐶</div>
                    <div class="avatar-opt" onclick="setAvatar('panda')" data-key="panda">🐼</div>
                    <div class="avatar-opt" onclick="setAvatar('alien')" data-key="alien">👽</div>
                    <div class="avatar-opt" onclick="setAvatar('dragon')" data-key="dragon">🐲</div>
                    <div class="avatar-opt" onclick="setAvatar('unicorn')" data-key="unicorn">🦄</div>
                    <div class="avatar-opt" onclick="setAvatar('monkey')" data-key="monkey">🐒</div>
                    <div class="avatar-opt" onclick="setAvatar('koala')" data-key="koala">🐨</div>
                    <div class="avatar-opt" onclick="setAvatar('penguin')" data-key="penguin">🐧</div>
                    <div class="avatar-opt" onclick="setAvatar('ghost')" data-key="ghost">👻</div>
                </div>

                <!-- 2. HÁBITOS -->
                <label class="form-label" style="margin-top: 30px;">Tus Hábitos Diarios</label>
                <div class="habit-grid">
                    <div class="habit-opt" onclick="toggleHabit('sleep')" data-h="sleep"><span>💤</span><label data-i18n="lang_h_sleep">Dormir Bien</label></div>
                    <div class="habit-opt" onclick="toggleHabit('exercise')" data-h="exercise"><span>🏋️</span><label data-i18n="lang_h_exercise">Ejercicio</label></div>
                    <div class="habit-opt" onclick="toggleHabit('food')" data-h="food"><span>🍎</span><label data-i18n="lang_h_food">Comer Sano</label></div>
                    <div class="habit-opt" onclick="toggleHabit('mobile')" data-h="mobile"><span>📵</span><label data-i18n="lang_h_mobile">Menos Móvil</label></div>
                    <div class="habit-opt" onclick="toggleHabit('read')" data-h="read"><span>📚</span><label data-i18n="lang_h_read">Aprender</label></div>
                    <div class="habit-opt" onclick="toggleHabit('water')" data-h="water"><span>💧</span><label data-i18n="lang_h_water">Beber Agua</label></div>
                    <div class="habit-opt" onclick="toggleHabit('meditate')" data-h="meditate"><span>🧠</span><label data-i18n="lang_h_meditate">Meditar</label></div>
                    <div class="habit-opt" onclick="toggleHabit('plan')" data-h="plan"><span>📅</span><label data-i18n="lang_h_plan">Planificar</label></div>
                    <div class="habit-opt" onclick="toggleHabit('thanks')" data-h="thanks"><span>✨</span><label data-i18n="lang_h_thanks">Agradecer</label></div>
                    <div class="habit-opt" onclick="toggleHabit('order')" data-h="order"><span>🏠</span><label data-i18n="lang_h_order">Orden</label></div>
                    <div class="habit-opt" onclick="toggleHabit('stretch')" data-h="stretch"><span>🧘</span><label data-i18n="lang_h_stretch">Pausas</label></div>
                    <div class="habit-opt" onclick="toggleHabit('journal')" data-h="journal"><span>📔</span><label data-i18n="lang_h_journal">Diario</label></div>
                </div>

                <!-- 3. GUÍA / PERSONALIDAD -->
                <label class="form-label">Elige tu Guía</label>
                <div class="personality-grid">
                    <div class="personality-opt" onclick="setPersonality('Colega sarcástico')" data-p="Colega sarcástico"><i>😎</i><span data-i18n="lang_pers_sarcastic">Sarcástico</span></div>
                    <div class="personality-opt" onclick="setPersonality('Sargento estricto')" data-p="Sargento estricto"><i>🎖️</i><span data-i18n="lang_pers_strict">Estricto</span></div>
                    <div class="personality-opt" onclick="setPersonality('Abuela cariñosa')" data-p="Abuela cariñosa"><i>🍪</i><span data-i18n="lang_pers_caring">Cariñosa</span></div>
                    <div class="personality-opt" onclick="setPersonality('Meme Lord')" data-p="Meme Lord"><i>🤡</i><span data-i18n="lang_pers_meme">Meme Lord</span></div>
                    <div class="personality-opt" onclick="setPersonality('Filósofo Estoico')" data-p="Filósofo Estoico"><i>🏛️</i><span data-i18n="lang_pers_stoic">Estoico</span></div>
                    <div class="personality-opt" onclick="setPersonality('Entrenador Personal')" data-p="Entrenador Personal"><i>💪</i><span data-i18n="lang_pers_coach">Coach</span></div>
                </div>

                <!-- 4. BIO & OBJETIVOS -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                    <div>
                        <label class="form-label" data-i18n="lang_age">Edad</label>
                        <input type="number" id="bio-age" value="25" style="width: 100%; background: var(--bg-dark); border: 1px solid var(--text-dim); color: var(--text-main); padding: 10px; border-radius: 8px;">
                    </div>
                    <div>
                        <label class="form-label" data-i18n="lang_job">Área Laboral</label>
                        <select id="bio-job" style="width: 100%; background: var(--bg-dark); border: 1px solid var(--text-dim); color: var(--text-main); padding: 10px; border-radius: 8px;">
                            <option value="Oficina" data-i18n="lang_job_office">Oficina / Tech</option>
                            <option value="Creativo" data-i18n="lang_job_creative">Creativo / Arte</option>
                            <option value="Manual" data-i18n="lang_job_manual">Manual / Físico</option>
                            <option value="Estudiante" data-i18n="lang_job_student">Estudiante</option>
                        </select>
                    </div>
                </div>

                <label class="form-label" data-i18n="lang_goals">Objetivos Primarios</label>
                <div class="personality-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 40px;">
                    <div class="personality-opt goal-opt" onclick="setGoal('Salud Mental')" data-g="Salud Mental"><i>🧘</i><span data-i18n="lang_goal_mental">Salud Mental</span></div>
                    <div class="personality-opt goal-opt" onclick="setGoal('Productividad')" data-g="Productividad"><i>🚀</i><span data-i18n="lang_goal_prod">Productividad</span></div>
                    <div class="personality-opt goal-opt" onclick="setGoal('Forma Física')" data-g="Forma Física"><i>💪</i><span data-i18n="lang_goal_fit">Forma Física</span></div>
                    <div class="personality-opt goal-opt" onclick="setGoal('Relaciones')" data-g="Relaciones"><i>🤝</i><span data-i18n="lang_goal_rel">Relaciones</span></div>
                    <div class="personality-opt goal-opt" onclick="setGoal('Finanzas')" data-g="Finanzas"><i>💰</i><span data-i18n="lang_goal_fin">Finanzas</span></div>
                    <div class="personality-opt goal-opt" onclick="setGoal('Creatividad')" data-g="Creatividad"><i>🎨</i><span data-i18n="lang_goal_creat">Creatividad</span></div>
                </div>

                <!-- BOTONES ACCIÓN -->
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <button type="submit" class="btn-sync" style="background: var(--neon-blue); color: #000; font-weight: 800;" data-i18n="lang_save">GUARDAR Y SINCRONIZAR</button>
                    <button type="button" class="btn-sync" style="background: rgba(255,255,255,0.05); color: var(--text-dim); border: 1px solid #303040;" onclick="closeSettings()" data-i18n="lang_back">Cerrar</button>
                </div>

                <input type="hidden" id="personalidadIA" value="Colega sarcástico">
                <input type="hidden" id="selectedAvatar" value="chick">
                <input type="hidden" id="selectedGoal" value="Productividad">
            </form>
        </div>
    </div>


    <!-- Main Content Area -->
    <div id="main-content-area">
        <div id="main-dashboard" class="container">
            <div class="evo-hub">
                <div class="evo-alert" id="evo-alert" data-i18n="lang_msg_protocol">¡PROTOCOLO PENDIENTE!</div>
                <div class="thought-bubble" id="thought-bubble" data-i18n="lang_msg_welcome">
                    Bienvenido. Iniciando tu ecosistema personal...
                </div>
                <div class="avatar-container" id="avatar-container">
                    <div class="env-visual"></div>
                    <div class="avatar-glow" id="avatar-glow"></div>
                    <div id="avatar-visual" class="avatar-visual">
                        <div class="evo-face" id="evo-face">
                            <div class="blush left"></div>
                            <div class="blush right"></div>
                            <div class="eye left" id="eye-l"><div class="eyelid"></div></div>
                            <div class="eye right" id="eye-r"><div class="eyelid"></div></div>
                            <div class="beak" id="beak"></div>
                            <div class="nose" id="nose"></div>
                        </div>
                    </div>
                </div>
                <div class="stats-panel">
                    <div class="stat-card"><label data-i18n="lang_foco">FOCO</label><div class="value" id="foco-value">0%</div><div class="stat-bar-bg"><div class="stat-bar-fill foco-color" id="foco-bar"></div></div></div>
                    <div class="stat-card"><label data-i18n="lang_energy">ENERGÍA</label><div class="value" id="energia-value">0%</div><div class="stat-bar-bg"><div class="stat-bar-fill energia-color" id="energia-bar"></div></div></div>
                    <div class="stat-card"><label data-i18n="lang_zen">ZEN</label><div class="value" id="zen-value">0%</div><div class="stat-bar-bg"><div class="stat-bar-fill zen-color" id="zen-bar"></div></div></div>
                </div>
                <div class="actions-grid">
                    <button class="action-btn" onclick="interact('work')"><i data-i18n="lang_work_ico">💻</i><strong data-i18n="lang_work">TRABAJAR</strong><span data-i18n="lang_work_desc">Foco+15|Energía-15</span></button>
                    <button class="action-btn" onclick="interact('rest')"><i data-i18n="lang_rest_ico">🧘</i><strong data-i18n="lang_rest">DESCANSAR</strong><span data-i18n="lang_rest_desc">Energía+15|Zen+15</span></button>
                    <button class="action-btn" onclick="interact('distraction')"><i data-i18n="lang_dist_ico">📱</i><strong data-i18n="lang_dist">DISTRACCIÓN</strong><span data-i18n="lang_dist_desc">Foco-15|Zen-15</span></button>
                </div>
            </div>
            <div class="habits-section">
                <h2 data-i18n="lang_plan_title">📋 Plan de Éxito Diario</h2>
                <div id="habits-list"><div style="text-align:center; padding: 20px; color: var(--text-dim);" data-i18n="lang_msg_loading">Cargando tu plan biótico...</div></div>
            </div>
        </div>
    </div>

    <div id="message" class="message"></div>

    <script>
    const API_URL = '/api';
    let tamagochi = {};
    let selectedHabits = [];

    const I18N = {
        es: {
            lang_foco: 'FOCO', lang_energy: 'ENERGÍA', lang_zen: 'ZEN',
            lang_work: 'TRABAJAR', lang_work_desc: 'Foco+15|Energía-15', lang_work_ico: '💻',
            lang_rest: 'DESCANSAR', lang_rest_desc: 'Energía+15|Zen+15', lang_rest_ico: '🧘',
            lang_dist: 'DISTRACCIÓN', lang_dist_desc: 'Foco-15|Zen-15', lang_dist_ico: '📱',
            lang_plan_title: '📋 Plan de Éxito Diario', lang_save: 'GUARDAR Y SINCRONIZAR',
            lang_options: '⚙️ Configuración', lang_logout: '🚪 Desconectar',
            lang_sync_title: 'Sincronización Evochii', lang_habits_title: 'Tus Hábitos Diarios',
            lang_age: 'Edad', lang_job: 'Área Laboral', lang_goals: 'Objetivos Primarios',
            lang_next: 'Siguiente Fase', lang_select_language: 'Idioma',
            lang_bio_profile: 'Perfil Biométrico', lang_back: 'Atrás',
            lang_select_avatar: 'Selecciona tu Evochii', lang_habitat: '🏡 Hábitat',
            lang_job_office: 'Oficina / Tech', lang_job_creative: 'Creativo / Arte', lang_job_manual: 'Manual / Físico', lang_job_student: 'Estudiante',
            lang_goal_mental: 'Salud Mental', lang_goal_prod: 'Productividad', lang_goal_fit: 'Forma Física', lang_goal_rel: 'Relaciones',
            lang_goal_fin: 'Finanzas', lang_goal_creat: 'Creatividad',
            lang_pers_sarcastic: 'Sarcástico', lang_pers_strict: 'Estricto', lang_pers_caring: 'Cariñoso', lang_pers_meme: 'Meme Lord', lang_pers_stoic: 'Estoico', lang_pers_coach: 'Coach',
            lang_h_sleep: 'Dormir Bien', lang_h_exercise: 'Ejercicio', lang_h_food: 'Comer Sano', lang_h_mobile: 'Menos Móvil',
            lang_h_read: 'Aprender', lang_h_water: 'Beber Agua', lang_h_meditate: 'Meditar', lang_h_plan: 'Planificar',
            lang_h_thanks: 'Agradecer', lang_h_order: 'Orden', lang_h_stretch: 'Pausas', lang_h_journal: 'Diario',
            lang_msg_sigh: 'Suspiro...', lang_msg_welcome: 'Bienvenido. Iniciando tu ecosistema personal...',
            lang_msg_pending_goals: 'Tienes metas por cumplir hoy...', lang_msg_habit_done: 'Hábito completado. Tu Evochii se siente mejor.',
            lang_msg_sync_ok: 'Evochii sincronizado con éxito.', lang_msg_select_habit: 'Selecciona al menos un hábito para tu evolución.',
            lang_msg_error_load: 'No pudimos cargar tus hábitos.', lang_msg_error_conn: 'Error de conexión con el Plan de Éxito.',
            lang_msg_no_habits: 'No hay hábitos configurados aún. Ve a Ajustes.', lang_msg_streak: 'RACHA',
            lang_msg_loading: 'Cargando tu plan biótico...', lang_msg_protocol: '¡PROTOCOLO PENDIENTE!'
        },
        en: {
            lang_foco: 'FOCUS', lang_energy: 'ENERGY', lang_zen: 'ZEN',
            lang_work: 'WORK', lang_work_desc: 'Focus+15|Energy-15', lang_work_ico: '💻',
            lang_rest: 'REST', lang_rest_desc: 'Energy+15|Zen+15', lang_rest_ico: '🧘',
            lang_dist: 'DISTRACTION', lang_dist_desc: 'Focus-15|Zen-15', lang_dist_ico: '📱',
            lang_plan_title: '📋 Daily Success Plan', lang_save: 'SAVE & SYNC',
            lang_options: '⚙️ Settings', lang_logout: '🚪 Logout',
            lang_sync_title: 'Evochii Sync', lang_habits_title: 'Your Daily Habits',
            lang_age: 'Age', lang_job: 'Work Area', lang_goals: 'Primary Goals',
            lang_next: 'Next Phase', lang_select_language: 'Language',
            lang_bio_profile: 'Biometric Profile', lang_back: 'Back',
            lang_select_avatar: 'Select your Evochii', lang_habitat: '🏡 Habitat',
            lang_job_office: 'Office / Tech', lang_job_creative: 'Creative / Art', lang_job_manual: 'Manual / Physical', lang_job_student: 'Student',
            lang_goal_mental: 'Mental Health', lang_goal_prod: 'Productivity', lang_goal_fit: 'Fitness', lang_goal_rel: 'Relationships',
            lang_goal_fin: 'Finance', lang_goal_creat: 'Creativity',
            lang_pers_sarcastic: 'Sarcastic', lang_pers_strict: 'Strict', lang_pers_caring: 'Caring', lang_pers_meme: 'Meme Lord', lang_pers_stoic: 'Stoic', lang_pers_coach: 'Coach',
            lang_h_sleep: 'Sleep Well', lang_h_exercise: 'Exercise', lang_h_food: 'Healthy Food', lang_h_mobile: 'Less Phone',
            lang_h_read: 'Learn', lang_h_water: 'Drink Water', lang_h_meditate: 'Meditate', lang_h_plan: 'Plan',
            lang_h_thanks: 'Be Grateful', lang_h_order: 'Order', lang_h_stretch: 'Breaks', lang_h_journal: 'Journal',
            lang_msg_sigh: 'Sigh...', lang_msg_welcome: 'Welcome. Starting your personal ecosystem...',
            lang_msg_pending_goals: 'You have goals to fulfill today...', lang_msg_habit_done: 'Habit completed. Your Evochii feels better.',
            lang_msg_sync_ok: 'Evochii synced successfully.', lang_msg_select_habit: 'Select at least one habit for your evolution.',
            lang_msg_error_load: 'Could not load your habits.', lang_msg_error_conn: 'Error connecting to the Success Plan.',
            lang_msg_no_habits: 'No habits configured. Go to Settings.', lang_msg_streak: 'STREAK',
            lang_msg_loading: 'Loading your biotic plan...', lang_msg_protocol: 'PENDING PROTOCOL!'
        },
        pt: {
            lang_foco: 'FOCO', lang_energy: 'ENERGIA', lang_zen: 'ZEN',
            lang_work: 'TRABALHAR', lang_work_desc: 'Foco+15|Energia-15', lang_work_ico: '💻',
            lang_rest: 'DESCANSAR', lang_rest_desc: 'Energia+15|Zen+15', lang_rest_ico: '🧘',
            lang_dist: 'DISTRAÇÃO', lang_dist_desc: 'Foco-15|Zen-15', lang_dist_ico: '📱',
            lang_plan_title: '📋 Plano de Sucesso Diário', lang_save: 'SALVAR E SINCRONIZAR',
            lang_options: '⚙️ Configuração', lang_logout: '🚪 Sair',
            lang_sync_title: 'Sincronização Evochii', lang_habits_title: 'Seus Hábitos Diários',
            lang_age: 'Idade', lang_job: 'Área de Trabajo', lang_goals: 'Objetivos Primários',
            lang_next: 'Próxima Fase', lang_select_language: 'Idioma',
            lang_bio_profile: 'Perfil Biométrico', lang_back: 'Voltar',
            lang_select_avatar: 'Selecione seu Evochii', lang_habitat: '🏡 Habitat',
            lang_job_office: 'Escritório / Tech', lang_job_creative: 'Criativo / Arte', lang_job_manual: 'Manual / Físico', lang_job_student: 'Estudante',
            lang_goal_mental: 'Saúde Mental', lang_goal_prod: 'Produtividade', lang_goal_fit: 'Forma Física', lang_goal_rel: 'Relacionamentos',
            lang_goal_fin: 'Finanças', lang_goal_creat: 'Criatividade',
            lang_pers_sarcastic: 'Sarcástico', lang_pers_strict: 'Estrito', lang_pers_caring: 'Carinhoso', lang_pers_meme: 'Meme Lord', lang_pers_stoic: 'Estoico', lang_pers_coach: 'Treinador',
            lang_h_sleep: 'Dormir Bem', lang_h_exercise: 'Exercício', lang_h_food: 'Comer Saudável', lang_h_mobile: 'Menos Telemóvel',
            lang_h_read: 'Aprender', lang_h_water: 'Beber Água', lang_h_meditate: 'Meditar', lang_h_plan: 'Planear',
            lang_h_thanks: 'Agradecer', lang_h_order: 'Ordem', lang_h_stretch: 'Pausas', lang_h_journal: 'Diário',
            lang_msg_sigh: 'Suspiro...', lang_msg_welcome: 'Bem-vindo. Iniciando seu ecossistema...',
            lang_msg_pending_goals: 'Você tem metas hoje...', lang_msg_habit_done: 'Hábito concluído. Seu Evochii sente-se melhor.',
            lang_msg_sync_ok: 'Evochii sincronizado com sucesso.', lang_msg_select_habit: 'Selecione pelo menos um hábito.',
            lang_msg_error_load: 'Erro ao carregar hábitos.', lang_msg_error_conn: 'Erro de conexão com o Plano de Sucesso.',
            lang_msg_no_habits: 'Sem hábitos configurados. Vá em Ajustes.', lang_msg_streak: 'SEQUÊNCIA',
            lang_msg_loading: 'Carregando seu plano biótico...', lang_msg_protocol: 'PROTOCOLO PENDENTE!'
        },
        de: {
            lang_foco: 'FOKUS', lang_energy: 'ENERGIE', lang_zen: 'ZEN',
            lang_work: 'ARBEITEN', lang_work_desc: 'Fokus+15|Energie-15', lang_work_ico: '💻',
            lang_rest: 'AUSRUHEN', lang_rest_desc: 'Energie+15|Zen+15', lang_rest_ico: '🧘',
            lang_dist: 'ABLENKUNG', lang_dist_desc: 'Fokus-15|Zen-15', lang_dist_ico: '📱',
            lang_plan_title: '📋 Täglicher Erfolgsplan', lang_save: 'SPEICHERN & SYNC',
            lang_options: '⚙️ Einstellung', lang_logout: '🚪 Abmelden',
            lang_sync_title: 'Evochii-Synchronisation', lang_habits_title: 'Deine täglichen Gewohnheiten',
            lang_age: 'Alter', lang_job: 'Arbeitsbereich', lang_goals: 'Primäre Ziele',
            lang_next: 'Nächste Phase', lang_select_language: 'Sprache',
            lang_bio_profile: 'Biometrisches Profil', lang_back: 'Zurück',
            lang_select_avatar: 'Wähle dein Evochii', lang_habitat: '🏡 Habitat',
            lang_job_office: 'Büro / Technik', lang_job_creative: 'Kreativ / Kunst', lang_job_manual: 'Manual / Physisch', lang_job_student: 'Student',
            lang_goal_mental: 'Mentale Gesundheit', lang_goal_prod: 'Produktivität', lang_goal_fit: 'Fitness', lang_goal_rel: 'Beziehungen',
            lang_goal_fin: 'Finanzen', lang_goal_creat: 'Kreativität',
            lang_pers_sarcastic: 'Sarkastisch', lang_pers_strict: 'Strikt', lang_pers_caring: 'Fürsorglich', lang_pers_meme: 'Meme Lord', lang_pers_stoic: 'Stoisch', lang_pers_coach: 'Trainer',
            lang_h_sleep: 'Gut Schlafen', lang_h_exercise: 'Sport', lang_h_food: 'Gesund Essen', lang_h_mobile: 'Weniger Handy',
            lang_h_read: 'Lernen', lang_h_water: 'Wasser Trinken', lang_h_meditate: 'Meditieren', lang_h_plan: 'Planen',
            lang_h_thanks: 'Dankbar Sein', lang_h_order: 'Ordnung', lang_h_stretch: 'Pausas', lang_h_journal: 'Tagebuch',
            lang_msg_sigh: 'Seufz...', lang_msg_welcome: 'Willkommen. Starte dein Ökosystem...',
            lang_msg_pending_goals: 'Ziele für heute...', lang_msg_habit_done: 'Gewohnheit erledigt. Dein Evochii fühlt sich besser.',
            lang_msg_sync_ok: 'Evochii synchronisiert.', lang_msg_select_habit: 'Wähle mindestens eine Gewohnheit.',
            lang_msg_error_load: 'Gewohnheiten laden fehlgeschlagen.', lang_msg_error_conn: 'Verbindung zum Erfolgsplan fehlgeschlagen.',
            lang_msg_no_habits: 'Keine Gewohnheiten. Gehe zu Einstellungen.', lang_msg_streak: 'SERIE',
            lang_msg_loading: 'Lade dein biotisches Plan...', lang_msg_protocol: 'PROTOKOLL AUSSTEHEND!'
        },
        fr: {
            lang_foco: 'FOCUS', lang_energy: 'ÉNERGIE', lang_zen: 'ZEN',
            lang_work: 'TRAVAILLER', lang_work_desc: 'Focus+15|Énergie-15', lang_work_ico: '💻',
            lang_rest: 'REPOSER', lang_rest_desc: 'Énergie+15|Zen+15', lang_rest_ico: '🧘',
            lang_dist: 'DISTRACTION', lang_dist_desc: 'Focus-15|Zen-15', lang_dist_ico: '📱',
            lang_plan_title: '📋 Plan de Succès Quotidien', lang_save: 'ENREGISTRER & SYNC',
            lang_options: '⚙️ Config', lang_logout: '🚪 Déconnexion',
            lang_sync_title: 'Synchronisation Evochii', lang_habits_title: 'Vos Habitudes Quotidiennes',
            lang_age: 'Âge', lang_job: 'Domaine de Travail', lang_goals: 'Objectifs Primaires',
            lang_next: 'Phase Suivante', lang_select_language: 'Langue',
            lang_bio_profile: 'Profil Biométrique', lang_back: 'Retour',
            lang_select_avatar: 'Choisissez votre Evochii', lang_habitat: '🏡 Habitat',
            lang_job_office: 'Bureau / Tech', lang_job_creative: 'Créatif / Art', lang_job_manual: 'Manuel / Physique', lang_job_student: 'Étudiant',
            lang_goal_mental: 'Santé Mentale', lang_goal_prod: 'Productividad', lang_goal_fit: 'Forme Physique', lang_goal_rel: 'Relations',
            lang_goal_fin: 'Finances', lang_goal_creat: 'Créativité',
            lang_pers_sarcastic: 'Sarcástico', lang_pers_strict: 'Strict', lang_pers_caring: 'Affectueux', lang_pers_meme: 'Meme Lord', lang_pers_stoic: 'Stoïque', lang_pers_coach: 'Coach',
            lang_h_sleep: 'Bien Dormir', lang_h_exercise: 'Exercice', lang_h_food: 'Manger Sain', lang_h_mobile: 'Moins de Portable',
            lang_h_read: 'Apprendre', lang_h_water: 'Boire de l\'Eau', lang_h_meditate: 'Méditer', lang_h_plan: 'Planifier',
            lang_h_thanks: 'Remercier', lang_h_order: 'Ordre', lang_h_stretch: 'Pauses', lang_h_journal: 'Journal',
            lang_msg_sigh: 'Soupir...', lang_msg_welcome: 'Bienvenue. Lancement de votre écosystème...',
            lang_msg_pending_goals: 'Objectifs à remplir...', lang_msg_habit_done: 'Habitude terminée. Votre Evochii se sent mieux.',
            lang_msg_sync_ok: 'Evochii synchronisé.', lang_msg_select_habit: 'Choisissez au moins une habitude.',
            lang_msg_error_load: 'Erreur chargement habitudes.', lang_msg_error_conn: 'Erreur connexion au Plan de Succès.',
            lang_msg_no_habits: 'Pas d\'habitudes. Allez dans Config.', lang_msg_streak: 'SÉRIE',
            lang_msg_loading: 'Chargement de votre plan biotique...', lang_msg_protocol: 'PROTOCOLE EN ATTENTE!'
        }
    };

    const AVATARS = {
        'chick': {'normal':'🐤','exhausted':'🐣','stressed':'😫','high':'🤩'},
        'robot': {'normal':'🤖','exhausted':'📴','stressed':'💢','high':'🚀'},
        'frog': {'normal':'🐸','exhausted':'🛌','stressed':'😨','high':'👑'},
        'fox': {'normal':'🦊','exhausted':'🥀','stressed':'🦊','high':'🔥'},
        'hamster': {'normal':'🐹','exhausted':'💤','stressed':'🐹','high':'🥜'},
        'owl': {'normal':'🦉','exhausted':'🌑','stressed':'🦉','high':'🧿'},
        'lion': {'normal':'🦁','exhausted':'🥀','stressed':'🦁','high':'👑'},
        'tiger': {'normal':'🐯','exhausted':'🌫️','stressed':'🐯','high':'🧡'},
        'raccoon': {'normal':'🦝','exhausted':'🗑️','stressed':'🦝','high':'💎'},
        'wizard': {'normal':'🧙','exhausted':'💀','stressed':'🧙','high':'🪄'},
        'cat': {'normal':'🐱','exhausted':'😿','stressed':'😾','high':'😻'},
        'dog': {'normal':'🐶','exhausted':'🐕','stressed':'🐩','high':'🥰'},
        'panda': {'normal':'🐼','exhausted':'🐨','stressed':'🐼','high':'🎋'},
        'alien': {'normal':'👽','exhausted':'👾','stressed':'👽','high':'👾'},
        'dragon': {'normal':'🐲','exhausted':'🐉','stressed':'🐲','high':'🔥'}
    };

    let isPerformingAction = false;

    function setLanguage(lang) {
        currentLang = lang;
        localStorage.setItem('evo_lang', lang);
        updateUI();
    }

    function updateUI() {
        try {
            const dict = I18N[currentLang] || I18N['es'];
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.dataset.i18n;
                if (dict[key]) {
                    if (el.tagName === 'INPUT' && el.placeholder) el.placeholder = dict[key];
                    else el.textContent = dict[key];
                }
            });
            // Títulos y botones específicos
            const optBtn = document.querySelector('button[onclick="openSettings()"]');
            if (optBtn) optBtn.title = dict['lang_options'] || 'Configuración';
        } catch(e) { console.error("Error en updateUI:", e); }
    }

    window.addEventListener('DOMContentLoaded', () => {
        // Ejecución inmediata de sistemas visuales
        try {
            updateUI();
            updateClock();
            updateTheme();
            startAlertSystem();
        } catch(e) { console.error("Error UI inicial:", e); }

        const token = localStorage.getItem('auth_token');
        if (!token) { 
            setTimeout(() => { if (!localStorage.getItem('auth_token')) window.location.href = '/login'; }, 1000); 
            return; 
        }
        
        // Carga de Datos persistentes
        loadTamagochi();
        loadHabits();

        if (window.location.pathname === '/configuration') openSettings();
    });

    function updateTheme() {
        const date = new Date();
        const hour = date.getHours();
        const month = date.getMonth() + 1;
        const body = document.body;
        const container = document.getElementById('avatar-container');
        const env = container.querySelector('.env-visual');

        // Día/Noche
        if (hour >= 8 && hour < 20) body.classList.add('light-mode');
        else body.classList.remove('light-mode');

        // Estaciones
        container.classList.remove('winter', 'spring', 'summer', 'autumn');
        let season = 'autumn';
        if ([12, 1, 2].includes(month)) season = 'winter';
        else if ([3, 4, 5].includes(month)) season = 'spring';
        else if ([6, 7, 8].includes(month)) season = 'summer';
        container.classList.add(season);

        // Generar Entorno (Emojis)
        spawnParticles(season, hour);
    }

    function spawnParticles(season, hour) {
        const env = document.querySelector('.env-visual');
        env.innerHTML = ''; // Limpiar
        
        // Astros
        const isDay = hour >= 8 && hour < 20;
        const celestial = document.createElement('div');
        celestial.className = 'celestial-body';
        celestial.textContent = isDay ? '☀️' : (season === 'winter' ? '🏔️' : '🌙');
        env.appendChild(celestial);

        // Partículas
        const configs = {
            winter: { emoji: '❄️', count: 8 },
            spring: { emoji: '🌸', count: 6 },
            summer: { emoji: '🔥', count: 4 },
            autumn: { emoji: '🍂', count: 7 }
        };
        const conf = configs[season];
        for(let i=0; i<conf.count; i++) {
            const p = document.createElement('div');
            p.className = 'particle';
            p.textContent = conf.emoji;
            p.style.left = Math.random() * 100 + '%';
            p.style.setProperty('--d', (4 + Math.random() * 6) + 's');
            p.style.animationDelay = (Math.random() * 5) + 's';
            p.style.fontSize = (0.8 + Math.random() * 0.7) + 'rem';
            env.appendChild(p);
        }
    }

    function setLanguage(lang) {
        currentLang = lang;
        localStorage.setItem('evo_lang', lang);
        updateUI();
        updateClock();
        showMessage((I18N[lang] || I18N['es'])['lang_save'] + '...', 'success');
    }

    function toggleHabit(h) {
        const el = document.querySelector(`.habit-opt[data-h="${h}"]`);
        const idx = selectedHabits.indexOf(h);
        if (idx > -1) {
            selectedHabits.splice(idx, 1);
            if (el) el.classList.remove('selected');
        } else {
            selectedHabits.push(h);
            if (el) el.classList.add('selected');
        }
    }

    function setPersonality(p) {
        document.querySelectorAll('.personality-opt').forEach(el => el.classList.remove('selected'));
        const selected = document.querySelector(`.personality-opt[data-p="${p}"]`);
        if (selected) selected.classList.add('selected');
        document.getElementById('personalidadIA').value = p;
    }

    function setAvatar(key) {
        document.querySelectorAll('.avatar-opt').forEach(el => el.classList.remove('selected'));
        const selected = document.querySelector(`.avatar-opt[data-key="${key}"]`);
        if (selected) selected.classList.add('selected');
        document.getElementById('selectedAvatar').value = key;
    }

    function setGoal(g) {
        document.querySelectorAll('.goal-opt').forEach(el => el.classList.remove('selected'));
        const selected = document.querySelector(`.goal-opt[data-g="${g}"]`);
        if (selected) selected.classList.add('selected');
        document.getElementById('selectedGoal').value = g;
    }

    async function loadTamagochi() {
        updateUI(); 
        const token = localStorage.getItem('auth_token');
        try {
            const res = await fetch(`${API_URL}/tamagochi`, { headers: {'Authorization':`Bearer ${token}`,'Accept':'application/json'} });
            const data = await res.json();
            if (res.ok && data.data) {
                tamagochi = data.data;
                if (!tamagochi.avatar) {
                    showOnboarding(); 
                } else {
                    updateDisplay(); 
                }
                if (tamagochi.current_thought) showThought(tamagochi.current_thought);
            }
        } catch(e){ 
            console.error("Error loadTamagochi:", e);
            const dict = I18N[currentLang] || I18N['es'];
            showMessage(dict['lang_msg_error_conn'] || 'Error', 'error');
        }
    }

    function showOnboarding() { document.getElementById('onboarding-screen').style.display='flex'; document.getElementById('main-dashboard').style.opacity='0.1'; }

    document.getElementById('onboarding-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const token = localStorage.getItem('auth_token');
        const dict = I18N[currentLang] || I18N['es'];
        if (selectedHabits.length === 0) { showMessage(dict['lang_msg_select_habit'], 'error'); return; }
        
        const payload = { 
            contextoVital: JSON.stringify({
                habitos: selectedHabits,
                edad: document.getElementById('bio-age').value,
                trabajo: document.getElementById('bio-job').value,
                objetivo: document.getElementById('selectedGoal').value,
                timestamp_sync: new Date().toISOString()
            }),
            personalidadIA: document.getElementById('personalidadIA').value,
            avatar: document.getElementById('selectedAvatar').value,
            habits: selectedHabits
        };
        try {
            const res = await fetch(`${API_URL}/tamagochi/sync`, {
                method: 'POST', headers: {'Authorization':`Bearer ${token}`,'Content-Type':'application/json','Accept':'application/json'},
                body: JSON.stringify(payload)
            });
            if (res.ok) { 
                loadHabits();
                loadTamagochi();
                const dict = I18N[currentLang] || I18N['es'];
                showMessage(dict['lang_msg_sync_ok'], 'success');
                closeSettings();
            }
        } catch(e){ console.error(e); }
    });

    async function interact(action) {
        const token = localStorage.getItem('auth_token');
        try {
            const res = await fetch(`${API_URL}/tamagochi/interact`, {
                method: 'POST', headers: {'Authorization':`Bearer ${token}`,'Content-Type':'application/json','Accept':'application/json'},
                body: JSON.stringify({action})
            });
            const data = await res.json();
            if (res.ok) { tamagochi = data.data; updateDisplay(); showThought(data.thought); }
        } catch(e){ console.error(e); }
    }

    function updateDisplay() {
        document.getElementById('foco-value').textContent = `${tamagochi.foco}%`;
        document.getElementById('foco-bar').style.width = `${tamagochi.foco}%`;
        document.getElementById('energia-value').textContent = `${tamagochi.energy}%`;
        document.getElementById('energia-bar').style.width = `${tamagochi.energy}%`;
        document.getElementById('zen-value').textContent = `${tamagochi.zen}%`;
        document.getElementById('zen-bar').style.width = `${tamagochi.zen}%`;
        if (tamagochi.current_thought) showThought(tamagochi.current_thought);
        updateAvatarVisual();
    }

    function updateAvatarVisual() {
        const face = document.getElementById('evo-face');
        const visual = document.getElementById('avatar-visual');
        const glow = document.getElementById('avatar-glow');
        const beak = document.getElementById('beak');
        const nose = document.getElementById('nose');
        
        const avatarType = tamagochi.avatar || 'chick';
        console.log("Rendering Species:", avatarType);
        
        // RESET ANATOMY AGGRESSIVELY
        face.className = 'evo-face'; 
        face.classList.add(`face-${avatarType}`);
        
        // BEAK: Only for birds (chick, owl, penguin)
        const birds = ['chick', 'owl', 'penguin'];
        if (birds.includes(avatarType)) {
            beak.style.display = 'block';
        } else {
            beak.style.display = 'none';
        }

        // NOSE: Only for certain mammals/creatures
        const hasNose = ['cat', 'dog', 'fox', 'koala', 'monkey', 'panda', 'dragon', 'unicorn', 'lion', 'tiger', 'raccoon', 'hamster'];
        if (hasNose.includes(avatarType)) {
            nose.style.display = 'block';
        } else {
            nose.style.display = 'none';
        }

        // BLUSH: Only for biological beings
        const organic = ['chick', 'frog', 'cat', 'dog', 'panda', 'dragon', 'unicorn', 'monkey', 'owl', 'fox', 'koala', 'penguin', 'lion', 'tiger', 'raccoon', 'hamster'];
        document.querySelectorAll('.blush').forEach(b => b.style.opacity = organic.includes(avatarType) ? '0.3' : '0');

        visual.classList.remove('anim-idle', 'anim-happy', 'anim-tired', 'anim-stressed', 'anim-focus');
        glow.classList.remove('state-exhausted', 'state-stressed', 'state-high');

        let anim = 'anim-idle';
        const pendingHabits = document.querySelectorAll('.habit-item:not(.completed)').length;

        if (tamagochi.energy < 30) { 
            anim = 'anim-tired'; glow.classList.add('state-exhausted');
        } else if (tamagochi.zen < 30 || pendingHabits > 0) { 
            anim = 'anim-stressed'; glow.classList.add('state-stressed');
        } else if (tamagochi.foco > 80) {
            anim = 'anim-focus';
        } else if (tamagochi.energy > 75 && tamagochi.zen > 75) { 
            anim = 'anim-happy'; glow.classList.add('state-high');
        }
        
        visual.classList.add(anim);
        
        if (!window.randomMotor) window.randomMotor = setInterval(triggerRandomAction, 8000);
    }

    function triggerRandomAction() {
        if (isPerformingAction) return;
        const eyeL = document.getElementById('eye-l');
        const eyeR = document.getElementById('eye-r');
        const beak = document.getElementById('beak');
        const nose = document.getElementById('nose');
        
        const actions = [
            { name: 'blink', apply: () => { eyeL.classList.add('blink'); eyeR.classList.add('blink'); setTimeout(() => { eyeL.classList.remove('blink'); eyeR.classList.remove('blink'); }, 150); }, dur: 300 },
            { name: 'wink', apply: () => { eyeR.classList.add('blink'); setTimeout(() => eyeR.classList.remove('blink'), 400); }, dur: 500 },
            { name: 'sigh', apply: () => { 
                beak.style.transform = 'translateY(5px) scale(1.3)'; 
                nose.style.transform = 'translateY(3px) scale(1.1)';
                showThought((I18N[currentLang] || I18N['es'])['lang_msg_sigh'] || 'Sigh...'); 
                setTimeout(() => { beak.style.transform = 'translateY(0) scale(1)'; nose.style.transform = 'translateY(0) scale(1)'; }, 1500); 
            }, dur: 1600 }
        ];
        
        const action = actions[Math.floor(Math.random() * actions.length)];
        isPerformingAction = true;
        action.apply();
        
        setTimeout(() => { isPerformingAction = false; }, action.dur);
    }

    function showThought(text) {
        const b = document.getElementById('thought-bubble');
        b.textContent = text; b.style.borderColor = 'var(--neon-green)';
        setTimeout(() => b.style.borderColor = 'var(--neon-blue)', 2000);
    }

    async function loadHabits() {
        const token = localStorage.getItem('auth_token');
        const list = document.getElementById('habits-list');
        try {
            const res = await fetch(`${API_URL}/habits`, { headers: {'Authorization':`Bearer ${token}`,'Accept':'application/json'} });
            const data = await res.json();
            if (res.ok) { 
                renderHabits(data.data); 
                checkAlerts(data.data); 
            } else {
                const dict = I18N[currentLang] || I18N['es'];
                list.innerHTML = `<div style="text-align:center; padding: 20px; color: var(--neon-pink);">${dict['lang_msg_error_load']}</div>`;
            }
        } catch(e){ 
            console.error("Error loadHabits:", e);
            const dict = I18N[currentLang] || I18N['es'];
            list.innerHTML = `<div style="text-align:center; padding: 20px; color: var(--neon-pink);">${dict['lang_msg_error_conn']}</div>`;
        }
    }

    function renderHabits(habits) {
        const list = document.getElementById('habits-list');
        const dict = I18N[currentLang] || I18N['es'];
        if (!habits || habits.length === 0) {
            list.innerHTML = `<div style="text-align:center; padding: 20px; color: var(--text-dim);">${dict['lang_msg_no_habits']}</div>`;
            return;
        }
        list.innerHTML = habits.map(h => `
            <div class="habit-card ${h.completed_today?'completed':''}">
                <div class="habit-check ${h.completed_today?'checked':''}" onclick="completeHabit(${h.id})">${h.completed_today?'✓':''}</div>
                <div style="flex:1"><div>${h.name}</div><div style="font-size:0.7em;color:var(--text-dim)">${(I18N[currentLang]||I18N['es'])['lang_msg_streak']}: ${h.current_streak} 🔥</div></div>
                <div style="color:var(--neon-blue);font-size:0.8em">+${h.reward_energy}⚡</div>
            </div>
        `).join('');
    }

    async function completeHabit(id) {
        const token = localStorage.getItem('auth_token');
        try {
            const res = await fetch(`${API_URL}/habits/${id}/complete`, { method:'POST', headers:{'Authorization':`Bearer ${token}`,'Accept':'application/json'} });
            if (res.ok) { 
                loadHabits(); 
                loadTamagochi(); 
                const dict = I18N[currentLang] || I18N['es'];
                showMessage(dict['lang_msg_habit_done'], 'success'); 
            }
        } catch(e){ console.error(e); }
    }

    function showView(view) {
        const dashboard = document.getElementById('main-dashboard');
        const config = document.getElementById('onboarding-screen');
        const onboardingTitle = document.getElementById('onboarding-title');

        if (view === 'config') {
            dashboard.style.display = 'none';
            config.style.display = 'flex';
            onboardingTitle.textContent = (I18N[currentLang] || I18N['es'])['lang_options'].replace('⚙️ ', '');
            history.pushState(null, '', '/configuration');
        } else {
            dashboard.style.display = 'flex';
            dashboard.style.opacity = '1';
            config.style.display = 'none';
            history.pushState(null, '', '/dashboard');
        }
    }

    function openSettings() {
        showView('config');
    }

    function closeSettings() {
        showView('dashboard');
    }

    function startAlertSystem() {
        // No llamamos a updateTheme aquí si ya se llamó en el inicio
        setInterval(() => { try { updateTheme(); } catch(e){} }, 60000); 
        setInterval(() => { try { updateClock(); } catch(e){} }, 1000);
        setInterval(() => { if (tamagochi && tamagochi.id) loadHabits(); }, 60000);
    }

    function updateClock() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');
        const timeStr = `${h}:${m}:${s}`;
        
        const dateStr = now.toLocaleDateString(currentLang, { weekday: 'long', day: 'numeric', month: 'long' });
        
        const timeEl = document.getElementById('h-time');
        const dateEl = document.getElementById('h-date');
        if (timeEl) timeEl.textContent = timeStr;
        if (dateEl) dateEl.textContent = dateStr;
    }

    function checkAlerts(habits) {
        if (!habits) return;
        const pending = habits.filter(h => !h.completed_today);
        const alert = document.getElementById('evo-alert');
        if (pending.length > 0) {
            alert.style.display = 'block';
            const dict = I18N[currentLang] || I18N['es'];
            if (Math.random() > 0.8) showThought(dict['lang_msg_pending_goals']);
        } else {
            alert.style.display = 'none';
        }
    }

    function showMessage(msg, type) { const m = document.getElementById('message'); m.textContent = msg; m.className = `message show ${type}`; setTimeout(() => m.className='message', 4000); }
    function logout() { localStorage.removeItem('auth_token'); window.location.href = '/login'; }

    // PERSISTENCE & THEME INITIALIZATION
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

    // BOOT
    setMode(currentMode);
    loadTamagochi();
    startAlertSystem();
    updateClock();
    </script>
</body>
</html>
