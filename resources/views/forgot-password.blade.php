<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - SISPEG BAPAS MAGELANG</title>

    <link rel="icon" type="image/png" href="{{ asset('img/ikon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body, html {
            height: 100%; margin: 0; font-family: 'Open Sans', sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("{{ asset('img/login.png') }}");
            background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center;
            background-attachment: fixed;
        }
        .reset-container {
            width: 100%; max-width: 480px; padding: 40px; color: white;
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(15px);
            border-radius: 25px; border: 1px solid rgba(255, 255, 255, 0.2); text-align: center;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }

        /* Brand Header */
        .brand-section { margin-bottom: 30px; }
        .brand-title { font-size: 2.2rem; font-weight: 700; letter-spacing: 3px; margin-bottom: 0; color: #ffffff; }
        .brand-subtitle { font-size: 0.9rem; font-weight: 400; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.8); margin-bottom: 5px; }
        .brand-location { font-size: 0.85rem; font-weight: 600; color: #f8b400; text-transform: uppercase; }

        /* Judul Ganti Password - Dibuat Bold 800 */
        .title-ganti { 
            font-weight: 800 !important; 
            margin-bottom: 25px; 
            font-size: 1.2rem; 
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Input Styling */
        .input-group-custom { 
            position: relative; margin-bottom: 25px; 
            border-bottom: 2px solid rgba(255, 255, 255, 0.8); 
            display: flex; align-items: center;
            background: transparent !important;
        }
        
        .form-control-custom {
            background: transparent !important;
            border: none !important;
            color: white !important;
            font-size: 1.1rem;
            padding: 10px 0;
            width: 100%;
            outline: none !important;
            box-shadow: none !important;
        }   

        input:-webkit-autofill {
            -webkit-background-clip: text;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 20px 20px transparent !important;
        }

        .password-toggle {
            position: absolute; right: 0; cursor: pointer; color: rgba(255, 255, 255, 0.6);
            font-size: 1.2rem; z-index: 10;
        }

        /* Button */
        .btn-reset {
            background: #1a1a2e; color: #ffffff; border: none; border-radius: 8px;
            padding: 14px; font-weight: 700; width: 100%; text-transform: uppercase; 
            transition: 0.3s; margin-top: 10px; letter-spacing: 1px;
        }
        .btn-reset:hover:not(:disabled) { background: #16213e; transform: translateY(-2px); }

        /* --- STYLING LOADING 3 TITIK TENGAH LAYAR --- */
        #loader-overlay {
            display: none; 
            position: fixed; 
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.2);
            z-index: 9999; 
            justify-content: center; 
            align-items: center;
        }

        .loading-dots { display: flex; gap: 12px; }
        .loading-dots div {
            width: 18px; height: 18px;
            background: #1a1a2e; 
            border-radius: 50%;
            animation: move-right-smooth 0.6s infinite alternate;
        }

        .loading-dots div:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots div:nth-child(3) { animation-delay: 0.4s; }

        @keyframes move-right-smooth {
            from { transform: translateX(0); opacity: 0.4; }
            to { transform: translateX(20px); opacity: 1; }
        }

        .mini-alert {
            font-size: 0.8rem; background: rgba(255, 60, 60, 0.2);
            border: 1px solid rgba(255, 60, 60, 0.5); color: #ffcccc;
            padding: 8px; border-radius: 10px; margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div id="loader-overlay">
        <div class="loading-dots">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="reset-container">
        <div class="brand-section">
            <h1 class="brand-title">SISPEG</h1>
            <div class="brand-subtitle">Sistem Informasi Kepegawaian</div>
            <div class="brand-location">Balai Pemasyarakatan Kelas II Magelang</div>
        </div>

        <h4 class="title-ganti">Ganti Password Admin</h4>
        
        @if($errors->any())
            <div class="mini-alert">
                <i class="bi bi-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.update.langsung') }}" method="POST" id="resetForm">
            @csrf
            
            <div class="input-group-custom">
                <input type="email" name="email" class="form-control-custom" placeholder="Email Admin" required autocomplete="off">
            </div>

            <div class="input-group-custom">
                <input type="password" name="password" id="passInput" class="form-control-custom" placeholder="Password Baru" required>
                <i class="bi bi-eye-slash password-toggle" id="togglePass1"></i>
            </div>

            <div class="input-group-custom">
                <input type="password" name="password_confirmation" id="confPassInput" class="form-control-custom" placeholder="Konfirmasi Password" required>
                <i class="bi bi-eye-slash password-toggle" id="togglePass2"></i>
            </div>

            <button type="submit" class="btn-reset" id="btnSubmit">
                <span id="btnText">Simpan Perubahan</span>
            </button>
        </form>
        
        <a href="{{ route('login') }}" style="display:block; margin-top:25px; color:white; opacity:0.7; text-decoration:none; font-size: 0.8rem;">
            <i class="bi bi-arrow-left"></i> Kembali ke Login
        </a>
    </div>

    <script>
        // Logic Toggle Password
        const setupToggle = (iconId, inputId) => {
            const icon = document.getElementById(iconId);
            const input = document.getElementById(inputId);
            if(icon && input) {
                icon.addEventListener('click', function () {
                    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                    input.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        };
        setupToggle('togglePass1', 'passInput');
        setupToggle('togglePass2', 'confPassInput');

        // Logic Loading 3 Bola
        const form = document.getElementById('resetForm');
        const btn = document.getElementById('btnSubmit');
        const overlay = document.getElementById('loader-overlay');
        const txt = document.getElementById('btnText');

        if(form) {
            form.addEventListener('submit', function() {
                btn.disabled = true;
                overlay.style.display = 'flex';
                txt.innerText = 'Memproses...';
            });
        }
    </script>
</body>
</html>