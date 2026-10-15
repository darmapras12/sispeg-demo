<div class="notif-guest-wrapper" style="position: absolute; bottom: -85px; left: 0; width: 100%; text-align: center; z-index: 20;">
    <div class="card p-2 border-0 rounded-4 shadow-lg mx-auto" style="background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2) !important; max-width: 780px;">
        <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
            <small class="text-white fw-semibold d-flex align-items-center gap-1" style="font-size: 12px;">
                <i class="bi bi-exclamation-circle-fill text-danger fs-6"></i>
                <span>Silakan login menggunakan akun Tamu/Guest untuk menguji fitur sistem tanpa akun Admin.</span>
            </small>
            <a href="{{ route('login.demo') }}" class="btn btn-danger btn-sm rounded-pill fw-bold px-3 py-1 text-white shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 11.5px; text-decoration: none;">
                <i class="bi bi-play-circle-fill"></i> Masuk Mode Guest/Tamu
            </a>
        </div>
        <div class="text-white-50 mt-1" style="font-size: 10px;">
            *Data yang dimasukkan tidak tersimpan permanen dan terhapus otomatis saat sesi berikutnya dimulai.
        </div>
    </div>
</div>