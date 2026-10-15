<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SISPEG</title>

    <link rel="icon" type="image/png" href="{{ asset('img/ikon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body, html {
            height: 100%; margin: 0; font-family: 'Open Sans', sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("{{ asset('img/login.png') }}");
            background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat;
        }

        .login-wrapper { height: 100vh; display: flex; align-items: center; justify-content: center; padding: 15px; position: relative; }

        .login-container {
            display: flex; width: 100%; max-width: 900px; color: white;
            align-items: stretch; background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px); border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3); overflow: visible; position: relative;
        }

        .brand-section { flex: 1.2; text-align: right; padding: 100px 60px; display: flex; flex-direction: column; justify-content: flex-start; position: relative; }
        .brand-section::after { content: ""; position: absolute; right: 0; top: 15%; height: 70%; width: 2px; background: rgba(255, 255, 255, 0.2); }
        .brand-section h1 { font-size: 5.5rem; font-weight: 700; margin: 0; letter-spacing: -4px; line-height: 1; }
        .brand-section .slogan { font-size: 1.1rem; font-weight: 300; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; margin-top: 10px; }

        .brand-section .desc { 
            font-size: 17px !important; 
            font-weight: 700 !important; 
            margin-top: 18px !important; 
            opacity: 1; 
            line-height: 1.3; 
        }

        .form-section { flex: 1; padding: 60px; display: flex; flex-direction: column; justify-content: center; position: relative; }
        
        .form-section h2 { 
            font-size: 2rem; 
            font-weight: 800 !important; 
            margin-bottom: 40px; 
            color: #ffffff; 
        }

        .input-group-custom { position: relative; margin-bottom: 35px; border-bottom: 2px solid rgba(255, 255, 255, 0.8); }

        .form-control-custom {
            background: transparent !important; border: none !important; border-radius: 0 !important;
            color: white !important; font-size: 1.3rem; font-weight: 400 !important;
            padding: 10px 0; width: 100%; box-shadow: none !important; outline: none !important;
        }

        input:-webkit-autofill {
            -webkit-background-clip: text;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
            box-shadow: inset 0 0 20px 20px transparent !important;
        }

        .password-toggle { position: absolute; right: 0; top: 15px; cursor: pointer; color: rgba(255, 255, 255, 0.6); font-size: 1.2rem; }

        .btn-masuk {
            background: #1a1a2e; color: #ffffff; border: none; border-radius: 8px;
            padding: 14px; font-weight: 700; width: 100%; margin-top: 15px;
            letter-spacing: 2px; transition: all 0.3s ease; text-transform: uppercase;
        }

        #loader-overlay {
            display: none; 
            position: fixed; 
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.05); 
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
            box-shadow: 0 0 15px rgba(26, 26, 46, 0.4);
        }

        .loading-dots div:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots div:nth-child(3) { animation-delay: 0.4s; }

        @keyframes move-right-smooth {
            from { transform: translateX(0); opacity: 0.4; }
            to { transform: translateX(20px); opacity: 1; }
        }

        @media (max-width: 768px) {
            .brand-section h1 { font-size: 3.5rem; }
            .login-container { flex-direction: column; padding: 30px 20px; margin-bottom: 90px; }
            .brand-section::after { display: none; }
            .brand-section .desc { font-size: 16px !important; margin-top: 20px !important; }
            .notif-guest-wrapper { bottom: -110px !important; }
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

    <div class="login-wrapper">
        <div class="login-container">
            <div class="brand-section">
                <h1>SISPEG</h1>
                <div class="slogan">Sistem Informasi Kepegawaian</div>
                <div class="desc">
                    Balai Pemasyarakatan Kelas II Magelang
                </div>
            </div>

            <div class="form-section">
                <h2>Login Admin</h2>

                {{-- Alert untuk Error Login --}}
                @if($errors->any())
                    <div class="alert alert-danger py-2 mb-3" style="font-size: 0.85rem; background: rgba(255,0,0,0.4); border: none; color: white;">
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Alert untuk Success Ganti Password --}}
                @if(session('success'))
                    <div class="alert alert-success py-2 mb-3" style="font-size: 0.85rem; background: rgba(40, 167, 69, 0.4); border: none; color: white;">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="loginForm" action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="input-group-custom">
                        <input type="email" name="email" class="form-control-custom" placeholder="Email Address" required autofocus autocomplete="off">
                    </div>

                    <div class="input-group-custom">
                        <input type="password" name="password" id="passInput" class="form-control-custom" placeholder="Password" required>
                        <i class="bi bi-eye-slash password-toggle" id="eyeIcon" onclick="togglePass()"></i>
                    </div>

                    {{-- Link Lupa Password --}}
                    @include('form_lupapass')
                    
                    <button type="submit" class="btn-masuk" id="btnMasuk">MASUK</button>
                </form>
            </div>

            {{-- PEMANGGILAN NOTIFIKASI GUEST MELAYANG DI BAWAH KOTAK UTAMA --}}
            @include('komponen.akun_tamu')
        </div>
    </div>

    <script>
        function togglePass() {
            const input = document.getElementById("passInput");
            const icon = document.getElementById("eyeIcon");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            } else {
                input.type = "password";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            }
        }

        document.getElementById('loginForm').addEventListener('submit', function() {
            document.getElementById('loader-overlay').style.display = 'flex';
            const btn = document.getElementById('btnMasuk');
            btn.disabled = true;
            btn.innerText = 'MEMPROSES...';
            btn.style.opacity = '0.8';
        });
    </script>
</body>
</html>