<style>
    :root {
        --lebar-samping: 260px;
        --lebar-samping-mini: 95px; 
        --warna-aksen-biru: #4361ee;
        --warna-glow: rgba(67, 97, 238, 0.4);
        --bg-samping: #1a1a2e; 
        --transisi-premium: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        --posisi-y-indikator: 0px;
        --tinggi-indikator: 65px; 
    }

    .sidebar-initializing * { transition: none !important; }

    .bilah-samping { 
        width: var(--lebar-samping); 
        background: var(--bg-samping); 
        height: 100vh; 
        position: fixed; 
        left: 0; top: 0; 
        z-index: 1050; 
        border-radius: 0 40px 40px 0; 
        display: flex; 
        flex-direction: column; 
        transition: var(--transisi-premium);
        box-shadow: 15px 0 50px rgba(0,0,0,0.2);
        overflow: visible; 
    }

    .btn-toggle-custom {
        position: absolute;
        right: -14px; top: 50%;
        transform: translateY(-50%);
        width: 30px; height: 30px;
        background-color: var(--warna-aksen-biru); 
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: white;
        border: 3px solid var(--bg-samping); 
        z-index: 1100;
        transition: var(--transisi-premium);
        box-shadow: 5px 0 15px rgba(0,0,0,0.2);
    }

    .btn-toggle-custom:hover { transform: translateY(-50%) scale(1.1); background-color: #3046c8; }
    .sidebar-is-mini .btn-toggle-custom i { transform: rotate(180deg); }

    .merk-samping { 
        padding: 40px 25px; 
        display: flex; align-items: center; gap: 15px; 
        transition: var(--transisi-premium);
        white-space: nowrap; height: 120px;
    }

    /* Penyesuaian Styling Logo Custom Gambar */
    .merk-samping .logo-sispeg-img { 
        width: 42px; 
        height: 42px; 
        object-fit: contain; 
        min-width: 42px; 
        flex-shrink: 0;
        transition: var(--transisi-premium);
    }

    .merk-samping span { font-size: 1.6rem; font-weight: 800; color: white; transition: var(--transisi-premium); }

    .sidebar-is-mini .merk-samping { padding: 40px 0; justify-content: center; }
    .sidebar-is-mini .merk-samping .logo-sispeg-img { width: 36px; height: 36px; min-width: 36px; }
    .sidebar-is-mini .merk-samping span { opacity: 0; width: 0; display: none; }

    .navigasi-wadah { position: relative; padding: 0 10px; flex-grow: 1; }

    .pembatas-nav {
        height: 1px;
        background: rgba(255,255,255,0.1);
        margin: 15px 20px;
        transition: var(--transisi-premium);
    }

    .sidebar-is-mini .pembatas-nav { margin: 15px 10px; }

    .indikator-nav { 
        position: absolute; 
        left: 10px; 
        width: calc(100% - 20px); 
        height: var(--tinggi-indikator); 
        background: linear-gradient(90deg, rgba(67, 97, 238, 0.2) 0%, rgba(67, 97, 238, 0.0) 100%);
        border-radius: 14px; 
        transform: translateY(var(--posisi-y-indikator));
        transition: var(--transisi-premium); 
        z-index: 0; 
        border-left: 5px solid var(--warna-aksen-biru);
        box-shadow: -5px 0 15px var(--warna-glow);
        pointer-events: none; 
        opacity: 0; 
        top: 0;
    }

    .tautan-nav { 
        color: rgba(255,255,255,0.4); 
        text-decoration: none; 
        display: flex; 
        align-items: center; 
        height: var(--tinggi-indikator); 
        padding: 0 25px;
        transition: var(--transisi-premium); 
        border-radius: 15px;
        margin-bottom: 8px; 
        position: relative; 
        z-index: 1;
        cursor: pointer;
    }

    .tautan-nav.aktif { color: white !important; }

    .tautan-nav i {
        font-size: 1.4rem;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transisi-premium);
        z-index: 2;
    }

    .tautan-nav span {
        font-size: 13px;
        font-weight: 500;
        position: absolute;
        left: 80px;
        transition: var(--transisi-premium);
        white-space: nowrap;
        opacity: 1;
    }

    .sidebar-is-mini .bilah-samping { width: var(--lebar-samping-mini); }

    .sidebar-is-mini .tautan-nav {
        padding: 0;
        justify-content: center;
    }

    .sidebar-is-mini .tautan-nav i { transform: translateY(-10px); }

    .sidebar-is-mini .tautan-nav span {
        left: 50%;
        transform: translateX(-50%) translateY(18px);
        font-size: 10px;
        opacity: 0.8;
    }

    .wadah-keluar {
        padding: 20px 10px;
        margin-top: auto;
    }

    .tombol-keluar { 
        background: rgba(255,77,77,0.1);
        color: #ff4d4d;
        border: none;
        width: 100%; 
        height: var(--tinggi-indikator);
        border-radius: 15px; 
        display: flex;
        align-items: center;
        padding: 0 25px;
        transition: var(--transisi-premium);
        cursor: pointer;
        position: relative;
    }

    .tombol-keluar i {
        min-width: 45px;
        display: flex;
        justify-content: center;
        transition: var(--transisi-premium);
    }

    .tombol-keluar span {
        font-weight: bold;
        font-size: 12px;
        position: absolute;
        left: 80px;
        transition: var(--transisi-premium);
    }

    .sidebar-is-mini .tombol-keluar {
        padding: 0;
        justify-content: center;
    }

    .sidebar-is-mini .tombol-keluar i { transform: translateY(-10px); }

    .sidebar-is-mini .tombol-keluar span {
        left: 50%;
        transform: translateX(-50%) translateY(18px);
        font-size: 10px;
    }
