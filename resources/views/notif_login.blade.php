@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Kostumisasi gaya agar lebih elegan & glassmorphism */
        .swal2-toast-custom {
            backdrop-filter: blur(10px) !important;
            background: rgba(26, 26, 46, 0.8) !important; /* Warna gelap khas Bapas */
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5) !important;
        }
        .swal2-title-custom {
            color: #ffffff !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
        }
    </style>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top', // Posisikan tepat di tengah atas
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            customClass: {
                popup: 'swal2-toast-custom',
                title: 'swal2-title-custom'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown' // Animasi turun dari atas
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp' // Animasi naik saat hilang
            }
        });

        Toast.fire({
            icon: 'success',
            iconColor: '#f8b400', // Warna emas agar senada dengan logo/branding Bapas
            title: "{{ session('success') }}"
        });
    </script>
@endif