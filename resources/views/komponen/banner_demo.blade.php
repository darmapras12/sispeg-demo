@if(Auth::check() && Auth::user()->email === 'guest@demo.com')
<div class="alert alert-warning border-0 shadow-sm rounded-0 m-0 py-2 text-center fw-medium" style="background-color: #fef3c7; color: #92400e; position: sticky; top: 0; z-index: 2000; font-size: 13px;">
    <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
    <strong>Informasi Akun Demo:</strong> Anda sedang login menggunakan akun <u>Guest Demo</u>. Silakan mencoba menginputkan data untuk menguji sistem SISPEG. Data yang di-inputkan tidak tersimpan secara permanen dan akan terhapus otomatis saat sesi demo berikutnya dimulai.
</div>
@endif