</style>

<script>
    (function() {
        const status = localStorage.getItem('sidebarStatus');

        if (status === 'mini') {
            document.documentElement.classList.add('sidebar-is-mini');

            document.addEventListener("DOMContentLoaded", function() {
                document.body.classList.add('sidebar-is-mini');
            });
        }
    })();
</script>

<aside class="bilah-samping" id="bilahSamping">
    <div class="btn-toggle-custom" onclick="toggleSidebarMini()">
        <i class="bi bi-caret-left-fill"></i>
    </div>

    <!-- PENGGUNAAN LOGO LOGO-SISPEG.PNG -->
    <div class="merk-samping">
        <img src="{{ asset('img/logo-sispeg.png') }}" alt="Logo SISPEG" class="logo-sispeg-img">
        <span>SISPEG</span>
    </div>
    
    <div class="navigasi-wadah">
        <div class="indikator-nav" id="penandaNav"></div>
        
        <a href="{{ route('dashboard') }}" class="tautan-nav {{ request()->routeIs('dashboard') ? 'aktif' : '' }}">
            <i class="bi bi-columns-gap"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('pegawai.data') }}" class="tautan-nav {{ request()->routeIs('pegawai.data') ? 'aktif' : '' }}">
            <i class="bi bi-person-badge"></i>
            <span>Data Pegawai</span>
        </a>

        <a href="{{ route('mutasi.index') }}" class="tautan-nav {{ request()->routeIs('mutasi.index') ? 'aktif' : '' }}">
            <i class="bi bi-arrow-left-right"></i>
            <span>Mutasi</span>
        </a>

        <a href="{{ route('pegawai.satya') }}" class="tautan-nav {{ request()->routeIs('pegawai.satya') ? 'aktif' : '' }}">
            <i class="bi bi-award"></i>
            <span>Satyalancana</span>
        </a>

        <a href="{{ route('pensiun.index') }}" class="tautan-nav {{ request()->routeIs('pensiun.index') ? 'aktif' : '' }}">
            <i class="bi bi-person-down"></i>
            <span>Pensiun</span>
        </a>

        <div class="pembatas-nav"></div>

        <a href="{{ route('pegawai.export') }}?tab=total" class="tautan-nav">
            <i class="bi bi-download"></i>
            <span>Export Excel</span>
        </a>
    </div>

    <div class="wadah-keluar">

        {{-- FORM LOGOUT --}}
        <form action="{{ route('logout') }}" method="POST" id="formLogout">
            @csrf

            <button 
                type="submit"
                class="tombol-keluar"
                data-bs-toggle="modal"
                data-bs-target="#modalKonfirmasiKeluar"
            >
                <i class="bi bi-power"></i>
                <span>KELUAR</span>
            </button>
        </form>

    </div>
</aside>

<script>
    function updateIndikator() {
        const aktif = document.querySelector('.tautan-nav.aktif');
        const ind = document.getElementById('penandaNav');

        if (aktif && ind) {
            const container = document.querySelector('.navigasi-wadah').getBoundingClientRect();
            const rect = aktif.getBoundingClientRect();

            document.documentElement.style.setProperty(
                '--posisi-y-indikator',
                (rect.top - container.top) + 'px'
            );

            ind.style.opacity = '1';
        }
    }

    function toggleSidebarMini() {
        const html = document.documentElement;
        const body = document.body;

        html.classList.remove('sidebar-initializing');

        const isNowMini = html.classList.toggle('sidebar-is-mini');

        if (body) {
            body.classList.toggle('sidebar-is-mini', isNowMini);
        }

        localStorage.setItem('sidebarStatus', isNowMini ? 'mini' : 'full');

        setTimeout(updateIndikator, 150);
    }

    window.addEventListener('load', () => {
        document.documentElement.classList.add('sidebar-initializing');

        if(document.documentElement.classList.contains('sidebar-is-mini')) {
            document.body.classList.add('sidebar-is-mini');
        }

        updateIndikator();

        requestAnimationFrame(() => {
            setTimeout(() => {
                document.documentElement.classList.remove('sidebar-initializing');
            }, 300);
        });
    });

    window.addEventListener('resize', updateIndikator);
</script>