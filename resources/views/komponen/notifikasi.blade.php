{{-- NOTIFIKASI SUKSES --}}
@if(session('success'))
<div id="alert-berhasil" class="alert-custom-wrapper">
    <div class="alert-custom-content bg-sukses">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-success me-3">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">Berhasil!</h6>
                    <small>{{ session('success') }}</small>
                </div>
            </div>
            <button type="button" class="btn-close-custom" onclick="tutupNotifikasi('alert-berhasil')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="progress-container">
            <div id="progress-bar-sukses" class="progress-bar-fill"></div>
        </div>
    </div>
</div>
@endif

{{-- NOTIFIKASI ERROR / AKSES DIBATASI --}}
@if(session('error'))
<div id="alert-error" class="alert-custom-wrapper">
    <div class="alert-custom-content bg-error">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-danger me-3">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">Akses Dibatasi!</h6>
                    <small>{{ session('error') }}</small>
                </div>
            </div>
            <button type="button" class="btn-close-custom" onclick="tutupNotifikasi('alert-error')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="progress-container">
            <div id="progress-bar-error" class="progress-bar-fill"></div>
        </div>
    </div>
</div>
@endif

{{-- NOTIFIKASI INFO --}}
@if(session('info'))
<div id="alert-info" class="alert-custom-wrapper">
    <div class="alert-custom-content bg-info-custom">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-white text-info me-3">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">Informasi!</h6>
                    <small>{{ session('info') }}</small>
                </div>
            </div>
            <button type="button" class="btn-close-custom" onclick="tutupNotifikasi('alert-info')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="progress-container">
            <div id="progress-bar-info" class="progress-bar-fill"></div>
        </div>
    </div>
</div>
@endif

<style>
    .alert-custom-wrapper {
        position: relative;
        z-index: 1000;
        margin-bottom: 20px;
        animation: slideDownCustom 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .alert-custom-content {
        color: white;
        padding: 15px 20px;
        border-radius: 12px;
        position: relative;
        overflow: hidden;
    }

    .bg-sukses {
        background: linear-gradient(45deg, #198754, #20c997);
        box-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);
    }

    .bg-error {
        background: linear-gradient(45deg, #dc3545, #f87171);
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.25);
    }

    .bg-info-custom {
        background: linear-gradient(45deg, #0dcaf0, #38bdf8);
        box-shadow: 0 10px 20px rgba(13, 202, 240, 0.2);
    }

    .icon-circle {
        width: 32px; height: 32px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }

    .btn-close-custom {
        background: rgba(255, 255, 255, 0.2);
        border: none; color: white;
        border-radius: 5px; width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        transition: 0.3s;
    }

    .btn-close-custom:hover { background: rgba(255, 255, 255, 0.4); }

    .progress-container {
        position: absolute; bottom: 0; left: 0;
        width: 100%; height: 4px; background: rgba(0,0,0,0.1);
    }

    .progress-bar-fill {
        height: 100%; background: rgba(255,255,255,0.7); width: 100%;
    }

    @keyframes slideDownCustom {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideUpFadeCustom {
        from { transform: translateY(0); opacity: 1; }
        to { transform: translateY(-30px); opacity: 0; }
    }

    .hide-alert {
        animation: slideUpFadeCustom 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards !important;
    }
</style>

<script>
    function tutupNotifikasi(idElement) {
        const alert = document.getElementById(idElement);
        if (alert) {
            alert.classList.add('hide-alert');
            setTimeout(() => { alert.remove(); }, 500);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const jalankanTimerNotif = (idAlert, idBar) => {
            const alertElement = document.getElementById(idAlert);
            const progressBar = document.getElementById(idBar);
            if (!alertElement) return;

            const duration = 4000; // 4 Detik
            let start = Date.now();

            const timer = setInterval(() => {
                let timePassed = Date.now() - start;
                let progress = 100 - (timePassed / duration * 100);
                if (progressBar) progressBar.style.width = progress + '%';
                if (timePassed >= duration) {
                    clearInterval(timer);
                    tutupNotifikasi(idAlert);
                }
            }, 10);
        };

        jalankanTimerNotif('alert-berhasil', 'progress-bar-sukses');
        jalankanTimerNotif('alert-error', 'progress-bar-error');
        jalankanTimerNotif('alert-info', 'progress-bar-info');
    });
</script>